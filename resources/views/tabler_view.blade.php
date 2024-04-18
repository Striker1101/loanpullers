<!-- resources/views/components/dynamic_table.blade.php -->

<div class="container">

    @if ($data->count() > 0)
        <!-- Search form -->
        <form action="{{ $searchRoute }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <button type="submit" class="btn btn-primary float-right mb-2">
            <a href="{{ route('loan.create') }}" class="text-light">Request Loan</a>
        </button>

        <!-- Display dynamic table -->
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @foreach ($columns as $column)
                                <td>{{ $item->$column }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination links -->
        {{ $data->links() }}
    @else
        <!-- Empty state -->
        <div>
            <img width="300" src="/UserDashboard/empty.svg" alt="empty" aria-describedby="empty">
            <h4 class="empty">Nothing here! <span>Click here to <a href="{{ $createUrl }}">{{ $text }}</a>
                    now</span></h4>
        </div>
    @endif
</div>
