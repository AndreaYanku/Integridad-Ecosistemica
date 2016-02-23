<?php
	include "../back/user-auth.php";
    verify();
	if(!$_SESSION['idAdm1n']){
		$redirect = "Location: ../info.php?result=error&message=".rawurlencode("No tienes los permisos suficientes para ver usuarios");
		header($redirect);	
	}
	include "../back/users.php";
	$record = getUser("idUser",$_GET['idUser']);
    $polygons = getUserPolygons("idUser",$_GET['idUser']);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $sec = "admin"; ?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Usuario</title>
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
    <h2><?php echo $record['name']; ?></h2>
    <table style="width:100%" border="1">
        <tr>
            <th>ID Polígono</th>
            <th>Integridad</th> 
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        <?php
        foreach($polygons as $polygon){
            echo "<tr>";          
                echo "<td>".$polygon['idPolygon']."</a></td>";
                echo "<td>".$polygon["ie"]."%</td>";
                echo "<td>".$polygon["reason"]."</td>";
                echo "<td>".$polygon["timestamp"]."</td>";
                echo "<td><a href='polygon.php?idPolygon=".$polygon['idPolygon']."'>Ver</a></td>";
            echo "</tr>";
        }?>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>