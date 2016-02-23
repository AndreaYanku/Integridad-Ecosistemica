<?php
	include "../back/user-auth.php";
    verify();
	if(!$_SESSION['idAdm1n']){
		$redirect = "Location: ../info.php?result=error&message=".rawurlencode("No tienes los permisos suficientes para ver usuarios");
		header($redirect);	
	}
	include "../back/users.php";
    $polygon = getPolygon($_GET['idPolygon']);
    $record = getUser("idUser",$polygon["idUser"]);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $sec = "admin"; ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Integridad Ecosistémica | Admin</title>
    <meta name="author" content="Yanku" />
    <meta name="description" content="Integridad ecosistémica en México" />
    <meta name="keywords"  content="ecosistema" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

        <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <link rel="stylesheet" href="../leaflet-0.7.3/leaflet.css" />

    <script>
    var pubThis;
    </script>
    <script src="../leaflet-0.7.3/leaflet-src.js"></script>

    <script src="../js/rastercoords.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?v=3"></script>
    <script src="../js/Google.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
    
<body onload="iniciar()" onresize="cambia()">
    <script type='text/javascript'>
        var screen = $(document).width();

        if(screen < 900){
            alert("Esta sección no ha sido desarrollada para pantallas menores a 900px");
            window.location.assign("http://integridadecosistemica.info/index.php");
        }
    </script>
    
    <?php include 'header.php'; ?>

    <div class="admin" id="mapa-admin">
        <p>Usuario: <?php echo $record['name']; ?></p>
        <p>Polígono: <?php echo $polygon['idPolygon']; ?></p>
        <p>Fecha: <?php echo $polygon['timestamp']; ?></p>
        <p>Integridad Ecosistémica: <?php echo $polygon['ie']; ?>%</p>
        <p>Motivo: <br><?php echo $polygon['reason']; ?></p>
        <div id="datos" style="display:none">
            <?php
            echo $polygon["data"];
            ?>
        </div>
        <div id="cuadro-mapa">
            <p class="exito"><?php echo $mensaje; ?></p>
            <div id='swipe'>
                <div id='handle'>drag</div>
            </div>  
            <div id="map"></div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>