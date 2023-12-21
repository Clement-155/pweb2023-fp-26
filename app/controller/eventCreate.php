<?php
if($_POST){
    // include database connection
    include './config.php';
    try{
        // insert query
        $query = "INSERT INTO event SET nama_event=:nama, tanggal_akhir=:tanggal_akhir, deskripsi=:deskripsi, pilihan=:pilihan, jumlah_vote=:jumlah_vote";
        

        // prepare query for execution
        $stmt = $pdo->prepare($query);
        // posted values
        $nama=htmlspecialchars(strip_tags($_POST['judul']));
        $tanggal_akhir=htmlspecialchars(strip_tags($_POST['tanggal_akhir']));
        $deskripsi=htmlspecialchars(strip_tags($_POST['deskripsi']));
        $pilihan=   (json_encode($_POST['pilihan']));
        // Init json untuk jumlah voting
        $jumlah_vote=json_encode(array("1"=>0, "2"=>0, "3"=>0,"4" => 0));
        // bind the parameters
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tanggal_akhir', $tanggal_akhir);

        $stmt->bindParam(':deskripsi', $deskripsi);

        $stmt->bindParam(':pilihan', $pilihan);

        $stmt->bindParam(':jumlah_vote', $jumlah_vote);


        // specify when this record was inserted to the database
        // $created=date('Y-m-d H:i:s');
        // $stmt->bindParam(':created', $created);
        // Execute the query
        if($stmt->execute()){
            header("Location: ../views/event/index.php", true, 301);

            exit();        
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>