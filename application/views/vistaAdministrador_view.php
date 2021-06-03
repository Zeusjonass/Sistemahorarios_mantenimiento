<html>
    <head>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/vistaAdmin.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminTable.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png" />
        <title>Administrador</title>
        <style>
            #title{
                margin: 15px 0;
            }
            .msg{
                text-align: center;
                position: absolute;
                top: 0;
                width: 100%;
                border-radius: 0%;
                padding: 3px; 
            }
            .msg-success{
                background-color: aqua;
            }
            .msg-fail{
                background-color: #FF342A;
            }
            .btn{
                margin: 15px 0;
            }
        </style>
        <script>
            function verClases(row){
                document.getElementById("curso").value = row.id;
                document.getElementById("verClases").submit();
            }
        </script>
    </head>   

    <body>
        <?php
        $usuario = $this->session->userdata('usuario');
        if(empty($usuario)) redirect('Login/logout');
        if (isset($error)){
            switch($error){
                case 1: 
                    $msg = "Las clases deben durar 2 horas o menos";
                    break;
                case 2:
                    $msg = "La hora final debe ir después de la hora de inicio";
                    break;
                case 3:
                    $msg ="No pueden haber 2 clases del mismo grupo el mismo día";
                    break;
                case 4:
                    $msg = "Otro grupo tiene el horario deseado";
                    break;
                case 5: 
                    $msg = "Se actualizó el horario de manera correcta";
                    break;
                case 6:
                    $msg = "Se guardó al estudiante correctamente";
                    break;
                case 7:
                    $msg = "Se guardó al profesor correctamente";
                    break;
                case 8:
                    $msg = "Ya existe un usuario con este id de acceso";
                    break;
            }
            $error>4 && $error <8? $success = true : $success = false;
            if($success){
                echo "<p class='msg msg-success'>".$msg."</p>";
            }
            else{
                echo "<p class='msg msg-fail'>".$msg."</p>";
            }
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3 mb-3 header text-center">
                    <h4 id="title">Bienvenido Administrador</h4>
                    <form action="<?php echo base_url(); ?>index.php/login/logout" method="GET">
                        <button type="submit" class="btn btn-primary btn-sm float-right" id="out_sesion">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <table class = "table table-sortable">
                    <thead>
                        <tr>
                            <th>Profesor</th>
                            <th>Materia</th>
                            <th>Aula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?php echo base_url(); ?>index.php/administrador/verClases" method="POST" id="verClases">
                            <?php                        
                            foreach ($dataTable->result() as $fila){?> 
                                <tr id="<?php echo $fila->idCurso; ?>" class='table-row' onclick="verClases(this)">
                                    <td><?php echo $fila->NomProf; ?></td>
                                    <td><?php echo $fila->NomMat; ?></td>
                                    <td>
                                        <?php
                                        foreach ($dataClases->result() as $fila_2){   
                                            if($fila->idCurso == $fila_2->idCurso){
                                                echo " ".$fila_2->descSalon;
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <input type="hidden" name="curso" id="curso">
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <form action="<?php echo base_url(); ?>index.php/administrador/crearClase" method="GET">
                        <button type="submit" class="btn btn-primary btn-md text-center">Registrar Nuevo Horario</button>
                    </form>
                    <form action="<?php echo base_url(); ?>index.php/administrador/verAltaEstudiante" method="GET">
                        <button type="submit" class="btn btn-info btn-md text-center">Dar de Alta Estudiante</button>
                    </form>
                    <form action="<?php echo base_url(); ?>index.php/administrador/verAltaProfesor" method="GET">
                        <button type="submit" class="btn btn-info btn-md text-center">Dar de Alta Profesor</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src = "<?php echo base_url(); ?>assets/js/tablesort.js"></script>
    </body>
</html>