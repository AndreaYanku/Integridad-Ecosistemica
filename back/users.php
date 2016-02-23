<?php
	
	$dsn = "mysql:localhost;port=3306;dbname=yankuser_integridad";
    $DBUser = "yankuser_ie";
    $DBPassword = "wfPyv_FJ.s86";

	if(isset($_GET["actionMethod"]))
	{
		switch($_GET["actionMethod"])
		{
			case "IU":
				if(isset($_POST["id"]) & $_POST["id"]!=0)
                {
					updateUser();
                }else{
					insertUser();
                }
			break;
            case "update":
                updateUser($_POST["idUser"]);
            break;
			case "delete":
				deleteUser($_GET["idUser"]);
			break;
			case "changeActive":
				changeActive($_GET["idUser"],$_GET["active"]);
			break;
			
		}
	}
	
	
	function getUser($field,$value)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM user WHERE ".$field."=:".$field;
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':'.$field, $value);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            // var_dump($row);
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}

    function getUserPolygons($field,$value)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM polygon WHERE ".$field."=:".$field;
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':'.$field, $value);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetchAll();
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}

    function getPolygon($idPolygon)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM polygon WHERE idPolygon=:idPolygon";
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':idPolygon', $idPolygon);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}

	function getUserWhere($field,$value)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM user WHERE ".$field."=:".$field;
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':'.$field, $value);

            $stmt->execute();
		
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetchAll();
            // var_dump($row);
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}
	
	function isFirst($idUser)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM user WHERE idUser=:idUser";
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);
	
			$stmt->bindParam(':idUser', $idUser);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetchAll();
            // var_dump($row);
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}
	
	function getUsers()
	{
		global	$dsn, $DBUser, $DBPassword;
		
		$query = "SELECT * FROM user";
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetchAll();
            // var_dump($row);
            return $row;
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
	}

	function insertUser()
	{
		global	$dsn, $DBUser, $DBPassword;
        
		
		if(isset($_POST["name"], $_POST["email"]))
        {
			if(recordExist($_POST["email"]) == false)
			{  
				try 
				{
					$query = "INSERT INTO user(email, name, role, active) values (:email, :name,'1','0')";
					$conn = new PDO($dsn, $DBUser, $DBPassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare($query);

					$tempPass =password_hash($_POST["password"], PASSWORD_DEFAULT);

					$stmt->bindParam(':email', $_POST["email"]);
					$stmt->bindParam(':name', $_POST["name"]);				
					
					$stmt->execute();

					if($stmt == true)
					{
						return true;
					}
					else{
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
				$redirect = "Location: ../info.php?result=error&message=".rawurlencode("Ya hay un usuario registrado con ese correo electr&oacute;nico");
				header($redirect);
				return false;
			}
		}
		else{
			// Redirect to info page and displays an error message
			$redirect = "Location: ../info.php?result=error&message=".rawurlencode("No se pudo insertar el usuario");
			header($redirect);
			return false;
		}
	}

    function deleteUser($idUser)
    {
        global $dsn, $DBUser, $DBPassword;

        try 
        {
            $query = "DELETE FROM user WHERE idUser = :idUser";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':idUser', $idUser);
            $stmt->execute();

            if($stmt == true)
            {
                $redirect = "Location: ../info.php?result=ok&message=".rawurlencode("Se ha eliminado el usuario exitosamente.");
                header($redirect); 
            }
            else{
                $redirect = "Location: ../info.php?result=error&message=".rawurlencode("No se pudo eliminar el usuario.");
                header($redirect);
            }
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
            return false;
        }
    }
	
	function recordExist($email)
    {
		global	$dsn, $DBUser, $DBPassword;
        
        $query = "SELECT * FROM user WHERE email = :email";
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            $rowNo = $stmt->rowCount();
            if($rowNo == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
    }
	
	function setLock($idUser,$value)
    {
        global $dsn, $DBUser, $DBPassword;

        try 
        {
            $query = "UPDATE user SET active = :active WHERE idUser = :idUser";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':active', $value);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->execute();

            if($stmt == true)
            {
                return true; 
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
            return false;
        }
    }
	function changeActive($idUser,$value)
    {
        global $dsn, $DBUser, $DBPassword;

        try 
        {
            $query = "UPDATE user SET active = :active WHERE idUser = :idUser";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':active', $value);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->execute();

            if($stmt == true)
            {
                $redirect = "Location: ../info.php?result=ok&message=".rawurlencode("Se ha cambiado el estado del usuario exitosamente.");
                header($redirect); 
            }
            else{
                $redirect = "Location: ../info.php?result=error&message=".rawurlencode("No se pudo cambiar el estado del usuario.");
                header($redirect);
            }
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
            return false;
        }
    }
	
	function generateNewRandomPassword($email)
    {
		global	$dsn, $DBUser, $DBPassword;
        
        $query = "SELECT * FROM user WHERE email = :email";
		
		try 
        {
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $_POST["email"]);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();

            $rowNo = $stmt->rowCount();
            if($rowNo == 0){
                $redirect = "Location: ../info.php?result=error&message=".rawurlencode("El email proporcionado no esta registrado en el sistema de Integridad Ecosistémica");
                header($redirect);
                return false;
            }
            else{
                // Generate new password
				$key = rand()*rand();
                $tempPass =password_hash($key, PASSWORD_DEFAULT);
                
                
                // Update the user with the password generated previously
                $query = "UPDATE user SET password = :password WHERE idUser = :idUser";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':password', $tempPass);
                $stmt->bindParam(':idUser', $row["idUser"]);
                
                $stmt->execute();
                
                if($stmt == true)
                {
                    return $key; 
                }
            }
        }
        catch (PDOException $e) { 
            var_dump($e->getMessage());
        }
    }

	function updateUser($idUser)
	{
		global	$dsn, $DBUser, $DBPassword;
        
		//var_dump($_POST);
		if(isset($_POST["idUser"], $_POST["email"], $_POST["name"]))
		{
			$query = "UPDATE user SET email = :email, name =:name WHERE idUser = :idUser";
			try 
			{
				$conn = new PDO($dsn, $DBUser, $DBPassword);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare($query);
	
				$stmt->bindParam(':email', $_POST["email"]);
				$stmt->bindParam(':name', $_POST["name"]);
				$stmt->bindParam(':idUser', $idUser);
				$stmt->execute();
	
				if($stmt == true)
				{
					$redirect = "Location: ../info.php?result=ok&message=".rawurlencode("La actualizaci&oacute;n ha sido correcta");
					header($redirect);
				}
				else{
					$redirect = "Location: ../info.php?result=error&message=".rawurlencode("La actualizaci&oacute;n ha sido incorrecta");
					header($redirect);
				}
			}catch (PDOException $e) { 
				var_dump($e->getMessage());
				if($stmt->errorCode() == 23000)
				{
					$redirect = "Location: ../info.php?result=error&message=".rawurlencode("La actualizaci&oacute;n ha sido incorrecta");
					header($redirect);
				}
			}
		}
		else{
			$redirect = "Location: ../info.php?result=error&message=".rawurlencode("Los datos no son correctos");
			header($redirect);
		}
	}
?>