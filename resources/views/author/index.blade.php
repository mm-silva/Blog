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
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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

                    <thead class="">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </thead>
                    <tbody class="insert">
                     <tr >


                     @foreach($posts as $key => $value)
                    <tr>
                      <td>
                        <img src="{{asset($value->image)}}" class="img-fluid mb-2" height="100px" width="100px">
                        </td>

                      <td class="align-middle">{{$value->title}}</td>
                      <td class="align-middle">{{$value->name_of_author}}</td>
                        <td class="align-middle">{{date('d/m/Y H:i', strtotime($value->date))}}</td>
                        <td class="align-middle">
                        <a href="{{route("posts.edit",$value->post_id)}}" class="btn btn-warning"><i class="fas fa-pencil-alt text-white"></i></a>
                        </td>
                        <td class="align-middle">
                      <div class="btn-group" role="group" aria-label="Basic example">

                     <form action="{{route("posts.destroy",$value->post_id)}}" method="POST">
                      @csrf
                      @method("DELETE")
                        <button class="btn btn-danger"><i class="fas fa-trash-alt text-white"></i></button>
                     </form>
                      </div>
                     </td>
                       </tr>
                    <tr>
                       @endforeach


                     </tr>
                     <tr>
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
