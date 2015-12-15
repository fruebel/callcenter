<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->view('Templates/head_view');
		$this->load->view('Templates/header_view');
		$this->load->view('Templates/end_view');
	}

	public function fruebel(){
		echo "Hola mundo soy jesus";
	}

	public function prueba(){
		$this->load->view('Templates/head_view');
		$this->load->view('Templates/header_view');
		$this->load->view('prueba/prueba');
		$this->load->view('Templates/end_view');
	}

	public function inserta(){
		$data = array('userid' => $_POST['userid'], 'nombre' => $_POST['nombre']);
		$this->load->model('Usuarios_model');
		$respuesta = $this->Usuarios_model->inserta($data);
		echo $respuesta;
	}

	public function contenido(){
		//$this->load->view('Templates/head_view');
		//$this->load->view('Templates/header_view');
		$this->load->model('Usuarios_model');
		$respuesta = $this->Usuarios_model->contenido();
		echo $respuesta;
		//$this->load->view('Templates/end_view');
	}

}
