<!-- Modal Nuevo Boton -->
<div class="modal fade" id="ModalRegisterButton" tabindex="-1" aria-labelledby="ModalRegisterButton" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Boton</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterButton">
              @csrf
                <div class="row">
                  <h4>Datos Boton</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputButton">Nombre</label>
                        <input type="text" class="form-control" name="inputButton" id="inputButton">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sltColorButton">Color</label>
                        <select class="form-control" name="sltColorButton" id="sltColorButton">
                         <option value="second">Seleccione</option>
                         <option  style="background-color: blue; color:white" value="primary">Primary </option>
                         <option  style="background-color: green; color:white" value="success">Success </option>
                         <option  style="background-color: red; color:white" value="danger">Danger </option>
                         <option  style="background-color: orange; color:white" value="warning">Warning </option>
                         <option  style="background-color: #17a2b8; color:white" value="info">Info </option>
                         
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fileButton" class="form-label">Documentos</label>
                        <input class="form-control" type="file" id="fileButton" name="fileButton">
                      </div>
                    </div>
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveButton();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal Editar Boton -->
<div class="modal fade" id="ModalEditButton" tabindex="-1" aria-labelledby="ModalEditButton" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Registro Boton</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <input type="hidden" name="idButon" id="idButon">
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formEditButton">
            @csrf
              <div class="row">
                <h4>Datos Boton</h4>
              </div>
                
              <div class="row" style="background-color: #17a2b8">
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditButton">Nombre</label>
                      <input type="text" class="form-control" name="inputEditButton" id="inputEditButton">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltEditColorButton">Color</label>
                      <select class="form-control" name="sltEditColorButton" id="sltEditColorButton">
                       <option value="second">Seleccione</option>
                       <option  style="background-color: blue" value="primary">Primary </option>
                       <option  style="background-color: green" value="success">Success </option>
                       <option  style="background-color: red" value="danger">Danger </option>
                       <option  style="background-color: orange" value="warning">Warning </option>
                       <option  style="background-color: #17a2b8" value="info">Info </option>
                       
                      </select>
                    </div>
                  </div>
                  
                  
              </div>

          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="updateButton();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>

<!-- Modal MOSTRAR ARCHIVOS Boton -->
<div class="modal fade bd-example-modal-lg" id="ModalShowButtonFiles" tabindex="-1" aria-labelledby="ModalShowButtonFiles" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="hideButtonId" id="hideButtonId">
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableButtonFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                      
                  </tr>
              </thead>
              <tbody id="bodyButtonFiles">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                  </tr>
              </tfoot>
            </table>
            @if(Auth::user()->hasAnyRole(['admin', 'calidad']))
            <div class="col-md-6">
              <div class="form-group">
                <label for="fileUploadButtonFile" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadButtonFile" name="fileUploadButtonFile">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="button" class="btn btn-success" onclick="masDocumentosButton()">Guardar Documentos</button>
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