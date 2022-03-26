@extends('adminlte::page')

@section('title', 'SIVOC-AUDITORIA INTERNA')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">AUDITORIA INTERNA</h1>
@stop

@section('content')
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Auth::user()->hasRole('admin'))
                        <span data-toggle="modal" data-target="#ModalRegisterInternalAudit">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Auditoria">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>

                        @endif
                        

                        @include('internalAudits.register')
                        @include('internalAudits.edit')

                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableInternalAudits" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Área</th>
                                    <th>Evaluador</th>
                                    <th>Fecha Evaluación</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->id }}</td>
                                        <td>{{ $audit->area_name }}</td>
                                        <td>{{ $audit->user_name }} {{ $audit->last_name }} {{ $audit->mother_last_name }}</td>
                                        <td>{{ $audit->date_register }}</td>
                                        <td>
                                            
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <span data-toggle="modal" data-target="#ModalShowInternalAuditFiles">
                                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" onclick="showInternalAuditFile({{$audit->id}})" data-original-title="Mostrar archivos">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                                @if(Auth::user()->hasAnyRole(['admin', 'calidad']))
                                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editInternalAudit({{$audit->id}});"><i class="fas fa-edit"></i></a></button>
                                                
                                                <form action="{{ route('internalAudits.destroy',$audit->id) }}" method="POST">
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
                                    <th>Área</th>
                                    <th>Evaluador</th>
                                    <th>Fecha Evaluación</th>
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
                        if (column == 4) {
                            return false;
                        }
                        return true;
                    },
                }
            };
            $("#tableInternalAudits").DataTable({
                dom: 'Bfrtip',
                buttons: [
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
    <script src="{{ asset('vendor/myjs/internalAudits.js') }}"></script> 
@stop

