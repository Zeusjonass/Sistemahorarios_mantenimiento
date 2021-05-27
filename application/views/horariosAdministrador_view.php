<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/horariosAdministrador.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>Horarios</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png"/>
        <script>
            function validarOpcion(opcion){
                form=document.getElementById("form");
                if(opcion=='borrar'){
                    form.action='<?php echo base_url(); ?>index.php/administrador/borrarClase';
                }
                else{
                    form.action='<?php echo base_url(); ?>index.php/administrador/editarClase';
                }
                form.submit();
            }
        </script>
    </head>   
    <body>
        <?php $cursoObtenido = $dataCurso->row();?>
        <div class="container-fluid ">
        	<div class="row">
        		<div class="col-12 header text-center mt-2">
        			<h4>Grupo <?php echo $cursoObtenido->idCurso;?></h4>
        		</div>
                <div class="col-12">
                    <form action="<?php echo base_url(); ?>index.php/administrador/verCursos" method="GET">
                        <button type="submit" class="btn btn-dark btn-sm float-left">Regresar</button>
                    </form>
                </div>
        	</div>

        	<div class="row justify-content-center">
        		<div class="col-6 text-center">
        			<p>Profesor : <?php if ( isset( $cursoObtenido ) ){ echo $cursoObtenido->NomProf; }?></p>
        			<p>Materia : <?php if ( isset( $cursoObtenido ) ){ echo $cursoObtenido->DescMat; }?></p>
        		</div>
        	</div>
            <div class="row justify-content-center">
                <div class="col-12 text-center table-responsive">
                    <form action="" method="POST" id="form">
                    <input type="hidden" name="curso" value=<?php echo $cursoObtenido->idCurso ?>>
                    <table class="table">
                        <tr>
                            <th scope="col"><p>Lunes</p></th>
                            <?php foreach ($dataTable->result() as $mostrar) {
                                if( $mostrar->Dia == 'Lunes' ){
                                    echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar->idClase." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar->DescMat."<br>Profesor: ".$mostrar->NomProf."<br>Hora Inicio: ".$mostrar->HoraInicio."<br>Hora final: ".$mostrar->HoraFin."<br>Salon: ".$mostrar->DescSalon;
                                    echo "</label>";
                                    echo "</td>";
                                    
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col"><p>Martes</p></th>
                            <?php foreach ($dataTable->result() as $mostrar2) {
                                if( $mostrar2->Dia == 'Martes' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar2->idClase." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar2->DescMat."<br>Profesor: ".$mostrar2->NomProf."<br>Hora Inicio: ".$mostrar2->HoraInicio."<br>Hora final: ".$mostrar2->HoraFin."<br>Salon: ".$mostrar2->DescSalon;
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col"><p>Miércoles</p></th>
                            <?php foreach ($dataTable->result() as $mostrar3) { 
                                if( $mostrar3->Dia == 'Miercoles' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar3->idClase." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar3->DescMat."<br>Profesor: ".$mostrar3->NomProf."<br>Hora Inicio: ".$mostrar3->HoraInicio."<br>Hora final: ".$mostrar3->HoraFin."<br>Salon: ".$mostrar3->DescSalon;
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col"><p>Jueves</p></th>
                            <?php foreach ($dataTable->result() as $mostrar4) { 
                                if( $mostrar4->Dia == 'Jueves' ){
                            		echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar4->idClase." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar4->DescMat."<br>Profesor: ".$mostrar4->NomProf."<br>Hora Inicio: ".$mostrar4->HoraInicio."<br>Hora final: ".$mostrar4->HoraFin."<br>Salon: ".$mostrar4->DescSalon;
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col"><p>Viernes</p></th>
                            <?php foreach ($dataTable->result() as $mostrar5) {
                                if( $mostrar5->Dia == 'Viernes' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar5->idClase." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar5->DescMat."<br>Profesor: ".$mostrar5->NomProf."<br>Hora Inicio: ".$mostrar5->HoraInicio."<br>Hora final: ".$mostrar5->HoraFin."<br>Salon: ".$mostrar5->DescSalon;
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                    </table>
                    <button type="input" class="btn btn-danger btn-md" onclick="validarOpcion('borrar')">Borrar</button>
                    <button type="input" class="btn btn-success btn-md" onclick="validarOpcion('editar')">Editar</button><br><br>
                    </form >
                </div>
            </div>
        </div>
    </body>
</html> 