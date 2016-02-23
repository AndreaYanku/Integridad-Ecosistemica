<?php
    session_start(); 
    if(isset($_SESSION['idAdm1n']) && !empty($_SESSION['idAdm1n'])) {  
    }
    else{
        $redirect = "Location: ../info.php?result=error&message=".rawurlencode("No tienes los permisos suficientes para ver usuarios");
        header($redirect);	
    }
	include "../back/users.php";
	$records = getUsers();
    $sec = "usuarios";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica | Usuarios</title>
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
    <h2>Usuarios Registrados</h2>
    <div class="box">
        <table style="width:100%" border="1">
          <tr>
            <th>ID</th>
            <th>Email</th> 
            <th>Nombre</th>
            <th>Rol</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>            
        <?php	
            foreach($records as $record){		
                echo "<tr>";          
                echo "<td>".$record['idUser']."</a></td>";
                echo "<td>".$record["email"]."</td>";
                echo "<td>".$record["name"]."</td>";
                if($record["role"]==0)
                    $rol ="Admin";
                elseif($record["role"]==1)
                    $rol = "Usuario";				
                echo "<td>".$rol."</td>";
                if($record["active"]==0)
                    $activo ="No";
                else
                    $activo = "Si";
                echo "<td>".$activo."</td>";
                if($record["active"]==1)
                    echo "<td><a href='user.php?idUser=".$record['idUser']."'>Ver</a>";
                else
                    echo "<td>";
                echo "<br><a href='../back/users.php?actionMethod=delete&idUser=".$record['idUser']."'>Borrar</a></td>";
                echo "</tr>";
            }?>
            </table>
    </div>

</div>

<?php include 'footer.php'; ?>
</body>
</html>