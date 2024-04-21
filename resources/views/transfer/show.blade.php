@include('layouts.header', ['location' => ' Show Transfer'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Transfer', 'locations' => [['name' => 'Transfer', 'route' => 'transfer.index', 'active' => false], ['name' => 'Make Transfer', 'route' => 'transfer.create', 'active' => true]]])


@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Transfer Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_id">Transfer ID</label>
                            <input type="text" class="form-control" id="transfer_id" value="{{ $transfer->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="from_wallet">From Wallet</label>
                            <input type="text" class="form-control" id="from_wallet" readonly
                                value="{{ \App\Models\Wallet::where('id', $transfer->from_id)->value('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="to_account">To Account</label>
                            <input type="text" class="form-control" id="to_account"
                                value="{{ \App\Models\Account::where('id', $transfer->to_id)->value('bank_name') }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" value="{{ $transfer->fee }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Add other transfer details here -->
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('transfer.index') }}" class="btn btn-secondary">Back to Transfers</a>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Add your custom styles here */
        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        /* Add more styles as needed */
    </style>
@endsection
