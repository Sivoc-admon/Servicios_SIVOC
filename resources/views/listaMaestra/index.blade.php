@extends('adminlte::page')

@section('title', 'SIVOC-PROYECTOS')

@section('content_header')
    @section('plugins.Jstree', true)
    <link rel="stylesheet" href="{{ asset("vendor/mycss/style.css") }}">

    @section('css')
        <style>
            ul, #myUL {
                list-style-type: none;
            }

            #myUL {
                margin: 0;
                padding: 0;
            }

            .caret {
                cursor: pointer;
                -webkit-user-select: none; /* Safari 3.1+ */
                -moz-user-select: none; /* Firefox 2+ */
                -ms-user-select: none; /* IE 10+ */
                user-select: none;
            }

            .caret::before {
                content: "\25B6";
                color: red;
                display: inline-block;
                margin-right: 6px;
            }

            .caret-down::before {
                -ms-transform: rotate(90deg); /* IE 9 */
                -webkit-transform: rotate(90deg); /* Safari */'
                transform: rotate(90deg);
            }

            .nested {
                display: none;
            }

            .active {
                display: block;
            }
        </style>
    @stop
    <h1 class="m-0 text-dark">Lista Maestra</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasAnyRole(['admin', 'calidad', 'compras', 'tesoreria', 'manufactura', 'servicio', 'ventas', 'lider calidad', 'lider compras', 'lider recursos humanos', 'lider tesoreria', 'lider ventas', 'lider servicio']))
                    <span data-toggle="modal" data-target="#exampleModal">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Lista Maestra">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                    <span >
                        <button type="button" class="btn btn-info" onclick="showDiv('divProject')" title="Mostrar Proyectos">
                            <i class="fas fa-project-diagram"></i>
                        </button>
                    </span>
                    <span >
                        <button type="button" class="btn btn-success" onclick="showDiv('divFiles')" title="Archivos">
                            <i class="fas fa-folder"></i>
                        </button>
                    </span>

                    @endif



                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="listasMaestras">
                        <ul>
                            <li >nodo 1</li>
                            <li >nodo 2
                                <ul>
                                    <li data-jstree='{"opened":false, "type":"file"}'>subnodo 1</li>
                                    <li data-jstree='{"opened":false, "type":"file"}'>subnodo 2</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script>
        $(document).ready(function() {
            let statusGrafica="";
            $('#listasMaestras').jstree({
                "types" : {
                    "default" : {
                        "icon" : "jstree-folder"
                    },
                    "file" : {
                        "icon" : "fas fa-file"
                    }
                },
                "plugins" : ["types"]
            });


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

            let status= [@json($projects)]

        } );


    </script>
    <script src="{{ asset('vendor/myjs/listaMaestra.js') }}"></script>

@stop
