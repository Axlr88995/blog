@extends('layout.app') 
@section('content') @if ($post)
<div>
    <a href="/posts" class="btn default">Go back</a>
    <img width="100%" src="/storage/cover_imgs/{{$post->cover_img}}"><br><br>
    <h1>{{$post->title}}</h1>
    <small><i>Created On {{$post->created_at}}</i></small>
    <div>
        <h2>{!!$post->body!!}</h2>
    </div>
</div>
@if (!Auth::guest() && $post->user_id == auth()->user()->id)
<div class="table-responsive">
    <table class="table">
        <tr align="left" class="success">
            <th>
                <a class="btn btn-info" href="/posts/{{$post->id}}/edit">Edit Post</a>
            </th>
            <th>
                {!! Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST']) !!} {{Form::submit('Delete', ['class'
                => 'btn btn-danger'])}} {{Form::hidden('_method','DELETE')}} {!! Form::close() !!}
            </th>
        </tr>
    </table>
</div>
@endif @endif
@endsection