<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
    function __contruct(){
        parent:: __contruct();
    }

    function index(){
        $this->load->view('login_view'); 
    }

    public function process()  {  
        $this->load->model('login_model');
        $usuario = $this->input->post('usuario');  
        $password = $this->input->post('password');
        $rol = $this->login_model->login($usuario, $password);
        $data['usuario'] = $usuario;
        $data['rol'] = $rol;
        switch($rol){
            case 1:
                $this->load->model('administrador_model');
                $data['dataTable'] = $this->administrador_model->getAdminTable(); 
                $data['dataClases'] = $this->administrador_model->getAdminClases(); 
                $this->load->view('vistaAdministrador_view', $data);  
                break;
            
            case 2:
                $this->load->model('profesor_model');
                $id = $this->profesor_model->getId($usuario);
                $data['nombre'] = $this->profesor_model->getNombre($id);
                $data['dataTable'] = $this->profesor_model->getHorario($id);  
                $this->load->view('vistaProfesor_view', $data);  
                break;

            case 3:
                $this->load->model('estudiante_model');
                $id = $this->estudiante_model->getId($usuario);
                $data['nombre'] = $this->estudiante_model->getNombre($id);
                $data['dataTable'] = $this->estudiante_model->getHorario($id);  
                $this->load->view('vistaEstudiante_view', $data);  
                break;

            default:
                $data['error'] = true;  
                $this->load->view('login_view', $data);  
                break;
        } 
    } 

    public function logout(){  
		$this->load->model('login_model');
        $this->login_model->logout();
        $this->index();  
    }  
}
?>
