@extends('adminlte::page')

@section('title', 'SIVOC-Venta de Inicio')

@section ( ' plugins.Datatables ' , true)

<style type="text/css">
    .btn-content button{
        margin: 15px 0;
    }
</style>

@section('content_header')
    <h1 class="m-0 text-dark">Ventana de Inicio</h1>
@stop

@section('content')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Botones</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Imagenes</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    @if(Auth::user()->hasRole('admin'))
    <div class="btn-content">
        <span data-toggle="modal" data-target="#ModalRegisterButton">
            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Boton">
                Agregar Boton
                <i class="fas fa-plus"></i>
            </button>
        </span>

        @include('buttons.register')
    </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableUsers" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buttons as $button)
                                    <tr>
                                        <td>{{ $button->id }}</td>
                                        <td>{{ $button->name }}</td>
                                        <td>{{ $button->color }}</td>
                                        <td>
                                            <span data-toggle="modal" data-target="#ModalShowButtonFiles">
                                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos" onclick="showButtonFile({{$button->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                            <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editButton({{$button->id}});"><i class="fas fa-edit"></i></a>

                                            <form action="{{ route('inicio.destroy',$button->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    @if(Auth::user()->hasRole('admin'))
        <div class="btn-content">
            <span data-toggle="modal" data-target="#ModalRegisterImage">
                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Imagen">
                    Agregar Imagen
                    <i class="fas fa-plus"></i>
                </button>
            </span>

            @include('imagesResource.register')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- class="table table-striped table-bordered" -->
                            <table id="tableImg" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Ruta</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $img)
                                        <tr>
                                            <td>{{ $img->id }}</td>
                                            <td>{{ $img->name }}</td>
                                            <td>{{ $img->path }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarImage({{$img->id}})"><i class="fas fa-minus-square"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Ruta</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  </div>
</div>


@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#tableUsers").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });

            $("#tableImg").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });

            //table('tableUsers');
        } );
    </script>
    <script src="{{ asset('vendor/myjs/buttons.js') }}"></script>
    <script src="{{ asset('vendor/myjs/imagesResource.js') }}"></script>
@stop

