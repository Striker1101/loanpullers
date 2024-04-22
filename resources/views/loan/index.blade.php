@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => '', 'locations' => [['name' => '', 'route' => '', 'active' => true]]])


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Transfactions Record</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">loan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        @if ($loans->count() > 0)
            <div class="container">
                <h4>All loans</h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="loans">
                        <thead>
                            <tr>
                                <th scope="col">Loan ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Loan Duration</th>
                                <th scope="col">Repayment Amount</th>
                                <th scoope="col">Loan Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->loan_number }}</td>
                                    <td>{{ $loan->principal_amount }}</td>
                                    <td>{{ $loan->loan_duration . ' ' . $loan->duration_period }}</td>

                                    <td>{{ $loan->repayment_amount }}</td>
                                    <td>{{ Str::limit($loan->transaction_reference, 20, '...') }}</td>
                                    <td>{{ $loan->loan_status }}</td>
                                    <td>{{ $loan->created_at }}</td>
                                    <td>
                                        <a href="{{ route('loan.show', $loan->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-eye"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a class="btn btn-primary" href="{{ route('loan.create') }}">Make a New loan</a>
            </div>

            <script>
                $('#loans').DataTable({
                    "lengthChange": true,
                    dom: 'Bfrtip',

                    buttons: [{
                            extend: 'pdfHtml5',
                            className: 'btn btn-info',
                            title: 'loan',
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-success',
                            title: 'loan',
                        },
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-primary',
                            title: 'loan',
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-secondary',
                            title: 'loan',
                        },


                    ]

                });
            </script>
        @else
            <!-- Empty state -->
            <div class="d-flex justify-content-center  align-items-center flex-column">
                <img width="300" class="float-" src="{{ asset('empty.webp') }}" alt="empty"
                    aria-describedby="empty">

                <h4 class="empty">Nothing here!
                    <span>Click here to
                        <a href="{{ route('loan.create') }}">
                            Make loan
                        </a>
                    </span>
                    now</span>
                </h4>
            </div>
        @endif

    </section>
    <!-- /.content -->
</div>
