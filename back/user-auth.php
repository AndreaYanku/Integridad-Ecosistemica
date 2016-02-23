<?php

    $domainAuth = "";

    $dsnAuth = "mysql:localhost;port=3306;dbname=yankuser_integridad";
    $DBUserAuth = "yankuser_ie";
    $DBPasswordAuth = "wfPyv_FJ.s86";


	foreach($_POST as &$v)
	{
		$v = strip_tags($v);
	}
	
	if(isset($_GET["actionMethod"])){
		switch ($_GET["actionMethod"])
		{
			case "login":
				login();
			break;
			case "logout":
				logout();
			break;
		}
	}
	function login()
	{
        global $domainAuth;
		global $dsnAuth, $DBUserAuth, $DBPasswordAuth;
		
        if(isset($_POST["email"],$_POST["password"]))
        {
            try 
            {
                $query = "SELECT * FROM user WHERE email=:email";

                $conn = new PDO($dsnAuth, $DBUserAuth, $DBPasswordAuth);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($query);

                $stmt->bindParam(':email', $_POST["email"]);
                $stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetch();

                if($stmt == true)
                {
					if($row['active']==1){
 						if(password_verify($_POST["password"], $row["password"] ) && $row["role"] == 0)
						{
							session_start(); 
							$_SESSION['login'] = true;
							$_SESSION['idAdm1n'] = $row["idUser"];
							$_SESSION['email'] = $row["email"];
							$_SESSION['username'] = $row["name"];
							$_SESSION['flag'] = rand();
							
							$redirect = "Location: ../admin/users.php";
							header($redirect);
						}
						elseif(password_verify($_POST["password"], $row["password"])  && $row["role"] == 1)
						{
							session_start(); 
							$_SESSION['login'] = true;
							$_SESSION['idUser'] = $row["idUser"];
							$_SESSION['email'] = $row["email"];
							$_SESSION['username'] = $row["name"];
							$_SESSION['flag'] = rand();
	
				            $redirect = "Location: ../index.php";
							header($redirect);
						}
						else{
							// Redirec to info page and displays an error message
							$redirect = "Location: ../login.php?result=error&message=".rawurlencode("Usuario y/o contrase&ntilde;a incorrectos");
							header($redirect);
						}
					}
					else{
						// Redirec to info page and displays an error message
						$redirect = "Location: ../login.php?result=error&message=".rawurlencode("La cuenta no se encuenta activa. Favor de verificarlo");
						header($redirect);
					}
                }
            }
            catch (PDOException $e) { 
                var_dump($e->getMessage());
            }
        }
	}
	
	function logout()
	{
		global $domainAuth;
		global $dsnAuth, $DBUserAuth, $DBPasswordAuth;
		
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
		
		$redirect = "Location: ../login.php?result=success&message=".rawurlencode("Has cerrado sesi&oacute;n exitosamente");
        header($redirect);
	}

	function verify()
	{
		global $domainAuth;
		global $dsnAuth, $DBUserAuth, $DBPasswordAuth;
		
		session_start(); 
		session_regenerate_id(true);
                
         
        if(isset($_SESSION['email']) && is_numeric($_SESSION['flag']))
		{
            try 
            {
                $query = "SELECT * FROM user WHERE email=:email";
                $conn = new PDO($dsnAuth, $DBUserAuth, $DBPasswordAuth);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($query);

                $stmt->bindParam(':email', $_SESSION["email"]);
                $stmt->execute();

                if($stmt == true)
                {
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $row = $stmt->fetch();

                    if($row["email"] == $_SESSION["email"] && ($row["role"] == 0 | $row["role"] == 1))
                    {
                        // Continue processing the page
                    }
                    else{
                        // Redirec to info page and displays an error message
                        $redirect = "Location: ../login.php?result=error&message=".rawurlencode("Por favor inicie sesi&oacute;n para continuar");
                        header($redirect);
                    }
                }
            }
            catch (PDOException $e) { 
                var_dump($e->getMessage());
            }
		}
        else{
            // Redirec to info page and displays an error message
            $redirect = "Location: ../login.php?result=error&message=".rawurlencode("Por favor inicie sesi&oacute;n para continuar");
            header($redirect);
        }
	}	
?>