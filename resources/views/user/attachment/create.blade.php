@include('layouts.header', ['location' => 'Create User Attachment'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => $attachment ? 'Update Attachment' : 'Create Attachment', 'locations' => [['name' => 'Add Attachment', 'route' => 'user.index', 'active' => true]]])


@section('content')
    <div class="container">

        <form action="{{ $attachment ? route('attachment.update', $attachment->id) : route('attachment.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($attachment)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Select Your File Type</option>
                    @foreach (['driver_license', 'passport', 'utility_bill', 'credit_card', 'master_card', 'national_card'] as $type)
                        <option value="{{ $type }}"
                            {{ $attachment && $attachment->type === $type ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Front View -->
            <div class="form-group">
                <label for="front_view">Front View:</label>
                <input type="file" name="front_view" id="front_view" class="form-control-file">
                @if ($attachment && $attachment->front_view)
                    <div id="front_preview">
                        <img src="{{ asset($attachment->front_view) }}" alt="Front View">
                    </div>
                @else
                    <div id="front_preview"></div>
                @endif
            </div>

            <!-- Back View (conditional) -->
            <div class="form-group" id="back_view_container"
                style="{{ $attachment && $attachment->back_view ? 'display: block;' : 'display: none;' }}">
                <label for="back_view">Back View:</label>
                <input type="file" name="back_view" id="back_view" class="form-control-file">
                @if ($attachment && $attachment->back_view)
                    <div id="back_preview">
                        <img src="{{ asset($attachment->back_view) }}" alt="Back View">
                    </div>
                @else
                    <div id="back_preview"></div>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $attachment ? $attachment->description : '' }}</textarea>
            </div>

            <button type="submit" class="btn m-3 btn-primary">
                {{ $attachment ? ' Update ' : 'Submit' }}</ </button>
        </form>

        <script>
            // Add event listener to the select input
            document.getElementById('type').addEventListener('input', function() {
                // Get the selected option value
                var selectedType = this.value;


                // Check if selected type has $type[1] === true
                var hideBackView = false;
                switch (selectedType) {
                    case 'driver_license':
                    case 'passport':
                    case 'credit_card':
                    case 'master_card':
                    case 'national_card':
                        hideBackView = true;
                        break;
                    default:
                        hideBackView = false;
                }

                // Toggle the display of the back view input based on the condition
                var backViewInput = document.getElementById('back_view_container');
                if (hideBackView) {
                    backViewInput.style.display = 'block';

                } else {
                    backViewInput.style.display = 'none';
                }
            });
        </script>
    </div>
@endsection

@section('scripts')
    <script>
        // Handle file input change for front view
        document.getElementById('front_view').addEventListener('change', function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('front_preview').innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" alt="Front View">';
            };
            reader.readAsDataURL(file);
        });

        // Handle file input change for back view
        document.getElementById('back_view').addEventListener('change', function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('back_preview').innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" alt="Back View">';
            };
            reader.readAsDataURL(file);
        });

        // Show/hide back view input based on selected type
        document.getElementById('type').addEventListener('change', function() {
            var backViewContainer = document.getElementById('back_view_container');
            if (this.value === 'driver_license' || this.value === 'passport') {
                backViewContainer.style.display = 'none';
            } else {
                backViewContainer.style.display = 'block';
            }
        });
    </script>
@endsection
