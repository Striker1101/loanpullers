@include('layouts.header', ['location' => 'Wallet'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Wallet', 'locations' => [['name' => 'Wallet', 'route' => 'wallet.index', 'active' => true]]])

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('card_view', [
        'data' => $wallets,
        'headers' => ['Name', 'Title', 'Description', 'Currency', 'Balance', 'Amount', 'Created At'],
        'columns' => ['name', 'slug', 'description', 'meta', 'balance', 'amount', 'created_at'],
        'searchRoute' => route('wallet.index'),
        'text' => ' Wallet',
        'createUrl' => route('wallet.create'),
        'path' => 'wallet',
    ])
@endsection
