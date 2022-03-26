<!-- Modal TIPO DE INDICADOR -->
<div class="modal fade" id="ModalRegisterTypeIndicador" tabindex="-1" aria-labelledby="ModalRegisterTypeIndicador" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content" style="background-color: #17a2b8">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Tipo de Indicador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterTypeIndicador">
              @csrf
                <div class="row">
                  <h4>Tipo de Indicador</h4>
                </div>
                  
                <div class="row" >
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Tipo de Indicador:</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputLastName">Formula: </label>
                        <input type="text" class="form-control" id="inputFormula" name="inputFormula" placeholder="Formula" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputMinimo">Minimo: </label>
                        <input type="number" class="form-control" id="inputMinimo" name="inputMinimo" placeholder="Minimo" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputMaximo">Maximo: </label>
                        <input type="number" class="form-control" id="inputMaximo" name="inputMaximo" placeholder="Maximo" required>
                      </div>
                    </div>
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveTypeIndicator();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal INDICADOR -->
<div class="modal fade" id="ModalRegisterIndicator" tabindex="-1" aria-labelledby="ModalRegisterIndicator" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content" style="background-color: #17a2b8">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Registro Tipo de Indicador</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formRegisterIndicador" enctype="multipart/form-data">
            @csrf
              <div class="row">
                <h4>Indicador</h4>
              </div>
                
              <div class="row" >
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltArea">Área:</label>
                      <select class="form-control" name="sltArea" id="sltArea">
                        @foreach ($areas as $area)
                          <option value="{{$area->id}}"> {{$area->name}}</option>
                                
                        @endforeach
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputLastName">Tipo de Indicador: </label>
                      <select class="form-control" name="inputIndicatorType" id="inputIndicatorType" onchange="minMax()">
                          <option value="0">--</option>
                        @foreach ($indicatorTypes as $indicatorType)
                          <option value="{{$indicatorType->id}}"> {{$indicatorType->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="minimo">Minimo</label>
                      <input type="number" class="form-control" id="minimo" name="minimo" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="maximo">Maximo:</label>
                      <input type="number" class="form-control" id="maximo" name="maximo" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputValue">Valor Obtenido:</label>
                      <input type="number" class="form-control" id="inputValue" name="inputValue" placeholder="valor">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputreRegistrationDate">Fecha de registro:</label>
                      <input type="date" class="form-control" id="inputreRegistrationDate" name="inputreRegistrationDate" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="fileIndicador" class="form-label">Documentos</label>
                      <input class="form-control" type="file" id="fileIndicador" name="fileIndicador">
                    </div>
                  </div>
              </div>

          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="saveIndicator();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>

<!-- Modal filtro GRAFICA -->
<div class="modal fade" id="ModalGraficaIndicator" tabindex="-1" aria-labelledby="ModalGraficaIndicator" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content" style="background-color: #17a2b8">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Registro Tipo de Indicador</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formGraficaIndicador">
            @csrf
              <div class="row">
                <h4>Grafica</h4>
              </div>
                
              <div class="row" >
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sltAreaGrafica">Área:</label>
                      <select class="form-control" name="sltAreaGrafica" id="sltAreaGrafica">
                        @foreach ($areas as $area)
                          <option value="{{$area->id}}"> {{$area->name}}</option>
                                
                        @endforeach
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputIndicatorTypeGrafica">Tipo de Indicador: </label>
                      <select class="form-control" name="inputIndicatorTypeGrafica" id="inputIndicatorTypeGrafica">
                          <option value="0">--</option>
                        @foreach ($indicatorTypes as $indicatorType)
                          <option value="{{$indicatorType->id}}"> {{$indicatorType->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="fechaInicial">Fecha Inicial:</label>
                      <input type="number" class="form-control" id="fechaInicial" name="fechaInicial" min="2019" value="2019">
                      
                    </div>
                  </div>
                  
              </div>

          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="graficaIndicador();">Graficar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>