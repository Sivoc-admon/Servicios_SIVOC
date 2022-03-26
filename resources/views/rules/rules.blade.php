@extends('adminlte::page')

@section('title', 'SIVOC-CLIENTES')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">Normas</h1>
@stop

@section('content')
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Auth::user()->hasRole(['admin','calidad', 'ingenieria', 'servicio']))
                            <span data-toggle="modal" data-target="#ModalRegisterRule">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Norma">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </span>
                        @endif

                        @include('rules.register')

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableCustomers" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>URL</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rules as $rule)
                                    <tr>
                                        <td>{{ $rule->id }}</td>
                                        <td>{{ $rule->code }}</td>
                                        <td>{{ $rule->name }}</td>
                                        <td> <a href="{{asset($rule->url) }}" target="_blank">{{ $rule->url }}</a></td>
                                        <td>
                                            <span data-toggle="modal" data-target="#ModalShowFiles">
                                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mostrar archivos" onclick="showRuleFile({{$rule->id}})">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </span>
                                            @if (Auth::user()->hasRole(['admin','calidad', 'ingenieria', 'servicio']))
                                            <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editRule({{$rule->id}});"><i class="fas fa-edit"></i></a>
                                        
                                                <form action="{{ route('rules.destroy',$rule->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                                </form>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>URL</th>
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
            $("#tableCustomers").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });
            
            //table('tableUsers');
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/rules.js') }}"></script> 
@stop

