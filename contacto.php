<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $sec = "contacto"; ?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Contacto</title>
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
    <div class="section" id="formulario">
        <div class="col-md-5 copy-form">
            <img src="img/logo.png" width="200" class="logo-inner">
            <h4>Queremos saber más de ti, déjanos tus datos, colabora con nosotros y sé parte de la historia de este diverso país.</h4>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 form-fields">
            <form action="sendmail.php" method="post" role="form">
              <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" value="<?php echo $_SESSION['username'] ?>" name="name" required>
              </div>
              <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" name="email" required>
              </div>
              <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea id="comment" name="comment" class="form-control" rows="4" cols="50" required></textarea>
              </div>
              
              <button type="submit" class="btn btn-default">Enviar</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>