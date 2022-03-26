 <!-- Modal Edit DE USUARIOS -->
 <div class="modal fade" id="ModalEditUserRh" tabindex="-1" aria-labelledby="ModalEditUserRh" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formEditUserRh">
              @csrf
                <div class="row">
                  <h4>Datos Empleado</h4>
                  <input type="hidden" name="hIdRh" id="hIdRh">
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputNameRh">Nombre</label>
                        <input type="text" class="form-control" id="inputNameRh" name="inputNameRh" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputLastNameRh">Apellido Paterno</label>
                        <input type="text" class="form-control" id="inputLastNameRh" name="inputLastNameRh" placeholder="Apellido Paterno" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputMotherLastNameRh">Apellido Materno</label>
                        <input type="text" class="form-control" id="inputMotherLastNameRh" name="inputMotherLastNameRh" placeholder="Apellido Materno" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEmailRh">Email</label>
                        <input type="email" class="form-control" id="inputEmailRh" name="inputEmailRh" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required readonly >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sltAreaRh">Área</label>
                        <select class="form-control" id="sltAreaRh" name="sltAreaRh" required>
                          <option value="0">---</option>
                          @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                              
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputRoleRh">Role</label>
                        <select class="form-control" id="inputRoleRh" name="inputRoleRh" required>
                          <option value="0">---</option>
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                
                            @endforeach
                        </select>
                      </div>
                    </div>
                </div>
               
                <!-- ANTECEDENTES ACADEMICOS -->
                <div class="row">
                  <h4>Antecedentes Académicos</h4>
                </div>
                <div class="row" style="background-color: #17a2b8">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEstudios">Ultimo Grado de Estudios</label>
                        <select class="form-control" name="inputEstudios" id="inputEstudios">
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="Licenciatura">Licenciatura</option>
                            <option value="Maestria">Maestria</option>
                            <option value="Doctorado">Doctorado</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputProfesion">Profesión</label>
                          <input class="form-control" type="text" name="inputProfesion" id="inputProfesion">
                        </div>
                    </div>
                </div>

                <!-- DATOS PERSONALES -->
                <div class="row">
                  <h4>Datos Personales</h4>
                </div>
                
                <div class="row" style="background-color: #17a2b8">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEdad">Edad</label>
                      <input type="number" class="form-control" id="inputEdad" name="inputEdad">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputGenero">Genero</label>
                      <select class="form-control" name="sltGenero" id="sltGenero">
                        <option value="">Seleccione Genero</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEstadoCivil">Estado Civil</label>
                      <input type="text" class="form-control" id="inputEstadoCivil" name="inputEstadoCivil">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputNSS">NSS</label>
                      <input type="text" class="form-control" id="inputNSS" name="inputNSS">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputRFC">RFC</label>
                      <input type="text" class="form-control" id="inputRFC" name="inputRFC">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputCURP">CURP</label>
                      <input type="text" class="form-control" id="inputCURP" name="inputCURP">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputDireccion">Dirección</label>
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputTelefono">Teléfono</label>
                      <input type="number" class="form-control" id="inputTelefono" name="inputTelefono">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputContacto">Contacto de Emergencia</label>
                      <input type="number" class="form-control" id="inputContacto" name="inputContacto">
                    </div>
                  </div>
                  
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="updateRH();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal MOSTRAR ARCHIVOS de Usuarios -->
<div class="modal fade bd-example-modal-lg" id="ModalShowRHFiles" tabindex="-1" aria-labelledby="ModalShowRHFiles" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="hideRHId" id="hideRHId">
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableRHFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                      
                  </tr>
              </thead>
              <tbody id="bodyRHFiles">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                  </tr>
              </tfoot>
            </table>
            @if(Auth::user()->hasAnyRole(['admin', 'rh']))
            <div class="col-md-6">
              <div class="form-group">
                <label for="fileUploadRHFile" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadRHFile" name="fileUploadRHFile">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="button" class="btn btn-success" onclick="masDocumentosRH()">Guardar Documentos</button>
              </div>
            </div>
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>