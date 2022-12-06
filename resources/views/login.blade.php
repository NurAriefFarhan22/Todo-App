{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head> --}}


@extends ('layout')

@section('style')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@endsection

@section('content')
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="">

    <center><h1>Halaman Login</h1></center>
    <br>

        @if(session('successRegister'))
            <p style="color: red">{{ session('successRegister') }}</p>
        @endif
    <form action="{{ route ('login-baru') }}" method="POST">
        @csrf
        Email <input type="email" name="email" placeholder="Masukan Email">
    </br>
    Password <input type="password" name="password" placeholder="Masukan Password">
    <br>

   
    <button type="submit"> Login </button>
    <div class="jarak">
        <center><a href="register" class="text-white">Form register</a></center>
    </div>
     





    @if(session('error'))
        {{ session ('error') }}
    @endif

    @if(session('isLogin'))
        {{ session ('isLogin') }}
    @endif

    </form>

    @endsection