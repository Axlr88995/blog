@extends('layout.app') 
@section('content')
<h1>Posts</h1>
@if (count($posts) > 0) @foreach ($posts as $post)
<div class="table-responsive">

    <table class="table">
        <tr align="justify" class="danger">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width=100%" src="/storage/cover_imgs/{{$post->cover_img}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h4><a href="/posts/{{$post ->id}}">{{$post->title}} </a></h4>
                    <td align="right"><small><i>Create by {{$post->user->name}} on {{$post->created_at}}</i></small></td>
                </div>
            </div>
        </tr>
    </table>
</div>
@endforeach {{$posts->links()}} @else
<h1>No Post Found. Create SOME :D.</h1>
@endif
@endsection