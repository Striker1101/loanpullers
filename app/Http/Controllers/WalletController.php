<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Retrieve wallets belonging to the authenticated user
        $wallets = Wallet::where('holder_id', $user->id)
            ->where(function ($query) use ($request) {
                $search = $request->input('search');
                $query->where('name', 'like', "%$search%")
                    ->orWhere('slug', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('meta', 'like', "%$search%")
                    ->orWhere('balance', 'like', "%$search%")
                    ->orWhere('amount', 'like', "%$search%");
            })
            ->paginate(10);

        return view('wallet.index', compact('wallets'));
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // Return the create form view with borrowers and loan types
        return view('wallet.create', ['wallet' => null]);
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:wallets',
            'description' => 'nullable|string',
            'meta' => 'nullable|string',
        ]);

        try {
            // Create a new wallet instance
            $wallet = new Wallet();
            $wallet->fill($validatedData);
            $wallet->holder_id = auth()->id();
            $wallet->holder_type = 'App\Models\User';
            $wallet->balance = 0;
            $wallet->amount = 0;
            $wallet->uuid = Str::uuid();

            // Save the wallet
            $wallet->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Wallet created successfully.');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create wallet: ' . $e->getMessage())->withInput();
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Wallet $wallet)
    {
        // Return a view with the specific loan data
        return view('wallet.show', compact('wallet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $loan
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Wallet $wallet)
    {
        // Return the edit form view with the specific loan data
        return view('wallet.create', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Wallet $wallet)
    {
        dd($wallet);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'meta' => 'required|string|in:USD,AED,CAD',

        ]);

        // Update the wallet with the validated data
        $wallet->update($validatedData);

        // Redirect back to the wallet index page with a success message
        return redirect()->route('wallet.index')->with('success', 'Wallet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Wallet $wallet)
    {
        // Delete the loan from the database
        $wallet->delete();

        // Redirect to the index page with success message
        return redirect()->route('wallet.index')->with('success', 'Loan deleted successfully.');
    }


}
