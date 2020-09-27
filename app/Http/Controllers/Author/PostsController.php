<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "pet_nome" => "required",
            "pet_peso" => "required",
            "pet_idade" => "required",
            "tipo" => "required",
            "raça" => "required",
            "nome_dono" => "required",
            "telefone" => "required"
        ]);

        if ($validator->fails()) {
            return redirect('fichas/create')
                ->withErrors($validator)
                ->withInput();
        }else{
            // Define o valor default para a variável que contém o nome da imagem
            $nameFile = null;

            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

                // Define um aleatório para o arquivo baseado no timestamps atual
                $date = date('HisYmd');

                // Recupera a extensão do arquivo
                $extension = $request->imagem->extension();
                $pet = Str::slug($request->nome_pet, '-');
                // Define finalmente o nome
                $nameFile = $pet.$date.".{$extension}";

                // Faz o upload:
                $upload = $request->imagem->storeAs('public/pets', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if ( !$upload )
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();

            }

            $dono =[ "nome" => $request->nome_dono,
                "telefone" => $request->telefone,
                "endereco" => $request->endereco,];
            Dono::create($dono);
            $x = Dono::where("nome" , $request->nome_dono)->get();
            $create = [
                "nome_pet" => $request->pet_nome,
                "peso" => $request->pet_peso,
                "idade_pet" => $request->pet_idade,
                "tipo" => $request->tipo,
                "raca" => $request->raça,
                "primeira_visita" => Carbon::now(),
                "ultima_visita" => Carbon::now(),
                "foto_pet" => "/pets/$nameFile",
                "id_dono" => $x[0]->id_dono
            ];

            Pet::create($create);

            return redirect("/fichas")->with("success","Ficha Cadastrada com sucesso!");
        }
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
        return view("author.edit")->with("id", $id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
