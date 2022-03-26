<!-- Modal REGISTRO DE SGC -->
<div class="modal fade" id="ModalRegisterSGC" tabindex="-1" aria-labelledby="ModalRegisterSGC" aria-hidden="true">
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
            <form id="formRegisterSgc">
              @csrf
                <div class="row">
                  <h4>Documento SGC</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltArea">Área</label>
                      <select class="form-control" name="sltArea" id="sltArea">
                          <option value="0">Seleccione</option>
                          @foreach ($areas as $area)
                              <option value="{{$area->id}}">{{$area->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sltSGC">Tipo</label>
                        <select class="form-control" name="sltSGC" id="sltSGC">
                            <option value="0">Seleccione</option>
                            <option value="PR">Procedimientos</option>
                            <option value="PRF">Formato de Procedimiento</option>
                            <option value="IT">Instructivo de Trabajo</option>
                            <option value="ITF">Formato de Instructivo de Trabajo</option>
                            <option value="DI">Diagrama</option>
                            <option value="MA">Manual</option>
                            <option value="AV">Ayuda Visual</option>

                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputResponsable">Responsable</label>
                        <select class="form-control" name="inputResponsable" id="inputResponsable">
                            <option value="0">Seleccione responsable</option>
                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}} {{$user->mother_last_name}}</option>
                          @endforeach
                        </select>
                        
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputCodigo">Código</label>
                          <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" required >
                          
                        </div>
                      </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputDescription">Descripción</label>
                        <textarea class="form-control" name="inputDescription" id="inputDescription" cols="7" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputCreate">Fecha de Creación</label>
                          <input type="date" class="form-control" id="inputCreate" name="inputCreate" required >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputUpdate">Fecha de Actualización</label>
                          <input type="date" class="form-control" id="inputUpdate" name="inputUpdate" required >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="fileSgc" class="form-label">Documentos</label>
                          <input class="form-control" type="file" id="fileSgc" name="fileSgc" multiple>
                        </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveSgc()">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal EDITAR DE SGC -->
<div class="modal fade" id="ModalEditSGC" tabindex="-1" aria-labelledby="ModalEditSGC" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formEditSgc">
            @csrf
              <div class="row">
                <h4>Documento SGC</h4>
              </div>
                
              <div class="row" style="background-color: #17a2b8">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" name="hIdSgc" id="hIdSgc">
                    <label for="sltEditAreaSgc">Área</label>
                    <select class="form-control" name="sltEditAreaSgc" id="sltEditAreaSgc">
                        <option value="0">Seleccione</option>
                    </select>
                  </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltEditTypeSGC">Tipo</label>
                      <select class="form-control" name="sltEditTypeSGC" id="sltEditTypeSGC">
                          <option value="0">Seleccione</option>
                          <option value="PR">Procedimientos</option>
                          <option value="PRF">Formato de Procedimiento</option>
                          <option value="IT">Instructivo de Trabajo</option>
                          <option value="ITF">Formato de Instructivo de Trabajo</option>
                          <option value="DI">Diagrama</option>
                          <option value="MA">Manual</option>
                          <option value="AV">Ayuda Visual</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditResponsable">Responsable</label>
                      
                      <select class="form-control" name="inputEditResponsable" id="inputEditResponsable">
                        <option value="0">Seleccione responsable</option>
                      @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}} {{$user->mother_last_name}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditCodigoSgc">Código</label>
                        <input type="text" class="form-control" id="inputEditCodigoSgc" name="inputEditCodigoSgc" required >
                        
                      </div>
                    </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditDescriptionSgc">Descripción</label>
                      <textarea class="form-control" name="inputEditDescriptionSgc" id="inputEditDescriptionSgc" cols="7" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditCreateSgc">Fecha de Creación</label>
                        <input type="date" class="form-control" id="inputEditCreateSgc" name="inputEditCreateSgc" required >
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditUpdateSgc">Fecha de Actualización</label>
                        <input type="date" class="form-control" id="inputEditUpdateSgc" name="inputEditUpdateSgc" required >
                      </div>
                  </div>
                  
              </div>

          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="updateSgc()">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>

<!-- Modal MOSTRAR ARCHIVOS AUDITORIA INTERNA -->
<div class="modal fade bd-example-modal-lg" id="ModalShowSgcFiles" tabindex="-1" aria-labelledby="ModalShowSgcFiles" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="hideSgcId" id="hideSgcId">
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableSgcFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Archivo</th>
                      <th>No. Revision</th>
                      <th>Acción</th>
                      
                  </tr>
              </thead>
              <tbody id="bodySgcFiles">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Archivo</th>
                      <th>No. Revision</th>
                      <th>Acción</th>
                  </tr>
              </tfoot>
            </table>
            @if(Auth::user()->hasAnyRole(['admin', 'calidad']))
            <div class="col-md-6">
              <div class="form-group">
                <label for="fileUploadSgcFile" class="form-label">Documentos</label>
                <input class="form-control" type="file" id="fileUploadSgcFile" name="fileUploadSgcFile">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="button" class="btn btn-success" onclick="masDocumentosSgc()">Guardar Documentos</button>
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