<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{

		if (isset($_SESSION['userid'])){
			redirect('Inicio');
		}
		else
		{		
			$this->load->view('templates/head_view');
			//$this->load->view('templates/header_view');
			$this->load->view('login_view');
			$this->load->view('templates/end_view');
		}	
	}

	public function verificalogin(){

		$data = array(
					'usuario'=>$_POST['usuario'],
					'contrasenia'=>$_POST['password']
				);
			
		$this->load->model('Login_model');
		$respuesta = $this->Login_model->verifica($data);

		/*obtengo valores de inicio de session*/
		
		if ($respuesta['respuesta'] == 'OK'){

			$_SESSION['nombre_completo'] = $respuesta['nombre_completo'];
			$_SESSION['userid'] = $respuesta['userid'];
			$_SESSION['usuario'] = $respuesta['usuario'];
			$_SESSION['id_modulo'] = 0;
			$_SESSION['id_funcion'] = 0;			
			$_SESSION['email'] = $respuesta['email'];
			$_SESSION['ultima_entrada'] = $respuesta['ultima_entrada'];

			/*if ($respuesta['cuenta_maestra'] == 1){
				$_SESSION['tipoCuenta'] = "Maestra";   
				$_SESSION['idCuentaMaestra'] = $_SESSION['userid'];
			}	
			else{
				$_SESSION['tipoCuenta'] = "";
				$_SESSION['idCuentaMaestra'] = $respuesta["id_depende_cuenta_maestra"];
				$_SESSION['cuenta_maestra_picco'] = $this->Login_model->obtengo_cuenta_maestra_subusuario($_SESSION['idCuentaMaestra']);
			}
			*/			
		}	
		/*************************************/

		echo json_encode($respuesta);
	}

	public function cerrar_sesion(){

		session_destroy();
		redirect('Inicio');

	}

	public function cambiarVariableSession(){

		$_SESSION['menu_visible'] = $_POST['valor'];
		$data = array(
					'variable'=>$_POST['variable'],
					'valor'=>$_POST['valor']
				);
		echo json_encode($data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */