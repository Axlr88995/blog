@extends('layout.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">




        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif @if (count($posts) > 0)
            <h1 align="center">Posts created by you !!</h1>
            <div class="table-responsive">
                <table class="table">
                    @foreach ($posts as $post)
                    <tr align="center" class="success">
                        <th>
                            <img style="width=100%" src="/storage/cover_imgs/{{$post->cover_img}}">
                        </th>
                        <th>
                            <h2>{{$post->title}}</h2>
                        </th>

                        <th>
                            <a class="btn btn-info" href="/posts/{{$post->id}}/edit">Edit Post</a>
                        </th>
                        <th>
                            {!! Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST']) !!} {{Form::submit('Delete', ['class'
                            => 'btn btn-danger'])}} {{Form::hidden('_method','DELETE')}} {!! Form::close() !!}
                        </th>

                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <h1>No Posts Yet! Create Some! :D </h1>
            @endif


        </div>
    </div>
</div>
@endsection