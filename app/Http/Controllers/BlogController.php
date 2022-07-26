<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;
use App\Models\User;
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

    public function author(User $author)
    {
        // die('posts by author');

        $authorName = $author->name;
        
        $posts = $author->posts()
                          ->with('category')
                          ->latestFirst()
                          ->published()
                          ->simplePaginate($this->limit);

        return view('blog/index', compact('posts', 'authorName'));
        // die('blog index');
    }


    public function show(Post $post)
    {
        // update posts set view_count = view_count + 1 where id = ?
        # 1
        // $viewCount = $post->view_count + 1;
        // $post->update(['view_count' => $viewCount]);
        
        # 2
        $post->increment('view_count', 1);
        
        return view("blog.show", compact('post'));
    }
} 
