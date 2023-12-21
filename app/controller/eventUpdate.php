<?php
if($_POST){
    // include database connection
    include './config.php';
    try{
        // insert query
        $id=isset($_POST['id']) ? $_POST['id'] : die('ERROR: Record ID not found.');
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