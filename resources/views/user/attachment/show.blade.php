@include('layouts.header', ['location' => 'Show Attachment'])
@include('layouts.navigation')
@include('layouts.menu')

@extends('layouts.link', ['location' => $attachment->type . ' Attachments', 'locations' => [['name' => 'User Attachment', 'route' => 'attachment.index', 'active' => true]]])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Attachment Details</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <p>{{ $attachment->type }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <p>{{ $attachment->description }}</p>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="front_view">Front View:</label>
                            <img style="width:80%;" src="{{ asset('storage/' . $attachment->front_view) }}"
                                alt="Front View">
                        </div>
                        @if ($attachment->back_view)
                            <div class="form-group">
                                <label for="back_view">Back View:</label>
                                <img src="{{ asset('storage/' . $attachment->back_view) }}" alt="Back View">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
