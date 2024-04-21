@include('layouts.header', ['location' => 'Account'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Account', 'locations' => [['name' => 'Account', 'route' => 'account.index', 'active' => true]]])

@section('content')




    @if ($accounts['bank']->count() > 0 || $accounts['crypto']->count() > 0)
        <button class="btn btn-primary float-right">
            <a class="text-light" href="{{ route('account.create') }}">
                Add Account
            </a>
        </button>
    @endif

    @if ($accounts['bank']->count() > 0)
        <!-- Display bank accounts -->
        <style>
            .head_acc {
                font-family: "Playfair Display", serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
            }
        </style>
        <h2 class="head_acc">Bank Accounts</h2>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Wallet Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Bank Branch</th>
                        <th>Bank Address</th>
                        <th>Swift Code</th>
                        <th>Routing Number</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts['bank'] as $item)
                        <tr>
                            <td>{{ $item->account_name }}</td>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->bank_name }}</td>
                            <td>{{ $item->bank_branch }}</td>
                            <td>{{ $item->bank_address }}</td>
                            <td>{{ $item->swift_code }}</td>
                            <td>{{ $item->routing_number }}</td>
                            <td>{{ strlen($item->description) > 10 ? substr($item->description, 0, 10) . '...' : $item->description }}
                            </td>
                            <td class="d-flex">
                                <a class="btn btn-success ml-1 btn-sm" type="button"
                                    href="{{ route('account.show', $item->id) }}">
                                    <i class="fa fa-eye"></i>
                                    View</a>
                                <a class="btn btn-primary ml-1 btn-sm" type="button"
                                    href="{{ route('account.edit', $item->id) }}">
                                    <i class="fa fa-edit"></i>Update</a>
                                <button class="btn btn-danger ml-1 btn-sm" type="button" data-toggle="modal"
                                    data-target="#passwordConfirmationAccountModal{{ $item->id }}">
                                    <i class="fa fa-trash"></i>Delete</button>

                            </td>
                            @include('deletes.account')

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Display pagination links for bank accounts -->
        {{ $accounts['bank']->links() }}
    @endif

    @if ($accounts['crypto']->count() > 0)
        <!-- Display crypto accounts -->
        <h2 class="head_acc">Crypto Accounts</h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Account Name</th>
                        <th> Crypto Wallet Address</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts['crypto'] as $item)
                        <tr>
                            <td>{{ $item->account_name }}</td>
                            <td>{{ $item->crypto_wallet_address }}</td>
                            <td>{{ strlen($item->description) > 10 ? substr($item->description, 0, 10) . '...' : $item->description }}
                            </td>
                            <td class="d-flex">
                                <a class="btn btn-success ml-1 btn-sm" type="button"
                                    href="{{ route('account.show', $item->id) }}">
                                    <i class="fa fa-eye"></i>
                                    View</a>
                                <a class="btn btn-primary ml-1 btn-sm" type="button"
                                    href="{{ route('account.edit', $item->id) }}">
                                    <i class="fa fa-edit"></i>Update</a>
                                <button class="btn btn-danger ml-1 btn-sm" type="button" data-toggle="modal"
                                    data-target="#passwordConfirmationAccountModal{{ $item->id }}">
                                    <i class="fa fa-trash"></i>Delete</button>

                            </td>
                        </tr>
                        @include('deletes.account')
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Display pagination links for crypto accounts -->
        {{ $accounts['crypto']->links() }}
    @endif

    @if (count($accounts['crypto']) === 0 && count($accounts['bank']) === 0)
        <div>
            <img width="300" src="/UserDashboard/empty.svg" alt="empty" aria-describedby="empty">
            <h4 class="empty">Nothing here! <span>Click here to <a href="{{ route('account.create') }}">Create Account</a>
                    now</span></h4>
        </div>
    @endif



@endsection
