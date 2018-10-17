<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Posts extends Controller
{
    protected $table = 'posts';

    public $primary_key = 'id';
 
}
