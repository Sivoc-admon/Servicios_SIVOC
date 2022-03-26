@extends('adminlte::page')

@section('title', 'SIVOC-CLIENTES')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">Clientes</h1>
@stop

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <span data-toggle="modal" data-target="#ModalRegisterCustomer">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Cliente">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>
                        
                        
                        
                        @include('customers.register')
                        @include('customers.edit')

                    
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
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->code }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editUser({{$customer->id}});"><i class="fas fa-edit"></i></a>
                                        
                                            <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
    <script src="{{ asset('vendor/myjs/customers.js') }}"></script> 
@stop

