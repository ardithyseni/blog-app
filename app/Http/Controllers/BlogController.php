<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;

use function Termwind\render;

class BlogController extends Controller
{
    protected $limit = 4;

    public function index()
    {
        $posts = Post::with('author')->latestFirst()->simplePaginate($this->limit);
        return view('blog/index', compact('posts'));
        // die('blog index');
    }
} 