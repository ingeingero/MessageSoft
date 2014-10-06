<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class documentos extends CI_Controller {

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
	$this->load->model('documentos_model');
    /* Cargamos la base de datos */
    $this->load->database();

    /* Cargamos la libreria*/
    $this->load->library('grocery_crud');

    /* Añadimos el helper al controlador */
    $this->load->helper('url');
	}
	public function index()
	{
		$dato['felipe']='felipe rocha';
		$this->load->helper('pie_de_pagina');
		
		$this->load->view('documentos/documentos',$dato);
		
		
	}
	public function header_body(){
	//$felipe = "felipe ocha";
	$this->load->library('menu');
	$data['mi_menu']= $this->menu->cargar(array('home','next','bn'));
	$data['mi_menu']= $this->menu->crearMenu();
	$this->load->view('header');
	$this->load->view('body', $data);
	
	
	}
	public function formulario(){
	    $lang['update_success_message'] = '.';
	$this->load->helper('form');
	$this->load->view('header');
	  $crud = new grocery_CRUD();
   $crud->set_theme('datatables');

    $crud->set_table('epss')
        ->set_subject('epss')
        ->columns('codigo','nombre','tipo_regimen','imagen')
        ->display_as('codigo','codigo')
        ->display_as('nombre','nombre')
        ->display_as('tipo_regimen','Office City')
         ->display_as('imagen','imagen');
       // $crud->delete('delete');
    $crud->set_relation('tipo_regimen','tipos_regimenes','nombre');
     $crud->set_field_upload('imagen','assets/uploads/files');
    
  
    $crud->required_fields('nombre','tipo_regimen','imagen');
   $crud->fields('codigo','nombre','tipo_regimen','imagen');
 //$crud->set_field_upload('nombre','assets/uploads/files');
    $output = $crud->render();
 
	$this->load->view('formulario',$output);
	}
	
	public function HistoriasClinicasListar(){
	
		$data = array(
		'codigo' => $this->input->post('codigo'),
		'medico_cedula' => $this->input->post('medico_cedula'),
		'medico_nombre' => $this->input->post('medico_nombre'),
		'paciente_cedula' => $this->input->post('paciente_cedula'),
		'paciente_nombre' => $this->input->post('paciente_nombre'),
		'servicio_medico_codigo' => $this->input->post('servicio_medico_codigo'),
		'servicio_medico_nombre' => $this->input->post('servicio_medico_nombre'),
		'eps' => $this->input->post('eps'),
		'dx' => $this->input->post('dx'),
		'fecha_inicio' => $this->input->post('fecha_inicio'),
		'fecha_fin' => $this->input->post('fecha_fin')
		);
	$this->documentos_model->HistoriasClinicasListar($data);	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */