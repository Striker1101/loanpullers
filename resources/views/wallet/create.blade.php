@include('layouts.header', ['location' => 'Create Wallet'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => $wallet ? 'Update Wallet' : 'Create New Wallet', 'locations' => [['name' => 'Account', 'route' => 'wallet.index', 'active' => false], ['name' => $wallet ? 'Update ' . $wallet->name : 'Create New Wallet', 'route' => '', 'active' => true]]])

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="walletForm" method="{{ $wallet ? 'PUT' : 'POST' }}"
        action="{{ $wallet ? route('wallet.update', $wallet->id) : route('wallet.store') }}" class="needs-validation"
        novalidate>


        @csrf
        @if ($wallet)
            @method('PUT')
        @else
            @method('POST')
        @endif

        <div>
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" value="{{ $wallet ? $wallet->name : '' }}" />
        </div>

        <div>
            <x-label for="slug" value="{{ __('Title') }}" />
            <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required
                autofocus autocomplete="title" value="{{ $wallet ? $wallet->slug : '' }}" />
        </div>


        <div>
            <x-label for="description" value="{{ __('Description') }}" />
            <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required
                autofocus autocomplete="description" value="{{ $wallet ? $wallet->description : '' }}" />
        </div>

        <div class="input-group mb-3 mt-2">
            <label class="input-group-text" for="meta">Currency</label>
            <select required class="form-control" id="meta" name="meta">
                <option value="" {{ !$wallet || !in_array($wallet->meta, ['USD', 'AED', 'CAD']) ? 'selected' : '' }}>
                    Choose...</option>
                <option value="USD" {{ $wallet && $wallet->meta === 'USD' ? 'selected' : '' }}>USD</option>
                <option value="AED" {{ $wallet && $wallet->meta === 'AED' ? 'selected' : '' }}>AED</option>
                <option value="CAD" {{ $wallet && $wallet->meta === 'CAD' ? 'selected' : '' }}>CAD</option>
            </select>
        </div>




        <button type="submit" class=" m-3 btn btn-primary mb-4">{{ $wallet ? 'Update' : 'Create' }}</button>
    </form>
    <script>
        document.getElementById('walletForm').addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
    </script>
@endsection
