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
    <div class="col-2"></div>
    <div class="col-12"><div id='calendar'></div></div>
    <div class="col-2"></div>
</div>

  <script>
    
    $(document).ready(function(){

      $('#calendar').fullCalendar({

          header:{
              left: 'today, prev,next, miBoton',
              center: 'title',
              right: 'month,basicWeek, basicDay,agendaWeek,agendaDay',

          },

        dayClick:function(date,jsEvent,view){

          $("#txtFecha").val(date.format());
          $("#ModalEventos").modal();
        },

        events: 'eventos.php',

        eventClick:function(calEvent,jsEvent,view){
          $('#tituloEvento').html(calEvent.title);
          $('#descripcionEvento').html(calEvent.descripcion);
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
          <button type="button" class="btn btn-success">Listo</button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>