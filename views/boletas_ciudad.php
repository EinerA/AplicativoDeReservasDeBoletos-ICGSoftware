<?php     include '../index.php'; ?>

<header>
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper" style="padding-left: 10px; padding-right: 10px">
                <a href="#" class="brand-logo">Boletas Disponibles</a>
            </div>
        </nav>
    </div>
</header>

      <div class="content-wrapper">        
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                    <div class="panel-body table-responsive" id="listadoregistros">    
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <select name="idcliente" id="idcliente" data-live-search="true" required></select>
                            <button class="btn btn-success" onclick="listarBoletasDisponibles()">Mostrar</button>
                        </div>
                        <table id="tblistado">
                          <thead>
                            <th>Ciudad</th>
                            <th>Boletas Disponibles</th>
                          </thead>
                        </table>
                    </div>                 
              </div>
          </div>
      </section>
    </div>

<script src="../includes/js/consultas.js"></script>






