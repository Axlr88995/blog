@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
    <h1>{{$title}}</h1>
    <p>This is the blogging page..</p>
    <p><button type="button" class="btn btn-success">Login</button>
        <button type="button" class="btn btn-info">Register</button></p>
    </div>
@endsection