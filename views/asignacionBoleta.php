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
                <a href="#" class="brand-logo">Asignacion Boleta</a>
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
                            <button class="btn btn-success" onclick="listarCompradoresAsignacionBoletos()">Listar</button>
                        </div>
                        <table id="tblistadoCompradoresAsignacionBoletos">
                          <thead>
                            <th>cc</th>
                            <th>nombre</th>                       
                            <th>correo</th>
                            <th></th>
                          </thead>
                        </table>
                    </div>                 
              </div>
          </div>
      </section>
    </div>


    <div class="content-wrapper">        
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                    <div class="panel-body table-responsive" id="listadoregistros">    
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <select name="idcliente" id="idcliente" data-live-search="true" required></select>
                            <button class="btn btn-success" onclick="listarBoletasDisponiblesCiudad()">Mostrar</button>
                        </div>
                        <table id="tblistadoBoletosDisponibles">
                          <thead>
                            <th>Ciudad</th>
                            <th>Boletas Disponibles #</th>
                            <th>idBoleta</th>
                            <th></th>
                          </thead>
                        </table>
                    </div>                 
              </div>
          </div>
      </section>
    </div>

    <div class="content-wrapper">        
        <section class="content">
            <div class="row">
            <form name="formulario" id="formulario" method="POST">
                    <div class="row">
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="cc" id="cc" type="text" class="validate" required>
                            <label for="cc">cc</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="idBoleta" id="idBoleta" type="text" class="validate" required>
                            <label for="idBoleta">IdBoleta</label>
                        </div>                       
                        <div class="input-field col s12 l4 m6" id="_select">

                        </div>
                        <div class="input-field col s12 l4 m6">
                            <!-- Button con metodo OnClick-->
                            <button class="btn btn-success" onclick="asignar()">Asignar</button>
                        </div>
                    </div>
                </form>

              </div>
          </div>
      </section>
    </div>

    <script src="../controllers/consultas.js"></script>

