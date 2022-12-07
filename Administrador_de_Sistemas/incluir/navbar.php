
<nav class="navbar navbar-expand-lg  navbar-light" >
  <a class="navbar-brand" href="#">En Linea</a>
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
   aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav text-center ml-auto" id="nav">
      <li class="nav-item ">
        <a class="nav-link <?php echo $inicio; ?>" href="Inicio.php">Inicio </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $registrar_usuario; ?>" href="Registrar_Usuario.php">Registrar usuario</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php echo $recuperar_contraseña; ?>" href="Recuperar_Contraseña">Recuperar Contraseñas Usuarios</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php echo $cambiar_contraseña; ?>" href="Cambio_de_contraseña_general.php">Cambiar mi Contraseña</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto text-center">
      <li class="dropdown nav-item ml-auto mr-auto">
        <a class="nav-link dropdown-toggler dropdown-toggle" href="#" role="button" data-toggle="collapse" data-target="#navbarDropdown"
         aria-controls="navbarDropdown" aria-expanded="false" aria-label="Toggle navigation" IdRol="<?php echo $_SESSION['IdRol']; ?>">
          <i class="icon-user fas fa-user"></i><?php echo $_SESSION['Rol']; ?>
        </a>
        <div class="no-hover dropdown-menu" id="navbarDropdown" role="menu" aria-labelledby="navbarDropdown" aria-expanded="false">
          <span class="dropdown-item-text" IdUsuario="<?php echo $_SESSION['IdUsuario']; ?>" Usuario='<?php echo $_SESSION['Empleado']; ?>'
           RolUsuario='<?php echo $_SESSION['Rol']; ?>'>
            <?php echo $_SESSION['Empleado']; ?>
          </span>
          <hr class="dropdown-divider">
          <a class="dropdown-item text-center" href="../Login/ajax/ajax_cerrar_sesion.php">Cerrar Sesion</a>
        </div>
      </li>
    </ul>
  </div>
</nav>