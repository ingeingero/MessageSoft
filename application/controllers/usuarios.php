<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarios extends CI_Controller {

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
	$this->load->model('usuarios_model');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('fecha_en_letras');
    $this->load->helper('calcular_edad');
    $this->load->library('Grocery_CRUD');
    
    
	}
	public function index()
        {
     
       
            if(!isset($_POST['Documento']))
            {
         $this->load->view('html_apertura');
        $this->load->view('header_apertura');
        $this->load->view('header_bootstrap');
       // $this->load->view('header_grocery',$output);
        $this->load->view('header_cierre');
        $this->load->view('body_apertura');
        //$this->load->view('menu');
        $this->load->view('container_apertura');
        //$this->load->view('banner',$data);
       $this->load->view('login/login'); //si no recibimos datos por post, cargamos la vista del formulario
        $this->load->view('container_cierre');
        $this->load->view('body_cierre');
        $this->load->view('html_cierre');
            
            }
            else
            {
            
                $isValidLogin = $this->usuarios_model->getLogin($_POST['Documento'],$_POST['Pass']); //pasamos los valores al modelo para que compruebe si existe el usuario con ese password
               
                    if($isValidLogin)
                    {
                    // si existe el usuario, registramos las variables de sesión y abrimos la página de exito
                   
                        $sesion_data = array(
                                        'Documento' => $_POST['Documento'],
                                        'Password' => $_POST['Pass']
                                            );
                        $this->session->set_userdata($sesion_data);
                   
                    $data['Documento'] = $this->session->userdata['Documento'];
                    $data['Password'] = $this->session->userdata['Password'];
                       
                   // $this->load->view('login_success',$data);
                    redirect('/modules/index','refresh');
                    }
                    else
                    {
                    // si es erroneo, devolvemos un mensaje de error
                    redirect('/usuarios/index','refresh');
                    }
                
           
           
            }
           
           
        }
     
        public function destroy()
        {
        //destruimos la sesión
        $this->usuarios_model->close();
     
            //echo "Sesión borrada"."";
            redirect('/usuarios/index','refresh');
           
     
        }
       
 
}
?>
