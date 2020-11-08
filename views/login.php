<?php     include '../index.php'; ?>
<header>
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper" style="padding-left: 10px; padding-right: 10px">
                <a href="#" class="brand-logo">INICIO DE SESIÓN</a>
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
                            <button class="btn btn-success" onclick="login()">INGRESAR</button>
                        </div>
                    </div>
                </form>

              </div>
          </div>
      </section>
    </div>


<script src="../controllers/login.js"></script>