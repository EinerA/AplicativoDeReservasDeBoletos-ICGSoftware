

<?php     include '../index.php'; ?>
<header>
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper" style="padding-left: 10px; padding-right: 10px">
                <a href="#" class="brand-logo">Editar Activar/Inactivar Eliminar Comprador</a>
            </div>
        </nav>
    </div>
</header>

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
                            <input placeholder="nombre" id="nombre" type="text" class="validate" required>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="fechaNacimiento" id="fechaNacimiento" type="date" class="validate" required>
                            <label for="fechaNacimiento">Fecha Nacimiento</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="direccion" id="direccion" type="text" class="validate" required>
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="tipoCliente" id="tipoCliente" type="text" class="validate" required>
                            <label for="tipoCliente">Tipo Cliente</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="estado" id="estado" type="text" class="validate" required>
                            <label for="estado">Estado</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="correo" id="correo" type="email" class="validate" required>
                            <label for="correo">Correo</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="contrasena" id="contrasena" type="password" class="validate" required>
                            <label for="contrasena">Contraseña</label>
                        </div>
                        <div class="input-field col s12 l4 m6" id="_select">

                        </div>
                        <div class="input-field col s12 l4 m6">
                            <!-- Button con metodo OnClick-->
                            <button class="btn btn-success" onclick="editarComprador()">Guardar</button>
                        </div>
                    </div>
                </form>

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
                            <button class="btn btn-success" onclick="listarCompradores()">Listar</button>
                        </div>
                        <table id="tblistadoCompradores">
                          <thead>
                            <th>cc</th>
                            <th>nombre</th>                       
                            <th>direccion</th>
                            <th>tipoCliente</th>
                            <th>estado</th>
                            <th>correo</th>
                            <th></th>
                          </thead>
                        </table>
                    </div>                 
              </div>
          </div>
      </section>
    </div>

<script src="../includes/js/consultas.js"></script>
