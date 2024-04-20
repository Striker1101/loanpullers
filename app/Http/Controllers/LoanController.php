<?php

namespace App\Http\Controllers;

use App\Filament\Resources\LoanResource\Pages\DefaultedLoans;
use App\Models\Borrower;
use App\Models\Loan;
use App\Models\LoanAgreementForms;
use App\Models\LoanSettlementForms;
use App\Models\LoanType;
use App\Tables\Columns\LoanTableView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $loans = Loan::where('user_id', $user->id)->paginate(10); // Assuming user_id is the foreign key in the loans table
        $search = $request->input('search');

        $loans = Loan::query()
            ->where('user_id', 'like', "%$search%")
            ->orWhere('borrower_id', 'like', "%$search%")
            ->orWhere('loan_type_id', 'like', "%$search%")
            ->orWhere('loan_status', 'like', "%$search%")
            ->orWhere('principal_amount', 'like', "%$search%")
            ->orWhere('loan_release_date', 'like', "%$search%")
            ->orWhere('loan_duration', 'like', "%$search%")
            ->orWhere('duration_period', 'like', "%$search%")
            ->orWhere('transaction_reference', 'like', "%$search%")
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // Retrieve all borrowers and loan types
        $borrowers = Borrower::all();
        $loanTypes = LoanType::all();

        // Return the create form view with borrowers and loan types
        return view('loan.create', compact('borrowers', 'loanTypes'));
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
            'borrower_id' => 'required|exists:borrowers,id',
            'loan_type_id' => 'required|exists:loan_types,id',
            'principal_amount' => 'required|numeric',
            'repayment_amount' => 'required|numeric',
            'loan_due_date' => 'required|date',
            'loan_duration' => 'required|string',
            'interest_amount' => 'required|numeric',
            'duration_period' => 'required|string',
            'transaction_reference' => 'string'
            // Add other validation rules as needed
        ]);

        try {
            // Create a new loan instance
            $loan = new Loan();
            $loan->fill($validatedData);

            // Generate a unique loan number (if needed)
            $loan->loan_number = $this->generateUniqueLoanNumber();
            $loan->user_id = auth()->user()->id;
            $loan->loan_release_date = null;
            $loan->balance = $loan->principal_amount;
            $loan->activate_loan_agreement_form = false;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images'); // Store the image in the 'images' directory
                // Save the image path to the 'imgpath' field of the Loan model
                $loan->imgpath = $imagePath;
            }
            // Save the loan
            $loan->save();

            // If form submission is successful
            return redirect()->back()->with('success', 'Loan created successfully');
        } catch (\Exception $e) {
            // If there's an error during loan creation
            return redirect()->back()->with('error', 'An error occurred while creating the loan: ' . $e->getMessage());
        }
    }



    // Function to generate a unique loan number
    private function generateUniqueLoanNumber()
    {
        // Generate a unique loan number logic here
        // Example: return 'LN-' . uniqid();
        return 'LN-' . uniqid();
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Contracts\View\Factory|Illuminate\Contracts\View\View
     */
    public function show(Loan $loan)
    {
        // Return a view with the specific loan data
        return view('loan.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Loan $loan)
    {
        // Return the edit form view with the specific loan data
        return view('loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        // Validate the request data
        $request->validate([
            // Define your validation rules here
        ]);

        // Update the loan attributes with the request data
        $loan->update([
            // Update loan attributes with request data
        ]);

        // Redirect to the index page with success message
        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        // Delete the loan from the database
        $loan->delete();

        // Redirect to the index page with success message
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }

    public function requested(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Query builder to filter loans with loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'requested')
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);
        return view('loan.index', compact('loans'));
    }

    public function processing(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Query builder to filter loans with loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'processing')
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }


    public function approved(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Query builder to filter loans with loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }

    public function denied(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Query builder to filter loans with loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'denied')
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }

    public function DefaultedLoans(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Query builder to filter loans with loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'default')
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }



    public function penalty(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $today = Carbon::today()->toDateString();

        // Query builder to filter loans with loan_due_date in the past and loan_status = 'processing'
        $loans = Loan::where('user_id', $user->id)
            ->where('loan_status', 'processing')
            ->where('loan_due_date', '<', $today)
            ->where(function ($query) use ($search) {
                $query->where('user_id', 'like', "%$search%")
                    ->orWhere('borrower_id', 'like', "%$search%")
                    ->orWhere('loan_type_id', 'like', "%$search%")
                    ->orWhere('loan_status', 'like', "%$search%")
                    ->orWhere('principal_amount', 'like', "%$search%")
                    ->orWhere('loan_release_date', 'like', "%$search%")
                    ->orWhere('loan_duration', 'like', "%$search%")
                    ->orWhere('duration_period', 'like', "%$search%")
                    ->orWhere('transaction_reference', 'like', "%$search%");
            })
            ->paginate(10);

        return view('loan.index', compact('loans'));
    }

    public function agreemenet_form()
    {
        $forms = LoanAgreementForms::with('loan_type')->paginate(1);
        return view('loan.form', compact('forms'));
    }

    public function settlement_form()
    {
        $forms = LoanSettlementForms::paginate(1);
        return view('loan.form', compact('forms'));
    }
}
