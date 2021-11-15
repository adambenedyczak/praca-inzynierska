@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar')

@if($mustVerify == true)
    <div class="mt-md-5 mt-3">  
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
                <div class="jumbotron bg-primary text-white">
                    <h1 class="mb-4">Witaj, {{$user->name}}!</h1>
                    <p class="lead">Dziękujemy za dołączenie do grona użytkowników 
                        {{ config('app.name', 'Laravel') }}
                    </br>Cieszymy się, że jesteś z nami!</p>

                    <hr class="my-4">

                    <p class="lead">Na podany przez Ciebie adres email został wysłany link weryfikacyjny. 
                        </br>Proszę, kliknij w niego aby korzystać w pełni z możliwości serwisu.
                        </br></br>Jeżeli nie otrzymałeś(-aś) wiadomości,  
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn text-white p-0 m-0 align-baseline">
                                <strong>{{ __('kliknij w ten link') }}</strong>
                            </button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@else
    @if( count($favs) > 0)
        <div class="mt-md-5 mt-3">
            @foreach ($favs as $fav)
            <div class="row justify-content-center">
                <div class="col-xl-8 col-md-10">
                @livewire('display-object', ['object_id' => $fav->id])        
                </div>
            </div>
            @endforeach
        </div>
    @else
    <div class="mt-md-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Twoja lista ulubionych jest pusta!</strong> 
                    <p>
                        Zaznacz ikonę gwiazdki przy Twoim pojeździe, przyczepie lub agregacie, 
                        aby widzieć go na stronie głównej.
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif

@endsection
