@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-sm-5 m-3">
    <div class="col-lg-4 col-md-5  col-sm-8 p-0">
        <div class="card border-primary" >
            <div class="card-body">
                <h4 class="card-title mb-3">{{ __('auth.auth_log_in') }}</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('auth.auth_password') }}</label>

                <div class="col-md-12">
                    <div class="input-group mb-2">
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
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            

            <div class="form-group row">
                <div class="col-md-12 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('auth.auth_remember') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary btn-block py-2 mt-2">
                        {{ __('auth.auth_btn_login') }}
                    </button>
                </div>
            </div>
            @if (Route::has('password.request'))
            <div class="text-md-right pt-2">
                <a class="btn btn-link text-right" href="{{ route('password.request') }}">
                    {{ __('auth.auth_forget_pass') }}
                </a>
            </div>
            @endif
        </form>
        <div class="mt-3">
            <div>
                <div>{{ __('auth.auth_no_account') }} </div>
                <a href="{{ route('register') }}" class="btn btn-link pl-0 pt-0">{{ __('auth.auth_register_now') }}</a>
            </div>                        
        </div>
    </div>
</div>  
@endsection