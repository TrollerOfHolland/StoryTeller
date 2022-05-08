@extends('layouts.app')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>E-mail cím megerősítése</h1>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                Az új visszaigazoló e-mailt elküldtük a címedre.
            </div>
        @endif

        Mielőtt továbblépnél, erősítsd meg az e-mail címedet. Ha nem kaptad meg és szeretnél egy újat akkor
        <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="d-inline btn btn-link p-0">
                kattints ide.
            </button>.
        </form>
    </div>
@endsection
