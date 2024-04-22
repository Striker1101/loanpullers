@include('layouts.header', ['location' => ' Edit User Profile'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'User', 'locations' => [['name' => 'User', 'route' => 'user.index', 'active' => false]]])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="profile_photo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

                                <div class="col-md-6">
                                    <input type="file" id="profile_photo" name="profile_photo"
                                        class="form-control @error('profile_photo') is-invalid @enderror">
                                    <img id="image-preview"
                                        src="{{ $user->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : asset('noimg.jpeg') }}"
                                        alt="Profile Photo Preview" class="mt-2"
                                        style="max-width: 200px; max-height: 200px;">

                                    @error('profile_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for image preview
        document.getElementById('profile_photo').addEventListener('change', function(event) {
            var image = document.getElementById('image-preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>
@endsection
