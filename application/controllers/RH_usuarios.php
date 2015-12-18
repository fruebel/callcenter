<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RH_usuarios extends CI_Controller {


	public function usuarios()
	{

		if (!isset($_SESSION['userid'])){
			redirect('Login');	
		}
		else{	
			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view('rh/usuarios_view');
			$this->load->view('templates/end_view');	
		}
	}

	public function usuarios_contenido()
	{			
		
		$this->load->model('RH_usuarios_model');
		$respuesta = $this->RH_usuarios_model->usuarios_contenido();
		echo $respuesta;	
	}


}