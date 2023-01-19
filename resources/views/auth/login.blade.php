@extends('layouts.app')

@section('content')

<div class="container">

    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            @error('login')
            <div class="alert alert-danger" role="alert">
             {{$message}}
            </div>
            @enderror
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input id="login" class="form-control @error('login') @enderror" placeholder="Ingrese usuario"
                    type="text" name="login" value="{{ old('login') }}" required autocomplete="login"
                    autofocus>
            </div>
            
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input id="password" type="password" name="password" placeholder="Ingrese Contraseña"
                    class=" form-control @error('password') @enderror" required autocomplete="current-password">
                @error('password')
                <label class="mensaje">
                    <strong>{{ $message }}</strong>
                </label>
                @enderror       
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesion</button>
    </form>
</div>

@endsection
