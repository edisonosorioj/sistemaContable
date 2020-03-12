<?php  
require 'admin/header.php';
require_once "../php/conexion.php";

$conex = new conection();
$result = $conex->conex();
$propiedades  = '';
$count        = 1;

// Consulta y por medio de un while muestra la lista de las propiedades

$query2 = mysqli_query($result,"SELECT p.*, z.nombre as ciudad FROM propiedad p INNER JOIN zonas z ON p.zona = z.id;");

while ($row = $query2->fetch_array(MYSQLI_BOTH)){
  $div          = '';
  $div2         = '';
  $opacidad   = '';
  $pagina     = $row['pagina'];
  $texto    = '';

  $desde    = ($row['estado'] == 1) ? 'Desde ' : '' ;

  if ($row['estado'] == 2) {
  $opacidad   = 'opacity';
    $pagina   = '#';
    $texto    = ' - No disponible';
  }

  $propiedades .= "
        <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch'>
          <div class='card bg-light'>
            <div class='card-header text-muted border-bottom-0'>
              Propiedad
            </div>
            <div class='card-body pt-0'>
              <div class='row'>
                <div class='col-7'>
                  <h2 class='lead'><b>" . utf8_encode($row['nombre']) .  $texto . "</b></h2>
                  <p class='text-muted text-sm'><b>Detalles: </b>" . $row['dato3'] ."</p>
                  <ul class='ml-4 mb-0 fa-ul text-muted'>
                    <li class='small'><span class='fa-li'><i class='fas fa-lg fa-building'></i></span> Ubicación: " . $row['ciudad'] . "</li>
                    <li class='small'><span class='fa-li'><i class='fas fa-lg fa-phone'></i></span> Contacto: 300 400 4272</li>
                  </ul>
                </div>
                <div class='col-5 text-center'>
                  <img src='" . $row['directorio'] . '/' . $row['img'] .  "' alt='' class='img-circle img-fluid'>
                </div>
              </div>
            </div>
            <div class='card-footer'>
              <div class='text-right'>
                <a href='../propiedad.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>
                  <i class='fas fa-user'></i> Ver propiedad
                </a>
                <a href='editar_propiedad.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>
                  <i class='fas fa-pen'></i> Editar
                </a>
              </div>
            </div>
          </div>
        </div>";
}


?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../vistas/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Brokers Web</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../vistas/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Propiedades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="propiedades.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="mis-propiedades.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Propiedades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../vistas/agregar-propiedades.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Propiedad</p>
                </a>
              </li>
            </ul>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Propiedades</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Propiedades</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <?php  echo $propiedades?>            
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
          </nav>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php  
require 'admin/footer.php';
?>

