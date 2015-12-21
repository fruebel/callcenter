<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RH_usuarios_model extends CI_Model {



	public function usuarios_contenido(){

		if ($_SESSION['super_usuario'] == 1){
			$sql = "select a.*,p.puesto,concat(j.nombre,' ',j.apaterno , ' ',j.amaterno) as jefe,pl.plaza
			from s_usuarios a inner join usrpuestos p on a.u_puesto = p.u_puesto 
			left join s_usuarios j on j.userid = a.u_jefedirecto		
			left join usrplazas	pl on pl.u_plaza = a.u_plaza
			order by a.u_plaza,a.creado_por,a.nombre asc limit 10000";	
		}
		else{
			$sql = "select a.*,p.puesto,concat(j.nombre,' ',j.apaterno , ' ',j.amaterno) as jefe,pl.plaza
			from s_usuarios a inner join usrpuestos p on a.u_puesto = p.u_puesto 
			left join s_usuarios j on j.userid = a.u_jefedirecto
			left join usrplazas	pl on pl.u_plaza = a.u_plaza
			where a.u_plaza = ".$_SESSION['u_plaza']." 
			order by a.creado_por,a.nombre asc limit 3000";		
		}
		
		$this->load->database();
		$query = $this->db->query($sql);


		$contenido = '';
		$contenido .= '<thead><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Plaza</th>';		    		   
		$contenido .= '<th>Nombre</th>';	    
		$contenido .= '<th>Usuario</th>';		    		   
		$contenido .= '<th>Puesto</th>';		    		   
		$contenido .= '<th>Jefe</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Telefono</th>';		    		   
		$contenido .= '<th>Creado Por</th>';
		$contenido .= '<th>Fecha Ultimo Acceso</th>';		    		   
		$contenido .= '<th>Estatus</th>';		    		   								   
		$contenido .= '</tr></thead>';

		$contenido .= '<tfoot><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Plaza</th>';		    		   
		$contenido .= '<th>Nombre</th>';	    
		$contenido .= '<th>Usuario</th>';		    		   
		$contenido .= '<th>Puesto</th>';		    		   
		$contenido .= '<th>Jefe</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Telefono</th>';		    		   
		$contenido .= '<th>Creado Por</th>';
		$contenido .= '<th>Fecha Ultimo Acceso</th>';		    		   
		$contenido .= '<th>Estatus</th>';				    		   
		$contenido .= '</tr></tfoot>';
      	

 		$contenido .= '<tbody>';
		if ($query->num_rows()>0){
			foreach ($query->result() as $row) {

				$estatus = 'baja';
				if ($row->u_status == 1)
				$estatus = 'activo';

				$contenido .= '<tr>
							    <td>
							    	<div class="btn btn-primary"  id="'.$row->userid.'"  onclick="editar(this);" data-toggle="modal" data-target="#fmodal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
							    	<div class="btn btn-primary"  id="'.$row->userid.'"  onclick="eliminar(this, '.$row->userid.');"  data-toggle="modal" data-target="#modal-eliminar" ><span  class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
							    </td>
							    
								<td>'.strtoupper($row->plaza).'</td>
								<td>'.strtoupper($row->nombre).'</td>
								<td>'.strtoupper($row->usuario).'</td>
								<td>'.strtoupper($row->puesto).'</td>
								<td>'.strtoupper($row->jefe).'</td>
								<td></td>
								<td>'.strtoupper($row->telefono).'</td>
								<td>'.strtoupper($row->creado_por).'</td>
								<td>'.date("d/m/Y h:i",strtotime($row->Fecha_Ultimo_Acceso)).'</td>
								<td>'.strtoupper($estatus).'</td>
							</tr>';
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
							<td >S/R</td>
							<td >S/R</td>
							<td >S/R</td>
							<td >S/R</td>
							<td >S/R</td>
																												
						   </tr>';			
		}


        $contenido .= '</tbody>'; 

		return $contenido;
	}


	public function usuarios_consulta($data){

		$mensaje = '';
		$respuesta = false;
		//$query = "select * FROM disponibilidad WHERE id_modulo_unidad = ".$data['id_row'];
		$query = "select * FROM s_usuarios WHERE userid = '".$data['id_row']."'";
		$this->load->database();
		$query= $this->db->query($query);

		if($query->num_rows()>0) {
			$row = $query->row();
			$contenido = array(				
				'nombre' => $row->nombre,
				'apaterno' => $row->apaterno,
				'amaterno' => $row->amaterno,
				'usuario' => $row->usuario,
				'contrasenia' => $row->contrasenia,
				'direccion' => $row->direccion,
				'u_estado' => $row->u_estado,
				'cp' => $row->cp,
				'pais' => $row->pais,
				'telefono' => $row->telefono,
				'email' => $row->email,												
				'u_status' => $row->u_status,
				'u_plaza' => $row->u_plaza,
				'RFC' => $row->rfc,
				'AfiliacionIMSS' => $row->imss,
				'colonia' => $row->colonia,
				'curp' => $row->curp,
				'email' => $row->email,							
				'sexo' => $row->Sexo,
				'u_estadocivil' => $row->u_estadocivil,
				'lada' => $row->lada,
				'telefono' => $row->telefono,
				'u_turno' => $row->u_turno,
				'cuentabanco' => $row->cuentabanco,
				'u_puesto' => $row->u_puesto,
				'u_jefedirecto' => $row->u_jefedirecto,							
				'usuario_banco' => $row->usuario_banco,								
				'contrasenia_banco' => $row->contrasenia_banco,	
				'FechaAlta' => date("d/m/Y",strtotime($row->FechaAlta)),
				'FechaContratacion' => date("d/m/Y",strtotime($row->FechaContratacion)),
				'FechaTerminacion' => date("d/m/Y",strtotime($row->FechaTerminacion)),
			);
			$mensaje = 'Se ejecuto correctamente';
			$respuesta = true;
		}
		else{
			$mensaje = 'Error consulta'; //obtener tabla de codigos
			$respuesta = false;
		}

		return array('respuesta'=>$respuesta,"mensaje" => $mensaje,'contenido'=>$contenido);

	}

	public function usuarios_menu($data)
	{
		$contador=0;
		$opciones = '';

		$opciones .= "<table width='100%' border='0' class='form0'>";
		$opciones .= "<tr><td align='left'>";
		$opciones .= "<ul id=treemenu1 class=treeview>";	
		$this->load->database();

		$sql = "SELECT * FROM s_modulos WHERE activo = 1 order by orden asc";
		$query = $this->db->query($sql);

		if ($query->num_rows()>0){

			foreach ($query->result() as $row) 
			{
				$id_modulo =  $row->id_modulo;
				$modulo =  $row->modulo;
				$url =  $row->url;
				
				$opciones .= "<li>".$modulo;
				
				$sql = "SELECT f.id_funcion,f.funcion,f.url
				FROM s_funciones f WHERE f.id_modulo = ".$id_modulo." and f.id_categoria in (1,2)
				order by f.id_categoria asc, orden asc";
				$query1 = $this->db->query($sql);
				if ($query1->num_rows()>0){
				
					$opciones .=  "<ul>";
					
					foreach ($query1->result() as $row_funciones) 
					{
						$contador++;
						$id_funcion =  $row_funciones->id_funcion;
						$funcion =  $row_funciones->funcion;
											
						if ($data["accion"] == 'editRow'){
							$sql = "select count(*) as permiso 
							from s_usuarios u,s_funcionesxusuario fxu
							where u.usuario = fxu.usuario and u.userid=".$data["id"]."
							and fxu.id_funcion = ".$id_funcion;
							
							$rsPermiso = $this->db->query($sql);
							//$rsPermiso = $conn->query($sql);
							$rs = $rsPermiso->row();
							//$rs = $rsPermiso->fetch_assoc();
							$permiso =  $rs->permiso;
							$selecciona = "";
							if ($permiso > 0)
								$selecciona = "checked";
						}
						else
							$selecciona = "";
						
						$nivel4 = 0;
						$sql = "SELECT f.id_funcion,f.funcion,f.url
						FROM s_funciones f WHERE f.id_modulo = ".$id_funcion." and f.id_categoria = 4
						order by f.id_categoria asc, orden asc";

						//$rsPermiso = $this->db->query($sql);
						if ($this->db->query($sql)){
							$result4 = $this->db->query($sql);
							//$result4 = $conn->query($sql);
							$nivel4 = $result4->num_rows();//$result4->num_rows;						
						}	

						
						$opciones .= "<li>
										<input ".$selecciona." type=checkbox name=mfuncion_".$contador.">
										".$funcion."
										<input type=hidden name=mval_funcion_".$contador." value=".$id_funcion.">";
										
										if ($nivel4>0){									
											$opciones .= "<ul>";	
											//while( $row_funciones_nivel4 = $result4->fetch_assoc() )
											foreach ($result4->result() as $row_funciones_nivel4) 
											{																			
												$contador++;
												if ($data["accion"] == 'editRow'){
													$sql = "select count(*) as permiso 
													from s_usuarios u,s_funcionesxusuario fxu
													where u.usuario = fxu.usuario and u.userid=".$data["id"]."
													and fxu.id_funcion = ".$row_funciones_nivel4->id_funcion;
													
													$rsPermiso4 = $this->db->query($sql);
													//$rsPermiso4 = $conn->query($sql);
													//$rs4 = $rsPermiso4->fetch_assoc();
													$rs4 = $rsPermiso4->row();

													$permiso4 =  $rs4->permiso;
													$selecciona4 = "";
													if ($permiso4 > 0)
														$selecciona4 = "checked";
												}
												else
													$selecciona4 = "";

												
												$opciones .= "<li><input ".$selecciona4." type=checkbox name=mfuncion_".$contador.">".$row_funciones_nivel4->funcion;
												$opciones .= "<input type=hidden name=mval_funcion_".$contador." value=".$row_funciones_nivel4->id_funcion.">";
												
													
													$nivel5=0;
													$sql = "SELECT f.id_funcion,f.funcion,f.url
													FROM s_funciones f WHERE f.id_modulo = ".$row_funciones_nivel4->id_funcion." and f.id_categoria in (2,3) and f.activo = 1
													order by f.id_categoria asc, orden asc";
													//if ($conn->query($sql)){
													if ($this->db->query($sql)) {
														$result5 = $this->db->query($sql);//$conn->query($sql);
														$nivel5 = $result5->num_rows();
													}	
													if ($nivel5>0){
														$opciones .= "<ul>";
														//while( $row_funciones_nivel5 = $result5->fetch_assoc() )
														foreach ($result5->result() as $row_funciones_nivel5) 
														{																			
															$contador++;
															
															if ($data["accion"] == 'editRow'){
																$sql = "select count(*) as permiso 
																from s_usuarios u,s_funcionesxusuario fxu
																where u.usuario = fxu.usuario and u.userid=".$data["id"]."
																and fxu.id_funcion = ".$row_funciones_nivel5->id_funcion;
																
																$rsPermiso5 = $this->db->query($sql);//$conn->query($sql);
																//$rs5 = $rsPermiso5->fetch_assoc();
																$rs5 = $rsPermiso5->row();
																$permiso5 =  $rs5->permiso;
																$selecciona5 = "";
																if ($permiso5 > 0)
																	$selecciona5 = "checked";
															}
															else
																$selecciona5 = "";
															
															
															$opciones .= "<li><input ".$selecciona5." type=checkbox name=mfuncion_".$contador.">".$row_funciones_nivel5->funcion;
															$opciones .= "<input type=hidden name=mval_funcion_".$contador." value=".$row_funciones_nivel5->id_funcion.">";														
														}
														$opciones .= "</ul>";
													}
													
													
												$opciones .= "</li>";
												
													
												
												
											}
											$opciones .= "</ul>";	
										}
										
						$opciones .= "</li>";

						
					}
					$opciones .= "</ul>";
					
				}
				$opciones .=  "</li>";
			}
		}

		$opciones .= "</ul>";
		$opciones .= "</td><tr>";
		$opciones .= "</table>";
		
		$opciones .= "<input type='hidden' name='mcontador' value='".$contador."'>";	
		
		$opciones .= "<script type='text/javascript'>";
		$opciones .= "ddtreemenu.createTree('treemenu1', true)";
		$opciones .= "</script>";		
		
		return $opciones;


	}	


	public function usuarios_altas($data){


		$mensaje = 'No se pudo ejecutar el insert';
		$respuesta = false;		
		$this->load->database();


		//Armamos el query
		$fecha = date("d-M-y");
		$sql = "insert into s_usuarios (";
		$sql .= "u_plaza,";
		$sql .= "u_puesto,";
		$sql .= "u_jefedirecto,";
		$sql .= "nombre,";
		$sql .= "apaterno,";
		$sql .= "amaterno,";
		$sql .= "usuario,";
		$sql .= "contrasenia,";
		$sql .= "u_estado,";
		$sql .= "direccion,";
		$sql .= "colonia,";
		$sql .= "cp,";
		$sql .= "rfc,";
		$sql .= "imss,";
		$sql .= "curp,";
		$sql .= "sexo,";
		$sql .= "u_estadocivil,";
		$sql .= "lada,";
		$sql .= "telefono,";
		$sql .= "email,";
		$sql .= "u_turno,";
		$sql .= "cuentabanco,";
		$sql .= "usuario_banco,";
		$sql .= "contrasenia_banco,";
		$sql .= "FechaAlta,";
		$sql .= "FechaContratacion,";
		$sql .= "FechaTerminacion,u_status,";					
		$sql .= "IDEmpleado";					
		$sql .= ") values (";
		
		$sql .= "'".$data['cpo_plazas']."','".$data['cbo_puesto']."','".$cbo_jefedirecto."',";
		$sql .= "'".$data['nombre_completo']."','".$data['apaterno']."','".$data['amaterno']."',";
		$sql .= "'".$data['usuario_f']."','".$data['contrasenia']."','".$data['cbo_estado']."',";
		$sql .= "'".$data['direccion']."','".$data['colonia']."','".$data['cp']."',";
		$sql .= "'".$data['rfc']."','".$data['imss']."','".$data['curp']."',";
		$sql .= "'".$data['cbo_sexo']."','".$data['cbo_estado_civil']."','".$data['lada']."',";
		$sql .= "'".$telefono."','".$data['email']."','".$data['cbo_turno']."',";
		$sql .= "'".$data['cuenta']."','".$data['usuario_banco']."','".$data['contrasenia_banco']."',";
		$sql .= "'".date('Y-m-d',strtotime(str_replace("/","-",$data['fechaalta'])))."','".date('Y-m-d',strtotime(str_replace("/","-",$data['fecha_contratacion'])))."','".date('Y-m-d',strtotime(str_replace("/","-",$data['fecha_termino'])))."'";

		$sql .= ",1,".$data['IDEmpleado'].")";

		if ($this->db->query($sql))
		{			
			$respuesta = true;
			$mensaje = "Se ha insertado el registro correctamente " . $sql;	
		}
		else{


		}

		return array('respuesta'=>$respuesta,"mensaje" => $mensaje);

	}

}