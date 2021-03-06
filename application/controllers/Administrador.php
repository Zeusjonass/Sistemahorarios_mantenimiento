<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Administrador extends CI_Controller{
    function __contruct(){
        parent:: __contruct();
    }

    function index(){
    }

    public function verClases()  {  
        $this->load->model('administrador_model');
        $curso = $this->input->post('curso');  
        $data['idCurso'] = $curso;
        $data['dataCurso'] = $this->administrador_model->getDatosCurso($curso);  
        $data['dataTable'] = $this->administrador_model->getHorarioCurso($curso);  
        $this->load->view('horariosAdministrador_view', $data);  
    }  

    public function verCursos() {  
        $this->load->model('administrador_model');
        $data['dataTable'] = $this->administrador_model->getAdminTable(); 
        $data['dataClases'] = $this->administrador_model->getAdminClases(); 
        $this->load->view('vistaAdministrador_view', $data);  
    }  

    public function borrarClase() {
        $this->load->model('administrador_model');
        $curso = $this->input->post('curso'); 
        $clase = $this->input->post('claseElegida'); 
        $this->administrador_model->borrarClase($clase);
        $data['dataCurso'] = $this->administrador_model->getDatosCurso($curso);  
        $data['dataTable'] = $this->administrador_model->getHorarioCurso($curso);  
        $this->load->view('horariosAdministrador_view', $data); 
    }  

    public function editarClase() {
        $curso = $this->input->post('curso'); 
        $clase = $this->input->post('claseElegida'); 
        $this->load->model('administrador_model');
        $data['curso'] = $curso; 
        $data['dataSalon'] = $this->administrador_model->getSalones();
        $data['dataClase'] = $this->administrador_model->getDatosClase($clase); 
        $this->load->view('editarClase_view', $data);  
    }
    
    public function crearClase() {
        $curso = $this->input->post('curso'); 
        $this->load->model('administrador_model');
        $data['dataGrupos'] = $this->administrador_model->getGrupos(); 
        $data['dataSalones'] = $this->administrador_model->getSalones(); 
        $this->load->view('registrarHorario_view', $data);  
    }

    public function registrarHorario() {
        $curso = $this->input->post('cursos');
        $horaInicio = $this->input->post('horaInicio');
        $horaFin = $this->input->post('horaFin');
        $dia = $this->input->post('dia'); 
        $salon = $this->input->post('salon');
        $this->load->model('administrador_model');
        $data['dataGrupos'] = $this->administrador_model->getGrupos(); 
        $data['dataSalones'] = $this->administrador_model->getSalones(); 
        //Validaci??n hora inicio vaya antes de hora final
        if($horaInicio > $horaFin){
            $data['error'] = 2;
            $this->load->view('registrarHorario_view', $data);  
        }
        else{
            //Validamos que la diferencia de hora no sea mayor a 2 hrs
            if((strtotime($horaFin) - strtotime($horaInicio)) > 7200){
                $data['error'] = 1;
                $this->load->view('registrarHorario_view', $data);  
            }
            else{
                //Validamos que no haya otra clase de esta materia ese d??a para este grupo
                $clasesPorDia = $this->administrador_model->clasesPorDia($dia, $curso);
                if($clasesPorDia > 0){
                    $data['error'] = 3;
                    $this->load->view('registrarHorario_view', $data);  
                }
                else{
                    //Validamos que no exista un choque de horarios
                    if(!$this->administrador_model->horarioDisponible($horaInicio, $horaFin, $salon, $curso, $dia)){
                        $data['error'] = 4;
                        $this->load->view('registrarHorario_view', $data); 
                    }
                    else{
                        $data['error'] = 5;
                        $this->administrador_model->guardarHorario($horaInicio, $horaFin, $salon, $curso, $dia);
                        $this->load->view('registrarHorario_view', $data); 
                    } 
                }
            }
        } 
    }

    public function editarHorario() {
        $curso = $this->input->post('curso');
        $idClase = $this->input->post('clase');
        $horaInicio = $this->input->post('horaInicio');
        $horaFin = $this->input->post('horaFin');
        $dia = $this->input->post('dia'); 
        $salon = $this->input->post('salon');
        $this->load->model('administrador_model');
        $datosClase = $this->administrador_model->getDatosClase($idClase);
        $clase = $datosClase->row();
        $this->administrador_model->borrarClase($idClase);
        $data['curso'] = $curso; 
        $data['dataSalon'] = $this->administrador_model->getSalones();
        $data['dataClase'] = $datosClase;
        //Validaci??n hora inicio vaya antes de hora final
        if($horaInicio > $horaFin){
            $this->administrador_model->guardarHorario($clase->HoraInicio, $clase->HoraFin, $clase->idSalon, $clase->idCurso, $clase->Dia);
            $data['error'] = 2;
            $this->load->view('editarClase_view', $data);  
        }
        else{
            //Validamos que la diferencia de hora no sea mayor a 2 hrs
            if((strtotime($horaFin) - strtotime($horaInicio)) > 7200){
                $this->administrador_model->guardarHorario($clase->HoraInicio, $clase->HoraFin, $clase->idSalon, $clase->idCurso, $clase->Dia);
                $data['error'] = 1;
                $this->load->view('editarClase_view', $data);  
            }
            else{
                //Validamos que no haya otra clase de esta materia ese d??a para este grupo
                $clasesPorDia = $this->administrador_model->clasesPorDia($dia, $curso);
                if($clasesPorDia > 0){
                    $this->administrador_model->guardarHorario($clase->HoraInicio, $clase->HoraFin, $clase->idSalon, $clase->idCurso, $clase->Dia);
                    $data['error'] = 3;
                    $this->load->view('editarClase_view', $data);  
                }
                else{
                    //Validamos que no exista un choque de horarios
                    if(!$this->administrador_model->horarioDisponible($horaInicio, $horaFin, $salon, $curso, $dia)){
                        $this->administrador_model->guardarHorario($clase->HoraInicio, $clase->HoraFin, $clase->idSalon, $clase->idCurso, $clase->Dia);
                        $data['error'] = 4;
                        $this->load->view('editarClase_view', $data); 
                    }
                    else{ 
                        $data['error'] = 5;
                        $data['dataClase'] = $this->administrador_model->guardarHorario($horaInicio, $horaFin, $salon, $curso, $dia);
                        $data['dataTable'] = $this->administrador_model->getAdminTable(); 
                        $data['dataClases'] = $this->administrador_model->getAdminClases(); 
                        $this->load->view('vistaAdministrador_view', $data); 
                    } 
                }
            }
        } 
    }
}
?>