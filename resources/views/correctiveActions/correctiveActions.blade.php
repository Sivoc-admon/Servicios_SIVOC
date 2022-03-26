@extends('adminlte::page')

@section('title', 'SIVOC-ACCIONES-CORRECTIVAS')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">Mejora Continua</h1>
@stop

@section('content')
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <span data-toggle="modal" data-target="#ModalRegisterCorrectiveAction">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Acción Correctiva">
                                <i class="fas fa-plus"></i>
                            </button>
                        </span>
                        
                        @include('correctiveActions.modalsCorrectiveActions')
                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableCorrectiveActions" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Archivos</th>
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>Tipo de acción</th>
                                    <th>Responsable</th>
                                    <th>Involucrados</th>
                                    <th>Estatus</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($correctiveActions))
                                    @foreach ($correctiveActions as $correctiveAction)
                                        <tr>
                                            <td>
                                                <span data-toggle="modal" data-target="#ModalShowCorrectiveAction">
                                                    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Mostrar Tableros" onclick="showCorrectiveActionFile({{$correctiveAction->id}})">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                            </td>
                                            <td>{{ $correctiveAction->id }}</td>
                                            <td>{{ $correctiveAction->issue }}</td>
                                            <td>{{ $correctiveAction->action }}</td>
                                            @foreach ($allUsers as $allUser)
                                                @if ($correctiveAction->user_id == $allUser->id)
                                                    <td>{{ $allUser->name }} {{ $allUser->last_name }} {{ $allUser->mother_last_name }}</td>
                                                @endif
                                            @endforeach
                                            <td>{{ $correctiveAction->involved }}</td>
                                            <td>{{ $correctiveAction->status }}</td>
                                            <td>{{ $correctiveAction->created_at }}</td>
                                            <td>
                                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editCorrectiveAction({{$correctiveAction->id}});"><i class="fas fa-edit"></i></a>
                                                @if (Auth::user()->hasAnyRole(['admin']))
                                                    <form action="{{ route('correctiveActions.destroy',$correctiveAction->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                        
                                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                                    </form>
                                                @endif
                                                

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Archivos</th>
                                    <th>#</th>
                                    <th>Problematica</th>
                                    <th>Tipo de acción</th>
                                    <th>Responsable</th>
                                    <th>Involucrados</th>
                                    <th>Estatus</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#tableCorrectiveActions").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });
            
            //table('tableUsers');
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/correctiveActions.js') }}"></script> 
@stop

