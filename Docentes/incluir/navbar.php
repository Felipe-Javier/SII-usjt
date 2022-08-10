
<nav class="navbar navbar-expand-lg  navbar-light" >
  <a class="navbar-brand" href="#">En Linea</a>
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav text-center ml-auto" id="nav">
      <li class="nav-item ">
        <a class="nav-link <?php echo $inicio; ?>" href="Inicio.php">Inicio </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $registrar_calificaciones; ?>" href="Registrar_Calificaciones.php">Registrar Calificaciones</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#">otro boton </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto text-center">
      <li class="nav-item dropdown ml-auto mr-auto">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-user fas fa-user "></i>Bienvenido!, <?php echo $_SESSION['Rol'] ?>
        </a>
        <div class="no-hover dropdown-menu" aria-labelledby="navbarDropdown" >
          <a class="dropdown-item text-center" href="../Login/ajax/ajax_cerrar_sesion.php">Cerrar Sesion</a>
        </div>
      </li>
    </ul>
  </div>
</nav>