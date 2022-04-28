<!-- Modal  REGISTRAR PROYECTO-->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <form method="POST" id="formRegisterProject">
                    @csrf
                      <div class="row">
                        <h4>Datos de Proyecto</h4>
                      </div>

                      <div class="row" style="background-color: rgb(144, 240, 144)">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="sltTypeProject">Tipo</label>
                            <select class="form-control" id="sltTypeProject" name="sltTypeProject" placeholder="Tipo de proyecto" required>
                              <option value="0">---</option>
                              <option value="PS">Proyecto de Servicio</option>

                            </select>
                          </div>
                        </div>
                        <div class="col-md-4" id="divAdicional" style="display: none">
                            <div class="form-group">
                                <label for="sltProjectAditional">Proyecto</label>
                                <select class="form-control" id="sltProjectAditional" onChange="creaAdiccional()">
                                    <option value="0">Seleccione proyecto</option>
                                    @isset($projects)
                                        @foreach ($projects as $project)
                                            @if ( $project->adicional == null)
                                                <option value="{{$project->id}}">{{$project->name_project}}</option>
                                            @endif
                                        @endforeach
                                    @endisset

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltProjectAditional">Adicional</label>
                                <input type="text" class="form-control" id="adicionalProject" name="adicionalProject" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group">
                                    <label for="inputNameProject">Nombre de Proyecto</label>
                                    <input type="text" class="form-control" id="inputNameProject" name="inputNameProject" placeholder="Nombre del proyecto" readonly>
                                  </div>
                            </div>
                            <div class="row">
                                <div class="form-group">

                                    <button type="button" class="btn btn-success" onClick="tipoProyecto('nuevo')">Nuevo</button>
                                    <button type="button" class="btn btn-info" onClick="tipoProyecto('adicional')">Adicional</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputProyecto">Referencia de proyecto</label>
                            <input type="text" class="form-control" id="inputProyecto" name="inputProyecto" placeholder="Referencia de proyecto" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="sltCliente">Cliente</label>
                            <select class="form-control" name="sltCliente" id="sltCliente">
                                <option value="0">---</option>
                                @foreach ($customers as $customer)
                                  <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputEstatus">Estatus</label>
                            <input type="text" class="form-control" id="inputEstatus" name="inputEstatus" value="Colocado" readonly required>
                          </div>
                        </div>
                      </div>

                  </form>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" onclick="saveProject()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<!-- Modal EDITAR PROYECTO-->
<div class="modal fade bd-example-modal-lg" id="modalEditProyect" tabindex="-1" aria-labelledby="modalEditProyect" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" id="formEditProject">
                  @csrf
                    <div class="row">
                      <h4>Datos de Proyecto</h4>
                    </div>

                    <div class="row" style="background-color: rgb(144, 240, 144)">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sltEditTypeProject">Tipo</label>
                          <select class="form-control" id="sltEditTypeProject" name="sltEditTypeProject" placeholder="Tipo de proyecto" required>

                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputNameProjectEdit">Nombre de Proyecto</label>
                          <input type="text" class="form-control" id="inputNameProjectEdit" name="inputNameProjectEdit" placeholder="Nombre del proyecto" required>
                        </div>
                      </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputEditProyecto">Referencia de proyecto</label>
                            <input type="text" class="form-control" id="inputEditProyecto" name="inputEditProyecto" required>
                            <input type="hidden" name="hideIdProject" id="hideIdProject">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="sltEditCliente">Cliente</label>
                            <select class="form-control" name="sltEditCliente" id="sltEditCliente">

                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputEditEstatus">Estatus</label>
                            <select class="form-control" name="inputEditEstatus" id="inputEditEstatus">

                            </select>
                          </div>
                        </div>
                    </div>

                </form>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="updateProject()">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Mostrar Archivos -->
<div class="modal fade" id="ModalShowFilesProject" tabindex="-1" aria-labelledby="ModalShowFilesProject" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" name="hideModalIdProject" id="hideModalIdProject">
          <input type="hidden" name="hideModalIdFolder" id="hideModalIdFolder">
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fileUploadProjectFile" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadProjectFile" name="fileUploadProjectFile" multiple>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="masDocumentos()">Guardar Documentos</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Mostrar carpetas -->
<div class="modal fade" id="ModalShowFoldersProject" tabindex="-1" aria-labelledby="ModalShowFoldersProject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Carpeta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <input type="hidden" name="hideIDPadreFolder" id="hideIDPadreFolder">
            <input type="hidden" name="hideIDProject" id="hideIDProject">
          </div>
          <div class="modal-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="inputNewFolder" name="inputNewFolder">
                </div>

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="newFolder()">Crear Carpeta</button>
          </div>
      </div>
    </div>
  </div>

