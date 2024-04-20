@include('layouts.header', ['location' => 'Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Create New Account', 'locations' => [['name' => 'Account', 'route' => 'account.index', 'active' => false], ['name' => 'Create Account', 'route' => '', 'active' => true]]])


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <form id="accountForm" method="{{ $account ? 'PUT' : 'POST' ?? '' }}"
        action="{{ $account ? route('account.update', $account->id) : route('account.store') }}" class="needs-validation"
        novalidate>

        @csrf






        <button type="submit" class=" m-3 btn btn-primary mb-4">Submit</button>
    </form> --}}
    <div class="shadow p-3 mb-5 bg-white rounded">

        <div class="modal-body bg-white">

            <ul class="nav nav-pills nav-justified mb-3">
                <li class="nav-item">
                    <a class="nav-link " data-toggle="pill" href="#pills-bank">Bank</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#pills-crypto">Crypto</a>
                </li>
            </ul>

            <hr>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="pills-bank">
                    <form method="POST" id="bankForm" action="{{ route('account.store') }}" class="needs-validation"
                        novalidate>
                        @csrf
                        <input type="text" value="bank" name="account_type" hidden id="account_type">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Account Name<strong class="text-danger">*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-umbrella"></i></span>
                                        </div>
                                        <input type="text" name="account_name"
                                            class="form-control @error('account_name') is-invalid @enderror"
                                            placeholder="Mohammed Aisha">
                                    </div>
                                    @error('account_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Account Number<strong class="text-danger">*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-umbrella"></i></span>
                                        </div>
                                        <input type="text" name="account_number"
                                            class="form-control @error('account_number') is-invalid @enderror"
                                            placeholder="9092-3984-938">
                                    </div>
                                    @error('account_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Bank Name<strong class="text-danger">*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-umbrella"></i></span>
                                        </div>
                                        <input type="text" name="bank_name"
                                            class="form-control @error('bank_name') is-invalid @enderror"
                                            placeholder=" First Abu Dhabi Bank ">
                                    </div>
                                    @error('bank_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">

                                    <label>Bank Branch<strong class="text-danger">*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-umbrella"></i></span>
                                        </div>
                                        <input type="text" name="bank_branch"
                                            class="form-control @error('bank_branch') is-invalid @enderror"
                                            placeholder="Al Qurm – Business Park">

                                    </div>
                                    @error('bank_branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="bank_name">Bank Address</label> <span class="text-danger">*</span>

                                    <input type="text" name="bank_address"
                                        class="form-control @error('bank_address') is-invalid @enderror"
                                        placeholder="Abu Dhabi, United Arab Emirates">
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="swift_code">Swift Code</label> <span class="text-danger">*</span>

                                    <input type="text" name="swift_code"
                                        class="form-control @error('swift_code') is-invalid @enderror"
                                        placeholder="AAAA-BB-CC-123">
                                    @error('swift_code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="routing_number"> Routing Number</label> <span class="text-danger">*</span>

                                    <input type="text" name="routing_number"
                                        class="form-control @error('routing_number') is-invalid @enderror" placeholder="">
                                    @error('routing_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description </label> <span class="text-danger">*</span>
                                    <input id="description" type="text" name="description"
                                        value="{{ old('description') }}"
                                        class="form-control @error('description') is-invalid @enderror">
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer bg-white">
                            <button type="submit" name="add_client" class="btn btn-primary text-bold"><i
                                    class="fa fa-check mr-2"></i>Save Changes</button>


                        </div>
                    </form>

                    <script>
                        document.getElementById('bankForm').addEventListener('submit', function(event) {
                            event.preventDefault();
                            this.submit();
                        });
                    </script>
                </div>


                <div class="tab-pane fade active" id="pills-crypto">

                    <form method="POST" id="cryptoForm" action="{{ route('account.store') }}" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row gap-4">
                            <input type="hidden" name="account_type" value="crypto">

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input id="account_name" type="text" name="account_name"
                                        value="{{ old('account_name') }}"
                                        class="form-control @error('account_name') is-invalid @enderror">
                                    @error('account_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input id="bank_name" type="text" name="bank_name"
                                        value="{{ old('bank_name') }}"
                                        class="form-control @error('bank_name') is-invalid @enderror">
                                    @error('bank_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="crypto_wallet_address">Crypto Wallet Address</label>
                                    <input id="crypto_wallet_address" type="text" name="crypto_wallet_address"
                                        value="{{ old('crypto_wallet_address') }}"
                                        class="form-control @error('crypto_wallet_address') is-invalid @enderror">
                                    @error('crypto_wallet_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="description">
                                        Description</label>
                                    <textarea id="description" type="text" name="description" value="{{ old('description') }}"
                                        class="form-control @error('description') is-invalid @enderror"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-white">
                            <button type="submit" name="add_client" class="btn btn-primary text-bold"><i
                                    class="fa fa-check mr-2"></i>Create Wallet Account</button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('cryptoForm').addEventListener('submit', function(event) {
                            event.preventDefault();
                            this.submit();
                        });
                    </script>
                </div>

            </div>



        </div>

    @endsection
