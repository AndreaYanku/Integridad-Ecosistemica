<?php
	include "back/user-auth.php";
    verify();
	include "back/users.php";
	
	if($_SESSION['idUser'])
		$idUser = $_SESSION['idUser'];
	if($_SESSION['idAdm1n'])
		$idUser = $_SESSION['idAdm1n'];
	
	$record = getUser("idUser",$idUser);
    $sec = "user"; 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $sec = "user"; ?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Cuenta</title>
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
<body>

<?php include 'header.php'; ?>
    
<div id="fullpage">
    <div class="section" id="section4">
        <div class="col-md-6">         
            <h2 class="titulo-seccion">Cuenta</h2>
            <form role="form" method="POST" action="back/users.php?actionMethod=update" class="form-validate">
                <input name="idUser" value="<?php echo $record["idUser"]?>" hidden="">
                <input name="name" value="<?php echo $record["name"]?>" hidden="">
                <input name="email" value="<?php echo $record["email"]?>" hidden="">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <p><?php echo $record["email"]?></p>
                </div>
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $record["name"]?>">
                </div>
                <button class="btn btn-default" type="submit" onclick="javascript:return myValidator(userForm, 'saveUser');">Guardar</button>
            </form>
        </div>
        <div class="col-md-6 form-fields">
            <h2 class="titulo-seccion">Cambio de contraseña</h2>
            <form role="form" method="POST" action="back/accounts.php?actionMethod=updatePassword&idUser=<?php echo $idUser ?>" class="form-validate">
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
                <button class="btn btn-default" type="submit" onclick="javascript:return myValidator(userForm, 'saveUser');">Cambiar</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>