<html>
    <head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/vistaProfesor.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>Profesor</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png" />
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <style>
            table {
                display: table;
            }
            table tr {
                display: table-cell;
            }
            table tr td {
                display: block;
            }
        </style>
    </head>   
    <body>
        <?php
        $usuario = $this->session->userdata('usuario');
        if(empty($usuario)) redirect('Login/logout');
        ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 text-center header mb-5 mt-3">
                    <h4 class="">Bienvenido profesor <?php echo "$nombre"; ?></h4>
                    <form action="<?php echo base_url(); ?>index.php/login/logout" method="GET">
                        <button type="submit" class="btn btn-dark btn-sm mb-5 float-right">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                        <th><strong>Lunes</strong></th>
                        <?php 
                            $i = 0;
                            foreach ($dataTable->result() as $rowHorario) {
                                if ($rowHorario->Dia == 'Lunes') {
                                    $i++;
                                    echo "<td>Materia: ".$rowHorario->DescMat."<br>Hora Inicio: ".$rowHorario->HoraInicio."<br>Hora final: ".$rowHorario->HoraFin."<br>Salon: ".$rowHorario->DescSalon."</td>";
                                }
                            }
                            if($i == 0) echo "<td><br>Sin Clases<br></td>";
                        ?>
                        </tr>
                        <tr>
                        <th><strong>Martes</strong></th>
                        <?php 
                            $i = 0;
                            foreach ($dataTable->result() as $rowHorario) {
                                if ($rowHorario->Dia == 'Martes') {
                                    $i++;
                                    echo "<td>Materia: ".$rowHorario->DescMat."<br>Hora Inicio: ".$rowHorario->HoraInicio."<br>Hora final: ".$rowHorario->HoraFin."<br>Salon: ".$rowHorario->DescSalon."</td>";
                                }
                            }
                            if($i == 0) echo "<td><br>Sin Clases<br></td>";
                        ?>
                        </tr>
                        <tr>
                        <th><strong>Miércoles</strong></th>
                        <?php 
                            $i = 0;
                            foreach ($dataTable->result() as $rowHorario) {
                                if ($rowHorario->Dia == 'Miercoles') {
                                    $i++;
                                    echo "<td>Materia: ".$rowHorario->DescMat."<br>Hora Inicio: ".$rowHorario->HoraInicio."<br>Hora final: ".$rowHorario->HoraFin."<br>Salon: ".$rowHorario->DescSalon."</td>";
                                }
                            }
                            if($i == 0) echo "<td><br>Sin Clases<br></td>";
                        ?>
                        </tr>
                        <tr>
                        <th><strong>Jueves</strong></th>
                        <?php 
                            $i = 0;
                            foreach ($dataTable->result() as $rowHorario) {
                                if ($rowHorario->Dia == 'Jueves') {
                                    $i++;
                                    echo "<td>Materia: ".$rowHorario->DescMat."<br>Hora Inicio: ".$rowHorario->HoraInicio."<br>Hora final: ".$rowHorario->HoraFin."<br>Salon: ".$rowHorario->DescSalon."</td>";
                                }
                            }
                            if($i == 0) echo "<td><br>Sin Clases<br></td>";
                        ?>
                        </tr>
                        <tr>
                        <th><strong>Viernes</strong></th>
                        <?php 
                            $i = 0;
                            foreach ($dataTable->result() as $rowHorario) {
                                if ($rowHorario->Dia == 'Viernes') {
                                    $i++;
                                    echo "<td>Materia: ".$rowHorario->DescMat."<br>Hora Inicio: ".$rowHorario->HoraInicio."<br>Hora final: ".$rowHorario->HoraFin."<br>Salon: ".$rowHorario->DescSalon."</td>";
                                }
                            }
                            if($i == 0) echo "<td><br>Sin Clases<br></td>";
                        ?>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <form action="<?php echo base_url(); ?>index.php/archivo/horarioProfesorPDF" method="POST">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <button type="submit" class="btn btn-danger btn-md text-center">Descargar PDF</button>
                </form><br>
            </div>
        </div>
    </body>
</html>