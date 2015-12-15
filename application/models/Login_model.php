<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function altas($data){

		$this->load->database();
		$this->db->insert('usuarios',$data);
		$respuesta = 'Se agrego con exito';

		return $respuesta;

	}

	public function verifica($data){

		$array = array('usuario' => $data['usuario'], 'contrasenia' => $data['contrasenia']);

		$respuesta = 'Verifica el usuario o contraseña';
		$this->load->database();	
		$this->db->select('userid, nombre , usuario , email , Fecha_Ultimo_Acceso');	 //select
		$this->db->where($array); 								 //where
		$query = $this->db->get('s_usuarios');					 //from			
		$datos = '';
		setlocale(LC_ALL,"es_ES");

		if ($query->num_rows()>0){			
			$row = $query->row();
			$data = array('userid'=>$row->userid,					   	
					 'nombre_completo'=>$row->nombre,
					 'usuario'=>$row->usuario,					 
					 'email'=>$row->email,	
					 'ultima_entrada'=>strftime("%d de %B del %Y", strtotime($row->Fecha_Ultimo_Acceso)),					 
					 'respuesta'=>'OK'
			);
			
        	
			$query2 = "update s_usuarios set Fecha_Ultimo_Acceso = NOW() where userid = ".$row->userid;			
			$result = $this->db->query($query2);
		}	
		else{
			$data = array(

				'nombre_completo'=>'',
				'usuario'=>'',					 
				'email'=>'',	
				'ultima_entrada'=>'',					 
				'respuesta'=>$respuesta
			);
		}	
		return $data;
	}


	public function obtengo_cuenta_maestra_subusuario($id_cuenta_maestra_depende){

		$useridPicco  = '';	
		$sql = "select * from s_usuarios where userid=".$id_cuenta_maestra_depende;
		$this->load->database();
		$query = $this->db->query($sql);

		if ($query->num_rows()>0){
			foreach ($query->result() as $row) {
				$useridPicco = $row->useridPicco;
			}
		}
		return $useridPicco;
	
	}

	
}
