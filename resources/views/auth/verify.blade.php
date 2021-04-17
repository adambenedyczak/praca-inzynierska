@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Potrzebna weryfikacja adresu email!</h4>
                @if (session('resent'))
                    <p>Nowy link weryfikacyjny został wysłany na Twój adres email!</p>
                @endif
                <p>Zanim przejdziesz dalej, sprawdź skrzynkę odbiorczą i kliknij w link weryfikacyjny.</p>
                <hr>
                Jeżeli nie otrzymałeś wiadomości,   
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><strong>{{ __('kliknij w ten link') }}</strong></button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
