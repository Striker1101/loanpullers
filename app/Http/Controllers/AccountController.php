<?php

namespace App\Http\Controllers;

use App\Models\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Retrieve bank accounts belonging to the authenticated user
        $bankAccounts = Account::where('user_id', $user->id)
            ->where('account_type', 'bank')
            ->where(function ($query) use ($request) {
                $search = $request->input('search');
                $query->where('account_name', 'like', "%$search%")
                    ->orWhere('account_number', 'like', "%$search%")
                    ->orWhere('bank_name', 'like', "%$search%")
                    ->orWhere('bank_branch', 'like', "%$search%")
                    ->orWhere('swift_code', 'like', "%$search%")
                    ->orWhere('routing_number', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('bank_address', 'like', "%$search%");
            })
            ->paginate(10);

        // Retrieve crypto accounts belonging to the authenticated user
        $cryptoAccounts = Account::where('user_id', $user->id)
            ->where('account_type', 'crypto')
            ->where(function ($query) use ($request) {
                $search = $request->input('search');
                $query->where('account_name', 'like', "%$search%")
                    ->orWhere('account_number', 'like', "%$search%")
                    ->orWhere('crypto_wallet_address', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->paginate(10);

        // Pass both bank and crypto accounts under the 'accounts' variable
        $accounts = [
            'bank' => $bankAccounts,
            'crypto' => $cryptoAccounts,
        ];

        return view('account.index', compact('accounts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // Return the create form view with borrowers and loan types
        return view('account.create', ['account' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // Add validation rules for all fields here
            'account_type' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required_if:account_type,bank|string',
            'bank_name' => 'required_if:account_type,bank|string',
            'bank_branch' => 'required_if:account_type,bank|string',
            'swift_code' => 'required_if:account_type,bank|string',
            'routing_number' => 'required_if:account_type,bank|string',
            'bank_address' => 'required_if:account_type,bank|string',
            'crypto_wallet_address' => 'required_if:account_type,crypto|string',
            'description' => 'nullable|string',
            // Add other fields as needed
        ]);


        // Determine the account type
        $accountType = $validatedData['account_type'];

        // Create a new account instance based on the account type
        $account = new Account();
        $account->fill($validatedData);
        $account->user_id = auth()->id();

        // Save the account
        $account->save();

        // Optionally, you can add a success message or redirect the user
        return redirect()->route('account.index')->with('success', 'Account created successfully');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Account $account)
    {
        // Return a view with the specific loan data
        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $loan
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Account $account)
    {
        // Return the edit form view with the specific loan data
        return view('account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Account $account)
    {
        // Validate the incoming request data based on the account type
        $validatedData = [];
        if ($account->account_type === 'bank') {
            $validatedData = $request->validate([
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'bank_branch' => 'required|string|max:255',
                'bank_address' => 'required|string|max:255',
                'swift_code' => 'required|string|max:255',
                'routing_number' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
        } elseif ($account->account_type === 'crypto') {
            $validatedData = $request->validate([
                'account_name' => 'required|string|max:255',
                'crypto_wallet_address' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
        }

        // Set the user_id
        $account->user_id = auth()->id();

        // Update the account with the validated data
        $account->update($validatedData);

        // Redirect back to the account index page with a success message
        return redirect()->route('account.index')->with('success', 'Account updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $account, Request $request)
    {
        try {
            $check_password = Hash::check($request->password, auth()->user()->password);
            if (!$check_password) {
                return redirect()->back()->with('error', 'Incorrect password. Unable to delete.');
            }
            $borrower = Account::findOrFail($account);
            $borrower->delete();
            return redirect()->route('account.index')->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('account.index')->with('error', 'Whoops! Something went wrong. Please try again.');
        }
    }


}
