@extends('layout.app')

@section('content')

    <h1>Whats on your mind today?</h1>

    {!! Form::open(['action' => 'PostsController@store','method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Write here..'])}}
        </div>
     {{Form::submit('Submit', ['class' => 'btn btn-success'])}}   
    {!! Form::close() !!}
@endsection