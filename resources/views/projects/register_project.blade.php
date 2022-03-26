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
                              <option value="PE">PUESTA EN MARCHA</option>
                              <option value="PO">OPERACIONAL</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputNameProject">Nombre de Proyecto</label>
                            <input type="text" class="form-control" id="inputNameProject" name="inputNameProject" placeholder="Nombre del proyecto" required>
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
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <table id="tableProjectFiles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Archivo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="showProjectFiles">

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Archivo</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fileUploadProjectFile" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadProjectFile" name="fileUploadProjectFile" multiple>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="button" class="btn btn-success" onclick="masDocumentos()">Guardar Documentos</button>
              </div>
            </div>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div>

