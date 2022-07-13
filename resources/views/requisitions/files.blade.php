<!-- Modal  REGISTRAR PROYECTO-->
<div class="modal fade bd-example-modal-lg" id="modalFilesRequisition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="hiddeIdRequisicion" id="hiddeIdRequisicion">
                            <input type="file" class="form-control" name="inputFile" id="inputFile" multiple>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="uploadFiles('normal')">Guardar archivo</button>
                        </div>
                    </div>
                    <div class="col-md-6" id="divFactura" style="display:none">
                        <div class="form-group">
                            <input type="file" class="form-control" name="inputFileFactura" id="inputFileFactura" multiple>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="uploadFiles('factura')">Guardar Factura</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3>Archivos Generales</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="bodyFiles"></tbody>
                </table>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>
