<?php     include '../index.php'; ?>
<?php
  ob_start();
  session_start();
  if(!isset($_SESSION["correo"]))
  {
    header("Location: login.php");
  }
    
?>
<header>
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper" style="padding-left: 10px; padding-right: 10px">
                <a href="#" class="brand-logo">Cancelar Reserva</a>
            </div>
        </nav>
    </div>
</header>
<?php     include './main.php'; ?>
      <div class="content-wrapper">        
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                    <div class="panel-body table-responsive" id="listadoregistros">    
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <select name="idcliente" id="idcliente" data-live-search="true" required></select>
                            <button class="btn btn-success" onclick="listarCompradoresBoletas()">Listar</button>
                        </div>
                        <table id="tblistadoCompradoresBoletas">
                          <thead>
                            <th>cc</th>
                            <th>nombre</th>                       
                            <th>Id Boleta</th>
                            <th>Numero Boleto</th>
                            <th>estado</th>
                            <th>id Compra detalle</th>
                            <th></th>
                          </thead>
                        </table>
                    </div>                 
              </div>
          </div>
      </section>
    </div>

    <script src="../controllers/consultas.js"></script>