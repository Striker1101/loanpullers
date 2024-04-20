@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => "Show  $account->account_name", 'locations' => [['name' => 'Account', 'route' => 'account.index', 'active' => false], ['name' => $account->account_name, 'route' => '', 'active' => true]]])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="m-0">{{ $account->account_name }} Details</h2>
                    </div>
                    <div class="card-body">
                        @if ($account->account_type === 'bank')
                            <div class="mb-3">
                                <h5 class="card-title">{{ $account->bank_name }}</h5>
                                <p class="card-text">Account Number: {{ $account->account_number }}</p>
                                <p class="card-text">Bank Branch: {{ $account->bank_branch }}</p>
                                <p class="card-text">Swift Code: {{ $account->swift_code }}</p>
                                <p class="card-text">Routing Number: {{ $account->routing_number }}</p>
                                <p class="card-text">Bank Address: {{ $account->bank_address }}</p>
                            </div>
                        @else
                            <div class="">
                                <p class="card-text"><strong class="text-success">Wallet Address:</strong>
                                    {{ $account->crypto_wallet_address }}</p>
                            </div>
                        @endif
                        <div class="mt-3">

                            <p class="card-text">Description: {{ $account->description }}</p>
                            <p class="card-text">Amount: {{ $account->amount }}</p>
                            <p class="card-text">Created At: {{ $account->created_at }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('account.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <a href="{{ route('account.edit', $account->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form id="deleteForm" method="POST" action="{{ route('account.destroy', $account->id) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this account?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
