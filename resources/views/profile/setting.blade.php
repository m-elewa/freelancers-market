@extends('layouts.app')
@section('title', 'Setting')
@push('css')
<x-app-layouts.background/>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header font-weight-bold">Setting</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('setting.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                                value="{{ old('first_name', Auth::user()->first_name) }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" 
                                value="{{ old('last_name', Auth::user()->last_name) }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_link" class="col-md-4 col-form-label text-md-right">{{ config("setting.freelance_website_name") }} Profile Link</label>

                            <div class="col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{ config("setting.freelance_website_domain") }}</div>
                                </div>

                                <input id="profile_link" type="text" class="form-control @error('profile_link') is-invalid @enderror" name="profile_link" 
                                value="{{ old('profile_link', Auth::user()->profile_link) }}">

                                @error('profile_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password</label>
            
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
            
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary shadow">
                                    Update
                                </button>
                                <button type="button" class="btn btn-warning shadow" data-toggle="modal" data-target="#changepass">
                                    Change Password
                                  </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="changepassLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <form method="POST" action="{{ route('setting.update-password') }}">
            @csrf


        <div class="modal-header">
          <h5 class="modal-title" id="changepassLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          

            <div class="form-group row">
                <label for="current_password_modal" class="col-md-4 col-form-label text-md-right">Current Password</label>

                <div class="col-md-6">
                    <input id="current_password_modal" type="password" class="form-control @error('current_password_modal') is-invalid @enderror" name="current_password_modal" required>

                    @error('current_password_modal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Change Password</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script type="text/javascript">
$("document").ready(function()
    {
        if ({{ $errors->has('password') || $errors->has('current_password_modal') }}){
            $('#changepass').modal('show');
    }
});
</script>
@endsection