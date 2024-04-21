@include('layouts.header', ['location' => 'Show ' . $wallet->name])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => "Show  $wallet->name", 'locations' => [['name' => 'Wallet', 'route' => 'wallet.index', 'active' => false], ['name' => $wallet->name, 'route' => '', 'active' => true]]])


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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $wallet->name }} Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <hr />
                            <h4 class="card-title mb-1">Wallet Name: {{ $wallet->name }}</h4>
                            <hr />
                            <p class="card-text">Slug: {{ $wallet->slug }}</p>
                            <hr />
                            <p class="card-text">Description: {{ $wallet->description }}</p>
                            <p class="card-text">Balance: {{ $wallet->balance }}</p>
                            <p class="card-text">Amount: {{ $wallet->amount . $wallet->meta }} </p>
                            <p class="card-text">Created At: {{ $wallet->created_at }}</p>
                            <!-- Add any other wallet details you want to display -->
                        </div>
                        <a href="{{ route('wallet.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Back</a>
                        <a href="{{ route('wallet.edit', $wallet->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit">
                                Edit
                            </i>
                        </a>
                        <form id="deleteForm" method="POST" action="{{ route('wallet.destroy', $wallet->id) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this wallet?')">
                                <i class="fas fa-file"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
