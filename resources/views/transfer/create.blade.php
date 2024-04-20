@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Transfer', 'locations' => [['name' => 'Transfer', 'route' => 'transfer.index', 'active' => false], ['name' => 'Make Transfer', 'route' => 'transfer.create', 'active' => true]]])


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="transferForm" method="post" action={{ route('transfer.store') }} class="needs-validation" novalidate>
        @csrf

        <div class="form-group">
            <label for="fee">Amount:</label>
            <input type="number" min="1" minlength="1" class="form-control" id="fee" name='fee' required>
            <div class="invalid-feedback">
                Please provide a valid Amount.
            </div>
        </div>


        <div class="input-group mb-3">
            <label class="input-group-text" for="wallet_id">Your Wallet:</label>
            <select class="form-control" id="from_id" name="from_id">
                <option value=""> Select Your Wallet</option>
                @foreach ($wallets as $wallet)
                    <option value="{{ $wallet->id }}">{{ ucfirst($wallet->first_name) }}
                        {{ ucfirst($wallet->name) }}</option>
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please provide a valid wallet ID.
            </div>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="account">Accounts</label>
            <select class="form-control" id="to_id" name="to_id">
                <option value=""> Select Your Account</option>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}" data-interest_rate="{{ $account->account_name }}"
                        data-interest-cycle="{{ $account->interest_cycle }}">
                        {{ $account->account_name . '(' . $account->account_type . ')' }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please provide a valid Account type .
            </div>
        </div>


        <style>
            .file-drop {
                position: relative;
                overflow: hidden;
            }

            .file-drop-area {
                border: 2px dashed #ccc;
                padding: 20px;
                text-align: center;
                cursor: pointer;
            }

            .image-preview {
                display: none;
                max-width: 100%;
                height: auto;
                margin-top: 10px;
            }

            .btn-reset {
                display: none;
                margin-top: 10px;
            }
        </style>

        <button type="submit" class="btn btn-primary mb-4">Confirm Transfer</button>
    </form>
    <script>
        document.getElementById('transferForm').addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
    </script>
@endsection
