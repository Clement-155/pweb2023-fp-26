<?php
require_once 'sessionauth.php';
if ($_SESSION["user_id"]<=0){
    header("Location: ../views/profile/login.php");
}
?>

<?php
if($_POST){
    // include database connection
    include './config.php';
    try{
        // insert query
        $id=isset($_POST['id']) ? $_POST['id'] : die('ERROR: Record ID not found.');
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

        $query = "UPDATE event SET nama_event=:nama, tanggal_akhir=:tanggal_akhir, deskripsi=:deskripsi, pilihan=:pilihan WHERE id = :id";
        
        // prepare query for execution
        $stmt = $pdo->prepare($query);
        // posted values
        $nama=htmlspecialchars(strip_tags($_POST['judul']));
        $tanggal_akhir=htmlspecialchars(strip_tags($_POST['tanggal_akhir']));



        if (strtotime($tanggal_akhir) <= time()){
            die('Invalid date time, must be greater than current date time');
        }

        $deskripsi=htmlspecialchars(strip_tags($_POST['deskripsi']));
        $pilihan=   (json_encode($_POST['pilihan']));

        // bind the parameters
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tanggal_akhir', $tanggal_akhir);

        $stmt->bindParam(':deskripsi', $deskripsi);

        $stmt->bindParam(':pilihan', $pilihan);

        $stmt->bindParam(':id', $id);


        // specify when this record was inserted to the database
        // $created=date('Y-m-d H:i:s');
        // $stmt->bindParam(':created', $created);
        // Execute the query
        if($stmt->execute()){
            header("Location: ../views/event/index.php", true, 301);

            exit();        
        }else{
            echo "<div class='alert alert-danger'>Unable to update record.</div>";
        }
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>