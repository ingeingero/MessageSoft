<?php
$imp = "";
if($tipo==1)
    echo "<script>window.print()</script>";
else if($tipo==2){
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=MI_ARCHIVO.xls");
}
$imp = "<h1>Reporte Facturacion</h1>";
$imp = $imp." <table  class='table table-bordered table-hover'>";
$imp = $imp."<thead><th>Codigo</th><th>Fecha</th><th>Cedula</th><th>Nombre Paciente</th><th>Servicio</th><th>Estado</th><th>EPS</th><th>Autorizacion</th></thead>";
$imp = $imp."<tbody>";
foreach($datos->result() as $registro){
    $imp = $imp. "<tr>
             <td> ". $registro->facturas_codigo ."  </td>
             <td> ". $registro->fecha ."  </td>
             <td> ". $registro->paciente ."  </td>
             <td> ". $registro->paciente_nombre  ." </td>
             <td> ". $registro->servicio_medico_nombre ."  </td>
             <td> ". $registro->estado_nombre." </td>
             <td> ". $registro->eps_nombre." </td>
             <td> ". $registro->autorizacion ."</td>
             </tr>";
        }
$imp = $imp."<tr><td style='text-align:center' colspan='9'>Registros : $rows</td></tr>";
$imp = $imp."</tbody>";
$imp=$imp."</table>";
echo $imp;

  ?>

