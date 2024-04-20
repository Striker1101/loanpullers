@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Loan', 'locations' => [['name' => 'Loan', 'route' => 'loan.index', 'active' => true]]])

@section('content')
    @include('tabler_view', [
        'data' => $loans,
        'headers' => ['ID', 'Amount', 'Loan Duration', 'Duration Period', 'Loan Description', 'Created At'],
        'columns' => [
            'id',
            'principal_amount',
            'loan_duration',
            'duration_period',
            'transaction_reference',
            'created_at',
        ],
        'searchRoute' => route('loan.index'),
        'text' => 'request loan',
        'createUrl' => route('loan.create'),
        'path' => 'loan',
    ])
@endsection
