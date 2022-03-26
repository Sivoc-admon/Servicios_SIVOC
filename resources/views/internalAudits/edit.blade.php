<!-- Modal REGISTRO DE USUARIOS -->
<div class="modal fade" id="ModalEditInternalAudit" tabindex="-1" aria-labelledby="ModalEditInternalAudit" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <input type="hidden" name="hIdInternanl" id="hIdInternanl">
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formEditInternal">
              @csrf
                <div class="row">
                  <h4>Datos Auditoria</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sltEditAreaAudit">Área Evaluada</label>
                        <select class="form-control" name="sltEditAreaAudit" id="sltEditAreaAudit">
                            @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditEvaluator">Evaluador</label>
                        <input type="text" class="form-control" id="inputEditEvaluator" name="inputEditEvaluator" required value="{{ Auth::user()->name}} {{Auth::user()->last_name}} {{Auth::user()->mother_last_name }}" readonly>
                        <input type="hidden" name="inputIdAutor" id="inputIdAutor" value="{{ Auth::user()->id }}" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditDateAudit">Fecha de registro</label>
                        <input type="date" class="form-control" id="inputEditDateAudit" name="inputEditDateAudit" required>
                      </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="updateInternalAudit();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>