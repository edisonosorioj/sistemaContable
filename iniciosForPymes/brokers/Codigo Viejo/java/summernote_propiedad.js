//// ACTIVAR SUMMERNOTE TEXT AREA / DESCRIPCION ////////////////////////////////////////////////////////////////
    $('#summernote').summernote({
          placeholder: 'Escriba aquí la descripción de la propiedad a publicar...',
          height: 300,
          toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
          ],          
          callbacks: {
            onPaste: function (e) {
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              document.execCommand('insertText', false, bufferText);
            }
          }
    });
    var _URL = window.URL || window.webkitURL;