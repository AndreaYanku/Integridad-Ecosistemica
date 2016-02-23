<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Info</title>
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
<body id="info">

<?php include 'header.php'; ?>

<div id="fullpage">
    <div class="section" id="section4">
        <?php 
        if(isset($_GET["result"],$_GET["message"])){
            $resultado = $_GET["result"];
            $mensaje = $_GET["message"];	
        }
        ?>
        <h2 class="titulo-seccion"><?php echo $mensaje; ?></h2>
        <a href="index.php" class="btn btn-default">Ir a inicio</a>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>