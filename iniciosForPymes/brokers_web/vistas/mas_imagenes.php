<?php  
require 'admin/header.php';

require_once "../php/conexion.php";

$conex 	= new conection();
$result = $conex->conex();
$id 	= $_GET['id'];

// Consulta y por medio de un while muestra la lista de las propiedades

$query 	= mysqli_query($result,"SELECT * FROM propiedad WHERE id = $id;");
$row 	= $query->fetch_assoc();

$directorio = $row['directorio'].'/';

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
                <a href="propiedades.php" class="nav-link">
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
                <a href="../vistas/agregar-propiedades.php" class="nav-link active">
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
            <h1>Imagenes propiedad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Agregar Propiedad</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulario Fotografías</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" action="acciones/agregar_mas_imagenes.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Fotografías varías</label>
                        <input type="hidden" class="form-control" name="id" value="<? echo $id ?>">
                        <input type="hidden" class="form-control" name="directorio" value="<? echo $directorio ?>">
                        <input type="file" class="form-control" name="imagen[]" multiple="">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                </div>
              </form>
              <!-- </form> -->
            </div>
            <!-- /.card -->
          </div>

           <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fotografías</h3>
              </div>
              <div class="card-body">
              	<?php
				    $directory=$directorio;
				    $dirint = dir($directory);
				    while (($archivo = $dirint->read()) !== false)
				    {
				        if (preg_match("/gif/", $archivo) || preg_match("/jpg/", $archivo) || preg_match("/png/", $archivo)){
				            echo '<img src="'.$directory."/".$archivo.'" style="width:180px;"">'."\n";
				        }
				    }
				    $dirint->close();
				?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php  
require 'admin/footer.php';
?>
