@extends('adminlte::page')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="{{asset("/css/inputTags.css")}}">
@section('title', 'Dashboard')


@section('content')
@section('content')
    <form method="POST" action="/" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <div class="card">
            {{--        @if ($errors->any())--}}
            {{--            <div class="alert alert-danger">--}}
            {{--                <ul>--}}
            {{--                    @foreach ($errors->all() as $error)--}}
            {{--                        <li>{{ $error }}</li>--}}
            {{--                    @endforeach--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            {{--        @endif--}}
            <div class="card-header">
                <h3 class="card-title">edit</h3>

                <div class="card-tools">

                </div>
            </div>

            <div class="card-body">
                <div class="row justify-content-md-center">

                    <textarea class="form-control mt-n1" height="100px" placeholder="Enter ..." name="editor1"></textarea>
                    <script>
                        CKEDITOR.replace( 'editor1' );

                    </script>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="imagem" class="form-control" id="exampleFormControlFile1">
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" maxlength="60">
                        </div>

                    </div>

                </div>
                <input type="text" id="tags" name="tags" value="" />

                <button type="submit" class="btn btn-success ">Criar</button>

            </div>


        </div>
    </form>
@stop
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $('form').bind("keypress", function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
        var dados =  ['Pellentesque', 'habitant', 'morbi', 'tristique', 'senectus', 'netus', 'malesuada', 'fames', 'turpis', 'egestas', 'Vestibulum']

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset("/js/inputTags.jquery.js")}}"></script>
    <script type="text/javascript" src="{{asset("/js/apps.js")}}"></script>


@stop


