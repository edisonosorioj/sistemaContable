<?php  
require 'admin/header.php';
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
              <form role="form" enctype="multipart/form-data" action="acciones/guardar_propiedad.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre Propiedad</label>
                    <input type="text" class="form-control" name="nombre_propiedad" placeholder="Nombre Propiedad">
                  </div>
                  <div class="form-group">
                    <label>Tipo</label>
                    <input type="text" class="form-control" name="tipo" placeholder="Tipo">
                  </div>
                  <div class="form-group">
                    <label>Zona</label>
                    <input type="text" class="form-control" name="zona" placeholder="Zona">
                  </div>
                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control" name="estado" placeholder="Estado">
                  </div>
                  <div class="form-group">
                    <label>Fotografía principal</label>
                        <input type="file" class="form-control" name="imagen">
                  </div>
                  <div class="form-group">
                    <label>Habitaciones</label>
                    <input type="text" class="form-control" name="habitaciones" placeholder="Habitaciones">
                  </div>
                  <div class="form-group">
                    <label>Baños</label>
                    <input type="text" class="form-control" name="banos" placeholder="Baños">
                  </div>
                  <div class="form-group">
                    <label>Tamaño</label>
                    <input type="text" class="form-control" name="tamano" placeholder="Tamaño">
                  </div>
                  <div class="form-group">
                    <label>Costo</label>
                    <input type="text" class="form-control" name="costo" placeholder="Costo">
                  </div>
                  <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" name='descripcion' placeholder="Descripción de la propiedad"></textarea>
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
                    <input type="text" class="form-control" name="adicional_1" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 2</label>
                    <input type="text" class="form-control" name="adicional_2" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 3</label>
                    <input type="text" class="form-control" name="adicional_3" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 4</label>
                    <input type="text" class="form-control" name="adicional_4" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 5</label>
                    <input type="text" class="form-control" name="adicional_5" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 6</label>
                    <input type="text" class="form-control" name="adicional_6" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 7</label>
                    <input type="text" class="form-control" name="adicional_7" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 8</label>
                    <input type="text" class="form-control" name="adicional_8" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 9</label>
                    <input type="text" class="form-control" name="adicional_9" placeholder="Adicional">
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
                    <input type="text" class="form-control" name="adicional_10" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 11</label>
                    <input type="text" class="form-control" name="adicional_11" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 12</label>
                    <input type="text" class="form-control" name="adicional_12" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 13</label>
                    <input type="text" class="form-control" name="adicional_13" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 14</label>
                    <input type="text" class="form-control" name="adicional_14" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 15</label>
                    <input type="text" class="form-control" name="adicional_15" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 16</label>
                    <input type="text" class="form-control" name="adicional_16" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 17</label>
                    <input type="text" class="form-control" name="adicional_17" placeholder="Adicional">
                  </div>
                  <div class="form-group">
                    <label>Adicional 18</label>
                    <input type="text" class="form-control" name="adicional_18" placeholder="Adicional">
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
                  <button type="submit" class="btn btn-primary" style="width: 200px;">Guardar</button>
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
