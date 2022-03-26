 <!-- Modal Nuevo Acuerdo -->
 <div class="modal fade" id="ModalRegisterAgreement" tabindex="-1" aria-labelledby="ModalRegisterAgreement" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Acuerdo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterAgreement">
              @csrf
                <div class="row">
                  <h4>Datos Acuerdo</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputDescriptionAgreement">Descripción</label>
                        <textarea class="form-control" id="inputDescriptionAgreement" name="inputDescriptionAgreement" rows="5" cols="7"></textarea>
                        <input id="inputIdMinute" name="inputIdMinute" type="hidden">
                      </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveAgreement();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal Mostrar Acuerdos -->
<div class="modal fade" id="ModalShowAgreement" tabindex="-1" aria-labelledby="ModalShowAgreement" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acuerdos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <table id="tableAgrement" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Acuerdo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="showAgreement">

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Acuerdo</th>
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

<!-- Modal Mostrar Archivos -->
<div class="modal fade" id="ModalShowFiles" tabindex="-1" aria-labelledby="ModalShowFiles" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Archivos</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <input type="hidden" name="hideModalId" id="hideModalId">
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <table id="tableMinuteFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody id="showMinuteFiles">

              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>archivo</th>
                      <th>Acción</th>
                  </tr>
              </tfoot>
          </table>
          <div class="col-md-6">
            <div class="form-group">
              <label for="fileUploadMinuteFile" class="form-label">Documentos</label>
              <input class="form-control" type="file" id="fileUploadMinuteFile" name="fileUploadMinuteFile" multiple>
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