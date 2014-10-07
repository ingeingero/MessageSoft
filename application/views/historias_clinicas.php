<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<button class="btn btn-primary btn-lg btn-block"><h4>Historias Clinicas</h4></button>
<hr />
<form id="FormularioListar" action="<?php echo base_url()?>index.php/modules/HistoriasClinicasListar" name="FormularioListar">
<div class="row-fluid">
  <div class="span4">
  <h4>Informacion Medico</h4>
  <hr />
    <label class="span4">Nombre Medico</label>
	<input class="span6" type="text" id="medico_nombre" name="medico_nombre" />
    <br />

    <label class="span4">Cedula Médico</label>
	<input class="span6" type="text"  id="medico_cedula"  name="medico_cedula"  /> 
  </div>
 
  <div class="span4">
  <h4>Informacion Paciente</h4>
  <hr />
    <label class="span4">Nombre Paciente</label>
	<input class="span6" type="text" id="paciente_nombre" name="paciente_nombre" />
    <br />

    <label class="span4">Cedula Paciente</label>
	<input class="span6" type="text"  id="paciente_cedula"  name="paciente_cedula"  /> 
  </div>
<div class="span4">
  <h4>Informacion Servicio</h4>
  <hr />
    <label class="span4">Nombre</label>
	<input class="span6" type="text" id="servicio_medico_nombre" name="servicio_medico_nombre" />
    <br />

    <label class="span4">Codigo</label>
	<input class="span6" type="text"  id="servicio_medico_codigo"  name="servicio_medico_codigo"  /> 
  </div>
  <div class="span4">
    <h4>Codigo</h4>
    <input class="span4" type="text"  id="codigo" name="codigo" />
    <h4>Programa PYP</h4>
     <select class="span8"  id="programa_pyp" name="programa_pyp">
    <option value="0">TODOS</option>
    <?php foreach($programa_pyp->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
  </div>
  <div class="span4">
    <h4>EPS</h4>
    <select class="span8"  id="eps" name="eps">
    <option value="0000">TODOS</option>
    <?php foreach($eps->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
     <h4>Factura</h4>
    <input class="span4" type="text"  id="factura" name="factura" />
  </div>
  <div class="span3">
    <h4>DX</h4>
     <select class="span12"  id="dx" name="dx"> 
     <option value="000x">TODOS</option>
      <?php foreach($dx->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
     </select>
  </div>
  <div align="center" class="span12">
        <hr />
         Desde
	   <input class="span2" type="text" id="fecha_inicio" name="fecha_inicio" value="<?php echo date("Y-m-d",strtotime('-3 month')); ?>"  />
         Hasta
		<input class="span2" type="text"  id="fecha_fin" name="fecha_fin" value="<?php echo date("Y-m-d"); ?>"  />
        <div style="float: right;">
            <input class="btn btn-success" type="submit" name="Enviar" />
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/historias_clinicas_list/1"   >Imprimir Resultado</a>
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/historias_clinicas_list/2" >Generar Excel</a>
        </div>
  </div>
</div>
                
                    
        
            <input type="hidden" id="pagina" name="pagina" />
			
            </form>
			<div >
                <table  class="table table-bordered table-hover">
                    <thead><th>Codigo</th><th>Fecha</th><th>Cedula</th><th>Nombre Paciente</th><th>Servicio</th><th>Medico</th><th>Motivo</th><th>DX</th><th>Programa PYP</th><th colspan="3"></th></thead>
                    <tbody  id='ResultadoGrilla'></tbody>
   
                </table>
            
            </div>