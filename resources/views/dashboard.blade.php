@extends('layout')

@section('content')

<div class="container">
    <div class="col-lg-8 m-auto">
        <div>
        <center><h1>selamat datang di halaman</h1></center>
        </div>
        
        <div style="border: 2px solid; background-color:rgba(0, 255, 251, 0.825); border-radius: 10px; width: 20em; margin-left:13em;">
        <center><h3>Username  : {{ auth()->user()->username }}</h3>
        <h3>Email : {{ auth()->user()->email}}</h3></center>
        </div>
        
        <div>
        </div>
    </div>
</div>






@if(session('isGuest'))
<h2>
    <b>
        <i>
            {{ session('isGuest') }}
        </i>
    </b>
</h2>
@endif

@if (Session::get('addTodo'))
    <div class="alert alert-success">
        {{ Session::get('addTodo') }}
    </div>
@endif
@endsection