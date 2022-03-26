@extends('adminlte::page')

@section('title', 'SIVOC-BOTONES')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">Botones</h1>
@stop

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <span data-toggle="modal" data-target="#ModalRegisterButton">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo bOTON">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>
                        

                        @include('buttons.register')

                    
                    </div>
                </div>
            </div>
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
            
            //table('tableUsers');
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/buttons.js') }}"></script> 
@stop

