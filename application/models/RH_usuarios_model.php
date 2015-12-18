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
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';	    
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   								   
		$contenido .= '</tr></thead>';

		$contenido .= '<tfoot><tr>';		    		   
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';	    
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';		    		   
		$contenido .= '<th>Fecha Registro</th>';
		$contenido .= '<th></th>';		    		   
		$contenido .= '<th>Modulo</th>';			    		   
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



}