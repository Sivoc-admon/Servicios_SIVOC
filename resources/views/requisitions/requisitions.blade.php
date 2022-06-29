@extends('adminlte::page')

@section('title', 'SIVOC-PROYECTOS')

@section('content_header')
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
            .modal-lg {
                max-width: 90%;
            }
        </style>
    @stop
    <h1 class="m-0 text-dark">Requisiciones</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasAnyRole(['admin', 'calidad', 'tesoreria', 'servicio', 'ventas', 'lider calidad', 'lider compras', 'lider recursos humanos', 'lider tesoreria', 'lider ventas', 'lider servicio']))

                    <span data-toggle="modal" data-target="#modalCreateRequisition" data-backdrop='static'>
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Requisición" onclick="newRequisition()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>


                    @endif
                    @include('requisitions.create_requisition')
                    @include('requisitions.files')


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="tableRequisitions" style="width: 100%" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Area</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($requisitions)
                                @foreach ($requisitions as $requisiton)
                                    <tr>
                                        <td>{{ $requisiton->no_requisition }}</td>
                                        @foreach ($areas as $area)
                                            @if($requisiton->id_area == $area->id)
                                                <td>{{ $area->name }}</td>

                                            @endif
                                        @endforeach
                                        <td>{{ $requisiton->created_at }}</td>
                                        <td>{{ $requisiton->status }}</td>

                                        @if (Auth::user()->hasAnyRole(['admin', 'calidad', 'compras', 'manufactura', 'servicio', 'ventas', 'lider calidad', 'lider compras', 'lider recursos humanos', 'lider servicio', 'lider ventas', 'lider tesoreria']))
                                            <td>
                                                <span data-toggle="modal" data-target="#modalCreateRequisition" data-backdrop='static'>
                                                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar requisicion" onclick="showRequisition({{$requisiton->id}})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </span>
                                                <span data-toggle="modal" data-target="#modalFilesRequisition">
                                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Archivos" onclick="showModalFile({{$requisiton->id}})">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                                @if (Auth::user()->hasAnyRole(['admin', 'lider calidad', 'lider compras', 'lider recursos humanos', 'lider servicio', 'lider ventas', 'lider tesoreria']))
                                                    @switch($requisiton->status)
                                                        @case("creada")
                                                                @switch($requisiton->id_area)
                                                                    @case(1)
                                                                            @if (Auth::user()->hasAnyRole('lider calidad') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @case(2)
                                                                            @if (Auth::user()->hasAnyRole('lider tesoreria') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @case(3)
                                                                            @if (Auth::user()->hasAnyRole('lider compras') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @case(5)
                                                                            @if (Auth::user()->hasAnyRole('lider recursos humanos') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @case(6)
                                                                            @if (Auth::user()->hasAnyRole('lider ventas') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @case(7)
                                                                            @if (Auth::user()->hasAnyRole('lider servicio') || Auth::user()->hasAnyRole('admin'))
                                                                                <span >
                                                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'proceso')">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @default
                                                                @endswitch

                                                            @break
                                                        @case("proceso")
                                                                @if (Auth::user()->hasAnyRole('lider compras') || Auth::user()->hasAnyRole('compras') || Auth::user()->hasAnyRole('admin'))
                                                                    <span >
                                                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'cotizada')">
                                                                            <i class="fas fa-check"></i>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @break
                                                        @case("cotizada")
                                                                @if (Auth::user()->hasAnyRole('lider compras') || Auth::user()->hasAnyRole('compras') || Auth::user()->hasAnyRole('admin'))
                                                                    <span >
                                                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'entregada')">
                                                                            <i class="fas fa-check"></i>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @break
                                                        @case("entregada")
                                                                @if (Auth::user()->hasAnyRole('lider compras') || Auth::user()->hasAnyRole('compras') || Auth::user()->hasAnyRole('admin'))
                                                                    <span >
                                                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Aprobar" onclick="aprobar({{$requisiton->id}}, 'devolucion')">
                                                                            <i class="fas fa-check"></i>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @break
                                                    @endswitch
                                                @endif

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
                                <th>#</th>
                                <th>Area</th>
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



            $("#tableRequisitions").DataTable({
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



        } );

    </script>
    <script src="{{ asset('vendor/myjs/requisitions.js') }}"></script>

@stop
