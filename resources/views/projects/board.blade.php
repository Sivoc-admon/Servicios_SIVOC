
<!-- Modal CREAR TABLERO -->
<div class="modal fade bd-example-modal-lg" id="ModalRegisterBoard" tabindex="-1" aria-labelledby="ModalRegisterBoard" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de tablero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" id="formRegisterBoard">
                  @csrf
                    <div class="row">
                      <h4>Datos de tablero</h4>
                    </div>
                      
                    <div class="row" style="background-color: rgb(144, 240, 144)">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputProyectBoard">Proyecto</label>
                          <input type="text" class="form-control" id="inputProyectBoard" name="inputProyectBoard" readonly>
                          <input type="hidden" id="inputIdProyect" name="inputIdProyect">
                            
                        </div>
                      </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inputNameBoard">Nombre de tablero</label>
                            <input type="text" class="form-control" id="inputNameBoard" name="inputNameBoard" placeholder="Nombre de tablero" required>
                          </div>
                        </div>
                    </div>
  
                </form>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="saveBoard()">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal MOSTRAR TABLEROS -->
<div class="modal fade bd-example-modal-lg" id="ModalShowBoard" tabindex="-1" aria-labelledby="ModalShowBoard" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tableros del Proyecto </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableProjectsBoards" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Nombre de tablero</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody id="bodyProjectBoards">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nombre de proyecto</th>
                      <th>Acción</th>
                  </tr>
              </tfoot>
            </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>