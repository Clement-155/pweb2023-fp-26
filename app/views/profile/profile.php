<?php include '../../controller/sessionauth.php';
include '../../controller/config.php';
include '../../controller/profilecont.php';
$id=$_SESSION["user_id"];
if ($id<=0){
    header("Location: ./login.php");
};
$query = "SELECT * FROM user WHERE id= :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt ->fetch(PDO::FETCH_ASSOC);
    $picture=$result["picture"];
    $username=$result["username"];
    $email=$result["email"];
    $bio = $result["bio"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../../../assets/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        #displayprofile {
            display:block;
            width: 32%;
            margin: 10px auto;
            border-radius: 50%;
        }
    </style>
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
                    <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
                    <li><a class="btn btn-primary" href="../../controller/sessionauth.php?isLogout=1">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End #header -->
    <main id="main">
    <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>Your Profile</h3>
                <?php $username = $_SESSION["user_username"];echo "<p>Welcome $username ! </p>"?>
              
                <div class="card">
            <form class="form-card" action="profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="picture">Profile picture:</label>
                    <input type="file" name="picture" id="picture" class="form-input" accept=".png, .jpg, .jpeg"  style="display: none;" required onchange="displayimage(this)"><br>
                <img src="..\..\..\assets\storage\profpic\<?php echo $picture?>"  id="displayprofile" onclick="changeprofile()"; width=200px height=200px>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input required type="text" class="form-control" name="username" placeholder="<?php echo $username?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" name="email" placeholder="<?php echo $email?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" name="password" placeholder="Change your password">
                </div>
                <div class="form-group">
                    <label for="bio">Your bio</label>
                    <input required type="text" class="form-control" name="bio" placeholder="<?php echo $bio?>">
                </div>
                <div class="form-group">
                <button type="submit" name="updateprofile" class="btn btn-primary">update profile</button>
                <button type="submit" name="deleteprofile" class="btn btn-danger">delete profile</button>
                 </div>
            </form>
        </div>
            </div>
        </div>
        </div>
    </main>    <!-- ======= Footer ======= -->
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
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>
</body>

</script>
</html>
