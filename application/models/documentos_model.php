<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Documentos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insert($data){ 
		$fecha = date('Y-m-d');
		$this->db->insert('documentos',array('nombre'=>$data['nombre'], 'created' => $fecha, 'modified' => $fecha ));

	}
    function getImagenCorporativa($id){
        $this->db->where('codigo',$id);
        $this->db->select('imagen_corporativa');
        $query = $this->db->get('parametros_generales');
        $datos = $query->result();
        $imagen  = "";
        foreach ($datos as $img){
          $imagen =   $img->imagen_corporativa;
        }
        return $imagen;
        
   }
   
   function getNombreEmpresa($id){
        $this->db->where('codigo',$id);
        $this->db->select('nombre_empresa');
        $query = $this->db->get('parametros_generales');
        $datos = $query->result();
        $nombre  = "";
        foreach ($datos as $img){
          $nombre =   $img->nombre_empresa;
        }
        return $nombre;
        
   }
    function getImagenEmpleado($cedula){
        $this->db->where('cedula',$cedula);
        $this->db->select('imagen');
        $query = $this->db->get('usuarios');
        $datos = $query->row();
        return $datos->imagen;
        
   }
   function HistoriasClinicasListar($data){
    @session_start();
	$codigo = $data['codigo'];
	$medico_cedula = $data['medico_cedula'];
	$medico_nombre = $data['medico_nombre'];
	$paciente_cedula = $data['paciente_cedula'];
	$paciente_nombre = $data['paciente_nombre'];
	$servicio_medico_codigo = $data['servicio_medico_codigo'];
	$servicio_medico_nombre = $data['servicio_medico_nombre'];
	$eps = $data['eps'];
	$dx = $data['dx'];
	$fecha_inicio = $data['fecha_inicio'].' 00:00:00';
	$fecha_fin = $data['fecha_fin'].' 23:59:59';
    $programa_pyp = $data['programa_pyp'];
    $factura = $data['factura'];
	$pagina = $data['pagina'];
    $registrospagina = $data['registrosxpagina'];
	$tipo = $data['tipo'];
     if ($pagina == 1) $limite_inferior = 0;
    else 
    $limite_inferior = (($pagina-1)*$registrospagina);

    $limite_superior = $registrospagina;
    
   
	$sql_string = "call HistoriasClinicasListar('$codigo','$medico_cedula','$medico_nombre','$paciente_cedula',
	'$paciente_nombre','$servicio_medico_codigo','$servicio_medico_nombre','$eps','$dx','$programa_pyp','$factura','$fecha_inicio','$fecha_fin','$tipo','$limite_inferior','$limite_superior')";
 
   if($tipo == 0)
    $_SESSION['query'] = $sql_string;
  
    $query = $this->db->query($sql_string);
    // $query->free();
//  if($query->num_rows()>0) 
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
   
   function FacturacionObtenerTotales(){
  
    
   }
    function getEPSs(){
        $query = $this->db->get('epss');
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
     function getDxs(){
        $query = $this->db->get('diagnosticos');
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
   
     function getProgramaPYP(){
         $this->db->order_by("codigo", "desc");
        $query = $this->db->get('programas_pyp');
   
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
     function PrintReporte(){
        session_start();
        $sql_string =  $_SESSION['query'];
        $query = $this->db->query($sql_string);
        return $query;
       
        
     }
     
     
     
       function getEstadosFacturas(){
         $this->db->order_by("codigo", "asc");
        $query = $this->db->get('facturas_estados');
   
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
     
       function getEximidos(){
         $this->db->order_by("codigo", "asc");
        $query = $this->db->get('estados');
   
       if($query->num_rows()>0) return $query;
       else return false;
       
     }
     
     function getTabla($tabla,$campoOrdenar,$orden){
        $this->db->order_by($campoOrdenar, $orden);
        $query = $this->db->get($tabla);
        if($query->num_rows()>0) return $query;
        else return false;
       
     }
     
     
 
}




?>