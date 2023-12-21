<?php

    function isempty(string $username, string $pwd, string $email,){
        if (empty($username)||empty($pwd)||empty($email)){
            return false;
        }else{ return true;}
    }
    function isemailvalid(string $email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{ return true;}
    }
    function isusrtaken($pdo, $username){
        $query = "SELECT username FROM user WHERE username= :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($result){
            return false;
        }else{ return true;}
    }
    function isemailtaken($pdo, $email){
        $query = "SELECT username FROM user WHERE email= :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($result){
            return false;
        }else{ return true;}
    }
?>