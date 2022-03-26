 <!-- Modal -->
 <div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="ModalEditUser" aria-hidden="true">
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
            <form id="formEditUser">
              @csrf
                <div class="row">
                  <h4>Datos Empleado</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputNameEditUser">Nombre</label>
                        <input type="text" class="form-control" id="inputNameEditUser" name="inputNameEditUser" placeholder="Nombre" required >
                        <input type="hidden" id="idUser">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputLastNameEditUser">Apellido Paterno</label>
                        <input type="text" class="form-control" id="inputLastNameEditUser" name="inputLastNameEditUser" placeholder="Apellido Paterno" required >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputMotherLastNameEditUser">Apellido Materno</label>
                        <input type="text" class="form-control" id="inputMotherLastNameEditUser" name="inputMotherLastNameEditUser" placeholder="Apellido Materno" required >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEmailEditUser">Email</label>
                        <input type="email" class="form-control" id="inputEmailEditUser" name="inputEmailEditUser" required >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sltAreaEditUser">Área</label>
                        <select class="form-control" id="sltAreaEditUser" name="sltAreaEditUser" required>
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputRoleEditUser">Role</label>
                        <select class="form-control" id="inputRoleEditUser" name="inputRoleEditUser" required>
                        </select>
                      </div>
                    </div>
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="updateUser()">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>