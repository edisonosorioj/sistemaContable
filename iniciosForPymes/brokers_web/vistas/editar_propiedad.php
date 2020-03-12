<?php  
require 'admin/header.php';
require_once "../php/conexion.php";

$conex = new conection();
$result = $conex->conex();
$id 	= $_GET['id'];
// Consulta y por medio de un while muestra la lista de las propiedades

$query 	= mysqli_query($result,"SELECT p.*, z.nombre as ciudad, ep.* FROM propiedad p INNER JOIN zonas z INNER JOIN especificaciones_propiedad ep ON p.zona = z.id AND p.id = ep.id_propiedad WHERE p.id = $id;");
$row 	= $query->fetch_assoc();

$nombre_propiedad = utf8_encode($row['nombre']);
$tipo 			= utf8_encode($row['tipo']);
$zona 			= utf8_encode($row['zona']);
$estado 		= utf8_encode($row['estado']);
$habitaciones 	= utf8_encode($row['dato1']);
$banos 			= utf8_encode($row['dato2']);
$tamano 		= utf8_encode($row['dato3']);
$costo 			= utf8_encode($row['costo']);
$descripcion 	= utf8_encode($row['descripcion']);

$dato1 		=	utf8_encode($row['dato1']);
$dato2 		=	utf8_encode($row['dato2']);
$dato3 		=	utf8_encode($row['dato3']);
$dato4 		=	utf8_encode($row['dato4']);
$dato5 		=	utf8_encode($row['dato5']);
$dato6 		=	utf8_encode($row['dato6']);
$dato7 		=	utf8_encode($row['dato7']);
$dato8 		=	utf8_encode($row['dato8']);
$dato9 		=	utf8_encode($row['dato9']);
$dato10 	=	utf8_encode($row['dato10']);
$dato11 	=	utf8_encode($row['dato11']);
$dato12 	=	utf8_encode($row['dato12']);
$dato13 	=	utf8_encode($row['dato13']);
$dato14 	=	utf8_encode($row['dato14']);
$dato15 	=	utf8_encode($row['dato15']);
$dato16 	=	utf8_encode($row['dato16']);
$dato17 	=	utf8_encode($row['dato17']);
$dato18 	=	utf8_encode($row['dato18']);


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
            <h1>Nueva Propiedad</h1>
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
                <h3 class="card-title">Formulario Nueva Propiedad</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" action="acciones/actualizar_propiedad.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre Propiedad</label>
                    <input type="text" class="form-control" name="nombre_propiedad" placeholder="Nombre Propiedad" value="<?php  echo $nombre_propiedad ?>">
                  </div>
                  <div class="form-group">
                    <label>Tipo</label>
                    <input type="text" class="form-control" name="tipo" placeholder="Tipo" value="<?php  echo $tipo ?>">
                  </div>
                  <div class="form-group">
                    <label>Zona</label>
                    <input type="text" class="form-control" name="zona" placeholder="Zona" value="<?php  echo $zona ?>">
                  </div>
                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control" name="estado" placeholder="Estado" value="<?php  echo $estado ?>">
                  </div>
                  <div class="form-group">
                    <label>Fotografía principal</label>
                        <input type="file" class="form-control" name="imagen">
                  </div>
                  <!-- <div class="form-group">
                    <label>Fotografías varías</label>
                        <input type="file" class="form-control" name="imagen[]" multiple="">
                  </div> -->
                  <div class="form-group">
                    <label>Habitaciones</label>
                    <input type="text" class="form-control" name="habitaciones" placeholder="Habitaciones" value="<?php  echo $habitaciones ?>">
                  </div>
                  <div class="form-group">
                    <label>Baños</label>
                    <input type="text" class="form-control" name="banos" placeholder="Baños" value="<?php  echo $banos ?>">
                  </div>
                  <div class="form-group">
                    <label>Tamaño</label>
                    <input type="text" class="form-control" name="tamano" placeholder="Tamaño" value="<?php  echo $tamano ?>">
                  </div>
                  <div class="form-group">
                    <label>Costo</label>
                    <input type="text" class="form-control" name="costo" placeholder="Costo" value="<?php  echo $costo ?>">
                  </div>
                  <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" name='descripcion' placeholder="Descripción de la propiedad"><?php  echo $descripcion ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div> -->
              <!-- </form> -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Adicionales de Propiedad</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form role="form" action="agregar_adicinal_1.php"> -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Adicional 1</label>
                    <input type="text" class="form-control" name="adicional_1" placeholder="Adicional" value='<?php echo $dato1?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 2</label>
                    <input type="text" class="form-control" name="adicional_2" placeholder="Adicional" value='<?php echo $dato2?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 3</label>
                    <input type="text" class="form-control" name="adicional_3" placeholder="Adicional" value='<?php echo $dato3?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 4</label>
                    <input type="text" class="form-control" name="adicional_4" placeholder="Adicional" value='<?php echo $dato4?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 5</label>
                    <input type="text" class="form-control" name="adicional_5" placeholder="Adicional" value='<?php echo $dato5?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 6</label>
                    <input type="text" class="form-control" name="adicional_6" placeholder="Adicional" value='<?php echo $dato6?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 7</label>
                    <input type="text" class="form-control" name="adicional_7" placeholder="Adicional" value='<?php echo $dato7?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 8</label>
                    <input type="text" class="form-control" name="adicional_8" placeholder="Adicional" value='<?php echo $dato8?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 9</label>
                    <input type="text" class="form-control" name="adicional_9" placeholder="Adicional" value='<?php echo $dato9?>'>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div> -->
              <!-- </form> -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Adicionales de Propiedad</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form role="form" action="agregar_adicinal_2.php"> -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Adicional 10</label>
                    <input type="text" class="form-control" name="adicional_10" placeholder="Adicional" value='<?php echo $dato10?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 11</label>
                    <input type="text" class="form-control" name="adicional_11" placeholder="Adicional" value='<?php echo $dato11?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 12</label>
                    <input type="text" class="form-control" name="adicional_12" placeholder="Adicional" value='<?php echo $dato12?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 13</label>
                    <input type="text" class="form-control" name="adicional_13" placeholder="Adicional" value='<?php echo $dato13?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 14</label>
                    <input type="text" class="form-control" name="adicional_14" placeholder="Adicional" value='<?php echo $dato14?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 15</label>
                    <input type="text" class="form-control" name="adicional_15" placeholder="Adicional" value='<?php echo $dato15?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 16</label>
                    <input type="text" class="form-control" name="adicional_16" placeholder="Adicional" value='<?php echo $dato16?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 17</label>
                    <input type="text" class="form-control" name="adicional_17" placeholder="Adicional" value='<?php echo $dato17?>'>
                  </div>
                  <div class="form-group">
                    <label>Adicional 18</label>
                    <input type="text" class="form-control" name="adicional_18" placeholder="Adicional" value='<?php echo $dato18?>'>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-footer" style="text-align: center;">
                  <a href='mas_imagenes.php?id=<?php echo $id ?>' class='btn btn-primary'>Mas imagenes...</a>
                  <button type="submit" class="btn btn-primary" style="width: 200px;">Actualizar</button>
                  <button type="submit" class="btn btn-danger" style="width: 200px;" onclick="history.back()">Cancelar</button>
                </div>
              </form>
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
