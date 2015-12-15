<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

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

		if (!isset($_SESSION['userid']) || $_SESSION['userid'] == ''){
			redirect('welcome');
		}
		else
		{

			$vista='';
			$default_view = '';
			if ($vista == '' )
				$default_view = 'default_view';

			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view($default_view);
			$this->load->view('templates/end_view');
		}
	}

	

}
