<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<br /><br /><br />
<button class="btn btn-primary btn-lg btn-block"><h4>Correspondencia</h4></button>
<form id="FormularioListar" action="<?php echo base_url();?>index.php/modules/CorrespondenciaListar" name="FormularioListar">
<div class="row-fluid">
  <div class="span4">
    <h4>Asunto/Codigo Bn bn bn </h4>
    <input placeholder="Asunto" class="span6" type="text"  id="Asunto" name="Asunto" />
    <input placeholder="ID" class="span6" type="text"  id="ID" name="ID" /> 
    <input placeholder="Codigo Barras" class="span6" type="text"  id="CodigoBarras" name="CodigoBarras" />  
  </div>
  <div class="span4">
  <h4>Remitente</h4>
	<input placeholder="Nombre" class="span6" type="text" id="FuncionariosNombreOrigen" name="FuncionariosNombreOrigen" />
	<input placeholder="Documento" class="span6" type="text"  id="FuncionariosDocumentoOrigen"  name="FuncionariosDocumentoOrigen"  /> 
  </div>
 
  <div class="span4">
  <h4>Destino</h4>
	<input placeholder="Nombre" class="span6" type="text" id="FuncionariosNombreDestino" name="FuncionariosNombreDestino" />
	<input placeholder="Documento" class="span6" type="text"  id="FuncionariosDocumentoDestino"  name="FuncionariosDocumentoDestino"  /> 
  </div>

  <div class="span4">
    <b>Tipo Correspondencia</b>
     <select class="span6"  id="Bas_tiposcorrespondenciaID" name="Bas_tiposcorrespondenciaID">
    <option value="0">TODOS</option>
    <?php foreach($Bas_tiposcorrespondenciaID->result() as $data){echo "<option value=".$data->ID.">".$data->Nombre."</option>";}?>
    </select>
    
  </div>
  <div class="span4">
   <b>Tipo Documento</b>
     <select class="span6"  id="Bas_tiposdocumentoID" name="Bas_tiposdocumentoID">
    <option value="0">TODOS</option>
    <?php foreach($Bas_tiposdocumentoID->result() as $data){echo "<option value=".$data->ID.">".$data->Nombre."</option>";}?>
    </select>
   </div>
   
   <div class="span3">
   <b>Estado</b>
     <select class="span6"  id="Bas_estadoID" name="Bas_estadoID">
    <option value="0">TODOS</option>
    <?php foreach($Bas_estadoID->result() as $data){echo "<option value=".$data->ID.">".$data->Nombre."</option>";}?>
    </select>
   </div>
  
   <div class="span4">
   <b>Usuario</b>
     <select class="span6"  id="UsuarioID" name="UsuarioID">
    <option value="0">TODOS</option>
    <?php foreach($UsuarioID->result() as $data){echo "<option value=".$data->ID.">".$data->Nombre."</option>";}?>
    </select>
   </div>
  

  <div align="center" class="span3">
  
         Desde
	   <input class="span4" style="font-size: small;" type="text" id="FechaInicio" name="FechaInicio" value="<?php echo date("Y-m-d",strtotime('-3 month')); ?>"  />
         Hasta
		<input class="span4" style="font-size: small;" type="text"  id="FechaFin" name="FechaFin" value="<?php echo date("Y-m-d"); ?>"  />
  </div>
        <div style="float: right;" class="span6" >
            <input class="btn btn-success" type="submit" value="Actualizar/Enviar" name="Actualizar/Enviar" />
            <a class="btn btn-success" target="_blank" href="<?php echo base_url(); ?>index.php/modules/correspondencia_recibida/add"   ><i class="icon-envelope"></i> Radicar</a>

            
            
           <a class="btn btn-success" target="_blank" href="<?php echo base_url(); ?>/index.php/modules/ImprimirReporte/correspondencias_list/2" ><i class="icon-download"></i> Generar Excel</a>
           <a class="btn btn-success" target="_blank" href="<?php echo base_url(); ?>/index.php/modules/ImprimirReporte/correspondencias_list/1" ><i class="icon-file"></i> Imprimir</a>
        </div>

</div>
                
                    
        
            <input type="hidden" id="pagina" name="pagina" />
			
            </form>
			<div >
                <table  class="table table-bordered table-hover">
                    <thead><th>ID</th><th>Fecha</th><th>Asunto</th><th>Folios</th><th>Origen</th><th>Destino</th><th>Tipo</th><th>Tipo Documento</th><th>Usuario</th><th>Estado</th></thead>
                    <tbody  id='ResultadoGrilla'></tbody>
   
                </table>
            
            </div>