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
$imp = "<h1>Reporte Correspondencias</h1>";
$imp = $imp." <table  class='table table-bordered table-hover'>";
$imp = $imp."<thead><th>ID</th><th>Fecha</th><th>Asunto</th><th>Folios</th><th>Origen</th><th>Destino</th><th>Tipo</th><th>Tipo Documento</th><th>Usuario</th><th>Estado</th></thead>";
$imp = $imp."<tbody>";
foreach($datos->result() as $registro){
    $imp = $imp. "<tr>
             <td> ". $registro->ID ."  </td>
             <td> ". $registro->Fecha ."  </td>
             <td> ". $registro->Asunto ."  </td>
             <td> ". $registro->Folios  ." </td>
             <td> ". $registro->FuncionariosNombreOrigen ."  </td>
             <td> ". $registro->FuncionariosNombreDestino." </td>
             <td> ". $registro->Bas_tiposcorrespondenciaNombre." </td>
             <td> ". $registro->Bas_tiposdocumentoNombre." </td>
             <td> ". $registro->UsuarioNombre ."</td>
             <td> ". $registro->Bas_estadoNombre ."</td>
             </tr>";
        }
$imp = $imp."<tr><td style='text-align:center' colspan='9'>Registros : $rows</td></tr>";
$imp = $imp."</tbody>";
$imp=$imp."</table>";
echo $imp;

  ?>

