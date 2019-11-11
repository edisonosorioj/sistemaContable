//// ACTIVAR SUMMERNOTE TEXT AREA / DESCRIPCION ////////////////////////////////////////////////////////////////
    $('#summernote').summernote({
          placeholder: 'Escriba aquí su mensaje.',
          height: 300,
          
          callbacks: {
            onPaste: function (e) {
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              document.execCommand('insertText', false, bufferText);
            }
          }
    });
    var _URL = window.URL || window.webkitURL;