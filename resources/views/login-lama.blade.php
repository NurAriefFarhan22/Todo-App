
@extends ('layout')

@section('content')
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password">

        <button type="submit" style="margin-bottom: 20px;">Log In</button>
        <center><p>Belum punya akun?</p><a href="register">Form Register!</a>
    </form>
    
@endsection