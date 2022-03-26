@extends('adminlte::page')

@section('title', 'SIVOC-MINUTAS')

@section('content_header')
    <link rel="stylesheet" href="{{ asset("vendor/mycss/style.css") }}">
    <h1 class="m-0 text-dark">MINUTAS</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <span data-toggle="modal" data-target="#ModalRegisterMinute">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Minuta">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                   
                    @include('minutes.register_minute')
                    @include('minutes.register_agreement')
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableMinutes" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Minuta</th>
                                <th>Participantes</th>
                                <th>Participantes Externos</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($minutes)
                                @foreach ($minutes as $minute)
                                    <tr>
                                        <td>{{ $minute->id }}</td>
                                        <td>{{ $minute->description }}</td>
                                        <td>{{ $minute->participant }}</td>
                                        <td>{{ $minute->external_participant }}</td>
                                        <td>{{ $minute->type }}</td>
                                        <td>{{ $minute->created_at }}</td>
                                        <td>{{ $minute->status }}</td>
                                        
                                        <td>
                                            <span data-toggle="modal" data-target="#ModalRegisterAgreement">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo acuerdo" onclick="datosMinute({{$minute->id}})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="modal" data-target="#ModalShowAgreement">
                                                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Mostrar acuerdos" onclick="showAgreement({{$minute->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="modal" data-target="#ModalShowFiles">
                                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos" onclick="showMinuteFile({{$minute->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="modal" data-target="#ModalEditMinute">
                                                <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar Minuta" onclick="editMinute({{$minute->id}})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Minuta</th>
                                <th>Participantes</th>
                                <th>Participantes Externos</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
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
            let statusGrafica="";
            var buttonCommon = {
                exportOptions: {
                    columns: function(column, data, node) {
                        if (column == 7) {
                            return false;
                        }
                        return true;
                    },
                }
            };

            $("#tableMinutes").DataTable({
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
            
            
            //grafica(1,'donutChart', 'pie');
        } );
    </script>
    <script src="{{ asset('vendor/myjs/minutes.js') }}"></script>

@stop
