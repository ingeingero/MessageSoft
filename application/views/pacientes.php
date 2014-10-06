<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<button class="btn btn-primary btn-lg btn-block"><h4>Pacientes</h4></button>
<hr />
<form id="FormularioListar" action="<?php echo base_url()?>index.php/modules/PacientesListar" name="FormularioListar">
<div class="row-fluid">

 <div class="span4">
    <h4>Cedula</h4>
    <input class="span4" type="text"  id="cedula" name="cedula" />
    <h4>Tipo Documento</h4>
     <select class="span8"  id="tipo_documento" name="tipo_documento">
    <option value="00">TODOS</option>
    <?php foreach($tipo_documento->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    <h4>Nombre</h4>
    <input class="span4" type="text"  id="nombre" name="nombre" />
  </div>
  
  <div class="span4">
     <h4>Genero</h4>
     <select class="span8"  id="genero_codigo" name="genero_codigo">
    <?php foreach($genero_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    
    <h4>Ciudad Origen</h4>
     <select class="span8"  id="ciudad_codigo" name="ciudad_codigo">
    <option value="0">TODOS</option>
    <?php foreach($ciudad_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    
    <h4>Estrato</h4>
     <select class="span8"  id="estrato_codigo" name="estrato_codigo">
    <option value="0">TODOS</option>
    <?php foreach($estrato_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
  </div>
  
  
   <div class="span4">
     <h4>Oficio</h4>
     <select class="span8"  id="oficio_codigo" name="oficio_codigo">
    <option value="XXXX">TODOS</option>
    <?php foreach($oficio_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    
    <h4>Eps</h4>
     <select class="span8"  id="eps_codigo" name="eps_codigo">
    <option value="0">TODOS</option>
    <?php foreach($eps_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    
     <h4>Estado</h4>
     <select class="span8"  id="estado_codigo" name="estado_codigo">
    <option value="2">TODOS</option>
    <?php foreach($estado_codigo->result() as $data){echo "<option value=".$data->codigo.">".$data->nombre."</option>";}?>
    </select>
    
  </div>
  
 

  <div align="center" class="span12">
        
         
             <div style="float: right;">
            <input class="btn btn-success" type="submit" name="Enviar" />
            <a class="btn btn-success" target="_blank" href="http://localhost/pacientes/pacientes_ingresar.php"   >Nuevo Paciente</a>
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/pacientes_list/1"   >Imprimir Resultado</a>
            <a class="btn btn-success" target="_blank" href="http://localhost/codeigniter/index.php/modules/ImprimirReporte/pacientes_list/2" >Generar Excel</a>
        </div>
  </div>
  </div>

                
                    
        
            <input type="hidden" id="pagina" name="pagina" />
			
            </form>
			<div  >
                <table style="min-height: 200px;height: auto" class="table table-bordered table-hover">
                    <thead><th>Documento</th><th>Tipo</th><th>Nombre</th><th>EPS</th><th>Oficio</th><th>Estado</th></th><th ></th></thead>
                    <tbody  id='ResultadoGrilla'></tbody>
   
                </table>
            
            </div>