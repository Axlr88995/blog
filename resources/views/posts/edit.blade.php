@extends('layout.app') 
@section('content')

<h1>Edit</h1>

{!! Form::open(['action' => ['PostsController@update', $post->id],'method' => 'POST', 'enctype' => 'multipart/form-data'])
!!}
<div class="form-group">
    {{Form::label('title','Title')}} {{Form::text('title',$post->title,['class' => 'form-control', 'placeholder' => 'Title'])}}
</div>
<div class="form-group">
    {{Form::label('body','Body')}} {{Form::textarea('body',$post->body,['id' => 'article-editor','class' => 'form-control', 'placeholder'
    => 'Write here..'])}}
</div>
<table class="table">
    <tr>
        <th><img style="width=100%" src="/storage/cover_imgs/{{$post->cover_img}}"></th>
        <th>{{Form::file( 'cover_img', ['class' => 'btn btn-info'])}}</th>
    </tr>
    <tr>
        <th>{{Form::submit('Update', ['class' => 'btn btn-info'])}} {{Form::hidden('_method','PUT')}} {!! Form::close() !!}</th>
    </tr>
</table>
@endsection