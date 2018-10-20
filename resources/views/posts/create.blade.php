@extends('layout.app') 
@section('content')

<h1>Whats on your mind today?</h1>

{!! Form::open(['action' => 'PostsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('title','Title')}} {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
</div>
<div class="form-group">
    {{Form::label('body','Body')}} {{Form::textarea('body','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder'
    => 'Write here..'])}}
</div>
<table class="table">
    <tr>
        <th>{{Form::file( 'cover_img', ['class' => 'btn btn-info'])}}</th>
    </tr>
    <tr>
        <th>{{Form::submit( 'Submit', [ 'class'=> 'btn btn-success'])}}</th>
    </tr>
</table> {!! Form::close() !!}
@endsection