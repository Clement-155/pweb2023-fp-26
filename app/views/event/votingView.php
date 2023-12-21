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

    <title>EZVote</title>s
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

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="../../../assets/css/form.css?<?php echo time(); ?>" rel="stylesheet">

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


    <!-- PHP START : Get event information -->

    <?php
    // get passed parameter value, in this case, the record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    //include database connection
    include '../../controller/config.php';
    // read current record's data
    try {
        // prepare select query
        $query = "SELECT id, nama_event, deskripsi, pilihan FROM event WHERE id = ? LIMIT 0,1";
        $stmt = $pdo->prepare($query);
        // this is the first question mark
        $stmt->bindParam(1, $id);
        // execute our query
        $stmt->execute();
        // store retrieved row to a variable
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // values to fill up our form
        $nama_event = $row['nama_event'];
        $deskripsi = $row['deskripsi'];
        $pilihan = json_decode($row['pilihan'], true);
    }
    // show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
    ?>
    <!-- PHP END -->

    <main id="main">

        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <h3>
                        <?php echo $nama_event ?>
                    </h3>
                    <p class="lead">
                        <?php echo $deskripsi ?>
                    </p>
                    <div class="card">
                        <form id="voting" class="form-card" action="../../controller/votingSubmit.php" method="post"">
                            <input value=<?php echo $id ?> type=" text" name="id" hidden required>
                            <div class="d-flex flex-column mb-3 align-items-center">
                                <?php
                                foreach ($pilihan as $index => $opt) {
                                    if ($opt != "" || $opt != null) {
                                ?>
                                        <input type="radio" class="btn-check" name="vote" id="opt<?php echo $index ?>" autocomplete="off" value="<?php echo $index ?>" required>
                                        <label class="btn btn-success m-3" style="width:30%" for="opt<?php echo $index ?>"><?php echo $opt ?></label>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="d-flex justify-content-evenly align-items-center">
                                <button type="submit" style="height:50%" class="btn btn-primary">VOTE</button>
                                <a class="btn btn-secondary" style="height:fit-content" href="./index.php" role="button">Back</a>
                            </div>
                        </form>
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

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js?<?php echo time(); ?>"></script>

</body>

</html>