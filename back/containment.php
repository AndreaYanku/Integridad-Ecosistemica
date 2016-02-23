<?php

    $dsn = "mysql:localhost;port=3306;dbname=yankuser_integridad";
    $DBUser = "yankuser_ie";
    $DBPassword = "wfPyv_FJ.s86";

    // var_dump($_POST);
    foreach($_POST as &$v)
    {
        $v = strip_tags($v);
    }
    // var_dump($_POST);





    function insertUserContent($idUser)
    {
        global $dsn, $DBUser, $DBPassword;
        $seed = $_POST["email"] . date(DATE_RFC2822) . $_POST["password"];
        $token = hash('sha512', $seed);
        
        try 
        {
            $query = "INSERT INTO containment(idUser,token) values (:idUser, :token)";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if($stmt == true)
            {
                $url = "account-verification.php?idUser=".$idUser."&token=".$token;
                return $url;
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

    function deleteUserContent($idUser)
    {
        global $dsn, $DBUser, $DBPassword;
        
        try 
        {
            $query = "DELETE FROM containment WHERE idUser = :idUser";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

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
            if($stmt->errorCode() == 23000)
            {
                return false;
            }
        }
    }

    function getUserContent($idUser, $token)
    {
        global $dsn, $DBUser, $DBPassword;
        
        try 
        {
            $query = "SELECT * FROM containment WHERE idUser = :idUser AND token = :token";
            $conn = new PDO($dsn, $DBUser, $DBPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            // var_dump($row);

            if($stmt == true)
            {
                return $row;
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
?>