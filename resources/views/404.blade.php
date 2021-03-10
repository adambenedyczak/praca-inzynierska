@extends('layouts.app')

@section('content')
<div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Mamma mia, błąd 404!</h4>
            <p>Chyba nie powinno Cię tu być?!</p>
            <hr>
            <p class="mb-0">Lepiej wróć skąd przyszedłeś!</p>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-success">Wróć do poprzedniej strony</a>
</div>

@endsection
