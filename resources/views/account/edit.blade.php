@include('layouts.header', ['location' => 'Account edit'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => ' Edit ' . $account->account_name . ' Account', 'locations' => [['name' => 'Account', 'route' => 'account.index', 'active' => false], ['name' => $account->account_name, 'route' => '', 'active' => true]]])

@section('content')
    @if ($account->account_type === 'bank')
        <form method="POST" id="bankForm" action="{{ route('account.update', $account->id) }}" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="account_type" value="bank">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label>Account Name<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-umbrella"></i></span>
                            </div>
                            <input type="text" name="account_name"
                                class="form-control @error('account_name') is-invalid @enderror"
                                placeholder="Mohammed Aisha" value="{{ $account->account_name }}">
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
                                placeholder="9092-3984-938" value="{{ $account->account_number }}">
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
                                placeholder="First Abu Dhabi Bank" value="{{ $account->bank_name }}">
                        </div>
                        @error('bank_name')
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
                                placeholder="9092-3984-938" value="{{ $account->account_number }}">
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
                                placeholder="First Abu Dhabi Bank" value="{{ $account->bank_name }}">
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
                                placeholder="Al Qurm – Business Park" value="{{ $account->bank_branch }}">
                        </div>
                        @error('bank_branch')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="bank_name">Bank Address<strong class="text-danger">*</strong></label>
                        <input type="text" name="bank_address"
                            class="form-control @error('bank_address') is-invalid @enderror"
                            placeholder="Abu Dhabi, United Arab Emirates" value="{{ $account->bank_address }}">
                        @error('bank_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="swift_code">Swift Code<strong class="text-danger">*</strong></label>
                        <input type="text" name="swift_code"
                            class="form-control @error('swift_code') is-invalid @enderror" placeholder="AAAA-BB-CC-123"
                            value="{{ $account->swift_code }}">
                        @error('swift_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="routing_number">Routing Number<strong class="text-danger">*</strong></label>
                        <input type="text" name="routing_number"
                            class="form-control @error('routing_number') is-invalid @enderror" placeholder=""
                            value="{{ $account->routing_number }}">
                        @error('routing_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="description">Description<strong class="text-danger">*</strong></label>
                        <input type="text" name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ $account->description }}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



            </div>

            <div class="modal-footer bg-white">
                <button type="submit" name="update_account" class="btn btn-primary text-bold"><i
                        class="fa fa-check mr-2"></i>Update Account</button>
            </div>
        </form>

        <script>
            document.getElementById('bankForm').addEventListener('submit', function(event) {
                event.preventDefault();
                this.submit();
            });
        </script>
    @else
        <form method="POST" id="cryptoForm" action="{{ route('account.update', $account->id) }}"
            class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="row gap-4">
                <input type="hidden" name="account_type" value="crypto">

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input id="account_name" type="text" name="account_name"
                            value="{{ $account->account_name }}"
                            class="form-control @error('account_name') is-invalid @enderror">
                        @error('account_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="crypto_wallet_address">Crypto Wallet Address</label>
                        <input id="crypto_wallet_address" type="text" name="crypto_wallet_address"
                            value="{{ $account->crypto_wallet_address }}"
                            class="form-control @error('crypto_wallet_address') is-invalid @enderror">
                        @error('crypto_wallet_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" type="text" name="description"
                            class="form-control @error('description') is-invalid @enderror">{{ $account->description }}</textarea>
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
    @endif
@endsection
