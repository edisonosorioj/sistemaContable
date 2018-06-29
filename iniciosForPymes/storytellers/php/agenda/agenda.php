<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agenda</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel='stylesheet' href='css/fullcalendar.css' />
  <script src='js/jquery.min.js'></script>
  <script src='js/moment.min.js'></script>
  <script src='js/fullcalendar.js'></script>
  <script src='js/es.js'></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container"> 
    <div class="col"></div>
    <div class="col-7"><div id='calendar'></div></div>
    <div class="col"></div>
</div>

  <script>
    
    $(document).ready(function(){

      $('#calendar').fullCalendar({

          header:{
              left: 'today, prev,next, miBoton',
              center: 'title',
              right: 'month,basicWeek, basicDay,agendaWeek,agendaDay',

          },
         
          customButtons:{
            miBoton:{
              text:"Boton 1",
              click:function(){
                alert("Haz hecho click");
            }
          }
        },

        dayClick:function(date,jsEvent,view){

          $("#txtFecha").val(date.format());
          $("#ModalEventos").modal();
        },

        events: 'http://localhost/sistemaContable/iniciosForPymes/storytellers/php/agenda/eventos.php',

        eventClick:function(calEvent,jsEvent,view){
          $('#tituloEvento').html(calEvent.pedido_nombre);
          $('#descripcionEvento').html(calEvent.empresa);
          $('#exampleModal').modal();
        }


      });  


    });


  </script>

<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="descripcionEvento"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" class="btn btn-success">Modificar</button>
          <button type="button" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal (Agregar, modificar, eliminar) -->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="descripcionEvento"></div>

        Fecha:        <input type="text" id="txtFecha" name="txtFecha" /><br />
        Título:       <input type="text" id="txtTitulo" /><br />
        Hora:         <input type="text" id="txtHora" value="10:30" /><br />
        Descripción:  <textarea id="txtDescripcion" row="3" /></textarea><br />
        Color:        <input type="color" value="#ff0000" id="txtColor" name="txtFecha" /><br />


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Agregar</button>
        <button type="button" class="btn btn-success">Modificar</button>
        <button type="button" class="btn btn-danger">Borrar</button>
        <button type="button" class="btn btn-default">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#btnAgregar').click(function(){

    var NuevoEvento = {
      title:"",
      start:"",
      color:"",
      descripcion:"",
      textColor:"#FFFFFF";
    }

  });

</script>

</body>
</html>