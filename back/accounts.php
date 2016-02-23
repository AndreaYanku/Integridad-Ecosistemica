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
			case "create":
				createAccount();
			break;
			case "unlock":
				unlockAccount();
			break;
            case "recoverPassword":
				recoverPassword();
			break;
			case "assignPassword":
				insertPassword($_GET["idUser"]);
			break;
			case "updatePassword":
				updatePassword($_GET["idUser"]);
			break;
		}
	}

    function createAccount()
    {
        // Insert data user
        $r = insertUser();
		if($r !== false)
		{
			// Lock the user
			$passport = lockAccount();

			// Send email confirmation to the user
            // email, title, text, linkText, link
			$text = "Bienvenido al sistema de Integridad Ecosistémica.<br><br>Haz clic en el enlace incluido en este mensaje para verificar que eres el propietario de esta dirección y puedas comenzar a utilizar la plataforma.";
            // email, title, text, linkText, link
            sendEmail($_POST["email"], "Verificación de cuenta", $text, "Activa tu cuenta", $passport);
            $redirect = "Location: ../info.php?result=success&message=".rawurlencode("El usuario ha sido agregado exitosamente. Deberá revisar su correo para activar la cuenta.");
            header($redirect);
		}
    }
	
	function insertPassword($idUser)
	{
		global	$dsn, $DBUser, $DBPassword;
		
		if(isset($_POST["password"], $_POST["password2"]))
        {
			if($_POST["password"]==$_POST["password2"]){
				try 
				{
					$query = "UPDATE user SET password = :password WHERE idUser = :idUser";
					$conn = new PDO($dsn, $DBUser, $DBPassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare($query);
	
					$tempPass =password_hash($_POST["password"], PASSWORD_DEFAULT);
	
					$stmt->bindParam(':password', $tempPass);
					$stmt->bindParam(':idUser', $idUser);			
					$stmt->execute();
	
					if($stmt == true)
					{
						$uA = unlockAccount();
						if($uA != false){
							// Redirect to info page and displays an error message
							$redirect = "Location: ../login.php?result=success&message=".rawurlencode("La cuenta se encuentra lista. Inicia sesi&oacute;n para disfrutar de los beneficios");
							header($redirect);
							return true;
						}
						else{
							return false;
						}
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
				$redirect = "Location: ../account-verification.php?idUser=".$_GET['idUser']."&token=".$_GET['token']."&message=".rawurlencode("No coinciden las contraseñas. Favor de verificarlas");
				header($redirect);
				return false;
			}
		}
		else{
			// Redirect to info page and displays an error message
			$redirect = "Location: ../info.php?result=error&message=".rawurlencode("No coinciden las contraseñas");
			header($redirect);
			return false;
		}
	}
	
	function updatePassword($idUser)
	{
		global	$dsn, $DBUser, $DBPassword;
        
		if(isset($_POST["password"], $_POST["password2"]))
        {
			if($_POST["password"]==$_POST["password2"]){
				try 
				{
					$query = "UPDATE user SET password = :password WHERE idUser = :idUser";
					$conn = new PDO($dsn, $DBUser, $DBPassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare($query);
	
					$tempPass =password_hash($_POST["password"], PASSWORD_DEFAULT);
	
					$stmt->bindParam(':password', $tempPass);
					$stmt->bindParam(':idUser', $idUser);			
					$stmt->execute();
	
					if($stmt == true)
					{
						session_start(); 
						session_regenerate_id(true);
						
						// Unset all of the session variables.
						$_SESSION = array();
				
						// If it's desired to kill the session, also delete the session cookie.
						// Note: This will destroy the session, and not just the session data!
						if (ini_get("session.use_cookies")) 
						{
							$params = session_get_cookie_params();
							setcookie(session_name(), '', time() - 42000,
								$params["path"], $params["domain"],
								$params["secure"], $params["httponly"]
							);
						}
						// Finally, destroy the session.
						session_destroy();
						
						$redirect = "Location: ../login.php?result=success&message=".rawurlencode("Tu contrase&ntilde;a ha sido cambiada exitosamente. Favor de iniciar sesi&oacute;n.");
						header($redirect);
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
				$redirect = "Location: ../new_password.php?idUser=".$_GET['idUser']."&message=".rawurlencode("No coinciden las contraseñas. Favor de verificarlas");
				header($redirect);
				return false;
			}
		}
		else{
			// Redirect to info page and displays an error message
			$redirect = "Location: ../info.php?result=error&message=".rawurlencode("No coinciden las contraseñas");
			header($redirect);
			return false;
		}
	}
	

    function lockAccount()
    {
        $record = getUser("email",$_POST["email"]);
        // Contain user. By default is contained in the DB, but we assure that state
        return insertUserContent($record["idUser"]);
    }

    function unlockAccount()
    {
		// Update User
		setLock($_GET["idUser"],1);
		//Delte user email from containment
		deleteUserContent($_GET["idUser"]);
		return true;
    }

    function recoverPassword()
    {
        $newPass = generateNewRandomPassword($_POST["email"]);
        sendEmail($_POST["email"], "Recuperación de contraseña", "Tu nuevo password es:" . $newPass, "Ir a Integridad Ecosistémica", "");
        // Redirec to info page and displays an ok message
        $redirect = "Location: ../info.php?result=ok&message=".rawurlencode("Se ha enviado un email para recuperar tu password");
        header($redirect);
    }
?>