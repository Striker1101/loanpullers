@include('layouts.header')
@include('layouts.navigation')
@include('layouts.menu')





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transfactions Record</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Transfer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        @if ($transfers->count() > 0)
            <div class="container">
                <h4>All Transfers</h4>
                <br>
                <table class="table table-striped" id="transfers">
                    <thead>
                        <tr>
                            <th scope="col">Transfer ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">From Wallet</th>
                            <th scope="col">To Account Bank</th>
                            <th scoope="col">Status</th>
                            <th scope="col">Date</th>

                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                            <tr>
                                <td>{{ $transfer->uuid }}</td>
                                <td>{{ $transfer->fee }}</td>

                                <td>{{ \App\Models\Wallet::where('id', $transfer->from_id)->value('name') }}</td>
                                <td>{{ \App\Models\Account::where('id', $transfer->to_id)->value('bank_name') }}</td>
                                <td>{{ $transfer->status }}</td>
                                <td>{{ $transfer->created_at }}</td>
                                <td>
                                    <a href="{{ route('transfer.show', $transfer->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a class="btn btn-primary" href="{{ route('transfer.create') }}">Make a New Transfer</a>
            </div>

            <script>
                $('#transfers').DataTable({
                    "lengthChange": true,
                    dom: 'Bfrtip',

                    buttons: [{
                            extend: 'pdfHtml5',
                            className: 'btn btn-info',
                            title: 'transfer',
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-success',
                            title: 'transfer',
                        },
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-primary',
                            title: 'transfer',
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-secondary',
                            title: 'transfer',
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
                        <a href="{{ route('transfer.create') }}">
                            Make Transfer
                        </a>
                    </span>
                    now</span>
                </h4>
            </div>
        @endif

    </section>
    <!-- /.content -->
</div>




@include('layouts.footer')
