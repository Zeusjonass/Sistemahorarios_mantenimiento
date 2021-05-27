<html> 
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/registrarHorario.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        
        <title>Alta Estudiante</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/uady.png" />
    </head>
    <body>
        <?php
        $usuario = $this->session->userdata('usuario');
        if(empty($usuario)) redirect('Login/logout');
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 header text-center mt-3 mb-3">
                    <h3>Dar de alta un Estudiante</h3>
                    <form action="<?php echo base_url(); ?>index.php/administrador/verCursos" method="GET">
                        <button type="submit" class="btn btn-dark float-left">Regresar</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <form action="<?php echo base_url(); ?>index.php/administrador/altaEstudiante" method="POST">
                <div class="formulario">
                    <div>
                        <label>
                            Nombre: 
                            <input class="form-control" type="text" name="NomAlum" required="true">
                        </label>
                    </div>
                    <div>
                        <label>
                            Licenciatura: 
                            <input class="form-control" type="text" name="Licenciatura" required="true">
                        </label>
                    </div>
                    <div>
                        <label>
                            ID de Usuario: 
                            <input class="form-control" type="text" name="idUsuario" required="true">
                        </label>
                    </div>
                    <div>
                        <label>
                            Contraseña: 
                            <input class="form-control" type="password" name="Password" required="true">
                        </label>
                    </div><br>
                    <div>
                        <input class="btn btn-success"type="submit" value="Guardar">
                    </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </body> 
</html>