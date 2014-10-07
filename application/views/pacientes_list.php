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
$imp = "<h1>Reporte Pacientes</h1>";
$imp = $imp." <table  class='table table-bordered table-hover'>";
$imp = $imp."<thead><th>Documento</th><th>Tipo</th><th>Nombre</th><th>EPS</th><th>Oficio</th><th>Estado</th></th><th ></th></thead>";
$imp = $imp."<tbody>";
foreach($datos->result() as $registro){
    $imp = $imp. "<tr>
             <td> ". $registro->cedula ."  </td>
             <td> ". $registro->tipo_documento_codigo ."  </td>
             <td> ". $registro->nombre ."  </td>
             <td> ". $registro->eps_nombre  ." </td>
             <td> ". $registro->oficio_nombre ."  </td>
             <td> ". $registro->estado_nombre." </td>
             </tr>";
        }
$imp = $imp."<tr><td style='text-align:center' colspan='6'>Registros : $rows</td></tr>";
$imp = $imp."</tbody>";
$imp=$imp."</table>";
echo $imp;

  ?>

