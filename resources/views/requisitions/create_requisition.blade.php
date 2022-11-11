<!-- Modal  REGISTRAR PROYECTO-->
<div class="modal fade bd-example-modal-lg" id="modalCreateRequisition" style="overflow-y: scroll;" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Requisición</h5>
          </div>
          <div class="modal-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_id">Departamento Solicita</label>
                            <input type="hidden" name="input_status" id="input_status" value="Creada">
                            <select class="form-control" id="project_id" name="project_id">
                                <option value="">Seleccione un area</option>
                                @if (Auth::user()->hasAnyRole(['admin', 'compras', 'lider compras', 'direccion']))
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ $areaUser->id }}">{{ $areaUser->name }}</option>
                                @endif


                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_project">No. Requisición</label>
                            <input type="text" class="form-control" id="name_project" name="name_project" readonly>
                            <input type="text" style="display:none;" id="requisition_"  >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <button type="submit" id="btn_new_item" class="btn btn-success" onclick="addRow()">Nuevo item</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div style="overflow-x: scroll">
                            <table id="createRequisition" class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cant</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Modelo</th>
                                        <th>Clasificación</th>
                                        <th>Referencia</th>
                                        <th>Nivel de Urgencia</th>
                                        <th>Estatus</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="save_req" onclick="saveRequisition()">Guardar</button>
            <button type="button" class="btn btn-success" id="edit_req" onclick="editRequisition()">Editar</button>
            <button type="button" class="btn btn-secondary" onclick="limpiaTabla()">Cerrar</button>
          </div>
      </div>
    </div>
</div>


<!-- Modal  REGISTRAR PROYECTO-->
<div class="modal fade" id="modalProvider">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="unit_price">Precio Unitario:</label>
                            <input type="number" id="unit_price" min=0>
                        </div>
                    </div>
                    <div class="col-2">
                        <div id="totalProvider"></div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button class="btn btn-success" onclick="saveProvider()"><i class="fas fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="provderTable" class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModalProvider()">Cerrar</button>
          </div>
      </div>
    </div>
</div>
