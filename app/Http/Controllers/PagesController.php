<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome To Blog Bla Bla!!";
        return view('pages.index')->with('title',$title);
    }

    public function service(){
        $title = "Service!!!!!!!!!!";
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design','Game Design','System Architecture Design','WTF Services']
        );
        return view('pages.service')->with($data);
    }

    public function about(){
        $title = "About!!!!!!!!!!";
        return view('pages.about')->with('title',$title);
    }
}
