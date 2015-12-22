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

	public function usuarios_consulta(){

		$data = array('id_row' => $_POST['id_row']);
		$this->load->model('RH_usuarios_model');
		$respuesta = $this->RH_usuarios_model->usuarios_consulta($data);
		echo json_encode($respuesta);

	}	

	public function usuarios_menu()
	{	

		$data = array('id' => $_POST["id"] , 'accion' => $_POST["accion"]);

		$this->load->model('RH_usuarios_model');
		$respuesta = $this->RH_usuarios_model->usuarios_menu($data);
		echo ($respuesta);	
	}	

	public function usuarios_altas(){

		
		if (isset($_POST['cbo_jefedirecto']))
			$cbo_jefedirecto = $_POST['cbo_jefedirecto'];
		else
			$cbo_jefedirecto = 0;

		$data = array(
		'cpo_plazas' => $_POST['cpo_plazas'], 'cbo_puesto' => $_POST['cbo_puesto'], 'cbo_jefedirecto' => $cbo_jefedirecto ,
		'nombre_completo' => $_POST['nombre_completo'] , 'apaterno' => $_POST['apaterno'], 'amaterno' => $_POST['amaterno'],
		'usuario_f' => $_POST['usuario_f'], 'contrasenia' => $_POST['contrasenia'], 'cbo_estado' =>  $_POST['cbo_estado'],
		'direccion' => $_POST['direccion'] , 'colonia' => $_POST['colonia'], 'cp' => $_POST['cp'],
		'rfc' => $_POST['rfc'], 'imss' => $_POST['imss'] , 'curp' => $_POST['curp'],
		'cbo_sexo' => $_POST['cbo_sexo'], 'cbo_estado_civil' => $_POST['cbo_estado_civil'], 'lada' => $_POST['lada'],
		'telefono' => $_POST['telefono'], 'email' => $_POST['email'],'cbo_turno' => $_POST['cbo_turno'],
		'cuenta' => $_POST['cuenta'],'usuario_banco' => $_POST['usuario_banco'],'contrasenia_banco' => $_POST['contrasenia_banco'],
		'fechaalta' => $_POST['fechaalta'] ,'fecha_contratacion' => $_POST['fecha_contratacion'],'fecha_termino' => $_POST['fecha_termino']
	    );

		$this->load->model('RH_usuarios_model');
		$respuesta = $this->RH_usuarios_model->usuarios_altas($data);
		echo json_encode($respuesta);

	}

	public function usuarios_cambios(){

		
		if (isset($_POST['cbo_jefedirecto']))
			$cbo_jefedirecto = $_POST['cbo_jefedirecto'];
		else
			$cbo_jefedirecto = 0;

		if ($_POST['cbo_estatus_empleado'] == "")
			$cbo_estatus_empleado = "1";
		else
			$cbo_estatus_empleado = $_POST['cbo_estatus_empleado'];



		$mensaje = 'No se pudo ejecutar el insert';
		$respuesta = false;		
		$this->load->database();
		//Armamos el query
		$queryu = "";
		$queryu = "update s_usuarios set ";
		$queryu .= "u_plaza='".$_POST['cpo_plazas']."',";
		$queryu .= "u_puesto='".$_POST['cbo_puesto']."',";
		$queryu .= "u_jefedirecto='".$cbo_jefedirecto."',";					
		$queryu .= "nombre='".$_POST['nombre_completo']."',";
		$queryu .= "apaterno='".$_POST['apaterno']."',";
		$queryu .= "amaterno='".$_POST['amaterno']."',";
		$queryu .= "usuario='".$_POST['usuario_f']."',";
		$queryu .= "contrasenia='".$_POST['contrasenia']."',";
		$queryu .= "u_estado='".$_POST['cbo_estado']."',";
		$queryu .= "direccion='".$_POST['direccion']."',";
		$queryu .= "colonia='".$_POST['colonia']."',";
		$queryu .= "cp='".$_POST['cp']."',";
		$queryu .= "rfc='".$_POST['rfc']."',";
		$queryu .= "imss='".$_POST['imss']."',";
		$queryu .= "curp='".$_POST['curp']."',";
		$queryu .= "sexo='".$_POST['cbo_sexo']."',";
		$queryu .= "u_estadocivil='".$_POST['cbo_estado_civil']."',";
		$queryu .= "lada='".$_POST['lada']."',";
		$queryu .= "telefono='".$_POST['telefono']."',";
		$queryu .= "email='".$_POST['email']."',";
		$queryu .= "u_turno='".$_POST['cbo_turno']."',";
		$queryu .= "cuentabanco='".$_POST['cuenta']."',";
		$queryu .= "usuario_banco='".$_POST['usuario_banco']."',";
		$queryu .= "contrasenia_banco='".$_POST['contrasenia_banco']."',";
		$queryu .= "FechaAlta='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['fechaalta'])))."',";
		$queryu .= "FechaContratacion='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['fecha_contratacion'])))."',";
		$queryu .= "FechaTerminacion='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['fecha_termino'])))."',";
		$queryu .= "u_status='".$cbo_estatus_empleado."'";
		$queryu .= " where userid=".$_POST['idRow'];

		if ($this->db->query($queryu))
		{			
			$respuesta = true;
			$mensaje = "Se ha actualizado el registro correctamente ";	
		}
		else{


		}

		$retorno = array('respuesta'=>$respuesta,"mensaje" => $mensaje);
		echo json_encode($retorno);

	}	

	public function tablaCampaniasxUsuario(){

		$data = array('id' =>  $_POST['id'] , 'accion' => $_POST['accion']);
		$this->load->model('RH_usuarios_model');
		$respuesta = $this->RH_usuarios_model->tablaCampaniasxUsuario($data);
		echo json_encode($respuesta);	

	}



	public function usuariosxcampania()
	{

		if (!isset($_SESSION['userid'])){
			redirect('Login');	
		}
		else{	
			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view('rh/usuariosxcampania_view');
			$this->load->view('templates/end_view');	
		}
	}

}