<?php
function isempty(string $username, string $pwd){
    if (empty($username)||empty($pwd)){
        return false;
    }else{ return true;}
}
function isusrwrong($result){
    if (!$result){
        return true;
    }else{ return false;}
}
function ispasswrong($pwd, $hashedpwd){

    if (!password_verify($pwd, $hashedpwd)){
        return true;
    }else{ return false;}
}
function getusername($pdo, $username){
    $query = "SELECT * FROM user WHERE username=:username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $result;
}
?>