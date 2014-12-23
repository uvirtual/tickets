<?php


/**
 * Config de moodle
 */
require "../config.php";
require_login();


/**
 * Variables globales de moodle
 */
global $USER;
global $DB;


/**
 *  Codigo para dar unicamente acceso a los perfiles de profesores que esten como estudiantes inscritos a un curso
 */


/**
 *  Verificamos que si el docente ya lleno el primer step de la solicitud del curso a fin de
 *
 * - ir al step 2
 * - evitamos que existan datos duplicados al llenar el step 2
 * - facilitamos al docente el llenado de solicitud de cursos
 *
 */

require_once "class/Solicitud.php";
$solicitud = new Solicitud();

$exist = $solicitud->existDocenteOnCourse($USER->firstname,$USER->email);
if($exist["valid"] == true)
{
    $_SESSION["id"] = $exist["id"];
    $_SESSION["nombre"] = $exist["nombre"]." ".$exist["apellidos"];
    header("Location: http://172.16.20.21/moodle_2.6.3/solicitud/step1.php");

}

/**
 *  $params = contexto, nombre corto del curso, rol al que se le va dar acceso
 */
$params = array(50,'adc',5);

/**
 * SQL Sentence
 */

$sql = "SELECT u.id as docentes
FROM {role_assignments} ra, {user} u, {course} c, {context} cxt
WHERE ra.userid = u.id
AND ra.contextid = cxt.id
AND cxt.contextlevel =?
AND cxt.instanceid = c.id
AND c.shortname =?
AND roleid=?";

/**
 * Extraccion de tados sql
 */
$data = $DB->get_records_sql($sql,$params);

/**
 * Conver stdClass to Array
 */
$result = array();
foreach ($data as $key => $value) {
    $result[] = $value->docentes;
}

/**
 * Verificamos si el id de usuario loguiado existe como estudiante en el curso seleccionado
 */

if(! in_array($USER->id,$result))
{
    header("Location: http://uvirtual.ucimed.com");
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apertura de Cursos - Aula Virtual</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	body{
    		background: #273990;
    	}
    	.container{
    		background: #FFFFFF;
    		border-radius: 5px;
    	}
        .login-or {
    position: relative;
    font-size: 18px;
    color: #aaa;
    margin-top: 10px;
            margin-bottom: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .span-or {
    display: block;
    position: absolute;
    left: 50%;
    top: -2px;
    margin-left: -80px;
    background-color: #fff;
    width: 200px;
    text-align: center;
  }
  .hr-or {
    background-color: #cdcdcd;
    height: 1px;
    margin-top: 0px !important;
    margin-bottom: 0px !important;
  }
    </style>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/step1.js"></script>

  </head>
  <body>
	  <div class="container">
          <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form class="form-horizontal" role="form" method="post" action="procesos/proceso_step1.php">
            <fieldset>

              <!-- Form Name -->
              <img src="img/uvirtual.jpg" alt="logo" height="100" width="200">
              <div class="login-or">
                <hr class="hr-or">
                <span class="span-or">Informacion Personal</span>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-sm-2 control-label" for="textinput">Nombre</label>
                <div class="col-sm-4">
                  <input type="text" placeholder="Nombre" name="nombre" id="nombre" class="form-control" value="<?php echo $USER->firstname;?>" readonly>
                </div>

                <label class="col-sm-2 control-label" for="textinput">Apellidos</label>
                <div class="col-sm-4">
                  <input type="text" placeholder="Apellidos" name="apellidos" id="apellidos" class="form-control" value="<?php echo $USER->lastname;?>" readonly>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-sm-2 control-label" for="textinput">Cedula</label>
                <div class="col-sm-4" id="cedula-group">
                  <input type="text" placeholder="Cedula" name="cedula" id="cedula" class="form-control">
                </div>

                <label class="col-sm-2 control-label" for="textinput">Correo</label>
                <div class="col-sm-4" id="correo-group">
                  <input type="text" placeholder="Correo" name="correo" id="correo" class="form-control" value="<?php echo $USER->email;?>" readonly>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-sm-2 control-label" for="textinput">Tel Oficina</label>
                <div class="col-sm-4" id="telefono-group">
                  <input type="text" placeholder="Telefono" name="telefono" id="telefono" class="form-control">
                </div>

                <label class="col-sm-2 control-label" for="textinput">Tel Celular</label>
                <div class="col-sm-4" id="celular-group">
                  <input type="text" placeholder="Celular" name="celular" id="celular" class="form-control">
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-sm-6 control-label" for="textinput">CÃ¡tedra, secciÃ³n o departamento al que pertenece</label>
                <div class="col-sm-6" id="departamento-group">
                  <input type="text" placeholder="Espeficique aqui" name="departamento" id="departamento" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="pull-right">
                    <button type="submit" id="paso2" class="btn btn-primary">Siguiente Paso</button>
                  </div>
                </div>
              </div>

            </fieldset>
          </form>
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
</div>


  </body>
</html>