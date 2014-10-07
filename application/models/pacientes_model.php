<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pacientes_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
   function PacientesListar($data){
    @session_start();
	$cedula = $data['cedula'];
	$nombre = $data['nombre'];
	$tipo_documento = $data['tipo_documento'];
	$estado_codigo = $data['estado_codigo'];
	$ciudad_codigo = $data['ciudad_codigo'];
    $eps_codigo = $data['eps_codigo'];
    $oficio_codigo = $data['oficio_codigo'];
	$genero_codigo = $data['genero_codigo'];
    $estrato_codigo = $data['estrato_codigo'];
	$pagina = $data['pagina'];
    $registrospagina = $data['registrosxpagina'];
	$tipo = $data['tipo'];
     if ($pagina == 1) $limite_inferior = 0;
    else 
    $limite_inferior = (($pagina-1)*$registrospagina);

    $limite_superior = $registrospagina;
    
   
	$sql_string = "call PacientesListar('$cedula','$tipo_documento','$nombre','$estado_codigo',
	'$ciudad_codigo','$genero_codigo','$eps_codigo','$estrato_codigo','$oficio_codigo','$tipo','$limite_inferior','$limite_superior')";
 
   if($tipo == 0)
    $_SESSION['query'] = $sql_string;
  
    $query = $this->db->query($sql_string);
    return $query;
   }
     function FacturacionListar($data){
    @session_start();
	$codigo = $data['codigo'];
	$paciente_cedula = $data['paciente_cedula'];
	$paciente_nombre = $data['paciente_nombre'];
	$servicio_medico_codigo = $data['servicio_medico_codigo'];
	$servicio_medico_nombre = $data['servicio_medico_nombre'];
	$eps = $data['eps'];
    $estado = $data['estado'];
	$eximido = $data['eximido'];
	$fecha_inicio = $data['fecha_inicio'].' 00:00:00';
	$fecha_fin = $data['fecha_fin'].' 23:59:59';
	$pagina = $data['pagina'];
    $registrospagina = $data['registrosxpagina'];
	$tipo = $data['tipo'];
     if ($pagina == 1) $limite_inferior = 0;
    else 
    $limite_inferior = (($pagina-1)*$registrospagina);

    $limite_superior = $registrospagina;
    
   
	$sql_string = "call FacturacionListar('$codigo','$paciente_cedula',
	'$paciente_nombre','$servicio_medico_codigo','$servicio_medico_nombre','$eps','$estado','$eximido','$fecha_inicio','$fecha_fin','$tipo','$limite_inferior','$limite_superior')";
 
   if($tipo == 0)
    $_SESSION['query'] = $sql_string;
  
    $query = $this->db->query($sql_string);
   // sleep(1);
    return $query;
   }
    function getEPSs(){
        $query = $this->db->get('epss');
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
   
     
     
 
}




?>