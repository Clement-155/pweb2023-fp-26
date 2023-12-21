<?php include '../../controller/profilecont.php'?>
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
                <h1><a href="index.html">Amoeba</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About Us</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                    <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End #header -->
    <main id="main">
    <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>Register</h3>
    <div class="card">
            <form class="form-card" action="register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="picture">Profile picture:</label>
                    <input type="file" name="picture" id="picture" class="form-input" accept=".png, .jpg, .jpeg"  style="display: none;" required onchange="displayimage(this)"><br>
                <img src="..\..\..\assets\storage\download.png"  id="displayprofile" onclick="changeprofile()"; width=200px height=200px>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input required type="text" class="form-control" name="username" placeholder="Enter your desired username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
                <div class="form-group">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
                 </div>
            </form>
        </div>
    </div>
            </div>
        </div>
    </main>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>
</body>
<script>function changeprofile(){
    document.querySelector('#picture').click();
}

function displayimage(e) {
    if (e.files[0]){
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('#displayprofile').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0])
    }
}

</script>
</html>
