<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<button class="btn btn-primary btn-lg btn-block"><h4>Facturacion</h4></button>
<hr />
<form id="FormularioListar" action="<?php echo base_url()?>index.php/modules/FacturacionListar" name="FormularioListar">
<div class="row-fluid">

 <div class="span4">
    <h4>Codigo</h4>
    <input class="span4" type="text"  id="codigo" name="codigo" />
    <h4>Estado</h4>
     <select class="span8"  id="estado" name="estado">
    <option value="0">TODOS</option>
    <?php foreach($estado->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
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
    <h4>EPS</h4>
    <select class="span8"  id="eps" name="eps">
    <option value="0000">TODOS</option>
    <?php foreach($eps->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
  </div>
  <div class="span4">
      <h4>Eximido</h4>
    <select class="span8"  id="eximido" name="eximido">
    <option value="2">TODOS</option>
    <?php foreach($eximido->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre1."</option>";}?>
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
         
            <a class="btn btn-success" target="_blank" href="http://localhost/facturacion/facturacion_crear_factura.php?#"   >Generar Factura</a>
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/facturacion_list/1"   >Imprimir Resultado</a>
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/facturacion_list/2" >Generar Excel</a>
        </div>
  </div>
</div>
                
                    
        
            <input type="hidden" id="pagina" name="pagina" />
			
            </form>
			<div >
                <table  class="table table-bordered table-hover">
                    <thead><th>Codigo</th><th>Fecha</th><th>Cedula</th><th>Nombre Paciente</th><th>Servicio</th><th>Estado</th><th>EPS</th><th>Valor Paciente</th><th>Valor EPS</th><th>Total</th></th><th colspan="3"></th></thead>
                    <tbody  id='ResultadoGrilla'></tbody>
   
                </table>
            
            </div>