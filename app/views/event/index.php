<!DOCTYPE html>
<html lang="en">

<?php
require_once '../../controller/sessionauth.php';

if ($_SESSION["user_id"]<=0){
    header("Location: ../profile/login.php");
}
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Amoeba Bootstrap Template - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css?<?php echo time(); ?>" rel="stylesheet">

    <script type='text/javascript'>
    // confirm record deletion
    function delete_event( id ){
        var answer = confirm('Are you sure?');
        if (answer){
            // if user clicked ok,
            // pass the id to delete.php and execute the delete query
            window.location = '../../controller/eventDelete.php?id=' + id;
        }
    }
    </script>
    <!-- =======================================================
  * Template Name: Amoeba
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">

            <div class="logo me-auto">
                <h1><a href="index.php">EZVote</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                <li><a class="nav-link scrollto" href="../profile/profile.php">Profile</a></li>
                    <li><a class="btn btn-primary" href="../../controller/sessionauth.php?isLogout=1">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End #header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1>Welcome to Amoeba</h1>
            <h2>We are team of talented designers making websites with Bootstrap</h2>
        </div>
    </section><!-- #hero -->

    <main id="main">
        <!-- PHP START - Get ALL data from database -->
        <?php
            // include database connection
            include '../../controller/config.php';
            // delete message prompt will be here
            // select all data
            $query = "SELECT id, nama_event, tanggal_akhir, deskripsi, total_vote FROM event ORDER BY tanggal_akhir DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            // this is how to get number of rows returned
            $num = $stmt->rowCount();
            // link to create record form

                
            
        ?>
        <!-- PHP END -->

        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <div class="table-responsive w-80">
                        <a class="btn btn-primary m-4" href="./inputForm.php" role="button">ADD NEW</a>
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Deskripsi</th>
                                        <th>Total Voter</th>
                                        <th>Options</th>

                                    </tr>
                                </thead>
                                <tbody>
        <?php 
             
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['firstname'] to
                    // just $firstname only
                    extract($row);

                    echo "<tr>
                        <td style=\"word-wrap: break-word;min-width: 10vw;max-width: 10vw; font-weight: bold;\">{$nama_event}</td>
                        <td >{$tanggal_akhir}</td>
                        <td style=\"word-wrap: break-word;min-width: 20vw;max-width: 15vw;\">{$deskripsi}</td>
                        <td >{$total_vote}</td>
                        <td >
                            <div class=\"row row-cols-1 justify-content-center\">
                                <a class=\"btn btn-warning ms-4 w-50\" href=\"./updateForm.php?id={$id}\" role=\"button\">EDIT</a>
                                <a class=\"btn btn-danger ms-4 w-50\" href=\"javascript:delete_event({$id})\" role=\"button\">DELETE</a>
                                <a class=\"btn btn-success ms-4 w-50\" href=\"./votingView.php?id={$id}\" role=\"button\">VOTE</a>
                            </div>
                        </td>
                    </tr>";
                }
            
        ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                <strong><span>Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2023)</span></strong>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/ -->
                    Dosen: Imam Kuswardayan, S.Kom, M.T
            </div>
        </div>
    </footer><!-- End #footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Template Main JS File -->

    <script src="../../../assets/js/main.js?<?php echo time(); ?>"></script>
    <script src="../../../assets/js/table.js?<?php echo time(); ?>"></script>
    


</body>

</html>