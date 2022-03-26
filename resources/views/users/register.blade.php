 <!-- Modal REGISTRO DE USUARIOS -->
 <div class="modal fade" id="ModalRegisterUser" tabindex="-1" aria-labelledby="ModalRegisterUser" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <form id="formRegisterUser">
                @csrf
                  <div class="row">
                    <h4>Datos Empleado</h4>
                  </div>
                    
                  <div class="row" style="background-color: #17a2b8">
                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputName">Nombre</label>
                          <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputLastName">Apellido Paterno</label>
                          <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Apellido Paterno" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputMotherLastName">Apellido Materno</label>
                          <input type="text" class="form-control" id="inputMotherLastName" name="inputMotherLastName" placeholder="Apellido Materno" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputEmail">Email</label>
                          <input type="email" class="form-control" id="inputEmail" name="inputEmail" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputPassword">Contraseña</label>
                          <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="sltArea">Área</label>
                          <select class="form-control" id="sltArea" name="sltArea" required>
                            <option value="0">---</option>
                            @foreach ($areas as $area)
                              <option value="{{ $area->id }}">{{ $area->name }}</option>
                                
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputRole">Role</label>
                          <select class="form-control" id="inputRole" name="inputRole" required>
                            <option value="0">---</option>
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                                  
                              @endforeach
                          </select>
                        </div>
                      </div>
                  </div>

              </form>
            </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="saveUser();">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
</div>

<!-- Modal RESTAURAR USUARIOS -->
<div class="modal fade" id="ModalRestoreUser" tabindex="-1" aria-labelledby="ModalRestoreUser" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Restaurar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <table id="tableUsersRestored" class="table table-striped table-bordered" style="width:100%">
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
                @if (isset($usersEliminados))
                  @foreach ($usersEliminados as $user)
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->last_name }}</td>
                      <td>{{ $user->mother_last_name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->area_name }}</td>
                      <td>
                          @if (Auth::user()->hasRole('admin'))
                              
                          
                              <form action="{{ route('users.restore',$user->id) }}" method="GET">
                                  @csrf
                                  @method('GET')
                  
                                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Restaurar"><i class="fas fa-undo"></i></button>
                              </form>
                          @endif
                          
                      </td>
                  </tr>
                  @endforeach
                @endif
                  

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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div>