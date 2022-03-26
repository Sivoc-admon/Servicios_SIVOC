@extends('adminlte::page')

@section('title', 'SIVOC-USUARIOS')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">INDICADORES</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <span data-toggle="modal" data-target="#ModalRegisterTypeIndicador">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tipo de indicador">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#ModalRegisterIndicator">
                        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Registro de indicador">
                            <i class="fas fa-user-plus"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#ModalGraficaIndicator">
                        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Graficar">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </span>
                    @include('indicators.modalsIndicator')

                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="text-align-last:center">Tabla de indicadores</h3>
                    <!-- class="table table-striped table-bordered" -->
                    <table id="tableIndicators" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Tipo Indicador</th>
                                <th>Valor</th>
                                <th>Archivo</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($indicators)
    
                            @foreach ($indicators as $indicator)
                                <tr>
                                    <td>{{ $indicator->area }}</td>
                                    <td>{{ $indicator->tipo_indicador }}</td>
                                    <td>{{ $indicator->value }}</td>
                                    <td><a href="{{asset('storage/Documents/Indicadores/'.$indicator->file_name)}}">{{ $indicator->file_name }}</a></td>
                                    <td>{{ $indicator->registration_date }}</td>
                                </tr>
                            @endforeach
                            
                            @endisset
                            
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Área</th>
                                <th>Tipo Indicador</th>
                                <th>Valor</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="text-align-last:center">Resultados de Graficacion</h3>
                    <!-- class="table table-striped table-bordered" -->
                    <table id="tableIndicatorsDos" class="table table-striped table-bordered" style="width:100%; display:none">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Tipo Indicador</th>
                                <th>Valor</th>
                                <th>Archivo</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody id="bodyIndicatorsDos">
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Área</th>
                                <th>Tipo Indicador</th>
                                <th>Valor</th>
                                <th>Archivo</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="card-body">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <canvas id="chartIndicator" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 348px;" width="435" height="312" class="chartjs-render-monitor"></canvas>
    </div>-->
    <div class="row" id="bar">
        <canvas id="chartIndicator"></canvas>
    </div>
@stop

@section('js')
    
    <script>
        
        $(document).ready(function() {
            $("#tableIndicators").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });

            
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/indicators.js') }}"></script> 
@stop

