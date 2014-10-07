<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modules extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function __construct(){
    	parent::__construct();
    	$this->load->model('correspondencia_model');
        $this->load->library('session');
        $this->load->database();
        $this->load->library('Grocery_CRUD');
        $this->load->helper('url');
        $this->load->helper('fecha_en_letras');
        $this->load->helper('miles');
    }
    function CheckSession(){
           if(isset($this->session->userdata['Documento'])) return true;
           else return false;
        
    }
    
    function LoadInformacionComunInicio($data){
        if($this->CheckSession()==false) redirect('/usuarios/index','refresh');
        $sql = $this->correspondencia_model->getParametrosGenerales(1);
        $data['imagen_corporativa'] = $sql->Imagen;
        $data['nombre_empresa'] = $sql->NombreEmpresa;
        $sql = $this->correspondencia_model->getInformacionEmpleado($this->session->userdata['Documento']); 
        if($sql->Foto == "")
            $data['imagen_usuario'] = "nofoto.jpg";
        else
        $data['imagen_usuario'] = $sql->Foto;
        $data['nombre_usuario'] = $sql->Nombre;
        $dataMenu['nombre_usuario']  = $sql->Nombre;
        
        $this->load->view('html_apertura');
    	$this->load->view('header_apertura');
        $this->load->view('header_bootstrap');
        $this->load->view('header_cierre');
        $this->load->view('body_apertura');
        $this->load->view('menu',$dataMenu);
        $this->load->view('container_apertura');
        $this->load->view('banner',$data);
        $this->load->view('contenido');
        $this->load->view('container_cierre');
        $this->load->view('body_cierre');
    	$this->load->view('html_cierre');    
        
    }
    function LoadInformacionComunGrocery($output,$data){
        if($this->CheckSession()==false) redirect('/usuarios/index','refresh');
        $sql = $this->correspondencia_model->getParametrosGenerales(1);
        $data['imagen_corporativa'] = $sql->Imagen;
        $data['nombre_empresa'] = $sql->NombreEmpresa;
        $sql = $this->correspondencia_model->getInformacionEmpleado($this->session->userdata['Documento']); 
         if($sql->Foto == "")
            $data['imagen_usuario'] = "nofoto.jpg";
        else
        $data['imagen_usuario'] = $sql->Foto;
        $data['nombre_usuario'] = $sql->Nombre;
        $dataMenu['nombre_usuario']  = $sql->Nombre;
       
        
        $this->load->view('html_apertura');
        $this->load->view('header_apertura');
        $this->load->view('header_bootstrap');
        $this->load->view('header_grocery',$output);
        $this->load->view('header_cierre');
        $this->load->view('body_apertura');
        $this->load->view('menu',$dataMenu);
        $this->load->view('container_apertura');
        $this->load->view('banner',$data);
        $this->load->view('contenido',$output);
        $this->load->view('container_cierre');
        $this->load->view('body_cierre');
        $this->load->view('html_cierre');
        
    }
	public function index(){
        $data['output'] = '<!-- Main hero unit for a primary marketing message or call to action -->
          <div class="hero-unit">
            <h1>Bienvenido</h1>
            <p>Software de Correspondencia</p>
           </div>
            <hr>
           <footer>
            <p>'.date("Y").'</p>
          </footer>';
        $data['nombre_modulo'] = 'Dependencias';
        $this->LoadInformacionComunInicio($data);
	}


    public function dependencias(){
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('dependencias')
            ->set_subject('Dependencia')
            ->columns('ID','Nombre','IDBAS_tiposdependencias');
            $crud->required_fields('Nombre','IDBAS_tiposdependencias');
            $crud->fields('Nombre','IDBAS_tiposdependencias');
            $crud->set_relation('IDBAS_tiposdependencias','bas_tiposdependencias','Nombre'); 
            
            $output = $crud->render();
            
            $data['nombre_modulo'] = 'Dependencias';
            
            $this->LoadInformacionComunGrocery($output,$data);
}

public function usuarios(){
   
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        
        $crud->unset_delete();
        $crud->set_table('usuarios')
        ->set_subject('Usuario')
        ->columns('Documento','Nombre','Foto');
        $crud->required_fields('Documento','Nombre');
        $crud->fields('Documento','Nombre','Foto','Password');
        $crud->set_field_upload('Foto','assets/uploads/files/usuarios');
        $crud->field_type('Password','hidden');
         $crud->callback_before_insert(array($this,'UsuariosPassword'));
        $output = $crud->render();
        $data['nombre_modulo'] = 'Usuarios';
        
        $this->LoadInformacionComunGrocery($output,$data);
       
}
  function UsuariosPassword($post_array){
        $post_array['Password'] = $post_array['Documento'];
        return $post_array;
        
        
    }


        public function mi_cuenta(){
        if($this->CheckSession()==false) redirect('/usuarios/index','refresh');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        
        $crud->unset_delete();
        $crud->unset_add();
        $crud->unset_read();
        $crud->where('Documento',$this->session->userdata['Documento']);
        $crud->set_table('usuarios')
        
        ->set_subject('Usuario')
        ->columns('Documento','Nombre','Foto');
        $crud->required_fields('Nombre','Password');
        $crud->fields('Nombre','Foto','Password');
        $crud->set_field_upload('Foto','assets/uploads/files/usuarios');
        $crud->field_type('Password','password');
        $crud->field_type('Documento','readonly');

        $output = $crud->render();
        $data['nombre_modulo'] = 'Usuarios';
        
        $this->LoadInformacionComunGrocery($output,$data);
       
    }
  
      
public function correspondencia_recibida(){
   
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        //$crud->unset_delete();
       
            $crud->set_table('correspondencias')
            ->set_subject('Correspondencia')
            ->columns('ID','Fecha','Asunto','IDFuncionariosOrigen','IDFuncionariosDestino','IDBas_tiposcorrespondencia','IDBAS_tiposdocumentos','Codigo')
            ->display_as('IDFuncionariosOrigen','Origen')   
            ->display_as('IDFuncionariosDestino','Destino')
             
            ->display_as('IDBas_tiposcorrespondencia','Tipo Correspondencia')
            ->display_as('Codigo','Codigo Interno')
            ->display_as('IDBAS_tiposdocumentos','Tipo Documento')
            ->display_as('IDBAS_estado','Estado');
            
            $crud->required_fields('ID','Fecha','Asunto','IDFuncionariosOrigen','IDFuncionariosDestino','Folios','FolioDigital','IDBas_tiposcorrespondencia','IDBAS_tiposdocumentos');
            $crud->fields('Fecha','Asunto','IDFuncionariosOrigen','IDFuncionariosDestino','Folios','FolioDigital','Codigo','IDBas_tiposcorrespondencia','IDBAS_tiposdocumentos','Observacion','IDUsuario','IDBAS_estado','CodigoBarras');
           
            $crud->set_relation('IDBAS_tiposdocumentos','bas_tiposdocumentos','Nombre'); 
            $crud->set_relation('IDFuncionariosOrigen','funcionarios','Nombre'); 
            $crud->set_relation('IDFuncionariosDestino','funcionarios','Nombre');
            $crud->set_relation('IDBas_tiposcorrespondencia','bas_tiposcorrespondencia','Nombre');
            $crud->set_relation('IDBAS_estado','bas_estados','Nombre');
            
            $crud->set_field_upload('FolioDigital','assets/uploads/files');
            $crud->set_rules('Folios','Cantidad de Folios','integer');
            $crud->callback_before_insert(array($this,'TestBefore'));
            $crud->field_type('Codigo', 'hidden');
            $crud->field_type('Folios', 'integer');
            $crud->field_type('Observacion','text');
            $crud->field_type('IDUsuario','hidden');
            //$crud->field_type('IDBAS_estado','hidden');
            
            
            
            $crud->unset_back_to_list();
           //  $crud->callback_edit_field('FolioDigital',array($this,'edit_field_callback_1'));
            
            $output = $crud->render();
            $data['nombre_modulo'] = 'Correspondencia';
            $this->LoadInformacionComunGrocery($output,$data);
            
     
}
function edit_field_callback_1($value, $primary_key)
{
    return "<a href='http://ingera.com.co/Messagesoft/assets/uploads/files/$value'>Descarga</a>";
}
     function TestBefore($post_array){
       
        $sql = $this->correspondencia_model->getEmailFuncionario($post_array['IDFuncionariosDestino']);
        $Email = $sql->Email;
        $Correo =  $sql->Correo;
        $Nombre = $sql->Nombre;
        
        
        
        $cantidad = $this->correspondencia_model->getCantidadCorrespondencia($post_array['IDBas_tiposcorrespondencia']);
        $nemonico = $this->correspondencia_model->getCodigoNemonico($post_array['IDBas_tiposcorrespondencia']);
       
       $sql = $this->correspondencia_model->getInformacionEmpleado($this->session->userdata['Documento']);
       
        $codigo = $cantidad + 1;
        $post_array['Codigo'] = $nemonico.str_pad($codigo, 6, '0', STR_PAD_LEFT); 
        $post_array['IDUsuario']  = $sql->ID;
        $post_array['IDBAS_estado']  = "1";
        $FolioDigital = $post_array['FolioDigital'];
        $UrlFolioDigital = base_url()."assets/uploads/files/".$FolioDigital;
        $sql = $this->correspondencia_model->getParametrosGenerales(1);
        $PieDePaginaCorreo = $sql->PieDePaginaCorreo;
        
        
        
        $cabeceras = 'MIME-Version: 1.0' . "\r\n"; 
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        $cabeceras .= 'FROM: Correspondencia Hospital <noresponder@correspondenciahospital.com.co> '."\r\n"; 
        mail($Email,'Hola, Mira tu Correspondencia',"Hola $Nombre <br><br> tienes una  Correspondencia puedes descargarla <a href='$UrlFolioDigital'>Aquí</a><br><br><em>$PieDePaginaCorreo</em>",$cabeceras);
        if($Correo != $Email)
        mail($Correo,'Hola, Mira tu Correspondencia',"Hola $Nombre <br><br> tienes una  Correspondencia puedes descargarla <a href='$UrlFolioDigital'>Aquí</a><br><br><em>$PieDePaginaCorreo</em>",$cabeceras);
        return $post_array;
     }
 
    public function tipos_documentos(){
       
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            //$crud->unset_delete();
           
            $crud->set_table('bas_tiposdocumentos')
            ->set_subject('Tipos Documentos')
            ->columns('ID','Nombre');
            $crud->required_fields('Nombre');
            $crud->fields('Nombre');
            $output = $crud->render();
            $data['nombre_modulo'] = 'Tipos Documentos';
            
            $this->LoadInformacionComunGrocery($output,$data,'Tipos Documentos');
            
    }
    public function tipos_correspondencia(){
       
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            //$crud->unset_delete();
           
            $crud->set_table('bas_tiposcorrespondencia')
            ->set_subject('Tipos Correspondencia')
            ->columns('ID','Nombre');
            $crud->required_fields('Nombre');
            $crud->fields('Nombre');
            $output = $crud->render();
            $data['nombre_modulo'] = 'Tipos Correspondencia';
            
            $this->LoadInformacionComunGrocery($output,$data);
            
    }
    public function externos(){
       
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            //$crud->unset_delete();
           
            $crud->set_table('externos')
            ->set_subject('Externos')
            ->columns('ID','Documento','Nombre');
            $crud->required_fields('Nombre');
            $crud->fields('Nombre','Documento');
            $output = $crud->render();
            $data['nombre_modulo'] = 'Externos';
            
            $this->LoadInformacionComunGrocery($output,$data);
          
}   
    public function funcionarios(){
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->unset_delete();
            $crud->set_table('funcionarios')
            ->set_subject('Funcionario')
            ->display_as('IDDependencias','Dependencia')
            ->display_as('Email','Correo Corporativo')
            ->display_as('Correo','Correo Personal')
            ->columns('Documento','Nombre','IDDependencias','Email','Correo');
            $crud->set_relation('IDDependencias','dependencias','Nombre'); 
            
            $crud->required_fields('Documento','Nombre','IDDependencias','Correo','Email');
            $crud->fields('Documento','Nombre','IDDependencias','Correo','Email');
          
            $output = $crud->render();
            $data['nombre_modulo'] = 'Funcionarios';
            
            $this->LoadInformacionComunGrocery($output,$data);
            
    }
  
public function correspondencias(){
        if($this->CheckSession()==false) redirect('/usuarios/index','refresh');  
        $data1['Bas_tiposcorrespondenciaID'] = $this->correspondencia_model->getTabla('bas_tiposcorrespondencia','ID','ASC');
        $data1['Bas_tiposdocumentoID'] = $this->correspondencia_model->getTabla('bas_tiposdocumentos','ID','ASC');
        $data1['Bas_estadoID'] = $this->correspondencia_model->getTabla('bas_estados','ID','ASC');
        $data1['UsuarioID'] = $this->correspondencia_model->getTabla('usuarios','ID','ASC');
        
        $sql = $this->correspondencia_model->getInformacionEmpleado($this->session->userdata['Documento']); 
        $dataMenu['nombre_usuario']  = $sql->Nombre;
        $this->load->view('html_apertura');
        $this->load->view('header_apertura');
        $this->load->view('header_bootstrap');
       	$this->load->view('funciones');
       // $this->load->view('header_grocery',$output);
        $this->load->view('header_cierre');
        $this->load->view('body_apertura');
        $this->load->view('menu',$dataMenu);
        $this->load->view('container_apertura');
        //$this->load->view('banner',$data);
        $this->load->view('correspondencias',$data1);
        $this->load->view('container_cierre');
        $this->load->view('body_cierre');
        $this->load->view('html_cierre');
}


 public function ImprimirReporte($vista){
    $vista = $this->uri->segment(3);
    $tipo = $this->uri->segment(4);    
    $info = $this->correspondencia_model->PrintReporte(); 
    $data['datos'] = $info;
    $data['tipo'] = $tipo;
    $data['rows'] = $info->num_rows();
    $this->load->view('html_apertura');
    $this->load->view('header_apertura');
    $this->load->view('header_bootstrap');
    $this->load->view('header_cierre');
    $this->load->view('body_apertura');
   // $this->load->view('menu');
    $this->load->view('container_apertura');
   // $this->load->view('banner',$data);
    $this->load->view($vista,$data);
  //  $this->load->view('contenido_excel',$data);
    $this->load->view('container_cierre');
    $this->load->view('body_cierre');
    $this->load->view('html_cierre');
  
    
 }

public function parametros_sistema(){
   
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        //$crud->unset_delete();
       
        $crud->set_table('bas_parametrossistema')
        ->set_subject('Patametros del Sistema')
        ->columns('ID','NombreEmpresa','Imagen','PieDePaginaCorreo')
        ->display_as('PieDePaginaCorreo','Texto en Correo')
        ->display_as('NombreEmpresa','Nombre Empresa');
        $crud->required_fields('ID','NombreEmpresa','Imagen','PieDePaginaCorreo');
        $crud->fields('ID','NombreEmpresa','Imagen','PieDePaginaCorreo');
         $crud->set_field_upload('Imagen','assets/uploads/files/parametros_generales');
        $crud->unset_add();
        $crud->unset_delete();
        $crud->callback_before_update(array($this,'Imagen'));
        $crud->field_type('PieDePaginaCorreo','text');
        $output = $crud->render();
        $data['nombre_modulo'] = 'Parametros Generales';
        
        $this->LoadInformacionComunGrocery($output,$data);
}   
function Imagen($post_array){
    //$post_array['NombreEmpresa'] = $post_array['Imagen'];
     return $post_array;
    
}

public function CorrespondenciaListar(){
  
        $data = array(
		'ID' => $this->input->post('ID'),
        'CodigoBarras' => $this->input->post('CodigoBarras'),
		'Asunto' => $this->input->post('Asunto'),
		'Folios' => $this->input->post('Folios'),
		'FuncionariosDocumentoOrigen' => $this->input->post('FuncionariosDocumentoOrigen'),
		'FuncionariosNombreOrigen' => $this->input->post('FuncionariosNombreOrigen'),
		'FuncionariosDocumentoDestino' => $this->input->post('FuncionariosDocumentoDestino'),
        'FuncionariosNombreDestino' => $this->input->post('FuncionariosNombreDestino'),
		'Bas_tiposcorrespondenciaID' => $this->input->post('Bas_tiposcorrespondenciaID'),
        'Bas_tiposdocumentoID' => $this->input->post('Bas_tiposdocumentoID'),
        'Bas_estadoID' => $this->input->post('Bas_estadoID'),
        'UsuarioID' => $this->input->post('UsuarioID'),
		'FechaInicio' => $this->input->post('FechaInicio'),
		'FechaFin' => $this->input->post('FechaFin'),
		'pagina' => $this->input->post('pagina'),
        'tipo' => '0',
        'registrosxpagina' => '5'
       	);
    
      $datos = $this->correspondencia_model->CorrespondenciaListar($data);  
      $totalregistros = $datos->num_rows();
      $this->db->close();
      $data['tipo'] = '1';
 	  $datoss = $this->correspondencia_model->CorrespondenciaListar($data);
       foreach($datoss->result() as $registro){
        $class = "info";
        if($registro->Bas_estadoNombre == "ANULADA")
            $class = "error";
        else if ($registro->Bas_estadoNombre == "POR ENTREGAR")
            $class = "info";
        else if ($registro->Bas_estadoNombre == "ENTREGADA")
            $class = "success";
             ?><tr style="font-size: 11px;" class="<?php echo $class?>">
             <td><?php echo $registro->ID." <br><label class='label label-info'>".$registro->CodigoBarras ?></label> </td>
             <td><?php echo $registro->Fecha; ?> </td>
              <td><?php echo $registro->Asunto; ?> </td>
             <td><?php echo $registro->Folios; ?> </td>
             <td><a target="_blank" href="<?php echo base_url(); ?>index.php/modules/funcionarios/edit/<?php echo $registro->FuncionariosIDOrigen;  ?>"><?php echo $registro->FuncionariosNombreOrigen; ?></a></td>
             <td><a target="_blank" href="<?php echo base_url(); ?>index.php/modules/funcionarios/edit/<?php echo $registro->FuncionariosIDDestino;  ?>"><?php echo $registro->FuncionariosNombreDestino; ?></a></td>
             <td><?php echo $registro->Bas_tiposcorrespondenciaNombre; ?> </td>
             <td><?php echo $registro->Bas_tiposdocumentoNombre; ?> </td>
             <td><?php echo $registro->UsuarioNombre; ?> </td>
             <td><?php echo $registro->Bas_estadoNombre; ?> </td>
             <td><a class="btn btn-warning" target="_blank" href="<?php echo base_url(); ?>index.php/modules/correspondencia_recibida/edit/<?php echo $registro->ID; ?>"><i class="icon-search icon-white"></i>Ver</a>
             
             
    
             
             </td>
            </tr><?php   
        }
    	?>
         <tr><td style="text-align: center;" colspan="11"><span class="label label-success"><?php echo "Registros ". $totalregistros; ?></span></td></tr>
        <tr><td style="text-align: center;" colspan="11"><?php echo $this->ImprimirPaginacion($data['registrosxpagina'],$data['pagina'],$totalregistros,'pagina'); ?></td></tr>
       
     <?php
     
    //	$datoss->free_result();
 
	}
    
     function ImprimirPaginacion($num_registros_por_pagina,$page,$total_registros,$nombre_funcion_recargar){
    $total_paginas = intval($total_registros/$num_registros_por_pagina); 
    $retornar="<div class='pagination'><ul>";
    //si la pagina actual es mayor que uno entonces pongo el boton Atras e Inicio
    if($page > 1){
        $ant = $page -1;
        $ini = 1;
        $funcion_recargar_ini = $nombre_funcion_recargar."($ini)";
        $funcion_recargar_ant = $nombre_funcion_recargar."($ant)";
        $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_ini'>Inicio</a></li>";
        $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_ant'>Ant</a></li>";
        }
    //Imprimo cada una de las paginas
    for($i=1; $i<=($total_paginas+1);$i++){
        $funcion_recargar = $nombre_funcion_recargar."($i)";
        if($page == $i) $class_paginacion = 'active';
        else $class_paginacion = '';
        $retornar = $retornar ."<li  style='cursor:pointer'  class='$class_paginacion' ><a style='cursor:ponter' title='Pagina $i' onclick='$funcion_recargar'>$i</a></li>";
      } 
    //Si la pagina es menor a la pagina final entonces pongo al boton de siguiente y el boton final.  
      if($page<($total_paginas+1)){
      $fin = $total_paginas+1;
      $sig = $page +1;
      $funcion_recargar_fin = $nombre_funcion_recargar."($fin)";
      $funcion_recargar_sig = $nombre_funcion_recargar."($sig)";
      $retornar = $retornar ."<li><a style='cursor:pointer' onclick='$funcion_recargar_sig'>Sig</a></li>";
      $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_fin'>Fin</a></li>";
      }
    $retornar = $retornar."</ul></div>";
    return $retornar;
 }
 
 


}
?>
