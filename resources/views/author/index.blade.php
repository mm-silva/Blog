@extends('adminlte::page')
<style>
    .modal-dialog {
        max-width: 800px !important;
    }
    .titulos{
        visibility: hidden;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.js"></script>



@section('title', '| Serviços')


@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Serviços</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" id="myInput" name="table_search" class="form-control float-right" placeholder="Pesquisar">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 450px;">
                <table id="myTable" class="table table-head-fixed">

                    <thead class="titulos">
                    <tr>
                        <th>#</th>
                        <th>Serviço</th>
                        <th>Descrição</th>
                        <th>Valor</th>

                    </thead>
                    <tbody class="insert">
                    {{-- <tr > --}}

                    {{-- @foreach($ficha as $row => $value)
                    <tr>
                      <td>
                        <img src="{{Storage::url($value->imagem)}}" class="img-fluid mb-2" height="100px" width="100px">
                        </td>
                      <td class="align-middle">{{$value->pet_nome}}</td>
                      <td class="align-middle">{{($value->pet_idade < 1 ? "$value->pet_idade meses" : "$value->pet_idade anos")}}</td>
                      <td class="align-middle">{{($value->pet_peso < 1 ? "$value->pet_peso g" : "$value->pet_peso kg" )}}</td>
                      <td class="align-middle">{{$value->tipo}}</td>
                      <td class="align-middle">{{$value->nome_dono}}</td>
                      <td class="align-middle">{{ date('d/m/Y', strtotime($value->ultima_visita))}}</td>
                      <td class="align-middle">
                      <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{route("fichas.edit",$value->id)}}" class="btn btn-warning"><i class="fas fa-pencil-alt text-white"></i></a>
                        <a href="{{route("fichas.show",$value->id)}}" class="btn btn-info"><i class="fas fa-eye text-white"></i></a>
                     <form action="{{route("fichas.destroy",$value->id)}}" method="POST">
                      @csrf
                      @method("DELETE")
                        <button class="btn btn-danger"><i class="fas fa-trash-alt text-white"></i></button>

                      </div>
                     </td>
                       </tr>
                    <tr>
                       @endforeach --}}


                    {{-- </tr> --}}
                    {{-- <tr> --}}
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.card -->


        <a href="{{route("posts.create")}}" class="btn btn-info font-weight-bold">Create</a>


    </div>
@stop

<script>




</script>
