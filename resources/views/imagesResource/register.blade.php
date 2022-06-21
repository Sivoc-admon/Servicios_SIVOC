<!-- Modal Nuevo Boton -->
<div class="modal fade" id="ModalRegisterImage" tabindex="-1" aria-labelledby="ModalRegisterImage" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterButton">
              @csrf
                <div class="row">
                  <h4>Datos de Imagen</h4>
                </div>

                <div class="row" style="background-color: #17a2b8">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputImage">Nombre</label>
                        <input type="text" class="form-control" name="inputImage" id="inputImage">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fileImage" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="fileImage" name="fileImage[]" multiple>
                      </div>
                    </div>
                </div>

            </form>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveImg();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal Preview Image -->
<div class="modal fade" id="ModalPreview" tabindex="-1" aria-labelledby="ModalPreview" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Vista Previa</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <input type="hidden" name="idButon" id="idButon">
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style='display:flex; justify-content:center;'>
                        <img id="preview" style="width:50%">
                    </div>
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

