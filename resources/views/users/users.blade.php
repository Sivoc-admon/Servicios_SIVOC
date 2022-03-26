@extends('adminlte::page')

@section('title', 'SIVOC-USUARIOS')

@section ( ' plugins.Datatables ' , true)

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <span data-toggle="modal" data-target="#ModalRegisterUser">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo Usuario">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>
                        <span data-toggle="modal" data-target="#ModalRestoreUser">
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Restaurar usuario">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </span>
                        

                        @include('users.register')
                        @include('users.edit')

                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- class="table table-striped table-bordered" -->
                        <table id="tableUsers" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Correo</th>
                                    <th>Área</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->mother_last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->area_name }}</td>
                                        <td>
                                            @if ($user->area_name != 'Direccion')
                                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editUser({{$user->id}});"><i class="fas fa-edit"></i></a>
                                            
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                    
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus-square"></i></button>
                                                </form>
                                            @else
                                                
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Correo</th>
                                    <th>Área</th>
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
            $("#tableUsers").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });
            
            //table('tableUsers');
        } );
    </script>  
    <script src="{{ asset('vendor/myjs/users.js') }}"></script> 
@stop

