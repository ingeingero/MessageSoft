<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Correspondencia_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
/*CorrespondenciaListar`(IN `ID` INT,IN `Asunto` VARCHAR(200), IN `Folios` INT, IN 
`FuncionariosDocumentoOrigen` VARCHAR(50), IN `FuncionariosNombreOrigen` VARCHAR(200),
 IN `FuncionariosDocumentoDestino` VARCHAR(50), IN `FuncionariosNombreDestino` VARCHAR(200),IN
  `Bas_tiposcorrespondenciaID` INT, IN `FechaInicio` DATETIME, IN `FechaFin` DATETIME,IN 
  `LimiteInferior` INT,IN `LimiteSuperior` INT, in `tipo` int)
    DETERMINISTIC*/

   function CorrespondenciaListar($data){
    @session_start();
	$ID = $data['ID'];
    $CodigoBarras = $data['CodigoBarras'];
	$Asunto = $data['Asunto'];
	$Folios = $data['Folios'];
	$FuncionariosDocumentoOrigen = $data['FuncionariosDocumentoOrigen'];
	$FuncionariosNombreOrigen = $data['FuncionariosNombreOrigen'];
	$FuncionariosDocumentoDestino = $data['FuncionariosDocumentoDestino'];
    $FuncionariosNombreDestino = $data['FuncionariosNombreDestino'];
	$Bas_tiposcorrespondenciaID = $data['Bas_tiposcorrespondenciaID'];
    $Bas_tiposdocumentoID = $data['Bas_tiposdocumentoID'];
    $Bas_estadoID = $data['Bas_estadoID'];
    $UsuarioID= $data['UsuarioID'];
    $FechaInicio = $data['FechaInicio'].' 00:00:00';
	$FechaFin = $data['FechaFin'].' 23:59:59';
	$pagina = $data['pagina'];
    $registrospagina = $data['registrosxpagina'];
	$tipo = $data['tipo'];
     if ($pagina == 1) $LimiteInferior = 0;
    else 
    $LimiteInferior = (($pagina-1)*$registrospagina);

    $LimiteSuperior = $registrospagina;
    
   
	$sql_string = "call CorrespondenciaListar('$ID','$CodigoBarras','$Asunto','$Folios','$FuncionariosDocumentoOrigen',
	'$FuncionariosNombreOrigen','$FuncionariosDocumentoDestino','$FuncionariosNombreDestino','$Bas_tiposcorrespondenciaID',
    '$Bas_tiposdocumentoID','$Bas_estadoID','$UsuarioID','$FechaInicio','$FechaFin','$LimiteInferior','$LimiteSuperior','$tipo')";


   if($tipo == 0)
    $_SESSION['query'] = $sql_string;
  
    $query = $this->db->query($sql_string);
    return $query;
   }
    function getTabla($tabla,$campoOrdenar,$orden){
        $this->db->order_by($campoOrdenar, $orden);
        $query = $this->db->get($tabla);
        if($query->num_rows()>0) return $query;
        else return false;
       
     }
     
    function getCantidadCorrespondencia($IDBas_tiposcorrespondencia){
        $this->db->where('IDBas_tiposcorrespondencia',$IDBas_tiposcorrespondencia);
        $sql = $this->db->get('correspondencias');
        $registros = $sql->num_rows();
        return $registros;
    }
    function getCodigoNemonico($IDBas_tiposcorrespondencia){
        $this->db->where('ID',$IDBas_tiposcorrespondencia);
        $sql = $this->db->get('bas_tiposcorrespondencia');
        $row = $sql->row();
        return $row->Nemonico;
    }
    function getEmailFuncionario($IDFuncionario){
        $this->db->where('ID',$IDFuncionario);
        $sql = $this->db->get('funcionarios');
        $row = $sql->row();
        return $row;
    }
     function getParametrosGenerales($id){
        $this->db->where('ID',$id);
        $sql = $this->db->get('bas_parametrossistema');
        $row = $sql->row();
        return $row;
        
   }
    function getInformacionEmpleado($Documento){
        $this->db->where('Documento',$Documento);
        $sql = $this->db->get('usuarios');
        $row = $sql->row();
        return $row;
        
   }
   function PrintReporte(){
        session_start();
        $sql_string =  $_SESSION['query'];
        $query = $this->db->query($sql_string);
        return $query;
       
        
     }
    
    
    

     
     
     
 
}




?>