<?php
require_once 'sessionauth.php';
if ($_SESSION["user_id"]<=0){
    header("Location: ../views/profile/login.php");
}
?>
<?php
/* CONFIRM DELETION/VALIDATE USER ID FOR DELETION */

if($_GET){
    // include database connection
    include './config.php';
    try{
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        //Check if user is owner of file
        $user_id = $_SESSION["user_id"];
        $query = "SELECT id_user FROM event WHERE id = ?";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $id);
        // execute our query
        $stmt->execute();
        // store retrieved row to a variable
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_owner = $row['id_user'];

        $id_owner == $user_id ? : die('ERROR : INVALID USER');
        
        

        $query = "DELETE FROM event WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            // redirect to read records page and
            // tell the user record was deleted
            header('Location: ../views/event/index.php');
        }else{
            die('Unable to delete record.');
        }
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>