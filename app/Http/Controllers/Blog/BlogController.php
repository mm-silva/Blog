<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


       $posts = DB::select("SELECT  p.post_id, p.title,p.content, p.image, auth.name as 'name_of_author',
        p.date FROM post p  inner join author auth on p.author_id = auth.id ");


        return view('blog.welcome')->with("posts", $posts);

    }
    public function show($post)
    {
        $posts = DB::select("SELECT   p.title,p.content, p.image, auth.name as 'name_of_author',
        p.date FROM post p  inner join author auth on p.author_id = auth.id ");
        $tags =  DB::select("SELECT
    tg.name as 'tag_name' FROM tag_post tgp INNER join post p on tgp.post_id = p.post_id
                                            inner join tags tg on tgp.tag_id = tg.tag_id where p.post_id = $post;");

        return view('blog.show')->with("value", $posts[0])->with('tags', $tags);

    }
}
