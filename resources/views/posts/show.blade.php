@extends('layout.app')
@section('content')
@if ($post)    
<div>
<a href="/posts" class="btn default">Go back</a>
<h1>{{$post->title}}</h1>
<small><i>Created On {{$post->created_at}}</i></small>
<div>
{!!$post->body!!}
</div>

<a class="btn btn-info" href="/posts/{{$post->id}}/edit" >Edit Post</a>

{!! Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST','class' => 'pull-right']) !!}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}  
{{Form::hidden('_method','DELETE')}} 
{!! Form::close() !!}

</div>
@endif
@endsection