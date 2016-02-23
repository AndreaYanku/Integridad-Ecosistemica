<?php
	require "users.php";
	require "containment.php";
    require_once "sendEmail.php";
	
    $dsnAuth = "mysql:localhost;port=3306;dbname=yankuser_integridad";
    $DBUserAuth = "yankuser_ie";
    $DBPasswordAuth = "wfPyv_FJ.s86";

    // var_dump($_POST);
    foreach($_POST as &$v)
    {
        $v = strip_tags($v);
    }
    // var_dump($_POST);

	if(isset($_GET["actionMethod"]))
	{
		switch($_GET["actionMethod"])
		{
			case "add":
				addPolygon($_POST["idUser"]);
			break;
		}
	}

	function addPolygon($idUser)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		if(isset($_POST["r1"], $_POST["comentario"], $_POST["datos"]))
        {
            try 
            {
                $query = "INSERT INTO polygon(idUser, ie, reason, data, timestamp) values (:idUser, :ie, :reason, :data, :timestamp)";
                $conn = new PDO($dsn, $DBUser, $DBPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($query);
                
                $date = date("Y-m-d H:i:s");
                
                $stmt->bindParam(':idUser', $idUser);
                $stmt->bindParam(':ie', $_POST["r1"]);
                $stmt->bindParam(':reason', $_POST["comentario"]);
                $stmt->bindParam(':data', $_POST["datos"]);
                $stmt->bindParam(':timestamp', $date);

                $stmt->execute();

                if($stmt == true)
                {
                    $redirect = "Location: ../mapa.php?result=success&message=".rawurlencode("Los datos han sido guardados exitosamente. Puedes añadir tantos polígonos como desees.");
                    header($redirect);
                    return true;
                }
                else{
                    $redirect = "Location: ../info.php?result=error&message=".rawurlencode("No ha sido posible guardar los valores. Intenta de nuevo");
			        header($redirect);
                    return false;
                }
            }
            catch (PDOException $e) { 
                var_dump($e->getMessage());
                if($stmt->errorCode() == 23000)
                {
                    return false;
                }
            }
		}
		else{
			// Redirect to info page and displays an error message
			$redirect = "Location: ../info.php?result=error&message=".rawurlencode("Los parámetros no son correctos");
			header($redirect);
			return false;
		}
	}
?>