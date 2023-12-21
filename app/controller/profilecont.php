<?php
if(isset($_POST['register'])){
    include 'config.php';
    try{
        require_once 'registercont.php';
        $picture =$_FILES['picture']['name'];
        $storepic= '../../../assets/storage/profpic/' . $picture;
        move_uploaded_file($_FILES['picture']['tmp_name'], $storepic);  
        $username = $_POST["username"];
        $email =$_POST["email"];
        $pwd=$_POST["password"];
        if(!isempty($username, $pwd, $email)){
            echo "<div class='alert alert-danger'>form is empty.</div>";
        }
        elseif(!isemailvalid($email)){
            echo "<div class='alert alert-danger'>email invalid.</div>";
        }
        elseif(!isusrtaken($pdo, $username)){
            echo "<div class='alert alert-danger'>Username Taken.</div>";
        }
        elseif(!isemailtaken($pdo, $email)){

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

?>