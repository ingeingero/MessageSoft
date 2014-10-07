$(document).ready(function () {
//alert('Bienvenido');;
pagina(1);

$( "#FechaInicio" ).datepicker({
     showButtonPanel: true,
      defaultDate: "+1w",
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      numberOfMonths: 2,
      
      onClose: function( selectedDate ) {
        $( "#FechaFin" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#FechaFin" ).datepicker({
    showButtonPanel: true,
      defaultDate: "+1w",
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#FechaInicio" ).datepicker( "option", "maxDate", selectedDate );
      }
    })

    $("#FormularioListar").submit(function () {
	pagina(1);
    return false;
     });
     
    $("#CodigoBarras").keyup(function (){
        pagina(1);
     return false; 
    });
  
 
});

function pagina(page){

   $('#pagina').val(page)
   $('#ResultadoGrilla').html('<h1>Cargando...</h1>')
    $.ajax({
    url: $('#FormularioListar').attr('action'),
    type: 'post',
    data: $('#FormularioListar').serialize(),
    success: function(data) {
     $('#ResultadoGrilla').html(data);
     
            }
              
    });
}

/*
function getEPSs(){
     $.ajax({
    url: 'http://localhost/codeigniter/index.php/modules/getEPSs',
    type: 'post',
    success: function(data) {
     $('#eps').append(data);
     pagina(1);
            }
              
    });
    
}
function getDxs(){
     $.ajax({
    url: 'http://localhost/codeigniter/index.php/modules/getDxs',
    type: 'post',
    success: function(data) {
     $('#dx').append(data);
    pagina(1);
            }
              
    });
    
}
function getProgramaPYP(){
     $.ajax({
    url: 'http://localhost/codeigniter/index.php/modules/getProgramaPYP',
    type: 'post',
    success: function(data) {
     $('#programa_pyp').append(data);
    pagina(1);
            }
              
    });
    
}*/