<?php

namespace App\Http\Controllers\Author;

use App\Author;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $posts = DB::select("SELECT p.post_id,p.title,p.content, p.image, auth.name as 'name_of_author', p.date
                            FROM  post p  inner join author auth on p.author_id = auth.id");
        return view('author.index')->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        foreach (Tags::all() as $tag) {
            $tags [] =  $tag->name;
        }

        return view('author.create')->with("tags", $tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            "image" => "required",
            "contents" => "required",
            "title" => "required",
            "tags" => "required",
        ]);


          // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('image') && $request->file('image')->isValid()) {


                // Recupera a extensão do arquivo
                $extension = $request->image->extension();
                $titles = Str::slug($request->title, '-');
                // Define finalmente o nome
                $nameFile = "$titles.{$extension}";

                // Faz o upload:


                $upload = $request->file("image")->storeAs('public/uploads', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage

                // Verifica se NÃO deu certo o upload (Redireciona de volta)



                if ( !$upload )
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();


                       }

//        array_diff(

        $tagsdb = DB::table('tags')->pluck('name')->all();

        $tag = explode(",",$request->tags);

        $tags = array_diff($tag, $tagsdb);

        $post = [
            "title" => $request->title,
            "image" => "/storage/public/uploads/$nameFile",
            "content" => $request->contents,
            "author_id" => Auth::id(),
            "date" => Carbon::now(),
        ];

        Post::create($post);
        $post_id = Post::where("title", $request->title)->where(
            "content", $request->contents)->where(
            "author_id", Auth::id())->first();

        //novas tags são criadas
        foreach($tags as $name) {
            Tags::create(['name'=> $name]);

            }
        // todas as tags são vinculadas com a tabela tag_post
        foreach($tag as $names) {
            $tag_id = Tags::where(['name' => $names])->first()->tag_id;
            DB::table('tag_post')->insert([
                'post_id' => $post_id->post_id,
                'tag_id' => $tag_id,
            ]);
        }




            return redirect()->back()->with('success', 'successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $post = DB::select("SELECT p.post_id,p.content, p.title, p.image, auth.name as 'name_of_uthor'
FROM  post p  inner join author auth on p.author_id = auth.id where p.post_id = $id");

       $tags =  DB::select("SELECT
       tg.name as 'tag_name' FROM tag_post tgp INNER join post p on tgp.post_id = p.post_id
       inner join tags tg on tgp.tag_id = tg.tag_id where p.post_id = $id;");

       foreach($tags as $tg){
           $tag[] = $tg->tag_name;
       }

        foreach (Tags::all() as $list) {
            $tag_list [] =  $list->name;
        }

        return view("author.edit")->with("post", $post[0])
            ->with("tag_list", $tag_list)
            ->with("tags", $tag)->with("id",$id);
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



        $request->validate([


            "contents" => "required",
            "title" => "required",
            "tags" => "required",
        ]);


        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('image') && $request->file('image')->isValid()) {


            // Recupera a extensão do arquivo
            $extension = $request->image->extension();
            $titles = Str::slug($request->title, '-');
            // Define finalmente o nome
            $nameFile = "$titles.{$extension}";

            // Faz o upload:


            $upload = $request->file("image")->storeAs('public/uploads', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage

            // Verifica se NÃO deu certo o upload (Redireciona de volta)


            if ( empty($nameFile) ){

                $nameFile = null;
            }



        }


//        array_diff(
        $tagsdb = DB::table('tags')->pluck('name')->all();

        $tag = explode(",",$request->tags);

        $tags = array_diff($tag, $tagsdb);



        $post = [
            "title" => $request->title,
            "content" => $request->contents,
            "author_id" => Auth::id(),
            "image" => ($nameFile = '' ? null : "/storage/public/uploads/"),
            "date" => Carbon::now(),
        ];
            if(empty($post['image'])){
                unset($post['image']);
            }
        Post::where('post_id', $id)->update($post);


        //novas tags são criadas
        foreach($tags as $name) {
            Tags::create(['name'=> $name]);

        }
        // todas as tags são vinculadas com a tabela tag_post
        foreach($tag as $names) {
            $tag_id = Tags::where(['name' => $names])->first()->tag_id;
            DB::table('tag_post')->insert([
                'post_id' => $id,
                'tag_id' => $tag_id,
            ]);
        }




        return redirect()->back()->with('success', 'successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tag_post')->where("post_id",$id)->delete();
        Post::where("post_id",$id)->delete();
        return redirect()->back()->with('success', 'successfully!');
        return redirect()->back()->with('success', 'successfully!');

    }
}
