@extends('adminlte::page')

@section('title', 'SIVOC-ACTIVOS')

@section('content_header')
    <link rel="stylesheet" href="{{ asset("vendor/mycss/style.css") }}">
    <h1 class="m-0 text-dark">ACTIVOS</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <span data-toggle="modal" data-target="#ModalRegisterAsset">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Activo">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                   
                    @include('assets.register')
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableAssets" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Calibración</th>
                                <th>Fecha Compra</th>
                                <th>Fecha Calibración</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($assets)
                                @foreach ($assets as $asset)
                                    <tr>
                                        <td>{{ $asset->id }}</td>
                                        <td>{{ $asset->description }}</td>
                                        @if ($asset->calibration == 1)
                                            <td>SI</td>
                                        @else
                                            <td>NO</td>
                                        @endif

                                        <td>{{ $asset->day_buy }}</td>

                                        @if ($asset->month >= 11)
                                            <td><p class="flash">{{ $asset->date_calibration }}</p></td>
                                        @else
                                            <td>{{ $asset->date_calibration }}</td>
                                        @endif
                                            
                                        
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <span data-toggle="modal" data-target="#ModalEditAsset">
                                                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar Activo" onclick="editAsset({{$asset->id}})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </span>
                                                <span data-toggle="modal" data-target="#ModalShowFilesAsset">
                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos" onclick="showAssetFile({{$asset->id}}, 'General')">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                                <span data-toggle="modal" data-target="#ModalShowFilesAsset">
                                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos de calibración" onclick="showAssetFile({{$asset->id}}, 'Calibracion')">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </span>
                                                @if (Auth::user()->hasRole('admin'))
                                                    <form action="{{ route('assets.destroy',$asset->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                        
                                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Calibración</th>
                                <th>Fecha Compra</th>
                                <th>Fecha Calibración</th>
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
                        if (column == 6) {
                            return false;
                        }
                        return true;
                    },
                }
            };

            $("#tableAssets").DataTable({
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
            
            
            //grafica(1,'donutChart', 'pie');
        } );
    </script>
    <script src="{{ asset('vendor/myjs/assets.js') }}"></script>

@stop
