
@extends ('layout')

@section('style')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@endsection

@section('content')
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="/register">
        @csrf
        <h3>Register Here</h3>
        <br>
        <input type="text" placeholder="Nama lengkap" id="username" name="name"/>
        <input type="text" placeholder="username" name="username">
        <input type="text" placeholder="Email" id="email" name="email">
        <input type="password" placeholder="Password" id="password" name="password">

        <button type="submit" style="margin-bottom: 20px;">Log In</button>
        <center>
        {{-- <p>Sudah punya akun!</p> --}}
        <a href="login" class="text-white">Form Login</a>
    </form>

    {{ session('Berhasil') }}
    
@endsection