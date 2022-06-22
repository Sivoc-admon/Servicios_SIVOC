<!-- Modal  REGISTRAR PROYECTO-->
<div class="modal fade bd-example-modal-lg" id="modalCreateRequisition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Requisición</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_id">Departamento Solicita</label>
                            <select class="form-control" id="project_id" name="project_id">
                                <option value="">Seleccione un area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_project">No. Requisición</label>
                            <input type="text" class="form-control" id="name_project" name="name_project" placeholder="Nombre del Proyecto" value="R-{{$newRequisition}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <button type="submit" class="btn btn-success" onclick="addRow()">Nuevo item</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style="overflow-x: scroll">
                        <table id="createRequisition" class="table table-striped" width="100%">

                            <tbody id="tableBodyCreateRequisition"></tbody>
                        </table>
                    </div>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" onclick="saveRequisition()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiaTabla()">Close</button>
          </div>
      </div>
    </div>
</div>
