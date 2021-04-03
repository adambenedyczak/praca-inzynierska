@extends('layouts.app')

@section('content')
<div class="row align-items-center" style="height: 80vh;">
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
        <div class="card border-primary p-2">
            <div class="card-body">
                <h4 class="card-title mb-3">{{ __('auth.auth_registration') }}</h4>

            <form method="POST" action="{{ route('register') }}">
            @csrf


            <div class="form-group row mb-1">
                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('auth.auth_name') }}</label>

                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                            </span>
                        </div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('auth.auth_email') }}</label>

                <div class="col-md-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">
                                @
                            </span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('auth.auth_password') }}</label>

                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">
                                <svg svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                </svg>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="form-text text-muted">Hasło powinno składać się z co najmniej 8 znaków, dużej litery i znaku specjalnego.</small>
                
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('auth.auth_confirm_password') }}</label>

                <div class="col-md-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">
                                <svg svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                </svg>
                            </span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            

            <div class="form-group row mb-0">
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary btn-block py-2 mt-2">
                    {{ __('auth.auth_btn_register') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="mt-3">
            


            <div>
                <div>{{ __('auth.auth_account') }} </div>
                <a href="{{ route('register') }}" class="btn btn-link pl-0 pt-0">{{ __('auth.auth_login_now') }}</a>
            </div>
            
        </div>

            </div>
        </div>  
    </div>                              
</div>
@endsection