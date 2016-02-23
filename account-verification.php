<?php
	include "back/user-auth.php";
	include "back/containment.php";

	$idUser = $_GET["idUser"];
	$token = $_GET["token"];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Verficiaci&oacute;n</title>
	<meta name="author" content="Yanku" />
	<meta name="description" content="Integridad ecosistémica en México" />
	<meta name="keywords"  content="ecosistema" />
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="css/scroll.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/jquery.fullPage.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({

			});
		});
	</script>

</head>
<body id="verify">

<?php include 'header.php'; ?>

<div id="fullpage">
    <div class="section" id="section5">
        <h2 class="titulo-seccion">Proceso de verificación</h2>
        <?php	
		$result = getUserContent($_GET["idUser"], $_GET["token"]);
        if($result !== false)
        {
?>
				<p>Tu dirección de correo fue verificada con éxito. Por favor asigna una contraseña a tu cuenta.</p>
                
                <form role="form" method="POST" action="back/accounts.php?actionMethod=assignPassword&idUser=<?php echo $idUser ?>&token=<?php echo $token ?>" class="form-validate">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" size="30" maxlength="100" required>
                </div>
                <div class="form-group">
                    <label for="password2">Confirmación</label>
                    <input type="password" class="form-control" id="password2" name="password2" size="30" maxlength="100" required>
                </div>
                <?php 
                $mensaje = $_GET["message"];
                    if($mensaje != ""){?>
                        <p class="error"><?php echo $mensaje; ?></p>
                <?php	}
                ?>
                <button class="btn btn-default" type="submit" onclick="javascript:return myValidator(userForm, 'saveUser');">Guardar</button>
            </form>
<?php
		}
		else
		{
?>
			<p>La verificación de tu email ha expirado o el email es invalido. Rev&iacute;salo con tu administrador.</p>
<?php
		} ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>