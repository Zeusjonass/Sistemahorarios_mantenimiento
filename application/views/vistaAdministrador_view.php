<html>
    <head>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/vistaAdmin.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminTable.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png" />
        <title>Administrador</title>
        <script>
            function errorMessage(num){
                if(num==1){
                    alert("Las clases deben durar 2 horas o menos");
                }else if(num==2){
                    alert("La hora final debe ir despues de la hora de inicio");
                }else if(num==3){
                    alert("No pueden haber 2 clases del mismo grupo el mismo día");
                }else if(num==4){
                    alert("Otro grupo tiene el horario deseado");
                }else if(num==5){
                    alert("Se actualizó el horario de manera correcta");
                }
            }

            function verClases(row){
                document.getElementById("curso").value = row.id;
                document.getElementById("verClases").submit();
            }
        </script>
    </head>   

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3 mb-3 header text-center">
                    <h4>Bienvenido Administrador</h4>
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
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <?php
                    if (isset($error)) {
                        $num=$error;
                    ?>
                    <script type="text/javascript">
                        errorMessage(<?php echo $num; ?>);
                    </script>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src = "<?php echo base_url(); ?>assets/js/tablesort.js"></script>

    </body>
</html>