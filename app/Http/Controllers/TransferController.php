<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Retrieve transfers associated with the user
        $transfers = Transfer::where('user_id', $user->id)->get();


        return view('transfer.index', [
            'transfers' => $transfers
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all the user's wallets
        $wallets = Wallet::where('holder_id', auth()->id())->get();

        // Retrieve all the user's accounts
        $accounts = Account::where('user_id', auth()->id())->get();

        // Pass the wallets and accounts to the create view
        return view('transfer.create', compact('wallets', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'from_id' => 'required',
            'to_id' => 'required',
            'fee' => 'required|numeric|min:0',
            // Add more validation rules as needed
        ]);

        // Check if the fee is greater than the amount in the wallet
        $fromWallet = Wallet::find($validatedData['from_id']);
        if ($validatedData['fee'] > $fromWallet->amount) {
            return redirect()->back()->with('error', 'Insufficient funds in wallet.');
        }

        // Check if the fee is less than 500
        if ($validatedData['fee'] < 500) {
            return redirect()->back()->with('error', 'Transfer fee must be at least 500.');
        }

        // Process and store the transfer data
        $transfer = new Transfer();
        $transfer->from_id = $validatedData['from_id'];
        $transfer->to_id = $validatedData['to_id'];
        $transfer->fee = $validatedData['fee'];
        $transfer->user_id = auth()->id();
        $transfer->discount = 20;
        $transfer->uuid = Str::uuid();
        $transfer->save();

        // Redirect back to the page with a success message
        return redirect()->route('transfer.index')->with('success', 'Transfer created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $transfer)
    {
        return view('transfer.show', [
            'transfer' => Transfer::findOrFail($transfer)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $borrower)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $borrower)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $borrower, Request $request)
    {

    }

}
