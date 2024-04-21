@include('layouts.header', ['location' => 'User Attachment'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'User Attachments', 'locations' => [['name' => 'User Attachment', 'route' => 'user.index', 'active' => true]]])


@section('content')
    <div class="container">
        <h1>Attachments</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <form action="{{ route('attachment.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search..."
                                            value="{{ request()->get('search') }}">
                                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('attachment.create') }}" class="btn btn-success">Add New Attachment</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>

                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attachments as $attachment)
                                    <tr>
                                        <td>{{ $attachment->id }}</td>

                                        <td>{{ $attachment->type }}</td>
                                        <td>{{ Str::limit($attachment->description, 9) }}</td>
                                        <td>
                                            <a href="{{ route('attachment.show', $attachment->id) }}"
                                                class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('attachment.edit', $attachment->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('attachment.destroy', $attachment->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this attachment?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $attachments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
