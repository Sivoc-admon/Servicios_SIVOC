 <!-- Modal Nueva Minuta -->
 <div class="modal fade" id="ModalRegisterMinute" tabindex="-1" aria-labelledby="ModalRegisterMinute" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Minuta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterMinute">
              @csrf
                <div class="row">
                  <h4>Datos Minuta</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputDescriptionMinute">Descripción</label>
                        <textarea class="form-control" id="inputDescriptionMinute" name="inputDescriptionMinute" rows="5" cols="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sltMinuteType">Tipo</label>
                        <select class="form-control" name="sltMinuteType" id="sltMinuteType">
                         <option value="0">Seleccione</option>
                         <option value="Interna">Interna</option>
                         <option value="Interna">Externa</option>
                         <option value="Interna">Dirección</option>
                         <option value="Cambio SGC">Cambio SGC</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputStatusMinute">Estatus</label>
                        <input type="text" class="form-control" id="inputStatusMinute" name="inputStatusMinute" value="Abierta" required readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sltParticipantesInternos">Participantes internos</label>
                        <select class="form-control" name="sltParticipantesInternos[]" id="sltParticipantesInternos" multiple aria-label="multiple select example">
                          @isset($minutes)
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}} {{$user->mother_last_name}}</option>
                            @endforeach
                          @endisset
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputExternalParticipant">Participantes externos</label>
                        <textarea class="form-control" id="inputExternalParticipant" name="inputExternalParticipant" rows="5" cols="7"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fileMinute" class="form-label">Documentos</label>
                        <input class="form-control" type="file" id="fileMinute" name="fileMinute" multiple>
                      </div>
                    </div>
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveMinute();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

 <!-- Modal Editar Minuta -->
 <div class="modal fade" id="ModalEditMinute" tabindex="-1" aria-labelledby="ModalEditMinute" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Editar Minuta</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formEditMinute">
            @csrf
              <div class="row">
                <h4>Datos Minuta</h4>
              </div>
                
              <div class="row" style="background-color: #17a2b8">
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" name="hIdMinute" id="hIdMinute">
                      <label for="inputEditDescriptionMinute">Descripción</label>
                      <textarea class="form-control" id="inputEditDescriptionMinute" name="inputEditDescriptionMinute" rows="5" cols="5"></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltEditMinuteType">Tipo</label>
                      <select class="form-control" name="sltEditMinuteType" id="sltEditMinuteType">
                       <option value="Interna">Interna</option>
                       <option value="Externa">Externa</option>
                       <option value="Direccion">Dirección</option>
                       <option value="Cambio SGC">Cambio SGC</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltEditStatusMinute">Estatus</label>
                      <select class="form-control" name="sltEditStatusMinute" id="sltEditStatusMinute">
                        <option value="Abierta">Abierta</option>
                        <option value="Proceso">Proceso</option>
                        <option value="Cerrada">Cerrada</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltEditParticipantesInternos">Participantes internos</label>
                      <textarea class="form-control" name="sltEditParticipantesInternos" id="sltEditParticipantesInternos" cols="5" rows="5" readonly></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditExternalParticipant">Participantes externos</label>
                      <textarea class="form-control" id="inputEditExternalParticipant" name="inputEditExternalParticipant" rows="5" cols="7" readonly></textarea>
                    </div>
                  </div>
              </div>
          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="updateMinute();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>
