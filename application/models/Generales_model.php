<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generales_model extends CI_Model {

	public function lista_m($data){

		$contenido = '';
		$contenido .= '<option value="">Seleccione...</option>';

		$tabla = $data['tabla']; //tabla a consultar
		$where = ($data['where'] != "") ? $data['where']." and " : " "; //condición
		$id = $data['id'];//id option
		$texto = $data['texto']; // texto option



		$query = "select ".$id." as id,".$texto." as texto from ".$tabla. " where ".$where." " . $id ." order by ".$texto." asc";


		$this->load->database();
		$query = $this->db->query($query);

		if ($query->num_rows()>0){

			foreach ($query->result() as $row) {
				# code...
				$contenido .= '<option value="'.$row->id.'">'.$row->texto.'</option>';
			}
		}

		return $contenido;
	}

	public function obtener_lista($data){

		if($data['seleccione'] == 1)
			$contenido = '<option>Seleccione... </option>';
		else
			$contenido = '';

		$id = $data['id']; //id option
		$texto = $data['texto']; // texto option
		$query = $data['query']; //consulta

		$this->load->database();
		$query = $this->db->query($query);

		if ($query->num_rows()>0){

			foreach ($query->result() as $row) {
				# code...
				$contenido .= '<option value="'.$row->$id.'">'.$row->$texto.'</option>';
			}
		}

		return $contenido;
	}


	public function listavehiculos($data){

		$contenido = '';

		if ($_SESSION["tipoCuenta"] == 'Maestra'){
			$sql = "
			select a.cve_activo,a.id_activo
			from inventarios_vehiculos a
			inner join cat_estatus_vehiculo b on a.id_estatus = b.id_estatus and a.id_estatus = 3
			inner join PICCO.subcuentas c on a.id_activo = c.id_activo  and c.id_inventario <> 0	
			inner join  contrataciones_x_modulo d on d.id_subcuenta = c.id_subcuenta and  d.activo = 1 and d.id_modulo = ".$data["modulo"]."
			where a.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']."
			and d.activo = 1 
			order by a.cve_activo asc	
			";
		}
		else{
			$sql = "	
			select distinct e.cve_activo,e.id_activo
			from usuarios_x_grupo a
			inner join unidades_x_grupo b on a.id_grupo = b.id_grupo
			inner join PICCO.subcuentas c on b.id_activo = c.id_activo  and c.id_inventario <> 0	
			inner join contrataciones_x_modulo d on d.id_subcuenta = c.id_subcuenta and  d.activo = 1 and d.id_modulo = ".$data["modulo"]."
			inner join inventarios_vehiculos e on e.id_activo = b.id_activo  and e.id_estatus = 3		
			where a.id_usuario = ".$_SESSION['userid']." order by e.cve_activo asc
			";

		}


		$this->load->database();
		$query = $this->db->query($sql);

		$contenido = '<option value="">Seleccione...</option>';
		if ($query->num_rows()>0){

			foreach ($query->result() as $row) {
				# code...
				$contenido .= '<option value="'.$row->id_activo.'">'.$row->cve_activo.'</option>';
			}
		}

		return $contenido;

	}

	public function comboReportes($data)
	{
		$contenido = '<option value="">Seleccione...</option>';
		
		if($_SESSION['tipoCuenta'] == 'Maestra')
		{
			$sql = "select a.id_reporte, a.nombre from reportes a 			
				where a.activo = 1 and a.id_funcion = ".$data["id_funcion"];
		}
		else
		{
			$sql = "select a.id_reporte, a.nombre from reportes a 
				join reporte_x_usuario b on a.id_reporte = b.id_reporte
				where a.activo = 1 and b.id_usuario = ".$data["id_usuario"]." and a.id_funcion = ".$data["id_funcion"];
		}

		$this->load->database();
		$query = $this->db->query($sql);

		if ($query->num_rows()>0){

			foreach ($query->result() as $row) {
				# code...
				$contenido .= '<option value="'.$row->id_reporte.'">'.$row->nombre.'</option>';
			}
		}
		$salidaJson = array("sql" => $sql,	"contenido" => $contenido);

		return $salidaJson;
	}

	public function comboMisReportes($data)
	{
		$contenido = '<option value="">Seleccione...</option>';		

		$sql = "select * from reportes_personalizados  where activo = 1 and id_funcion = ".$data["id_funcion"]." and id_modulo = ".$data["id_modulo"]." and id_usuario =".$_SESSION['userid'];

	
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query->num_rows()>0){

			foreach ($query->result() as $row) {
				# code...
				$contenido .= '<option value="'.$row->id_reporte_pers.'-'.$row->id_reporte.'-'.$row->periodo.'">'.$row->nombre.'</option>';
			}
		}

		$salidaJson = array("sql" => $sql,	"contenido" => $contenido);

		return $salidaJson;
	}

	public function ObtenerFiltrosReporte($data)
	{
		$elementos = array();
		$elemento = '';
		$id_usuario = $_SESSION['userid'];
		$tipo_cuenta = $_SESSION['tipoCuenta'];

		if($tipo_cuenta == 'Maestra')
		{
			$sql = "select a.id_campo,a.id_reporte, a.campo, a.alias, a.tipo_html, a.filtro, a.tipo_dato, a.requerido, a.catalogo, a.campo_string, a.grupo, a.orden, b.nombre, b.tabla, b.otra_pagina, b.plantilla, b.agrupar, a.grafica ";
			$sql .= "from campos_x_reporte a join reportes b on a.id_reporte= b.id_reporte where a.id_reporte = ".$data["id_reporte"]." order by a.grupo, a.orden";
		}
		else
		{
			$sql = "select a.id_campo,a.id_reporte, a.campo, a.alias, a.tipo_html, a.filtro, a.tipo_dato, a.requerido, a.catalogo, a.campo_string, a.grupo, a.orden,b.nombre, b.tabla, b.otra_pagina, b.plantilla , b.agrupar, a.grafica
				from campos_x_reporte a 
				join reportes b on a.id_reporte = b.id_reporte
				join campos_x_usuario c on a.id_campo = c.id_campo
				where c.id_reporte = ".$data["id_reporte"]." and c.id_usuario = ".$id_usuario." order by a.grupo, a.orden asc";
		}

		
		$this->load->database();
		$query = $this->db->query($sql);
		$elemento['otra_pagina'] = 0;
		$elemento['plantilla'] = '';
		$elemento['agrupar'] = 0;
		$elemento['nombre'] = '';
		if($query->num_rows()>0)		
		{			
			foreach ($query->result() as $lista)
			{
				$elemento['id_campo'] = $lista->id_campo;
				$elemento['id_reporte'] = $lista->id_reporte;
				$elemento['nombre'] = $lista->nombre;
				$elemento['campo'] = $lista->campo;
				$elemento['campo_string'] = $lista->campo_string;
				$elemento['alias'] = $lista->alias;
				$elemento['tipo'] = $lista->tipo_html;
				$elemento['filtro'] = $lista->filtro;
				$elemento['tipo_dato'] = $lista->tipo_dato;
				$elemento['requerido'] = $lista->requerido;
				$elemento['otra_pagina'] = $lista->otra_pagina;
				$elemento['plantilla'] = $lista->plantilla;
				$elemento['tabla'] = $lista->tabla;
				$elemento['agrupar'] = $lista->agrupar;
				$elemento['grafica'] = $lista->grafica;
				$elemento['catalogo'] = $lista->catalogo;	
				$elemento['orden'] = $lista->orden;	
				$elemento['grupo'] = $lista->grupo;				

				$elementos[$lista->campo_string] = $elemento;
			}
		}

		$salidaJson = array("sql" => $sql, "contenido" => $elementos, 'otra_pagina' => $elemento["otra_pagina"], 'plantilla' => $elemento["plantilla"], 'nombreReporte' => $elemento["nombre"], "agrupar" => $elemento['agrupar']);

		return $salidaJson;
	}

	public function combosFiltrosReportes($data)
	{
		$tipo_cuenta = $_SESSION['tipoCuenta'];
		$opciones = '<option value="">Todos...</option>';
		$campo_string = '';

		$sql = "select campo_string from campos_x_reporte where id_campo = ".$data["id_campo"];

		$this->load->database();
		$query = $this->db->query($sql);

		if($query)		
		{		
			foreach ($query->result() as $lista)
			{
				$campo_string = $lista->campo_string;			
			}
		}


		$campo_id = explode(".",$data["nombre_campo"])[1];

		if($campo_id == 'cve_activo' )
		{
			if($tipo_cuenta == 'Maestra')
			{
				$sql = "select distinct c.id_activo , c.cve_activo, e.activo
							from inventarios_vehiculos c 
						    inner join PICCO.subcuentas d on d.id_activo = c.id_activo and d.id_inventario <> 0
						    inner join contrataciones_x_modulo e on e.id_subcuenta = d.id_subcuenta and e.id_modulo = ".$data["id_modulo"]." and e.activo = 1
						where c.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." order by c.cve_activo asc";
			}		
			else
			{			
				$sql ="select distinct b.id_activo , c.cve_activo, e.activo 
							from usuarios_x_grupo a 
							inner join unidades_x_grupo b on b.id_grupo = a.id_grupo 
							inner join inventarios_vehiculos c on c.id_activo = b.id_activo
						    inner join PICCO.subcuentas d on d.id_activo = c.id_activo and d.id_inventario <> 0
						    inner join contrataciones_x_modulo e on e.id_subcuenta = d.id_subcuenta and e.id_modulo = ".$data["id_modulo"]." and e.activo = 1
						where a.id_usuario = ".$_SESSION['userid']." order by c.cve_activo asc";
			}	

		}
		else if($campo_id == 'id_empleado' )
		{
			$sql ="select CONCAT(cve_empleado,' - ', primer_nombre,' ',apellido_paterno,' ',apellido_materno) AS operador, id_empleado, activo from ".$data["tabla"]." where id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and activo = 1 order by cve_empleado asc" ;
		}
		else if($campo_id == 'id_pdi' ) //gasolineria
		{
			$sql ="select nombre_pdi, id_pdi, activo from ".$data["tabla"]." where id_tipo_pdi = 5 and id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and activo = 1" ;
		}
		else if($campo_id == 'id_marca' ) //marca
		{
			$sql = "select ".$campo_id.", marca, activo from ".$data["tabla"]." where activo = 1" ;
		}
		else if($campo_id == 'id_grupo' ) //grupo
		{
			$sql = "select ".$campo_id.", ".$campo_string.", activo from ".$data["tabla"]." where id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and activo = 1 and id_modulo = 3" ;
		}
		else if($campo_id == 'id_tipo_combustible' ) //tipocombustible
		{
			$sql = "select ".$campo_id.", ".$campo_string.", activo from ".$data["tabla"]." where activo = 1" ;
		}
		else
			$sql = "select ".$campo_id.", ".$campo_string.", activo from ".$data["tabla"]." where id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and activo = 1" ;

		
		
		$query = $this->db->query($sql);

		if($query->num_rows()>0 && $campo_string != '')		
		{
			
			foreach ($query->result() as $lista)
			{			
				$activo = ($lista->activo == 1) ? '' : '--> inactivo'; 	
				$opciones.='<option value="'. $lista->$campo_id. '">' .utf8_encode($lista->$campo_string).' '.$activo.' </option>';
			}
		}

		$salidaJson = array("sql" => $sql,	"contenido" => $opciones);

		return $salidaJson;
	}

	public function addReportesPersonalizados($data)
	{		
		$query = "";
		$respuesta = false;
		$mensajeError = "";
		
		if($data['id_grupo'] == 0)//nuevo grupo
		{
			$query = "insert into grupos_mis_reportes (nombre, id_usuario) values ('".$data['nombre_grupo']."', ".$_SESSION['userid'].")";
			

			$this->load->database();
			$response = $this->db->query($query);
			$id = $this->db->insert_id();
			if ($response)
			{
				$query = "insert into reportes_personalizados (id_reporte, nombre, filtros, campos, id_usuario, id_funcion, periodo, id_modulo, id_grupo) values (";
				$query .= $data['id_reporte'].",";
				$query .= "'".$data['nombre']."',";
				$query .= "'".$data['filtros']."',";
				$query .= "'".$data['campos']."',";
				$query .= "".$_SESSION['userid'].",";
				$query .= "".$data['id_funcion'].",";
				$query .= "".$data['periodo'].",";
				$query .= "".$data['id_modulo'].",";
				$query .= "".$id."";
				$query .= ");";

				
				$response = $this->db->query($query);

				if ($response)
				{
					$respuesta = true;
					$mensajeError = "Se ha actualizado el registro correctamente " . $query;
				}
				else
				{
					$respuesta = false;
					$mensajeError = "no se pudo ejecutar " . $query;
				}
			}
		}
		else
		{
			$query = "insert into reportes_personalizados (id_reporte, nombre, filtros, campos, id_usuario, id_funcion, periodo, id_modulo, id_grupo) values (";
			$query .= $data['id_reporte'].",";
			$query .= "'".$data['nombre']."',";
			$query .= "'".$data['filtros']."',";
			$query .= "'".$data['campos']."',";
			$query .= "".$_SESSION['userid'].",";
			$query .= "".$data['id_funcion'].",";
			$query .= "".$data['periodo'].",";
			$query .= "".$data['id_modulo'].",";
			$query .= "".$data['id_grupo']."";
			$query .= ");";

			$this->load->database();
			$response = $this->db->query($query);

			if ($response)
			{
				$respuesta = true;
				$mensajeError = "Se ha actualizado el registro correctamente " . $query;
			}
			else
			{
				$respuesta = false;
				$mensajeError = "no se pudo ejecutar " . $query;
			}
		}

			

		$salidaJson = array("sql" => $query, "contenido" => "", "respuesta" => $respuesta, "mensaje" => $mensajeError,);

		return $salidaJson;
	}


	public function listaMisReportes($data)
	{
		$contenido = '';
		$respuesta = false;	

		$sql = 'select * from grupos_mis_reportes where id_usuario = '.$_SESSION['userid'].' and activo = 1';
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query)
		{
			foreach ($query->result() as $lista)
			{			
				$contenido .= '<h3>'.$lista->nombre.'</h3>';

				$sql = "select * from reportes_personalizados  where activo = 1 and id_funcion = ".$data["id_funcion"]." and id_modulo = ".$data["id_modulo"]." and id_usuario =".$_SESSION['userid']." and id_grupo =". $lista->id_grupo;
	            
	            $query2 = $this->db->query($sql);
	            if ($query->num_rows()>0)
	            {
	            	$contenido .= '<div>';
	            	foreach ($query2->result() as $row) {				
						$contenido .= '
						
			                <div class="row" id="rep-'.$row->id_reporte_pers.'">
			                    <div class="btn btn-primary eliminar-mi-reporte"  data-id="'.$row->id_reporte_pers.'" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>
			                    <div class="btn btn-primary editar-mi-reporte" data-id="'.$row->id_reporte_pers.'-'.$lista->id_grupo.'-'.$row->periodo.'-'.$row->id_reporte.'"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></div>
			                    
			                    <div class="mis-reportes-detalle" style="display:inline"> <span>'.$row->nombre.'</span> - '.$row->periodo.' días </div>
			                </div>
			            ';
					}
					$contenido .= '</div>';
					$respuesta = true;
	            }
	            else
	            	$respuesta = false;	
		            
	            
			}
		}
		else
			$respuesta = false;
			

		$salidaJson = array("sql" => $sql,	"contenido" => $contenido, 'respuesta' => $respuesta);

		return $salidaJson;
	}

	public function camposReportePersonalizado($data)
	{
		$contenido = '';
		$respuesta = false;
		$sql = "select * from reportes_personalizados where activo = 1 and id_usuario = ".$_SESSION['userid']." and id_funcion = ".$data["id_funcion"]." and id_reporte_pers=".$data["id_reporte_pers"];

		$this->load->database();
		$query = $this->db->query($sql);
		
		
		if ($query->num_rows()>0)		
		{						
			foreach ($query->result() as $row) {
				$contenido = $row;
			}
			
			$respuesta	= true;
		}
		


		$salidaJson = array("sql" => $sql,	"contenido" => $contenido, "respuesta" => $respuesta);

		return $salidaJson;
	}

	public function comboGraficarpor($data)
	{
		$contenido = '';
		$respuesta = false;
		$opciones = '<option value="">Seleccione...</option>';

		$sql = "SELECT * FROM campos_x_grafica  where activo = 1 and id_campo =".$data["id_campo"];
		
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query->num_rows()>0)		
		{
		
			foreach ($query->result() as $lista)
			{
				$sql = " SELECT campo, alias, tipo_dato FROM campos_x_reporte where id_campo = ".$lista->id_campo_graficar;	
				$res = $this->db->query($sql);
				$row = $res->row();

				$opciones.='<option value="'. $row->campo.'-'.$row->tipo_dato. '">' .$row->alias. ' </option>';
			}

			$respuesta = true;
		}
		

		$salidaJson = array("sql" => $sql,	"contenido" => $opciones, "respuesta" => $respuesta);

		return $salidaJson;
	}

	public function eliminarReportes($data)
	{
		$contenido = '';
		$respuesta = false;		

		$sql = "delete from reportes_personalizados where id_reporte_pers = ".$data['id_reporte'];
		
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query)		
		{			
			$respuesta = true;
		}
		

		$salidaJson = array("sql" => $sql,	"contenido" => $contenido, "respuesta" => $respuesta);

		return $salidaJson;
	}

	public function reporteCombustible($data)
	{
		$tipo_cuenta = $_SESSION['tipoCuenta'];
		$where = $data['where'];
		$group_by = $data['group_by'];
		$campos = $data['campos'];
		$campo = '';
		$alias = $data['alias'];
		$alias = explode(",", $alias);
		$fecha_inicio = $data['fecha_inicio'];
		$fecha_fin = $data['fecha_fin'];
		$contenido = '';
		$contenido2 = '';
		$grafica = '';
		$respuesta = true;
		$mensajeError = "";
		$contador = 1;
		$sumaCosto = 0;
		$sumaCostoSinIVA = 0;
		$sumaIVA = 0;
		$sumaKmAnterior = 0;
		$sumaKmActual = 0;
		$sumaKmRecorridos = 0;
		$sumaLitrosCalculados = 0;
		$sumaLitrosReales = 0;
		$sumaDiferenciaLitros = 0;
		$sumaRendReal = 0;
		$sumaRendAuditado = 0;
		$sumaDifRend = 0;
		$totales = '';
		$numRows = 0;	

		//datos grafica
		$eje_x = $data['x'];
		$aliasX = $data['aX'];
		$eje_y = $data['y'];
		$aliasY = $data['aY'];		  
		$grafica = $data['grafica'];
		$col1 = array('id' => 'ejeX', 'label' => $data['x'],  'type' => 'string');
  		$col2 = array('id' => 'ejeY', 'label' => $data['y'],  'type' => $data['dato_y']);
  		$jsonGrafica = array('cols'=> array($col1,$col2), 'rows' =>array());  
  		$rows = array();
  		$colVal = array();
		
		

		if($tipo_cuenta == 'Maestra')
		{		

			if($group_by == 'grupo' || strpos($where, 'g.id_grupo' ))
			{
				$tabla = 'rep_combustible_grupos';
				$tabla2 = 	'cargas_combustible tkm
							join inventarios_vehiculos veh on veh.id_activo = tkm.id_activo
							join inventarios_empleados oper on oper.id_empleado = tkm.id_operador
							join cat_marcas_vehiculos mar on mar.id_marca = veh.id_marca
							join itinerarios_pdi pdi on pdi.id_pdi = tkm.id_gasolinera
							join activos_x_grupo axg on axg.id_activo = veh.id_activo
							join grupos g on g.id_grupo = axg.id_grupo and g.id_modulo = 3
							join cat_tipo_combustible comb on comb.id_tipo_combustible = veh.id_tipo_combustible';	
			}
			else
			{
				$tabla = 'rep_combustible_sinGrupos';
				$tabla2 = 	'cargas_combustible tkm
							join inventarios_vehiculos veh on veh.id_activo = tkm.id_activo
							join inventarios_empleados oper on oper.id_empleado = tkm.id_operador
							join cat_marcas_vehiculos mar on mar.id_marca = veh.id_marca
							join itinerarios_pdi pdi on pdi.id_pdi = tkm.id_gasolinera
							join activos_x_grupo axg on axg.id_activo = veh.id_activo
							join grupos g on g.id_grupo = axg.id_grupo and g.id_modulo = 3
							join cat_tipo_combustible comb on comb.id_tipo_combustible = veh.id_tipo_combustible';	
			}	
					
		}				
		else
		{
			$tabla = 'rep_combustible_subusuarios_grupos';
			$tabla2 = 	'cargas_combustible tkm
						 join inventarios_vehiculos veh on veh.id_activo = tkm.id_activo
						 join inventarios_empleados oper on oper.id_empleado = tkm.id_operador
						 join cat_marcas_vehiculos mar on mar.id_marca = veh.id_marca
						 join itinerarios_pdi pdi on pdi.id_pdi = tkm.id_gasolinera
						 join activos_x_grupo axg on axg.id_activo = veh.id_activo
						 join grupos g on g.id_grupo = axg.id_grupo and g.id_modulo = 3 
						 join usuarios_x_grupo uxg on uxg.id_grupo = g.id_grupo
						 join cat_tipo_combustible comb on comb.id_tipo_combustible = veh.id_tipo_combustible';				
		}

		$fecha_fin =  date ( 'Y-m-j' , strtotime ( '+1 day' , strtotime ( $fecha_fin ) ) );

		if($group_by != '')
		{
			
			if($group_by == 'fecha')
			{
				$group_by = 'DAYOFMONTH(tkm.fecha_hora_carga)';
				$query = "select ".$group_by.", 
							count(tkm.id_activo) as numReg,
							veh.id_tipo_combustible AS tipocombustible,
							comb.tipo_combustible AS tipo_combustible_text,
							DATE_FORMAT(tkm.fecha_hora_carga,'%Y-%m-%d') as fecha, 
							sum(tkm.kilometraje_actual - tkm.kilometraje_anterior) as km_recorridos, 
							sum(tkm.litros_calculados) as litros_calculados, 
							sum(tkm.litros_registrados) as litros_reales, 
							sum((tkm.litros_registrados - tkm.litros_calculados)) as diferencia_litros, 
							0 AS costo_sin_iva, 
							0 as iva, 
							0 as costoxTicket, 
							(sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) as rendimiento_auditado, 
							(sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) ) as rendimiento_real, 
							((sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) - (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) )) as diferencia_rendimiento
						from ".$tabla2." ".$where." group by ".$group_by." order by tkm.fecha_hora_carga desc";
			}
			elseif($group_by == 'operador')
			{
				$query = "select CONCAT(oper.primer_nombre,' ',oper.apellido_paterno,' ',oper.apellido_materno) AS operador,
						count(tkm.id_activo) as numReg, 
						veh.id_tipo_combustible AS tipocombustible,
						comb.tipo_combustible AS tipo_combustible_text, 
						DATE_FORMAT(tkm.fecha_hora_carga,'%Y-%m-%d') as fecha, 
						sum(tkm.kilometraje_actual - tkm.kilometraje_anterior) as km_recorridos, 
						sum(tkm.litros_calculados) as litros_calculados, 
						sum(tkm.litros_registrados) as litros_reales, 
						sum((tkm.litros_registrados - tkm.litros_calculados)) as diferencia_litros, 
						0 AS costo_sin_iva, 
						0 as iva, 
						0 as costoxTicket, 
						(sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) as rendimiento_auditado, 
						(sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) ) as rendimiento_real, 
						((sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) - (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) )) as diferencia_rendimiento
						from ".$tabla2." ".$where." group by ".$group_by." order by tkm.fecha_hora_carga desc";
			}
			elseif($group_by == 'cve_activo')
			{
				$query = "select ".$group_by.", 
						count(tkm.id_activo) as numReg, 
						veh.id_tipo_combustible AS tipocombustible, 
						comb.tipo_combustible AS tipo_combustible_text,
						tkm.fecha_hora_carga as fecha,
						mar.id_marca,
						mar.marca AS marca,
						sum(tkm.kilometraje_actual - tkm.kilometraje_anterior) as km_recorridos, 
						sum(tkm.litros_calculados) as litros_calculados, 
	                    sum(tkm.litros_registrados) as litros_reales, 
	                    sum((tkm.litros_registrados - tkm.litros_calculados)) as diferencia_litros, 
	                    0 AS costo_sin_iva, 
	                    0 AS iva, 
	                    0 AS costoxTicket, 
	                    veh.vin AS vin,
	                    (sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) as rendimiento_auditado, 
	                    (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) ) as rendimiento_real, 
	                    ((sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) - (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) )) as diferencia_rendimiento
	                    from ".$tabla2." ".$where." group by ".$group_by." order by tkm.fecha_hora_carga desc";
			}
			else
				$query = "select ".$group_by.", 
						count(tkm.id_activo) as numReg, 
						veh.id_tipo_combustible AS tipocombustible, 
						comb.tipo_combustible AS tipo_combustible_text,
						tkm.fecha_hora_carga as fecha,
						sum(tkm.kilometraje_actual - tkm.kilometraje_anterior) as km_recorridos, 
						sum(tkm.litros_calculados) as litros_calculados, 
	                    sum(tkm.litros_registrados) as litros_reales, 
	                    sum((tkm.litros_registrados - tkm.litros_calculados)) as diferencia_litros, 
	                    0 AS costo_sin_iva, 
	                    0 AS iva, 
	                    0 AS costoxTicket, 
	                    (sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) as rendimiento_auditado, 
	                    (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) ) as rendimiento_real, 
	                    ((sum(tkm.rendimiento_calculado)/count(tkm.id_activo)) - (sum((tkm.kilometraje_actual - tkm.kilometraje_anterior))/sum(tkm.litros_registrados) )) as diferencia_rendimiento
	                    from ".$tabla2." ".$where." group by ".$group_by." order by tkm.fecha_hora_carga desc";
	       			
		}		
		else
			$query = 'CALL '.$tabla.'(" '.$where.' ")';	

		$query2 = "select distinct
				case when MONTH(tkm.fecha_hora_carga) = '1' then 'ENE' when MONTH(tkm.fecha_hora_carga) = '2' then 'FEB' 
				when MONTH(tkm.fecha_hora_carga) = '3' then 'MAR' when MONTH(tkm.fecha_hora_carga) = '4' then 'ABR' 
				when MONTH(tkm.fecha_hora_carga) = '5' then 'MAY' when MONTH(tkm.fecha_hora_carga) = '6' then 'JUN' 
				when MONTH(tkm.fecha_hora_carga) = '7' then 'JUL' when MONTH(tkm.fecha_hora_carga) = '8' then 'AGO' 
				when MONTH(tkm.fecha_hora_carga) = '9' then 'SEP' when MONTH(tkm.fecha_hora_carga) = '10' then 'OCT' 
				when MONTH(tkm.fecha_hora_carga) = '11' then 'NOV' when MONTH(tkm.fecha_hora_carga) = '12' then 'DIC' end as 'Mes',
				COUNT(distinct tkm.id_carga) as total,
				DATEDIFF( '".$fecha_fin." 23:59:59', '".$fecha_inicio."' ) as diasconsulta,
				COUNT(distinct tkm.id_carga)/ DATEDIFF( '".$fecha_fin." 23:59:59', '".$fecha_inicio."' ) as promedio,
				sum(tkm.kilometraje_actual-tkm.kilometraje_anterior) / sum(tkm.litros_registrados) as rendimiento_real, 
				sum(tkm.rendimiento_calculado) / COUNT(distinct tkm.id_carga) as rendimiento_promedio,
				sum(tkm.kilometraje_actual - tkm.kilometraje_anterior) / sum(tkm.litros_calculados) as rendimiento_auditado												
				from ".$tabla2." ".$where."					 	
				GROUP BY MONTH(tkm.fecha_hora_carga)";

		$this->load->database();
		$resp = $this->db->query($query2);

		if ($resp)
		{
			$respuesta = true;			
			//$res = $conn->query($query2);	

			$contenido2 = '
			<table class="table table-bordered tabla-reporte" id="reporte_agrupado" style="margin-bottom: 40px">		
				<thead>
					<tr>
					 	<th>Mes</th>
					 	<th>Dias Consultados</th>
					 	<th>Total de Cargas</th>
					 	<th>Promedio Cargas Diarias</th>
					 	<th>Rendimiento Auditado</th>
					 	<th>Rendimiento Real</th>					 	
					</tr>
				</thead>
				<tbody>';

			foreach ($resp->result() as $row)
			{
										
				$contenido2 .= '<tr>'; 																							
					$contenido2 .= '<td>'.$row->Mes.'</td>';
					$contenido2 .= '<td>'.$row->diasconsulta.'</td>';
					$contenido2 .= '<td>'.$row->total.'</td>';					
					$contenido2 .= '<td>'.number_format($row->promedio,2).'</td>';
					$contenido2 .= '<td>'.number_format($row->rendimiento_auditado,2).'</td>';
					$contenido2 .= '<td>'.number_format($row->rendimiento_real, 4).'</td>';													
				$contenido2 .= '</tr>';
				
				$sumaRendAuditado = $row->rendimiento_promedio;
			}

			$contenido2 .= '</tbody>
					<table>';
			
		}
		else
		{
			$mensajeError = "No se puede consultar promedio";
			$respuesta = false;	
		}

		$campos = explode(",", $campos);
		$resp2 = $this->db->query($query);
		if ($resp2)
		{
			/************tabla reporte ******************/
			$header = '
			<table class="table table-bordered tabla-reporte" id="reporte_contenido">		
				<thead>
					<tr>
					 	<th>No.</th>';									
					
			//generar encabezado
			for($i = 0; $i < count($alias); $i++)
			{
				$header .= '<th> '.$alias[$i].' </th>';
			}
				
			$header .= '</tr>	
				</thead>
				<tbody class="Lista">';

			$fields = $resp2->list_fields();

			foreach ($resp2->result_array() as $row)
			{
				
				$fecha = $row['fecha'];	
							
				/************Obtener color de fila *********************************************/
				$diferencia = floatval(($row['diferencia_rendimiento']));
				if ($diferencia < -0.001 && $diferencia > -0.15)
				{
					$colorR = "#E2E28B"; //amarillo
				}
				elseif ($diferencia < -0.15){
					$colorR = "#DE8383"; //rojo					
				}
				else
					$colorR = "#BFF7BF"; 	

				$contenido .= '<tr bgcolor='.$colorR.'>'; 
				$contenido .= '<td>&nbsp;&nbsp;&nbsp;'.$contador.'&nbsp;&nbsp;&nbsp;</td>';

				/************Obtener precio *****************************************************/												
				$precio_sin_iva_sin_ipes = $this->obtenerPrecio($fecha, $row['tipocombustible']);
				//$precio_sin_iva_sin_ipes = 1;
				/************generar columnas ***************************************************/
				for($i = 0; $i < count($campos); $i++)
				{
					$campo = str_replace(' ', '', $campos[$i]);	
					$campo = explode(".", $campos[$i]);

					if(sizeof($campo) > 1)
						$campo = $campo[1];
					else
						$campo = $campo[0];

					$Costo_S_IVA = $precio_sin_iva_sin_ipes * $row['litros_reales'];
					$Costo_IVA = $Costo_S_IVA * 0.16;					
					$Total_Ticket = $Costo_IVA + $Costo_S_IVA;			

					

					//validar si la variable campos existe en el campo de la consulta.
					if (in_array($campo, $fields))
					{
						
						/*-------generar objeto para grafica---------*/
						if($data['y'] != '')
						{
							if($campo == $data['y'])
					        {
					          $val1 = array('v' => $row[$data['x']]);
					                   
					          if(is_numeric($row[$data['y']]))
					            $val2 = array('v' => (int)$row[$data['y']]);
					          else
					            $val2 = array('v' => $row[$data['y']]);
					         
					         if($campo == 'rendimiento_real')
					             $val2 = array('v' => (float)$row[$data['y']]);
					         
					         if($campo == 'costoxTicket')
					            $val2 = array('v' => number_format($Total_Ticket, 2, '.', '')); 				         
					          
					          $colVal['c'] = array($val1, $val2);

					          $jsonGrafica['rows'][] = $colVal;
					        }
						}
							



						/*---------columnas reporte--------*/
						if($campo == 'costoxTicket')
						{					
							$contenido .= '<td> $'.number_format($Total_Ticket,2).'</td>';
							$sumaCosto += $Total_Ticket;
						}
						elseif($campo == 'precio_combustible')
						{
							$contenido .= '<td> $'.number_format($precio_sin_iva_sin_ipes,2).'</td>';					
						}
						elseif($campo == 'costo_sin_iva')
						{
							$contenido .= '<td> $'.number_format($Costo_S_IVA,2).'</td>';	
							$sumaCostoSinIVA += $Costo_S_IVA;				
						}
						elseif($campo == 'iva')
						{
							$contenido .= '<td> $'.number_format($Costo_IVA,2).'</td>';	
							$sumaIVA += $Costo_IVA;				
						}				
						elseif ($campo == 'kmanterior') {
							
							$contenido .= '<td>'.$row[$campo].'</td>';
							$sumaKmAnterior += $row[$campo];
						}
						elseif ($campo == 'kmactual') {

							$contenido .= '<td>'.$row[$campo].'</td>';
							$sumaKmActual += $row[$campo];					
						}
						elseif ($campo == 'km_recorridos') {
							
							$contenido .= '<td>'.$row[$campo].'</td>';
							$sumaKmRecorridos += $row[$campo];
						}
						elseif ($campo == 'litros_reales') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							$sumaLitrosReales += $row[$campo];
						}
						elseif ($campo == 'litros_calculados') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							$sumaLitrosCalculados += $row[$campo];
						}
						elseif ($campo == 'diferencia_litros') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							$sumaDiferenciaLitros += $row[$campo];
						}
						elseif ($campo == 'rendimiento_auditado') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							//$sumaRendAuditado += number_format($row[$campo],2);
						}
						elseif ($campo == 'rendimiento_real') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							$sumaRendReal += $row[$campo];
						}	
						elseif ($campo == 'diferencia_rendimiento') {
							
							$contenido .= '<td>'.number_format($row[$campo],2).'</td>';
							$sumaDifRend += $row[$campo];
						}
						else
						{
							$contenido .= '<td>'.$row[$campo].'</td>';
						}
					}
					elseif ($campo == 'tipo_combustible') {							
						$contenido .= '<td>'.$row['tipo_combustible_text'].'</td>';							
					}
					else
						$contenido .= '<td></td>';
						
					

				}

				$contenido .= '</tr>';
				$contador ++;
			}

			/************agregar totales***************************************************/
			if($sumaKmRecorridos != 0 || $sumaLitrosReales != 0 || $sumaCosto != 0 || $sumaCostoSinIVA != 0 || $sumaIVA != 0 )
				$totales = '<tr style="font-weight: bold;"><td> Total </td>';

			$numColumna = 0;
			
			if($sumaKmRecorridos != 0)
			{
				$index = array_search('km_recorridos', $campos);			

				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaKmRecorridos,0).'</td>';
				$numColumna++;
			}

			if($sumaLitrosCalculados != 0)
			{
				$index = array_search('litros_calculados', $campos);			
				
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaLitrosCalculados,2).'</td>';
				$numColumna++;
			}

			if($sumaLitrosReales != 0)
			{
				$index = array_search('litros_reales', $campos);			
				
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaLitrosReales,2).'</td>';
				$numColumna++;
			}

			if($sumaDiferenciaLitros != 0)
			{
				$index = array_search('diferencia_litros', $campos);			
				
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaDiferenciaLitros,2).'</td>';
				$numColumna++;
			}

			$index = array_search('rendimiento_auditado', $campos);
			if($sumaRendAuditado != 0 && $index != 0)
			{					
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaRendAuditado ,2).'</td>';
				
				$numColumna++;
			}
			//$sumaRendAuditado = $sumaRendAuditado /($contador-1);

			if($sumaRendReal != 0)
			{
				$index = array_search('rendimiento_real', $campos);			
				
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format(($sumaKmRecorridos/$sumaLitrosReales),2).'</td>';
				
				$numColumna++;
			}
			
			if($sumaLitrosReales != 0)
				$sumaRendReal = $sumaKmRecorridos/$sumaLitrosReales;
			else
				$sumaRendReal = 0;

			if($sumaDifRend != 0)
			{
				$index = array_search('diferencia_rendimiento', $campos);			
				
				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;
				}

				$totales .= '<td>'.number_format($sumaRendAuditado - $sumaRendReal,2).'</td>';
				$numColumna++;
			}
					
			if($sumaCostoSinIVA != 0)
			{
				$index = array_search('costo_sin_iva', $campos);			

				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;				
				}

				$totales .= '<td>$'.number_format($sumaCostoSinIVA,2).'</td>';		
				$numColumna++;
			}

			if($sumaIVA != 0)
			{
				$index = array_search('iva', $campos);			

				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;				
				}

				$totales .= '<td>$'.number_format($sumaIVA,2).'</td>';		
				$numColumna++;
			}

			if($sumaCosto != 0)
			{
				$index = array_search('costoxTicket', $campos);			

				for ($i=$numColumna; $i < $index; $i++) { 
					$totales .= '<td> </td>';
					$numColumna++;				
				}

				$totales .= '<td>$'.number_format($sumaCosto,2).'</td>';		
				$numColumna++;
			}

			if($sumaKmRecorridos != 0 || $sumaLitrosReales != 0 || $sumaCosto != 0 || $sumaCostoSinIVA != 0 || $sumaIVA != 0)
			{
				$totales .= '</tr>';
				$contenido = $contenido2. $header . $totales . $contenido;
				$contenido .= $totales;
			}
			else
			{
				$contenido = $contenido2. $header . $contenido;
			}
					

			$contenido .= '</tbody>
			</table>';

			
			if($contador == 1)
			{
				$contenido = '<center> NO SE ENCONTRO NING&Uacute;N REGISTRO </center>';
				$contenido2 = '';
			}
		}
		else
		{
			$contenido = '<center> NO SE puede ejecutar ->'.$query.' </center>';
		}

		$jsonGrafica = json_encode($jsonGrafica);

		$salidaJson = array("sql" => $query, "contenido" => $contenido,  "mensaje" => $mensajeError, 'campo' => $campo, 'fields' => $fields, 'jsonGrafica' => $jsonGrafica);
		return $salidaJson;
	}


	public function editarReportePersonalizado($data)
	{
		$contenido = '';
		$respuesta = false;		

		$sql = "update reportes_personalizados set 
				nombre = '".$data['nombre']."',
				filtros = '".$data['filtros']."',
				campos = '".$data['campos']."',
				periodo = '".$data['periodo']."',
				id_grupo = '".$data['id_grupo']."',
				fecha_actualizo=NOW(),
				id_usuario_actualizo=".$_SESSION['userid']."
				where id_reporte_pers = ".$data['id_reporte_pers'];
		
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query)		
		{			
			$respuesta = true;
		}
		

		$salidaJson = array("sql" => $sql,	"contenido" => $contenido, "respuesta" => $respuesta);

		return $salidaJson;
	}
	
	public function obtenerPrecio($fecha, $tipocombustible)
	{
		$precio_sin_iva_sin_ipes = 0;
		$mes = date("m",strtotime($fecha));
		$anio =  explode("-", $fecha);		
		//siempre indicar la base de datos, ya que es una conexion a PICCO	
		$sql = "select tipo, precio_sin_iva, cuota_ieps from suite.combustible_costo where mes=".$mes." and anio=".$anio[0]." and id_tipo = ".$tipocombustible.";";
		
		
		$DB2 = $this->load->database('conexion2', TRUE);
		
		
		$otra = $DB2->query($sql);

		if ($otra)
		{					
			foreach ($otra->result_array() as $lista)
			{
				$precio_sin_iva_sin_ipes =	$lista['precio_sin_iva'];				
			}
		}
		else							
			$mensajeError = "No se puede consultar el precio->".$otra;
		

		return $precio_sin_iva_sin_ipes;
	}


	/*  ------------------ funciones para grupos de cada modulo  ----------------------*/
	public function grupos_contenido($data){

		$query = "
		select a.*, b.nombre_completo as usuario_actualizo
		from grupos a left join s_usuarios b on a.id_usuario_actualizo = b.userid
		where a.id_cuenta_maestra=".$_SESSION['cuenta_maestra_picco']."
		and a.id_modulo = ".$data['id_modulo']."		
		order by a.fecha_registro desc
		limit 100
		";
		
		$this->load->database();
		$query = $this->db->query($query);


		$contenido = '';
		$contenido .= '<thead><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Grupo</th>';		    		   
		$contenido .= '<th>Usuario Actualizo</th>';		    		   
		$contenido .= '<th>Fecha Actualizo</th>';		    		   		
		$contenido .= '</tr></thead>';

		$contenido .= '<tfoot><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Grupo</th>';		    		   
		$contenido .= '<th>Usuario Actualizo</th>';		    		   
		$contenido .= '<th>Fecha Actualizo</th>';		    		   
		$contenido .= '</tr></tfoot>';
      
 		$contenido .= '<tbody>';
		if ($query->num_rows()>0){
			foreach ($query->result() as $row) {
			
				$contenido .= '<tr>
							    <td><div class="btn btn-primary" id="'.$row->id_grupo.'" onclick=editar(this); data-toggle="modal" data-target="#fmodal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div></td>												    
							    <td>'.strtoupper($row->grupo).'</td>
								<td>'.strtoupper($row->usuario_actualizo).'</td>  
								<td>'.strtoupper($row->fecha_actualizo).'</td>					
							</tr>';

			}			
		}
		else{
			$contenido .= '<tr>
							<td >S/R</td>
							<td >S/R</td>
							<td >S/R</td>
							<td >S/R</td>
						   </tr>';			
		}


        $contenido .= '</tbody>'; 

		return $contenido;
	}

	public function grupos_consulta($data){

		$query = "select * FROM grupos WHERE id_grupo = ".$data['idRow'];
		$respuesta = false;
		$usuarios_x_grupo = '';
		$unidades_x_grupo = '';
		$nombre_grupo = '';
		$usuarios = '<option value="">Seleccione...</option>';
		$unidades = '<option value="">Seleccione...</option>';

		$this->load->database();
		$response= $this->db->query($query);

		if ($response)
		{
			$respuesta = true;
			$mensaje = "";
			
			$row = $response->row();								
			$nombre_grupo = $row->grupo;

			/*   -----------obtener lista de usuarios disponibles-------------*/
			
			$query = "			
				select * 
				from s_usuarios 
				where id_depende_cuenta_maestra = ".$_SESSION['userid']." and activo = 1 
				and userid not in (select id_usuario from usuarios_x_grupo WHERE id_grupo =".$data['idRow'].")			
				";

			$response= $this->db->query($query);
			if ($response) 		
			{				
				foreach ($response->result() as $lista)
				{
		       			$usuarios.='<option value="'. $lista->userid. '">' . $lista->nombre_completo.' </option>';
				}
		    }

			/*   -----------obtener los usuarios por grupo-------------*/
			$query = "
				select a.*
				from s_usuarios a,usuarios_x_grupo b
				where a.id_depende_cuenta_maestra = ".$_SESSION['userid']."
				and a.userid = b.id_usuario
				and b.id_grupo = ".$data['idRow']."			
			";	    	
			$response= $this->db->query($query);
			if ($response) 		
			{				
				foreach ($response->result() as $lista)
				{
		       			$usuarios_x_grupo.='<option value="'. $lista->userid. '">' . $lista->nombre_completo.' </option>';
				}
		    }


		    /* ------------obtener lista vehiculos disponibles-------------------*/

		    $query = "select * from inventarios_vehiculos where id_estatus = 3  and id_cuenta_maestra = '".$_SESSION['cuenta_maestra_picco']."' 
				and id_activo in (select b.id_activo from disponibilidad a,disponibilidad_detalle b where a.id_modulo_unidad = b.id_modulo and a.id_modulo = ".$data['id_modulo'].")
				and id_activo in (select b.id_activo from   contrataciones_x_modulo a inner join PICCO.subcuentas b on a.id_subcuenta = b.id_subcuenta where  a.id_modulo = ".$data['id_modulo']." and a.activo = 1)
				and id_activo not in (select id_activo from unidades_x_grupo where id_grupo = ".$data['idRow'].")";

			$response= $this->db->query($query);
			if ($response) 		
			{
				foreach ($response->result() as $lista)
				{
					$unidades.='<option value="'. $lista->id_activo. '">' . $lista->cve_activo.' </option>';		
				}
		    }

		    /* ------------obtener vehiculos por grupo-------------------*/
		    $query = "select * from inventarios_vehiculos where id_estatus = 3  and id_cuenta_maestra = '".$_SESSION['cuenta_maestra_picco']."' and id_activo in (select id_activo from unidades_x_grupo where id_grupo=".$data['idRow'].")";
			
			$response= $this->db->query($query);
			if ($response) 		
			{
				foreach ($response->result() as $lista)
				{
					$unidades_x_grupo.='<option value="'. $lista->id_activo. '">' . $lista->cve_activo.' </option>';		
				}
		    }
			
		}
		else
		{
			$mensaje = "No se puede consultar el registro en la base de datos";	
		}
		
		$contenido = array('nombre_grupo' => $nombre_grupo, 'usuarios_x_grupo' => $usuarios_x_grupo, 'unidades_x_grupo' => $unidades_x_grupo, 'usuarios' => $usuarios, 'unidades' => $unidades);
		return array('respuesta'=>$respuesta,'contenido'=>$contenido);
	}


	public function grupos_altas($data){

		$mensaje = '';
		$respuesta = false;
		$grupo = $data['nombre_grupo'];
				
														
		$query = "insert into grupos 
		(					
		grupo,
		id_cuenta_maestra,
		activo,
		fecha_registro,
		id_usuario_registro,
		id_modulo
		) values (";
		$query .= "'".$grupo."',";
		$query .= "'".$_SESSION['cuenta_maestra_picco']."',1,";
		$query .= "NOW(),";
		$query .= "'".$_SESSION['userid']."',".$data['id_modulo'].")";

		$this->load->database();
		
		$response = $this->db->query($query);
		
		if($response)
		{											
			
			$mensaje = "Se ha actualizado el registro correctamente " . $query;
			$id = $this->db->insert_id();										
			
			$id_usuarios_x_grupo = $data["usuarios"];

			for ($i=0;$i<$data["numUsuarios"];$i++)    
			{
					$id_usuario = $id_usuarios_x_grupo[$i];
					$query = "insert into usuarios_x_grupo 
					(
					id_grupo,
					id_usuario
					) values (";
					$query .= "'".$id."',";
					$query .= "'".$id_usuario."')";
					
					$response = $this->db->query($query);
		
					if(!$response){
						$respuesta = false;
						$mensaje = "No se puede guardar el registro documentos x vehiculo en la base de datos -> ".$query;	
						break;
					}					
					else
					{
						$respuesta = true;
						$mensaje = "Se ha actualizado el registro correctamente ";
					}							
			}
		
			$id_activo_x_grupo = $data["activos"];
			for ($i=0;$i<$data["numVehiculos"];$i++)    
			{
					$id_activo = $id_activo_x_grupo[$i];
					$query = "insert into unidades_x_grupo 
					(
					id_grupo,
					id_activo
					) values (";
					$query .= "'".$id."',";
					$query .= "'".$id_activo."')";
					
					$response = $this->db->query($query);
		
					if(!$response){
						$respuesta = false;
						$mensaje = "No se puede guardar el registro documentos x vehiculo en la base de datos -> ".$query;	
						break;
					}	
					
					else
					{
						$respuesta = true;
						$mensaje = "Se ha actualizado el registro correctamente ";
					}							
			}					
			
			
		}
		else{
			$mensaje = "No se puede consultar el registro en la base de datos-> ".$query;	
		}

		
		return array('respuesta'=>$respuesta, 'mensaje' => $mensaje, 'sql' => $query);
	}

	
	public function grupos_cambios($data)
	{

		$grupo = $data['nombre_grupo'];
		
												
		$query = "update grupos set 
			grupo = '".$grupo."',
			fecha_actualizo=NOW(),
			id_usuario_actualizo=".$_SESSION['userid']."
			where id_grupo = ".$data['idRow'];
		
		
		$this->load->database();
		$response= $this->db->query($query);

		if ($response)
		{											
			
			$id = $data['idRow'];											
			
			
			$query = "delete from usuarios_x_grupo where id_grupo=".$data['idRow'];
			$response= $this->db->query($query);
			if($response)
			{
				$id_usuarios_x_grupo = $data["usuarios"];

				for ($i=0;$i<$data["numUsuarios"];$i++)    
				{
						$id_usuario = $id_usuarios_x_grupo[$i];
						$query = "insert into usuarios_x_grupo 
						(
						id_grupo,
						id_usuario
						) values (";
						$query .= "'".$id."',";
						$query .= "'".$id_usuario."')";
						
						$response = $this->db->query($query);
			
						if(!$response){
							$respuesta = false;
							$mensaje = "No se puede guardar el registro documentos x vehiculo en la base de datos -> ".$query;	
							break;
						}					
						else
						{
							$respuesta = true;
							$mensaje = "Se ha actualizado el registro correctamente ";
						}							
				}
			}
			else
			{
				$respuesta = false;
				$mensaje = "No se puede eliminar -> ".$query;
				break;
			}	
			
				
			$contador = 0;
			$query = "delete from unidades_x_grupo where id_grupo=".$data['idRow'];

			$response= $this->db->query($query);
			if($response)
			{
				$id_activo_x_grupo = $data["activos"];
				for ($i=0;$i<$data["numVehiculos"];$i++)    
				{
						$id_activo = $id_activo_x_grupo[$i];
						$query = "insert into unidades_x_grupo 
						(
						id_grupo,
						id_activo
						) values (";
						$query .= "'".$id."',";
						$query .= "'".$id_activo."')";
						
						$response = $this->db->query($query);
			
						if(!$response){
							$respuesta = false;
							$mensaje = "No se puede guardar el registro documentos x vehiculo en la base de datos -> ".$query;	
							break;
						}						
						else
						{
							$respuesta = true;
							$mensaje = "Se ha actualizado el registro correctamente ";
						}							
				}	
			}
			else
			{
				$respuesta = false;
				$mensaje = "No se puede eliminar -> ".$query;
				break;
			}			
								
			
		}
		else{
			$respuesta = false;
			$mensaje = "No se puede consultar el registro en la base de datos->".$query;	
		}



		return array('respuesta'=>$respuesta, 'mensaje' => $mensaje, 'sql' => $query);

	}

	/*  ------------------ funciones para contratación de cada modulo  ----------------------*/
	public function contratacion_contenido($data){

		$contenido = '';
		$contenido .= '<thead><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Eco</th>';		    		   
		$contenido .= '<th>Subcuenta</th>';		    		   
		$contenido .= '<th>Estatus en modulo</th>';
		$contenido .= '<th>Fecha alta</th>';
		$contenido .= '<th>Activar</th>';		    		   		
		$contenido .= '</tr></thead>';

		$contenido .= '<tfoot><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Eco</th>';		    		   
		$contenido .= '<th>Subcuenta</th>';		    		   
		$contenido .= '<th>Estatus en modulo</th>';
		$contenido .= '<th>Fecha alta</th>';
		$contenido .= '<th>Activar</th>';		    		   
		$contenido .= '</tr></tfoot>';
      
 		$contenido .= '<tbody>';
		$this->load->database();

		if ($_SESSION['tipoCuenta']  == 'Maestra'){
			/*$query = "
			select c.id_subcuenta,d.id_asignacion,a.cve_activo,b.estatus,c.subcuenta,d.fecha_registro as fechaAsignacion, a.id_activo
			from inventarios_vehiculos a
					inner join cat_estatus_vehiculo b on a.id_estatus = b.id_estatus
					inner join PICCO.subcuentas c on a.id_activo = c.id_activo
					left join  contrataciones_x_modulo d on d.id_subcuenta = c.id_subcuenta and d.activo = 1 and d.id_modulo = ".$data['id_modulo']."
			where a.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']."			  		
			order by a.fecha_creacion asc				
			";*/
			$query = "select c.*,d.id_asignacion, d.fecha_registro as fechaAsignacion, e.cve_activo
				from disponibilidad a	 
				     join disponibilidad_detalle b on a.id_modulo_unidad = b.id_modulo 
				     join inventarios_vehiculos e on b.id_activo = e.id_activo
				     join PICCO.subcuentas c on c.id_activo = b.id_activo
				     left join contrataciones_x_modulo d on d.id_subcuenta = c.id_subcuenta and d.id_modulo = ".$data['id_modulo']." and d.activo = 1
				where a.id_modulo = ".$data['id_modulo']." and a.id_cuenta_maestra =".$_SESSION['cuenta_maestra_picco'];

			$query = $this->db->query($query);
					
			if ($query->num_rows()>0){
				foreach ($query->result() as $row) {
					$contenido .= '<tr>';
					if (isset ($row->id_asignacion) )
						{
							$contenido .= '<td><div class="btn btn-primary" id="'.$row->id_subcuenta.'|'.$row->cve_activo.'|'.$row->subcuenta.'|'.$row->id_activo.'" onclick=editar(this); data-toggle="modal" data-target="#fmodal"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div></td>';			
							$estatus="ACTIVO";
						}
					else
						{
							$contenido .= '<td> </td>';
							$estatus="NO ACTIVO";
						}

					if(isset($row->fechaAsignacion))
						$fecha = date("d/m/Y",strtotime($row->fechaAsignacion));
					else
						$fecha = $row->fechaAsignacion;
					
					$contenido .= '<td>'.strtoupper($row->cve_activo).'</td>
									<td>'.strtoupper($row->subcuenta).'</td>  
									<td>'.strtoupper($estatus).'</td>
									<td>'.$fecha.'</td>';
					if ($row->id_asignacion != '')
						$contenido .= '<td> </td>';			
					else
						$contenido .= '<td class="registro_unidad" ><input type="checkbox" value="'.$row->id_subcuenta.'|'.$row->cve_activo.'|'.$row->subcuenta.'"/></td>';					
					$contenido .= '</tr>';
				}			
			}
			else{
				$contenido .= '<tr>
								<td >S/R</td>
								<td >S/R</td>
								<td >S/R</td>
								<td >S/R</td>
								<td >S/R</td>
								<td >S/R</td>
							   </tr>';			
			}

	        $contenido .= '</tbody>';
		}
		else
		{
			$sql = "SELECT * FROM usuarios_x_grupo where id_usuario =".$_SESSION['userid'];
			$sql = $this->db->query($sql);

			if($sql->num_rows()>0)
			{

				foreach ($sql->result() as $row)
				{
					$query = "
					select c.id_subcuenta,d.id_asignacion,a.cve_activo,b.estatus,c.subcuenta,d.fecha_registro as fechaAsignacion
					from inventarios_vehiculos a
							inner join cat_estatus_vehiculo b on a.id_estatus = b.id_estatus
							inner join PICCO.subcuentas c on a.id_activo = c.id_activo
							left join  contrataciones_x_modulo d on d.id_subcuenta = c.id_subcuenta and d.activo = 1 and d.id_modulo = ".$data['id_modulo']."				
							where a.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']."			  		
						  	and a.id_activo in (select id_activo from unidades_x_grupo where id_grupo = ".$row->id_grupo.")
					order by a.fecha_creacion asc				
					";

					$query = $this->db->query($query);
					
					if ($query->num_rows()>0){
						foreach ($query->result() as $row) {
						
							$contenido .= '<tr>';
							if ($row->id_asignacion != '')
								{
									$contenido .= '<td><div class="btn btn-primary" id="'.$row->id_subcuenta.'|'.$row->cve_activo.'|'.$row->subcuenta.'" onclick=editar(this); data-toggle="modal" data-target="#fmodal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div></td>';			
									$estatus="ACTIVO";
								}
							else
								{
									$contenido .= '<td> </td>';
									$estatus="NO ACTIVO";
								}

							if(isset($row->fechaAsignacion))
								$fecha = date("d/m/Y",strtotime($row->fechaAsignacion));
							else
								$fecha = $row->fechaAsignacion;
							
							$contenido .= '<td>'.strtoupper($row->cve_activo).'</td>
											<td>'.strtoupper($row->subcuenta).'</td>  
											<td>'.strtoupper($estatus).'</td>
											<td>'.$fecha.'</td>';
							if ($row->id_asignacion != '')
								$contenido .= '<td> </td>';			
							else
								$contenido .= '<td class="registro_unidad" ><input type="checkbox" value="'.$row->id_subcuenta.'|'.$row->cve_activo.'|'.$row->subcuenta.'"/></td>';					
							$contenido .= '</tr>';
						}			
					}			        
				}
						
			}	
			else{
					$contenido .= '<tr>
									<td >S/R</td>
									<td >S/R</td>
									<td >S/R</td>
									<td >S/R</td>
									<td >S/R</td>
									<td >S/R</td>
								   </tr>';			
				}

			$contenido .= '</tbody>';			

		}				 

		return $contenido;	

	}

	public function obtieneCostoXModuloXunidad(){
		$sql = "select precio from PICCO.bienes_y_servicios where id_bien_servicio=3";
		$respuesta = false;
		$this->load->database();
		$response = $this->db->query($sql);
		
		if($response)		
		{
			$respuesta = true;
			$row = $response->row();			
			$precio = $row->precio;	
	    }

	    $precio = 25; 
	    return array('respuesta'=>$respuesta,'contenido'=>$precio);

	}

	public function contratacion_altas($data){

		$arrayRegistros = $data['arrayRegistros'];
		
		$respuesta = false;
		$mensaje = '';
		$this->load->database();
		for ($i = 0; $i < $data['numReg']; $i++)
		{						
			$id_subcuenta = $arrayRegistros[$i];	

			$query = "insert into contrataciones_x_modulo 
			(
			id_cuenta_maestra,
			id_subcuenta,
			id_modulo,
			id_usuario_registro,
			fecha_registro,
			precio_unitiario,
			activo
			) values (";
			$query .= "'".$_SESSION['cuenta_maestra_picco']."',";
			$query .= "'".$id_subcuenta."',".$data['id_modulo'].",";
			$query .= "'".$_SESSION['userid']."',";
			$query .= "NOW(),".$data['costoxUnidad'].",1)";
			

			
			$response = $this->db->query($query);

			if($response){				
				$respuesta = true;
				$mensaje = "Se ha actualizado el registro correctamente.";
			}	
			else{
				$respuesta = false;
				$mensaje = "No se puede ASIGNAR EL ACTIVO AL MODULO COMBUSTIBLE -> ".$query;	
				break;
			}
		}

		return array('respuesta'=>$respuesta,'mensaje'=>$mensaje);
	}

	public function contratacion_cambios($data){

		
		$respuesta = false;
		$mensaje = '';
		$this->load->database();
			

		$query = "update contrataciones_x_modulo set ";
		$query .= " fecha_actualizo=NOW(),";
		$query .= " id_usuario_actualizo='".$_SESSION['userid']."', activo=0, comentarios_baja='".$data['comentarios']."'";
		$query .= " where activo = 1 and id_subcuenta = ".$data["id_subcuenta"]." and id_cuenta_maestra=".$_SESSION['cuenta_maestra_picco']." and id_modulo=".$data['id_modulo'];
		
		

		
		$response = $this->db->query($query);

		if($response){				
			$respuesta = true;
			$mensaje = "Se ha actualizado el registro correctamente.";
		}	
		else{
			$respuesta = false;
			$mensaje = "No se puede ASIGNAR EL ACTIVO AL MODULO COMBUSTIBLE -> ".$query;				
		}
		

		return array('respuesta'=>$respuesta,'mensaje'=>$mensaje);
	}

	public function validar_unidad_activa_en_grupo($data){

		$mensaje = 'No se pudo ejecutar la consulta';
		$respuesta = false;
		$existe = 0;
		$query = "SELECT a.*, b.grupo FROM unidades_x_grupo a join grupos b on a.id_grupo = b.id_grupo where a.id_activo = ".$data['idRow']. " and b.id_modulo =".$data['id_modulo'];
		$this->load->database();
		$resultado= $this->db->query($query);

		$cont = 0;
		$contenido = array();
		if($resultado){
			
			foreach ($resultado->result() as $row)
			{
				$contenido[$row->id_unidad_x_grupo] = $row;
				$cont++;
			}
			
			
			$mensaje = 'Se ejecuto correctamente';
			$respuesta = true;
		}
		else{
			$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
			$respuesta = false;
		}

		return array('respuesta'=>$respuesta,'mensaje' => $mensaje,'existe'=>$cont, 'contenido' => $contenido);

	}

	public function validar_unidad_contratada($data){

		$mensaje = 'No se pudo ejecutar la consulta';
		$respuesta = false;
		$numReg = 0;
		
		$array = $data['unidades'];
		$unidadesContradas = array();
		$this->load->database();

		foreach ($array as $valor)
		{
			$query = "SELECT a.*, b.id_activo, c.cve_activo FROM contrataciones_x_modulo a 
			join PICCO.subcuentas b on a.id_subcuenta = b.id_subcuenta 
			join inventarios_vehiculos c on c.id_activo = b.id_activo
			where a.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and a.id_modulo =".$data['id_modulo']." and b.id_activo =".$valor;
			$resultado = $this->db->query($query);
			if($resultado){

				if ($resultado->num_rows()>0)
				{
					$row = $resultado->row();
					$unidadesContradas[$row->id_activo] = $row->cve_activo;
					$numReg ++;
				}		
						
				
				$mensaje = 'Se ejecuto correctamente';
				$respuesta = true;
				
			}
			else
			{
				goto salida;
				$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
				$respuesta = false;
			}				
		}	

		salida:
		return array('respuesta'=>$respuesta,'mensaje' => $mensaje, 'contenido' => $unidadesContradas, 'sql' => $query, 'numReg' => $numReg );
	}


	public function validar_unidades_en_modulo($data){

		$mensaje = 'No se pudo ejecutar la consulta';
		$respuesta = false;
		$numReg = 0;
		$this->load->database();
		$unidadesContradas = array();
		$this->load->database();

		$query = "SELECT a.*, b.id_activo, c.cve_activo FROM contrataciones_x_modulo a 
			join PICCO.subcuentas b on a.id_subcuenta = b.id_subcuenta 
			join inventarios_vehiculos c on c.id_activo = b.id_activo
			where a.id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and a.id_modulo =".$data['id_modulo'];
			$resultado = $this->db->query($query);
			if($resultado){			

				foreach ($resultado->result() as $row)
				{
					$unidadesContradas[$row->id_activo] = $row->cve_activo;
					$numReg ++;
				}						
				
				$mensaje = 'Se ejecuto correctamente';
				$respuesta = true;
				
			}
			else
			{
				
				$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
				$respuesta = false;
			}	
		
		return array('respuesta'=>$respuesta,'mensaje' => $mensaje, 'contenido' => $unidadesContradas, 'sql' => $query, 'numReg' => $numReg );
	}

	/*  ------------------------- notificaciones  --------------------------------------------*/

	public function listar_notificaciones(){

		$mensaje = 'No se pudo ejecutar la consulta';
		$contenido = array('actualizacion'=> '', 'nuevo' => '');

		$respuesta = false;
		$this->load->database();

		if ($_SESSION['tipoCuenta']  == 'Maestra')
			$query = "SELECT a.* FROM suite.notificaciones a where activo = 1 and estatus = 2 ";
		else
			$query = "SELECT a.* FROM suite.notificaciones a join s_funcionesxusuario b on a.id_funcion = b.id_funcion where activo = 1 and estatus = 2 and b.usuario = ".$_SESSION['usuario'];
		
		$resultado = $this->db->query($query);
		if($resultado){

			foreach ($resultado->result() as $row)
			{
				
				if($row->tipo == 1)
				{
					$contenido['actualizacion'][] = '<h3>'.$row->titulo.'</h3><div>'.$row->descripcion.'</div>';					
				}
				else
				{
					$contenido['nuevo'][] = '<h3>'.$row->titulo.'</h3><div>'.$row->descripcion.'</div>';
				} 
						        
			}					
			
			$mensaje = 'Se ejecuto correctamente';
			$respuesta = true;			
		}
		else
		{
			
			$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
			$respuesta = false;
		}

		//agregar notificaciones globales
		if ($_SESSION['tipoCuenta']  != 'Maestra')
		{
			$query = "SELECT a.* FROM suite.notificaciones a  where activo = 1 and estatus = 2  and global = 1";
			$resultado = $this->db->query($query);
			if($resultado){

				foreach ($resultado->result() as $row)
				{
					
					if($row->tipo == 1)
					{
						$contenido['actualizacion'][] = '<h3>'.$row->titulo.'</h3><div>'.$row->descripcion.'</div>';					
					}
					else
					{
						$contenido['nuevo'][] = '<h3>'.$row->titulo.'</h3><div>'.$row->descripcion.'</div>';
					} 
							        
				}					
				
				$mensaje = 'Se ejecuto correctamente';
				$respuesta = true;			
			}
			else
			{
				
				$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
				$respuesta = false;
			}
		
		}
			
		return array('respuesta'=>$respuesta,'mensaje' => $mensaje, 'contenido' => $contenido, 'sql' => $query );
	}

	/*  ------------------------- alertas subcuentas  --------------------------------------------*/

	public function listar_alerta_subcuentas(){

		$mensaje = 'No se pudo ejecutar la consulta';
		$contenido = '';
		$cont = 0;

		$respuesta = false;
		$this->load->database();

		$query = "SELECT * FROM PICCO.subcuentas where id_cuenta_maestra = ".$_SESSION['cuenta_maestra_picco']." and sin_equipo = 1";
		
		$resultado = $this->db->query($query);
		if($resultado){

			foreach ($resultado->result() as $row)
			{
				$contenido[$row->id_subcuenta] = $row;
				$cont++;
			}					
			
			$mensaje = 'Se ejecuto correctamente';
			$respuesta = true;			
		}
		else
		{
			
			$mensaje = 'No se pudo ejecutar query ->'.$query; //obtener tabla de codigos
			$respuesta = false;
		}
		
			
		return array('respuesta'=>$respuesta,'mensaje' => $mensaje, 'contenido' => $contenido, 'sql' => $query, 'numReg' => $cont );
	}

}