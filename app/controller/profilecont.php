<?php
if(isset($_POST['register'])){
    include 'config.php';
    try{
        require_once 'registercont.php';
        require_once 'sessionauth.php';
        $picture =$_FILES['picture']['name'];
        $storepic= '../../../assets/storage/profpic/' . $picture;
        move_uploaded_file($_FILES['picture']['tmp_name'], $storepic);  
        $username = $_POST["username"];
        $email =$_POST["email"];
        $pwd=$_POST["password"];
        if(!isempty($username, $pwd, $email)){
            echo "<div class='alert alert-danger'>form is empty.</div>";
            die();
        }
        elseif(!isemailvalid($email)){
            echo "<div class='alert alert-danger'>email invalid.</div>";
            die();
        }
        elseif(!isusrtaken($pdo, $username)){
            echo "<div class='alert alert-danger'>Username Taken.</div>";
            die();
        }
        elseif(!isemailtaken($pdo, $email)){
            echo "<div class='alert alert-danger'>Email Taken.</div>";
            die();
            }
        else{
        $query = "INSERT INTO user (username, pwd ,email, picture) VALUES (:username, :pwd, :email, :picture)";
        // prepare query for execution
        $stmt = $pdo->prepare($query);
        $options = [
            'cost' => 12
        ];
        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT,$options);
        // bind the parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $hashedpwd);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':picture', $picture);
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>User was saved.</div>";
            
        }else{
            echo "<div class='alert alert-danger'>User to save record.</div>";
        }
        }      
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
if(isset($_POST['login'])){
    include 'config.php';
 
    try{
        require_once 'logincont.php';
        require_once 'sessionauth.php';
        $username = $_POST["username"];
        $pwd=$_POST["password"];
        if(!isempty($username, $pwd)){
            echo "<div class='alert alert-danger'>form is empty.</div>";
            die();
        }
        $result = getusername($pdo, $username);
        print_r($result);
        if(isusrwrong($result)){
            echo "<div class='alert alert-danger'>Username doesnt exist.</div>";

            die();
        }else if(ispasswrong($pwd,$result["pwd"])){
            echo "<div class='alert alert-danger'>Wrong Password</div>";

            die();
        }
        $newsessionid = session_create_id();
        $sessionid = $newsessionid ."_" .  $result["id"];
        session_id($sessionid);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: ../profile/profile.php");
        die();
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
if(isset($_POST['updateprofile'])){
    include 'config.php';
    try{
        require_once 'registercont.php';
        require_once 'sessionauth.php';
        $id =$_SESSION["user_id"];
        $query = "SELECT * FROM user WHERE id= :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        $picture =$_FILES['picture']['name'];
        $username = $_POST["username"];
        $email =$_POST["email"];
        $pwd=$_POST["password"];
        $bio=$_POST["bio"];
        if(empty($picture)){
            $picture = $result["picture"];
        }else {
            $storepic= '../../../assets/storage/profpic/' . $picture;
            move_uploaded_file($_FILES['picture']['tmp_name'], $storepic); 
        }
        if(empty($username)){
            $username = $result["username"];
        }
        if(empty($email)){
            $email = $result["email"];
        }
        if(empty($pwd)){
            $pwd = $result["pwd"];
        }
        if(empty($bio)){
            $bio = $result["bio"];
        }
        elseif(!isusrtaken($pdo, $username)){
            echo "<div class='alert alert-danger'>Username Taken.</div>";
            die();
        }
        elseif(!isemailtaken($pdo, $email)){
            echo "<div class='alert alert-danger'>Email Taken.</div>";
            die();
            }
        else{
        $query = "UPDATE user SET username = :username, pwd = :pwd, email = :email, picture = :picture, bio = :bio WHERE id:id";
        // prepare query for execution
        $stmt = $pdo->prepare($query);
        $options = [
            'cost' => 12
        ];
        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT,$options);
        // bind the parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $hashedpwd);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bio', $bio);
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Update successful.</div>";
            
        }else{
            echo "<div class='alert alert-danger'>Update failed.</div>";
        }
        }      
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
if(isset($_POST['deleteprofile'])){
    include 'config.php';
    try{
        require_once 'sessionauth.php';
        $id =$_SESSION["user_id"];
        $query = "DELETE FROM event WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Update successful.</div>";
            
        }else{
            echo "<div class='alert alert-danger'>Update failed.</div>";
        }
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>