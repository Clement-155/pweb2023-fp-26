
<?php
/* CONFIRM DELETION/VALIDATE USER ID FOR DELETION */

if($_GET){
    // include database connection
    include './config.php';
    try{
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        

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