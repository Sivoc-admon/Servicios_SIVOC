<!-- Modal REGISTRO DE AUDITORIA INTERNA -->
<div class="modal fade" id="ModalRegisterInternalAudit" tabindex="-1" aria-labelledby="ModalRegisterInternalAudit" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterUser">
              @csrf
                <div class="row">
                  <h4>Datos Auditoria</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputAreaAudit">Área</label>
                        <select class="form-control" name="sltAreaAudit" id="sltAreaAudit">
                            @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEvaluator">Evaluador</label>
                        <select class="form-control" name="sltEvaluator" id="sltEvaluator">
                          <option value="0">Selecciona</option>
                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}} {{$user->mother_last_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputDateAudit">Fecha de registro</label>
                        <input type="date" class="form-control" id="inputDateAudit" name="inputDateAudit" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="fileInternalAudit" class="form-label">Documentos</label>
                          <input class="form-control" type="file" id="fileInternalAudit" name="fileInternalAudit" multiple>
                        </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveInternalAudit();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal MOSTRAR ARCHIVOS AUDITORIA INTERNA -->
<div class="modal fade bd-example-modal-lg" id="ModalShowInternalAuditFiles" tabindex="-1" aria-labelledby="ModalShowInternalAuditFiles" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="hidInternal" id="hidInternal">
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableInternalAuditFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Archivo</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody id="bodyInternalAuditFiles">
                  
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
                <label for="fileUploadInernal" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadInernal" name="fileUploadInernal" multiple>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>