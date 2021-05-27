<?php
class Profesor_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }

    public function getId($usuario){
        $query = $this->db->get_where('profesor', array('idUsuario' => $usuario));
        $profesor = $query->row();
        return $profesor->idProfesor;
    }

    public function getNombre($id){
        $query = $this->db->get_where('profesor', array('idProfesor' => $id));
        $profesor = $query->row();
        return $profesor->NomProf;
    }
    
    public function getHorario($id){
        $this->db->select('*');
        $this->db->from('curso');
        $this->db->join('profesor', 'curso.idProfesor = profesor.idProfesor');
        $this->db->join('clase', 'curso.idCurso = clase.idCurso');
        $this->db->join('materia', 'curso.idMateria = materia.idMateria');
        $this->db->join('salon', 'clase.idSalon = salon.idSalon');
        $this->db->where('curso.idProfesor', $id);
        $query = $this->db->get();
        return $query;
    }
}