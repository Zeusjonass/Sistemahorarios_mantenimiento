<?php
class Administrador_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    
    public function getAdminTable(){
        $this->db->select('*');
        $this->db->from('curso');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->order_by('curso.idCurso', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function getAdminClases(){
        $this->db->distinct();
        $this->db->select('clase.idCurso, clase.idSalon, salon.descSalon');
        $this->db->from('clase');
        $this->db->join('salon', 'clase.idSalon = salon.idSalon');
        $this->db->order_by('clase.idCurso', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function getDatosCurso($id){
        $this->db->select('*');
        $this->db->from('curso');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $this->db->where('curso.idCurso', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getHorarioCurso($id){
        $this->db->select('*');
        $this->db->from('curso');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $this->db->join('clase', 'curso.idCurso = clase.idCurso');
        $this->db->join('salon', 'clase.idSalon = salon.idSalon');
        $this->db->where('curso.idCurso', $id);
        $query = $this->db->get();
        return $query;
    }

    public function borrarClase($idClase){
        $this->db->delete('clase', array('idClase' => $idClase));
        return true;
    }

    public function getGrupos(){
        $this->db->select('curso.idCurso, profesor.NomProf, materia.NomMat');
        $this->db->from('curso');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $query = $this->db->get();
        return $query;
    }

    public function getSalones(){
        $this->db->select('*');
        $this->db->from('salon');
        $query = $this->db->get();
        return $query;
    }

    public function getDatosClase($idClase){
        $query = $this->db->get_where('clase', array('idClase' => $idClase));
        return $query;
    }

    public function getProfesorCurso($idCurso){
        $query = $this->db->get_where('curso', array('idCurso' => $idCurso));
        $curso = $query->row();
        return $curso->idProfesor;
    }

    public function getProfesorClase($idClase){
        $query = $this->db->get_where('clase', array('idClase' => $idClase));
        $clase = $query->row();
        $query = $this->db->get_where('curso', array('idCurso' => $clase->idCurso));
        $curso = $query->row();
        return $curso->idProfesor;
    }

    public function clasesPorDia($dia, $curso){
        $query = $this->db->get_where('clase', array('Dia' => $dia, 'idCurso' => $curso));
        return $query->num_rows();
    }

    public function horarioDisponible($horaInicio, $horaFin, $salon, $curso, $dia){
        $clasesDelDia = $this->db->get_where('clase', array('Dia' => $dia));
        foreach($clasesDelDia->result() as $clase){
            if($this->getProfesorCurso($curso) == $this->getProfesorClase($clase->idClase)){
                if(!(strtotime($clase->HoraInicio) >= strtotime($horaFin) || strtotime($clase->HoraFin) <= strtotime($horaInicio))){
                    return false; 
                }
            }
            if($salon == $clase->idSalon){
                if(!(strtotime($clase->HoraInicio) >= strtotime($horaFin) || strtotime($clase->HoraFin) <= strtotime($horaInicio))){
                    return false; 
                }
            }
        }
        return true;
    }

    public function guardarHorario($horaInicio, $horaFin, $salon, $curso, $dia){
        $data = array(  
            'HoraInicio' => $horaInicio,
            'HoraFin' => $horaFin, 
            'idSalon' => $salon,
            'idCurso' => $curso,
            'Dia' => $dia
        );
        $this->db->insert('clase', $data);
        $query = $this->db->get_where('clase', array('HoraInicio' => $horaInicio, 'HoraFin' => $horaFin, 'idSalon' => $salon,'idCurso' => $curso, 'Dia' => $dia));
        return $query;
    }
}