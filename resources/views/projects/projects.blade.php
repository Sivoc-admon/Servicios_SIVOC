@extends('adminlte::page')

@section('title', 'SIVOC-PROYECTOS')

@section('content_header')
    <link rel="stylesheet" href="{{ asset("vendor/mycss/style.css") }}">
    <h1 class="m-0 text-dark">PROYECTOS</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasAnyRole(['admin', 'calidad', 'operaciones', 'manufactura', 'servicio']))
                    <span data-toggle="modal" data-target="#exampleModal">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Proyecto">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                   
                    @endif
                    @include('projects.register_project')
                    @include('projects.board')

                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableProjects" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Nombre de proyecto</th>
                                <th>Tipo</th>
                                <th>Referencia de proyecto</th>
                                <th>Cliente</th>
                                <th>Estatus</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($projects)
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>
                                            <span data-toggle="modal" data-target="#ModalShowFilesProject">
                                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos" onclick="showProjectFile({{$project->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                        @if (Auth::user()->hasAnyRole(['admin', 'calidad', 'operaciones', 'manufactura', 'servicio', 'ventas']))
                                            
                                            <span data-toggle="modal" data-target="#ModalShowBoard">
                                                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Mostrar Tableros" onclick="showBoards({{$project->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                            
                                        
                                        </td>
                                        @endif
                                        
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->name_project }}</td>
                                        <td>{{ $project->type }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->name_customer }}</td>
                                        <td>{{ $project->status }}</td>

                                        @if (Auth::user()->hasAnyRole(['admin', 'calidad', 'operaciones', 'manufactura', 'servicio', 'ventas']))
                                            <td>
                                                <span data-toggle="modal" data-target="#ModalRegisterBoard">
                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo tablero" onclick="datosTablero({{$project->id}}, '{{$project->name_project}}')">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                                <span data-toggle="modal" data-target="#ModalEditProyect">
                                                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar proyecto" onclick="editProject({{$project->id}})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </span>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        
                                        
                                    </tr>
                                @endforeach
                            @endisset
                            
                            
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Nombre de proyecto</th>
                                <th>Tipo</th>
                                <th>Referencia de proyecto</th>
                                <th>Cliente</th>
                                <th>Estatus</th>
                                <th>Acción</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md6">
            <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Estatus de Proyecto</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">
                                </div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class="">
                                </div>
                                </div>
                            </div>
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 348px;" width="435" height="312" class="chartjs-render-monitor">
                        </canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            let statusGrafica="";

            $("#tableProjects").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   -1
                } ]
            });

            let status= [@json($colocado),@json($proceso),@json($terminado)]
            console.log(status);
            
            grafica(status,'donutChart', 'pie');
        } );
    </script>
    <script src="{{ asset('vendor/myjs/projects.js') }}"></script>

@stop
