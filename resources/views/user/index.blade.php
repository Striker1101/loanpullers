@include('layouts.header')
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'User', 'locations' => [['name' => 'User', 'route' => 'user.index', 'active' => false]]])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ $user->profile_photo_path ? asset($user->profile_photo_path) : asset('noimg.jpeg') }}"
                        class="card-img-top" alt="Profile Photo">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->email }}</p>
                        <p class="card-text"><small class="text-muted">Registered At: {{ $user->created_at }}</small></p>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
