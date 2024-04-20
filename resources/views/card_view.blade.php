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
        <div class="row ">
            <button type="submit" class="btn btn-primary float-right mb-2">
                <a href="{{ route('wallet.create') }}" class="text-light">Request {{ $text }}</a>
            </button>
        </div>

        <!-- Display dynamic cards -->
        <div class="row d-flex ">
            @foreach ($data as $item)
                <div class="col-md-4 mb-4 m-1">
                    <div class="card" style="min-width: 300px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $item->slug }}</h6>
                            <p class="card-text">{{ $item->description }}</p>
                            @if ($path == 'wallet')
                                @if (is_string($item->meta))
                                    <p class="card-text">Currency: {{ json_decode($item->meta)->currency ?? 'AED' }}</p>
                                @else
                                    <p class="card-text">Currency: {{ $item->meta['currency'] ?? 'AED' }}</p>
                                @endif
                            @endif
                            <p class="card-text">Balance: {{ $item->balance }}</p>
                            <p class="card-text">Amount: {{ $item->amount }}</p>
                            <p class="card-text">Created At: {{ $item->created_at }}</p>
                            <a href="{{ route('wallet.show', $item->id) }}" class="card-link">More Info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    @else
        <!-- Empty state -->
        <div>
            <img width="300" src="{{ assets('empthy2.png') }}" alt="empty" aria-describedby="empty">
            <h4 class="empty">Nothing here! <span>Click here to <a href="{{ $createUrl }}">{{ $text }}</a>
                    now</span></h4>
        </div>
    @endif
</div>
