<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Archivo extends CI_Controller{
    function __contruct(){
        parent:: __contruct();
    }

    function index(){          
    }

    public function horarioEstudiantePDF(){
        require_once APPPATH.'fpdf/fpdf.php';
        $id = $this->input->post('id');
        $this->load->model('estudiante_model');
        $nombre = $this->estudiante_model->getNombre($id);
        $horario = $this->estudiante_model->getHorario($id);
        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4', 0);
        //HEADER
        $pdf->Image(base_url() . 'assets/img/encabezado.jpg', 24, 12, 160); 
        $ancho = 190;
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(24, 40);
        $pdf->Cell($ancho, 10,'Estudiante: ' . utf8_decode($nombre), 0, 0, 'L');
        //BODY
        //Encabezado de la tabla
        $pdf->SetFont('arial', 'B', 8);
        $y = $pdf->GetY() + 16;
        $pdf->SetXY(10, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Lunes"), 1, 'C'); 
        $pdf->SetXY(48, $y); 
        $pdf->MultiCell(38, 4, utf8_decode("Martes"), 1, 'C');
        $pdf->SetXY(86, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Miércoles"), 1, 'C');
        $pdf->SetXY(124, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Jueves"), 1, 'C');
        $pdf->SetXY(162, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Viernes"), 1, 'C');

        //Cuerpo de la tabla
        $pdf->SetFont('arial', '', 8);
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Lunes') {
                $y = $pdf->GetY();
                $pdf->SetXY(10, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\nProfesor: " . $clase->NomProf . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Martes') {
                $y = $pdf->GetY();
                $pdf->SetXY(48, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\nProfesor: " . $clase->NomProf . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Miercoles') {
                $y = $pdf->GetY();
                $pdf->SetXY(86, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\nProfesor: " . $clase->NomProf . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Jueves') {
                $y = $pdf->GetY();
                $pdf->SetXY(124, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\nProfesor: " . $clase->NomProf . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Viernes') {
                $y = $pdf->GetY();
                $pdf->SetXY(162, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\nProfesor: " . $clase->NomProf . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }

        //Descargamos
        $pdf->Output("Horario_" . $nombre . '.pdf' , 'D' );
    }

    public function horarioProfesorPDF(){
        require_once APPPATH.'fpdf/fpdf.php';
        $id = $this->input->post('id');
        $this->load->model('profesor_model');
        $nombre = $this->profesor_model->getNombre($id);
        $horario = $this->profesor_model->getHorario($id);
        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4', 0);
        //HEADER
        $pdf->Image(base_url() . 'assets/img/encabezado.jpg', 24, 12, 160); 
        $ancho = 190;
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(24, 40);
        $pdf->Cell($ancho, 10,'Profesor: ' . utf8_decode($nombre), 0, 0, 'L');
        //BODY
        //Encabezado de la tabla
        $pdf->SetFont('arial', 'B', 8);
        $y = $pdf->GetY() + 16;
        $pdf->SetXY(10, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Lunes"), 1, 'C'); 
        $pdf->SetXY(48, $y); 
        $pdf->MultiCell(38, 4, utf8_decode("Martes"), 1, 'C');
        $pdf->SetXY(86, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Miércoles"), 1, 'C');
        $pdf->SetXY(124, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Jueves"), 1, 'C');
        $pdf->SetXY(162, $y);
        $pdf->MultiCell(38, 4, utf8_decode("Viernes"), 1, 'C');

        //Cuerpo de la tabla
        $pdf->SetFont('arial', '', 8);
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Lunes') {
                $y = $pdf->GetY();
                $pdf->SetXY(10, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Martes') {
                $y = $pdf->GetY();
                $pdf->SetXY(48, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Miercoles') {
                $y = $pdf->GetY();
                $pdf->SetXY(86, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Jueves') {
                $y = $pdf->GetY();
                $pdf->SetXY(124, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }
        $pdf->SetY(60);
        foreach ($horario->result() as $clase) {
            if ($clase->Dia == 'Viernes') {
                $y = $pdf->GetY();
                $pdf->SetXY(162, $y);
                $pdf->MultiCell(38, 4, utf8_decode("Materia: " . $clase->DescMat . "\n" . $clase->HoraInicio . "-" . $clase->HoraFin . "\nSalón: " . $clase->DescSalon), 1, 'C'); 
            }
        }

        //Descargamos
        $pdf->Output("Horario_" . $nombre . '.pdf' , 'D' );
    }
}