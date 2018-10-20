<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999'
        ]);

        //handle cover_img
        if($request->hasFile('cover_img')){
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'.'.time().'.'.$extension;
            $path = $request->file('cover_img')->storeAs('public/cover_imgs',$fileNameToStore);
        }else
            $fileNameToStore = 'noimage.jpg';

        //create a post
        $post = new Post;
        $input = $request->all();
        $post->title = $input['title'];
        $post->body = $input['body'];
        $post->user_id = auth()->user()->id;
        $post->cover_img = $fileNameToStore;
        $post->save();
        return redirect('/home')->with('success','Post Created Successfully !!');
    }
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);
        if($post->user_id == auth()->user()->id){
            return view('posts.edit')->with('post',$post);  
        }
        else
           return redirect('/home')->with('error','Unauthorized !!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
         if($request->hasFile('cover_img')){
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'.'.time().'.'.$extension;
            $path = $request->file('cover_img')->storeAs('public/cover_imgs',$fileNameToStore);
        }
        $post = Post::find($id);
        $input = $request->all();
        $post->title = $input['title'];
        $post->body = $input['body'];
        if($request->hasFile('cover_img')){
            $post->cover_img = $fileNameToStore;
        }
        $post->update();
        return redirect('/home')->with('success','Post Updated Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $post = Post::find($id);
        if($post->user_id ==  auth()->user()->id){
            $post->delete();
            if($post->cover_img != 'noimage.jpg'){
                Storage::delete('/public/cover_imgs/'.$post->cover_img);
            }
            return redirect('/home')->with('success','Post Deleted Successfully !!');
            
        }
        else
            return redirect('/home')->with('error','Unauthorized !!');
    }
}
