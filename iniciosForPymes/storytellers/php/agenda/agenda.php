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

        events: 'https://forpymes.co/wink/php/agenda/eventos.php',

        eventClick:function(calEvent,jsEvent,view){
          // h2
          $('#tituloEvento').html(calEvent.title);

          // Mostrar la informacion del evento en los input
          $('#txtDescripcion').val(calEvent.empresa);
          $('#txtID').val(calEvent.id);
          $('#txtTitulo').val(calEvent.title);
          $('#txtColor').val(calEvent.color);

          FechaHora= calEvent.start._i.split(" ");
          $('#txtFecha').val(FechaHora[0]);
          $('#txtHora').val(FechaHora[1]);
          

          $('#ModalEventos').modal();
        }


      });  


    });


  </script>

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
        Id:           <input type="text" id="txtID" name="txtID" />
        Fecha:        <input type="text" id="txtFecha" name="txtFecha" /><br />
        Título:       <input type="text" id="txtTitulo" /><br />
        Hora:         <input type="text" id="txtHora" value="10:30" /><br />
        Descripción:  <textarea id="txtDescripcion" row="3" /></textarea><br />
        Color:        <input type="color" value="#ff0000" id="txtColor" name="txtFecha" /><br />


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

<script>
  var NuevoEvento;
  $('#btnAgregar').click(function(){



    var NuevoEvento = {
      title: $('#txtTitulo').val(),
      start: $('#txtFecha').val() + " " + $('#txtHora').val(),
      color: $('#txtColor').val(),
      descripcion: $('#txtDescripcion').val(),
      textColor: "#FFFFFF"
    };

    $('#calendar').fullCalendar('renderEvent', NuevoEvento );
    $("#ModalEventos").modal('toggle');

  });

  function

</script>

</body>
</html>