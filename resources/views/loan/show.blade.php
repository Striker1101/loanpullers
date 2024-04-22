@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')

@extends('layouts.link', ['location' => 'Show Loan', 'locations' => [['name' => 'Loan', 'route' => 'loan.index', 'active' => false], ['name' => $loan->id, 'route' => '', 'active' => true]]])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Loan Details</div>

                    <div class="card-body">
                        {{-- loan type --}}
                        <h2>Loan Type</h2>
                        <p><strong>Loan Name</strong>{{ $loan->loan_type->loan_name }}</p>
                        <p><strong>Interest Rate</strong>{{ $loan->loan_type->interest_rate }}</p>
                        <p><strong>Interest Rate</strong>{{ $loan->loan_type->interest_rate }}</p>

                        <hr>
                        <hr>

                        <p><strong>Loan Number:</strong> {{ $loan->loan_number }}</p>
                        <p><strong>Loan Status:</strong> {{ ucfirst($loan->loan_status) }}</p>
                        <p><strong>Principal Amount:</strong> ${{ number_format($loan->principal_amount, 2) }}</p>
                        <p><strong>Repayment Amount:</strong> ${{ number_format($loan->repayment_amount, 2) }}</p>
                        <p><strong>Loan Due Date</strong>{{ $loan->loan_due_date }}</p>
                        <p><strong>Loan Duration</strong>{{ $loan->loan_duration . ' ' . $loan->duration_period }}</p>
                        <!-- Add more loan details here as needed -->
                        <hr>
                        <hr>
                        {{-- borrower --}}

                        <h2>Borrowers Details</h2>
                        <img src="{{ asset('storage/' . $loan->borrower->attachment) }}" alt="borrowers img">
                        <p><strong>Name: </strong> {{ $loan->borrower->full_name }}</p>
                        <p><strong>Bank Name: </strong>{{ $loan->borrower->bank_name }}</p>
                        <p><strong>Bank Branch: </strong>{{ $loan->borrower->bank_branch }}</p>
                        <p><strong>Bank Sort Code: </strong>{{ $loan->borrower->bank_sort_code }}</p>
                        <p><strong>Bank Account Name: </strong>{{ $loan->borrower->bank_account_name }}</p>
                        <p><strong>Bank Account Number: </strong>{{ $loan->borrower->bank_account_number }}</p>
                        <p> <strong>Mobile</strong>{{ $loan->borrower->mobile }}</p>

                        <!-- Display loan agreement file if available -->
                        @if ($loan->loan_agreement_file_path)
                            <p><strong>Loan Agreement File:</strong> <a
                                    href="{{ asset('storage/' . $loan->loan_agreement_file_path) }}" target="_blank">View</a>
                            </p>
                        @endif

                        <!-- Display loan settlement file if available -->
                        @if ($loan->loan_settlement_file_path)
                            <p><strong>Loan Settlement File:</strong> <a
                                    href="{{ asset('storage/' . $loan->loan_settlement_file_path) }}"
                                    target="_blank">View</a>
                            </p>
                        @endif

                        <p><strong>Transaction Reference</strong>{{ $loan->transaction_reference }}</p>

                        @if ($loan->loan_release_date)
                            <p>
                                {{ $loan->loan_release_date }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
