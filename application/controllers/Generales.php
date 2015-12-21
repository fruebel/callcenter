<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Generales extends CI_Controller {

	public function index()
	{
	
	}

	public function lista(){

		$data = array('tabla' => $_POST['tabla'] , 'id' => $_POST['id'] , 'texto' => $_POST['texto'], 'where' => $_POST['where']);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->lista_m($data);

		echo $respuesta;
	}



	public function listavehiculos(){

		$data = array('modulo' => $_POST["modulo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->listavehiculos($data);

		echo $respuesta;
	}

	public function plantilla_reportes()
	{

		if (!isset($_SESSION['userid'])){
			redirect('Login');	
		}
		else{	
			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view('Generales/plantillaReportes_view');
			$this->load->view('templates/end_view');	
		}
	}

	public function comboReportes(){

		$data = array('id_usuario' => $_POST["id_usuario"], 'id_funcion' => $_POST["id_funcion"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->comboReportes($data);

		echo json_encode($respuesta);
	}

	public function comboMisReportes(){

		$data = array('id_funcion' => $_POST["id_funcion"], 'id_modulo' => $_POST["id_modulo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->comboMisReportes($data);

		echo json_encode($respuesta);
	}

	public function ObtenerFiltrosReporte(){

		$data = array('id_reporte' => $_POST["id_reporte"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->ObtenerFiltrosReporte($data);

		echo json_encode($respuesta);
	}

	public function combosFiltrosReportes(){

		$data = array('tabla' => $_POST["tabla"], 'id_campo' => $_POST["id_campo"], 'nombre_campo' => $_POST["nombre_campo"], 'id_modulo' => $_POST["id_modulo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->combosFiltrosReportes($data);

		echo json_encode($respuesta);
	}

	public function addReportesPersonalizados(){

		$data = array('id_reporte' => $_POST["id_reporte"], 'nombre' => $_POST["nombre"],'periodo' => $_POST["periodo"], 'filtros' => $_POST["filtros"], 'campos' => $_POST["campos"], 'id_funcion' => $_POST["id_funcion"], 'id_modulo' => $_POST["id_modulo"], 'id_grupo' => $_POST["id_grupo"], 'nombre_grupo' => $_POST["nombre_grupo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->addReportesPersonalizados($data);

		echo json_encode($respuesta);
	}

	public function listaMisReportes(){

		$data = array('id_funcion' => $_POST["id_funcion"], 'id_modulo' => $_POST["id_modulo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->listaMisReportes($data);

		echo json_encode($respuesta);
	}

	public function camposReportePersonalizado(){

		$data = array('id_funcion' => $_POST["id_funcion"], 'id_reporte_pers' => $_POST["id_reporte_pers"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->camposReportePersonalizado($data);

		echo json_encode($respuesta);
	}

	public function comboGraficarpor(){

		$data = array('id_campo' => $_POST["id_campo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->comboGraficarpor($data);

		echo json_encode($respuesta);
	}

	public function eliminarReportes(){

		$data = array('id_reporte' => $_POST["id_reporte"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->eliminarReportes($data);

		echo json_encode($respuesta);
	}

	public function reporteCombustible(){

		$data = array('where' => $_POST["where"], 'group_by' => $_POST["group_by"], 'campos' => $_POST["campos"], 
			'alias' => $_POST["alias"], 'fecha_inicio' => $_POST["fecha_inicio"], 'fecha_fin' => $_POST["fecha_fin"],
			'x' => $_POST["x"], 'aX' => $_POST["aX"], 'y' => $_POST["y"], 'aY' => $_POST["aY"],
			'grafica' => $_POST["grafica"], 'dato_y' => $_POST["dato_y"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->reporteCombustible($data);

		echo json_encode($respuesta);
	}

	public function editarReportePersonalizado(){

		$data = array('id_reporte_pers' => $_POST["id_reporte_pers"], 'nombre' => $_POST["nombre"],'periodo' => $_POST["periodo"], 'filtros' => $_POST["filtros"], 'campos' => $_POST["campos"], 'id_grupo' => $_POST["id_grupo"], 'nombre_grupo' => $_POST["nombre_grupo"]);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->editarReportePersonalizado($data);

		echo json_encode($respuesta);
	}


	/*ABC grupos*/
	public function grupos_modulos()
	{
		if (!isset($_SESSION['userid'])){
			redirect('Login');	
		}
		else{	
			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view('Generales/grupos_modulos_view');
			$this->load->view('templates/end_view');	
		}
	}
	
	public function grupos_contenido()
	{				
		$data = array('id_modulo' => $_POST['id_modulo']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->grupos_contenido($data);
		echo $respuesta;	
	}

	public function grupos_consulta(){

		$data = array('idRow' => $_POST['idRow'], 'id_modulo' => $_POST['id_modulo']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->grupos_consulta($data);
		echo json_encode($respuesta);

	}

	public function grupos_altas(){

		$data = array(
			'nombre_grupo' => $_POST['nombre_grupo'],
			'usuarios' => $_POST['usuarios_x_grupo'],
			'activos' => $_POST['vehiculos_x_grupo'],
			'numUsuarios' => $_POST['numUsuarios'],
			'numVehiculos' => $_POST['numVehiculos'],	
			'id_modulo' => $_POST['id_modulo']	
			);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->grupos_altas($data);
		echo json_encode($respuesta);

	}

	

	public function grupos_cambios(){
 		
 		if(isset($_POST['usuarios_x_grupo']))
			$usuarios = $_POST['usuarios_x_grupo'];
		else
			$usuarios = '';

		if(isset($_POST['vehiculos_x_grupo']))
			$vehiculos = $_POST['vehiculos_x_grupo']; 
		else
			$vehiculos = '';

		$data = array(
			'nombre_grupo' => $_POST['nombre_grupo'],
			'usuarios' => $usuarios,
			'activos' => $vehiculos,
			'numUsuarios' => $_POST['numUsuarios'],
			'numVehiculos' => $_POST['numVehiculos'],
			'idRow' => $_POST['idRow']		
			);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->grupos_cambios($data);
		echo json_encode($respuesta);
	}

	public function obtener_lista_grupos()
	{			
		/*$query = "select * from inventarios_vehiculos where id_estatus = 3  and id_cuenta_maestra = '".$_SESSION['cuenta_maestra_picco']."' 
				and id_activo in (select b.id_activo from disponibilidad a,disponibilidad_detalle b where a.id_modulo_unidad = b.id_modulo and a.id_modulo=3)
				and id_activo in (select b.id_activo from contrataciones_x_modulo a inner join PICCO.subcuentas b on a.id_subcuenta = b.id_subcuenta where  a.id_modulo = 3 and a.activo = 1)";*/
		
		//lista vehiculos en grupos_reduce_view		
		$query = "SELECT a.id_asignacion, a.id_cuenta_maestra, a.id_subcuenta, a.id_modulo, b.subcuenta, c.cve_activo, b.id_activo
					FROM contrataciones_x_modulo a 
					join PICCO.subcuentas b on a.id_subcuenta = b.id_subcuenta
					join inventarios_vehiculos c on b.id_activo = c.id_activo
					where a.id_cuenta_maestra = '".$_SESSION['cuenta_maestra_picco']."' and a.id_modulo = ".$_POST["id_modulo"]." and a.activo = 1";
						
			
		$data = array('query' => $query, 'id' => $_POST['id'], 'texto' => $_POST['texto'], 'seleccione'=> $_POST['seleccione']);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->obtener_lista($data);

		echo $respuesta;
	}

	/*ABC contratación*/
	public function contratacion_modulos()
	{

		if (!isset($_SESSION['userid'])){
			redirect('Login');	
		}
		else{	
			$this->load->database();
			$this->load->view('templates/head_view');
			$this->load->view('templates/header_view');	
			$this->load->view('Generales/contratacion_modulos_view');
			$this->load->view('templates/end_view');	
		}
	}
	
	public function contratacion_contenido()
	{				
		$data = array('id_modulo' => $_POST['id_modulo']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->contratacion_contenido($data);
		echo $respuesta;	
	}

	
	public function obtieneCostoXModuloXunidad()
	{
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->obtieneCostoXModuloXunidad();
		echo json_encode($respuesta);
	}

	public function contratacion_altas()
	{
		$numReg = (int)$_POST['numReg'];
		$arrayRegistros = array();
		for ($i = 0; $i < $numReg; $i++){
			$arrayRegistros[$i] = $_POST['id_subcuenta_'.$i];
		}
		$data = array( 'numReg' => $_POST['numReg'], 'arrayRegistros'=> $arrayRegistros, 'costoxUnidad' => $_POST['costoxUnidad'], 'id_modulo' => $_POST['id_modulo']);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->contratacion_altas($data);

		echo json_encode($respuesta);
	}

	
	public function contratacion_cambios()
	{
		$data = array( 'comentarios' => $_POST['comentarios'], 'id_subcuenta' => $_POST['id_subcuenta'], 'id_modulo' => $_POST['id_modulo']);

		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->contratacion_cambios($data);

		echo json_encode($respuesta);
	}

	public function validar_unidad_activa_en_grupo(){

		$data = array('idRow' => $_POST['idRow'], 'id_modulo' => $_POST['id_modulo']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->validar_unidad_activa_en_grupo($data);
		echo json_encode($respuesta);

	}

	public function validar_unidad_contratada(){

		$data = array('id_modulo' => $_POST['id_modulo'], 'unidades' => $_POST['unidades']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->validar_unidad_contratada($data);
		echo json_encode($respuesta);

	}

	public function validar_unidades_en_modulo(){

		$data = array('id_modulo' => $_POST['id_modulo']);
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->validar_unidades_en_modulo($data);
		echo json_encode($respuesta);

	}

	/*  ------------------------- notificaciones  --------------------------------------------*/
	public function listar_notificaciones(){
		
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->listar_notificaciones();
		echo json_encode($respuesta);

	}

	/*  ----------------------------- alertas  ------------------------------------------------*/
	public function listar_alerta_subcuentas(){
		
		$this->load->model('Generales_model');
		$respuesta = $this->Generales_model->listar_alerta_subcuentas();
		echo json_encode($respuesta);

	}

}