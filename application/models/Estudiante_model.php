<?php
class Estudiante_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }

    public function getId($usuario){
        $query = $this->db->get_where('alumno', array('idUsuario' => $usuario));
        $alumno = $query->row();
        return $alumno->idAlumno;
    }

    public function getNombre($id){
        $query = $this->db->get_where('alumno', array('idAlumno' => $id));
        $alumno = $query->row();
        return $alumno->NomAlum;
    }
    
    public function getHorario($id){
        $this->db->select('*');
        $this->db->from('alumnoinscrito');
        $this->db->join('curso', 'alumnoinscrito.idCurso = curso.idCurso');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->join('clase', 'curso.idCurso = clase.idCurso');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $this->db->join('salon', 'clase.idSalon = salon.idSalon');
        $this->db->where('alumnoinscrito.idAlumno', $id);
        $query = $this->db->get();
        return $query;
    }
}