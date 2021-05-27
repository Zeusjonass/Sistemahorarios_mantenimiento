<?php
class Login_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }

    public function login($usuario, $password){
        $query = $this->db->get_where('usuarios', array('idUsuario' => $usuario));
        if($query->num_rows() == 1){
            $row = $query->row();
            if($row->Password === $password){
                $data = array(
                    'usuario'=>$row->idUsuario,
                    'rol'=>$row->Rol,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                return $row->Rol;
            }
            else{
                return 0;
            }
        }
        else {
            return 0;
        }
    }

    public function logout(){
        $newdata = array(
            'usuario'  =>'',
            'rol'  =>'',
            'logged_in' => FALSE
           );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy(); 
    }
}