<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use function Termwind\render;

class BlogController extends Controller
{
    protected $limit = 4;

    public function index()
    {
        // ComposerServiceProvider

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
            
        return view('blog/index', compact('posts'));
        // die('blog index');
    }
    
    public function category(Category $category)
    {// ComposerServiceProvider
        $categoryName = $category->title;
        
        $posts = $category->posts()
                          ->with('author')
                          ->latestFirst()
                          ->published()
                          ->simplePaginate($this->limit);

        return view('blog/index', compact('posts', 'categoryName'));
        // die('blog index');
    }

    public function show(Post $post)
    {
        // $post = Post::published()->findOrFail($id);
        return view("blog.show", compact('post'));
    }
} 
