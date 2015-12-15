<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuarios_model extends CI_Model {
		public function inserta($data){
			$respuesta = "";
			$this->load->database();
			$sql = "INSERT INTO seg_usuarios(usuariod, nombre) VALUES('" . $data['userid'] . "','" . $data['nombre'] . "')";
			if($this->db->query($sql)){
				$respuesta = "Etsito";
			}else{
				$respuesta = "error";
			}
			return $respuesta;
 		}

 		public function contenido(){
			$respuesta = "";
			$elimina = 0;
			
			$this->load->database();
			$sql = "SELECT usuariod, nombre FROM seg_usuarios";
			/*if($this->db->query($sql)){
				$respuesta = "Etsito";
			}else{
				$respuesta = "error";
			}
			return $respuesta;
			*/
			$query = $this->db->query($sql);

			$contenido = '';
		  	$contenido .= '<thead><tr>';           
		  	$contenido .= '<th></th>';           
		  	$contenido .= '<th>Usuario ID</th>';           
		  	$contenido .= '<th>Nombre</th>';          
		  	$contenido .= '</tr></thead>';

			$contenido .= '<tfoot><tr>';           
			$contenido .= '<th></th>';           
			$contenido .= '<th>Usuario ID</th>';           
			$contenido .= '<th>Nombre</th>';          
		  	$contenido .= '</tr></tfoot>';
       
		  	$contenido .= '<tbody>';
  			if ($query->num_rows()>0){
   				foreach ($query->result() as $row) {
   					$contenido .= '<tr>
           			<td>
            			<div class="btn btn-primary"  id="'.$row->usuariod.'"  onclick="editar(this);" data-toggle="modal" data-target="#fmodal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>';
            		if ($elimina == 0)
             		$contenido .= '<div class="btn btn-primary"  id="'.$row->usuariod.'"  onclick="eliminar(this);" ><span  class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>';
           			$contenido .= '</td>
           			<td>'.$row->usuariod.'</td>
           			<td>'.$row->nombre.'</td>
           			</tr>';
   				}   
  			}
		  	else{
		   		$contenido .= '<tr>
		       		<td >S/R</td>
		       	</tr>';   
		  	}
		  	$contenido .= '</tbody>'; 

  			return $contenido;

  		}


 	}
