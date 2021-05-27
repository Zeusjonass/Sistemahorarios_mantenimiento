<html>
<head>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png"/>
	<title>Editar clase</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			background: url('<?php echo base_url(); ?>assets/img/schedule.jpg') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
			backdrop-filter: blur(4px);
		}
		.formulario{
			background-color: rgba(26,53,90,.8);
			border-radius: 15px;
			box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.61);
		}
		.formulario label p {
			color: white;
		}
		.formulario h2{
			color: white;
		}
	</style>
	<script>
            function errorMessage(num){
                if (num==1) {
                    alert("Las clases deben durar 2 horas o menos");
                }else if (num==2) {
                    alert("La hora final debe ir después de la hora de inicio");
                }else if (num==3) {
                    alert("No pueden haber 2 clases del mismo grupo el mismo día");
                }else if (num==4) {
                    alert("Otro grupo tiene el horario deseado");
                }else if (num==5) {
                    alert("Se actualizó el horario de manera correcta");
                }
            }
        </script>
</head>
<body>
	<?php
	$usuario = $this->session->userdata('usuario');
	if(empty($id)) redirect('Login/logout');
	?>
	<div class="container-fluid min-vh-100">
		<div class="row justify-content-center">
			<div class="col-12 text-center mt-3">
				<form action="<?php echo base_url(); ?>index.php/administrador/verClases" method="POST">
				<input type="hidden" value="<?php echo $curso; ?>" name="curso">
					<button type="submit" class="btn btn-dark btn-sm float-left">Regresar</button>
				</form>
			</div>
		</div>       
		<div class="form-row h-100 justify-content-center ">
			<div class="col-4 text-center my-auto">
				<div class="formulario">
					<br>
					<h2>Editar horario</h2><br>
					<form action="<?php echo base_url(); ?>index.php/administrador/editarHorario" method="POST">
						<input type="hidden" value="<?php echo $curso; ?>" name="curso">
						<?php $claseAEditar = $dataClase->row(); ?>
						<input type="hidden" value="<?php echo $claseAEditar->idClase; ?>" name="clase">

						<label><p>Hora inicio:</p>
							<input type="time" name="horaInicio" min="07:00"  max="21:00" required="true" step="1800" value="<?php echo $claseAEditar->HoraInicio ?>">
						</label><br>
						<label><p>Hora Fin: </p><input type="time" name="horaFin" required="true" min="07:00"  max="21:00" step="1800" value="<?php echo $claseAEditar->HoraFin ?>"></label><br>
						<label><p>Día: </p>
							<select name="dia" required="true">
								<option value="Lunes" <?php if($claseAEditar->Dia == "Lunes"){echo "selected";} ?> >Lunes</option>
								<option value="Martes" <?php if($claseAEditar->Dia == "Martes"){echo "selected";} ?> >Martes</option>
								<option value="Miercoles" <?php if($claseAEditar->Dia == "Miercoles"){echo "selected";} ?> >Miércoles</option>
								<option value="Jueves" <?php if($claseAEditar->Dia == "Jueves"){echo "selected";} ?> >Jueves</option>
								<option value="Viernes" <?php if($claseAEditar->Dia == "Viernes"){echo "selected";} ?> >Viernes</option>
							</select>
						</label><br>
						<label><p>Salón: </p>
							<select name="salon" required="true">
								<?php foreach ($dataSalon->result() as $salones) { 
									echo "<option ".(($claseAEditar->idSalon == $salones->idSalon)?'selected':"")." value=".$salones->idSalon.">".$salones->DescSalon."</option> ";
								} 
								?>
							</select>
						</label><br>
						<input type="submit" class="btn btn-dark btn-sm " value="Editar"><br><br>
					</form>
				</div>
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
</body>
</html>