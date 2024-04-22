@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Show Loan', 'locations' => [['name' => 'Loan', 'route' => 'loan.index', 'active' => false], ['name' => $loan->loan_type, 'route' => '', 'active' => true]]])

@section('content')
@endsection
