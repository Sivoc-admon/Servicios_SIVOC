@extends('adminlte::page')

@section('title', 'SIVOC-DOCUMENTO SGC')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">DOCUMENTOS SGC</h1>
@stop

@section('content')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Auth::user()->hasRole('admin'))
                        <span data-toggle="modal" data-target="#ModalRegisterSGC">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Documento SGC">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>

                        @endif
                        

                        @include('sgc.register')
                        @include('sgc.edit')

                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableSGC" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Fecha Creación</th>
                                    <th>Fecha Actualización</th>
                                    <th>Responsable</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sgcs as $sgc)
                                    <tr>
                                        <td>{{ $sgc->id }}</td>
                                        <td>{{ $sgc->code }}</td>
                                        <td>{{ $sgc->description }}</td>
                                        <td>{{ $sgc->create_date }}</td>
                                        <td>{{ $sgc->update_date }}</td>
                                        <td>{{ $sgc->user_name }} {{ $sgc->last_name }} {{ $sgc->mother_last_name }}</td>
                                        <td>
                                            
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <span data-toggle="modal" data-target="#ModalShowSgcFiles">
                                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" onclick="showSgcFile({{$sgc->id}})" data-original-title="Mostrar archivos">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                                @if(Auth::user()->hasAnyRole(['admin', 'calidad']))
                                                
                                                    <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editSgc({{$sgc->id}});"><i class="fas fa-edit"></i></a></button>
                                                    
                                                    <form action="{{ route('sgc.destroy',$sgc->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                        
                                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Fecha Creación</th>
                                    <th>Fecha Actualización</th>
                                    <th>Responsable</th>
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
            var buttonCommon = {
                exportOptions: {
                    columns: function(column, data, node) {
                        if (column == 6) {
                            return false;
                        }
                        return true;
                    },
                }
            };
            $("#tableSGC").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    /*'csv', 'excel', 'pdf',*/
                    $.extend( true, {}, buttonCommon, {
                        extend: 'csv'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excel'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdf'
                    } )
                ]
            });
            
            //table('tableUsers');
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/sgc.js') }}"></script> 
@stop

