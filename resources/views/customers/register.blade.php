 <!-- Modal -->
 <div class="modal fade" id="ModalRegisterCustomer" tabindex="-1" aria-labelledby="ModalRegisterCustomer" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterCustomer">
              @csrf
                <div class="row">
                  <h4>Datos Cliente</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputNameCustomer">Nombre</label>
                        <input type="text" class="form-control" id="inputNameCustomer" name="inputNameCustomer" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputCodeCustomer">Código</label>
                        <input type="text" class="form-control" id="inputCodeCustomer" name="inputCodeCustomer" placeholder="Código" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputAddressCustomer">Dirección</label>
                        <input type="text" class="form-control" id="inputAddressCustomer" name="inputAddressCustomer" placeholder="Dirección" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputPhoneCustomer">Teléfono</label>
                        <input type="text" class="form-control" id="inputPhoneCustomer" name="inputPhoneCustomer" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEmailCustomer">Correo</label>
                        <input type="email" class="form-control" id="inputEmailCustomer" name="inputEmailCustomer" required>
                      </div>
                    </div>
                    
                    
                </div>
               

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveCustomer();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>