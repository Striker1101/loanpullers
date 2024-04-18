@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Agreement Forms', 'locations' => [['name' => 'Loan', 'route' => 'loan.index', 'active' => false], ['name' => 'agreement form', 'route' => 'loan.agreemenet_form', 'active' => true]]])
@section('content')
    <div>
        @foreach ($forms as $form)
            <div>
                <h2>{{ $form->loan_type->loan_name ?? '' }}</h2>
            </div>
            <hr class="w-100">
            <div>
                {!! $form->loan_agreement_text ?? $form->loan_settlement_text !!}
            </div>
        @endforeach
        <!-- Pagination links -->
        {{ $forms->links() }}
    </div>
@endsection
