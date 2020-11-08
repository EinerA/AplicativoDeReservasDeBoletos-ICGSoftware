<?php     include '../index.php'; ?>
<header>
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper" style="padding-left: 10px; padding-right: 10px">
                <a href="#" class="brand-logo">Registrar Comprador</a>
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
                            <input placeholder="Nombre" id="Nombre" type="text" class="validate" required>
                            <label for="Nombre">Nombre</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="FechaNacimiento" id="FechaNacimiento" type="date" class="validate" required>
                            <label for="FechaNacimiento">Fecha Nacimiento</label>
                        </div>
                        <div class="input-field col s12 l4 m6">
                            <input placeholder="Direccion" id="Direccion" type="text" class="validate" required>
                            <label for="Direccion">Direccion</label>
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
                            <button class="btn btn-success" onclick="registarComprador()">Guardar</button>
                        </div>
                    </div>
                </form>

              </div>
          </div>
      </section>
    </div>


<script src="../includes/js/consultas.js"></script>

