<br /><br />
<h4>Area de Filtros</h4>
<hr />
<form id="HistoriasClinicasListar" action="<?php echo base_url()?>index.php/modules/HistoriasClinicasListar" name="HistoriasClinicasListar">
                
                  
                   <div class="row-fluid">
  
  <div class="span4">
  <h4><?php echo $data->paciente_nombre; ?><li class="icon-user"></li></h4>
  <hr />
  <b>Documento :</b> <?php echo $data->paciente; ?><br />
  <b>Tipo Documento :</b> <?php echo $data->tipo_documento; ?><br />
  <b>Telefono Fijo :</b> <?php echo $data->telefono_fijo; ?><br />
  <b>Celular :</b> <?php echo $data->telefono_movil; ?><br />
  <b>Ciudad :</b> <?php echo $data->ciudad_nombre; ?><br />
  <b>Edad :</b> <?php echo CalculaEdad($data->nacimiento). " Años"; ?><br />
  
  </div>
 
  <div class="span4">
  <h4>Informacion de Diagnostico</h4>
  
  
  <hr />
  <b>DX :</b> <?php echo $data->dx; ?><br />
  <b>DX Nombre:</b> <?php echo $data->dx_nombre; ?><br />
  <b>Motivo :</b> <?php echo $data->motivo; ?><br />
  <b>Enfermedad Actual :</b> <?php echo $data->enfermedad_actual; ?><br />
  <b>Analisis :</b> <?php echo $data->analisis; ?><br />
 
  </div>
<div  class="span12">
<hr />
<h4>Medicamento/Servicio Medico/Prestacion De Salud No Incluida en el POS</h4>
<hr />
</div>
<div class="span4">

<h5>Nombre Medicamento/Servicio</h5>
<hr />
<textarea ></textarea>
</div>
<div class="span4">
<h5>Forma de Presentación y/o Concentración</h5>
<hr />
<textarea ></textarea>
</div>
<div class="span4">
<h5>Dosis y/o Frecuencia de Uso</h5>
<hr />
<textarea ></textarea>
</div>
<div class="span4">
<h5>No. Dias de Tratamiento</h5>
<hr />
<textarea ></textarea>
</div>

</div>
<button style="float: right;"class="btn btn-success" onclick="window.print()">Imprimir</button>
		