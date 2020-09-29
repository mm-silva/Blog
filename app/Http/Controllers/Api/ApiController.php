<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tags;
use App\Author;
use Carbon\Carbon;

class ApiController extends Controller
{


    public function index(Request $request)
    {

        $ficha = DB::select('select a.id_agendamento,p.id_pet,p.tipo, p.foto_pet, p.nome_pet, p.idade_pet,
     p.tipo, d.nome, d.telefone, a.data_agendada, s.tipo_servico from pet_agendado pg
    inner join pet p on p.id_pet = pg.id_pet
    inner join agendamento a on a.id_agendamento = pg.id_agendamento
    inner join dono d on d.id_dono = a.id_dono inner join servico_pet s on s.id_servico = a.id_servico;
    ');

        return response()->json($ficha);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = [];
        $ficha = Fichas::all();

        return view("admin.consultas.create")->with('ficha',$ficha);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $dono = Pet::select('id_dono')->where('id_pet',$request->id_pet)->first();

        $marcado = [
            'data_agendada' => "$request->data_agendada $request->horario",
            'id_dono' => $dono->id_dono,
            'id_servico' => $request->id_servico,
        ];
        $agendado = Agendamentos::where($marcado)->first();
        if($agendado){
            return response()->json("O agendamento já existe!");
        }

        Agendamentos::create($marcado);
        $id = Agendamentos::select('id_agendamento')->where('data_agendada', $request->data_agendada." ".$request->horario)->where('id_dono',$dono->id_dono)->where('id_servico', $request->id_servico)->first();
        Agendado::create(['id_agendamento' => $id->id_agendamento,'id_pet' => $request->id_pet]);

        return response()->json("Consulta cadastrada!");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ficha = Fichas::find($id);

        return view("admin.fichas.show")->with("ficha",$ficha);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ficha = Fichas::find($id);
        return view("admin.fichas.edit")->with("ficha", $ficha);
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
        Agendado::where('id_agendamento',$id)->delete();
        Agendamentos::where('id_agendamento',$id)->delete();

        return response()->json("ok");
    }
    public function consultas()
    {
        $url = Storage::url("pets/$filename");
        return Storage::url('');
    }

}
