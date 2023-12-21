<?php
require_once 'sessionauth.php';
if ($_SESSION["user_id"]<=0){
    header("Location: ../views/profile/login.php");
}
?>

<?php
        if ($_POST){
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_POST['id']) ? $_POST['id'] : die('ERROR: Record ID not found.');
        $vote = isset($_POST['vote']) ? $_POST['vote'] : die('ERROR: Must at least pick 1 option.');
        //include database connection
        include './config.php';
        // read current record's data
        try {
            // prepare select query
            $query = "SELECT jumlah_vote, total_vote FROM event WHERE id = ? LIMIT 0,1";
            $stmt = $pdo->prepare($query);
            // this is the first question mark
            $stmt->bindParam(1, $id);
            // execute our query
            $stmt->execute();
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // values to fill up our form
            $jumlah_vote = json_decode($row['jumlah_vote'], true);
            $total_vote = $row['total_vote'];

            $total_vote++;
            $jumlah_vote[$vote+1]++;
            
            $jumlah_vote = json_encode($jumlah_vote);

            $query = "UPDATE event SET jumlah_vote=:jumlah_vote, total_vote=:total_vote WHERE id = :id";
            $stmt = $pdo->prepare($query);
            // this is the first question mark
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':total_vote', $total_vote);
            $stmt->bindParam(':jumlah_vote', $jumlah_vote);
            // execute our query
            $stmt->execute();

            // Log voting in table
            $query = "INSERT INTO event_user SET event_id=:event_id, user_id=:user_id";
            $stmt->bindParam(':event_id', $id);
            $stmt->bindParam(':user_id', $_SESSION["user_id"]);

            if($stmt->execute()){
                header("Location: ../views/event/index.php", true, 301);
    
                exit();        
            }else{
                echo "<div class='alert alert-danger'>Unable to submit vote.</div>";
            }
        }
        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }
?>