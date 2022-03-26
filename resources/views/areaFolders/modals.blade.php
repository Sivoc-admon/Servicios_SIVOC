 <!-- Modal -->
 <div class="modal fade" id="ModalCreateFolder" tabindex="-1" aria-labelledby="ModalCreateFolder" aria-hidden="true" data-controls-modal="ModalCreateFolder" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-md modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Crear nueva carpeta</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="container-fluid">
                     <div id="formFolder">
                         <form id="formRegisterUser">
                             @csrf

                             <input type="hidden" id="nivelFolder">
                             <input type="hidden" id="areaIdFolder">

                             <div class="row" style="background-color: #17a2b8">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="inputName">Nombre de la carpeta</label>
                                         <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre" required>
                                         <span class="control-label" style="color:white;" id="errorFolder"></span>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                     <div id="divMsge" class="text-center">
                         
                     </div>
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-success" onclick="createFolder()" id="guardaModal">Guardar</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             </div>
         </div>
     </div>
 </div>

  <!-- Modal para cambiar el nombre a una carpeta -->
  <div class="modal fade" id="ModalModifyFolder" tabindex="-1" aria-labelledby="ModalModifyFolder" aria-hidden="true" data-controls-modal="ModalModifyFolder" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-md modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="taitolModify">Cambiar nombre a carpeta</h5>
             </div>
             <div class="modal-body">
                 <div class="container-fluid">
                     <div id="formFolderx">
                         <form id="formModifyFolder">
                             @csrf
                            <input type="hidden" id="folderIdModFolder" value="">
                            <input type="hidden" id="folderOldName" value="">
                            <div class="row" style="background-color: #17a2b8">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="inputName">Nuevo nombre de la carpeta</label>
                                         <input type="text" class="form-control" id="inputNameModify" name="inputNameModify" placeholder="Nombre de la carpeta" required>
                                         <span class="control-label" style="color:white;" id="errorFolderModify"></span>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                     <div id="divMsgeModFolder" class="text-center">
                         
                     </div>
                 </div>

             </div>
             <div class="modal-footer" id="buttonsModifyName">
                 <button type="button" class="btn btn-success" onclick="modifyNameFolder()">Guardar</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             </div>
         </div>
     </div>
 </div>