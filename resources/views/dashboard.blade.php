@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (Route::has('register'))
                        Sikeres regisztráció!
                    @elseif (Route::has('login'))
                        Sikeres bejelentkezés!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
