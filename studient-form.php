<html lang="es">
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>U VIrtual | Soporte | TICKETS</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="/images/mifavicon.png" />
<!-- bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    </head>
    <body> 

        <div class="container">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div id="menu" name="menu">
                    <?php 
                        include 'brand-nav.php';
                    ?>
                    </div>
                    <h1 class="panel-title">Consulta Estudiante</h1>
                </div>
                
                

                <div class="panel-body" style="padding : 0 10%">
                    <div id="breadc" name="breadc">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="#">Casos</a></li>
                            <li><a href="#">Nuevo Caso</a></li>
                            <li class="active"><a href="studient-form.php">Estudiantes</a></li>
                        </ol>
                    </div>
                        
                        <form class="form-horizontal" role="form" method="post" action="procesos/proceso_step1.php">
                            
                            <div class="input-group" style="padding : 20px">
                                <span class="input-group-addon">Tipo de Consulta</span>
                                <select class="form-control">
                                  <option value="pass" selected>Reinicio de Contraseña</option>
                                  <option value="matri">Matricula de Curso</option>
                                  <option value="vw">Consulta</option>
                                  <option value="audi" >UpToDate</option>
                                </select>
                            </div> <!-- input-group -->
                            
                            <div class="input-group" style="padding : 20px">
                                <span class="input-group-addon">ID</span>
                                <input type="text" class="form-control" placeholder="Número de Carnet">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="E-Mail">                                
                            </div> <!-- input-group -->

                            <div class="input-group" style="padding : 20px">                            
                                <span class="input-group-addon">Comentarios</span>
                                <textarea rows="4" cols="50" class="form-control" placeholder="...">
                                </textarea>
                            </div> <!-- input-group -->
                           <!--
                            <div class="input-group pull-right" align="rigth" style="padding : 20px; float: right">
                                <button class="form-control btn btn-primary" type="button">Enviar</button>
                                
                            </div> <!-- input-group -->
                            
                            <div class="input-group pull-right" align="rigth" style="padding : 20px">
                                <button type="submit" id="enviar" class="btn btn-primary">Enviar</button>
                            </div>                            
                       </form>
                           
                </div><!--!panel panel-body -->
            </div><!--!panel panel-primary -->
            
        </div><!-- Container-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
  </body>

</html>