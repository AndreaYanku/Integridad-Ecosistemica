<?php
session_start(); 
if(isset($_SESSION['idAdm1n']) && !empty($_SESSION['idAdm1n'])) {  
}
else{
    $redirect = "Location: ../info.php?result=error&message=".rawurlencode("No tienes los permisos suficientes para ver usuarios");
    header($redirect);	
}	
$sec = "new-user";
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Nuevo Usuario</title>
	<meta name="author" content="Yanku" />
	<meta name="description" content="Integridad ecosistémica en México" />
	<meta name="keywords"  content="ecosistema" />
    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'header.php'; ?>
    
<div class="admin">
    <h2>Registro Nuevo Usuario</h2>
    <form method="POST" action="../back/accounts.php?actionMethod=create" class="form-admin">
        <div class="form-group">
            <label for="username">Email</label>
            <input class="form-control" type="text" id="email" name="email" size="30" value="" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="username">Nombre</label>
            <input class="form-control" type="text" id="name" name="name" size="30" value="" maxlength="100" required>
        </div>
        <button class="btn btn-default" type="submit" onclick="javascript:return myValidator(userForm, 'saveUser');">Registrar</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>