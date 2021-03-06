<?php 

require_once("config.php");

if(isset($_POST['feedback_send'])){

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $nomor_telp = filter_input(INPUT_POST, 'nomor_telp', FILTER_SANITIZE_STRING);
    $deskripsi = filter_input(INPUT_POST, 'deskripsi', FILTER_SANITIZE_STRING);
    
     //menyiapkan query
     $sql = "INSERT INTO feedback ( nama, email, nomor_telp, deskripsi) 
     VALUES ( :nama, :email, :nomor_telp, :deskripsi)";
 
     $stmt = $db->prepare($sql);
 
     // bind parameter ke query
     $params = array(
         ":nama" => $nama,
         ":email" => $email,
         ":nomor_telp" => $nomor_telp,
         ":deskripsi" => $deskripsi,
     );
 
     // eksekusi query untuk menyimpan ke database
     $saved = $stmt->execute($params);

     $cek = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if($cek){
         
         // jika query simpan berhasil, maka feedback sudah terdaftar
         // maka alihkan ke halaman index
         header("Location: index.php");
         
         //cetak popup selamat
         echo '<script language="javascript">
         window.alert("Feedback berhasil dikirim");</script>';
         
     }
     

}

?>

<!DOCTYPE html>
<html lang="id-ID">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>PT Delima Karya Putra</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="assets/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

</head>

<body>
    <header>
        <div class="layout_padding banner_section_start">
            <!-- header inner -->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo"><a href="#home"><img src="assets/images/logo.png"
                                                style="max-width: 100%;"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <div class="menu-area">
                                <div class="limit-box">
                                    <nav class="main-menu">
                                        <ul class="menu-area-main">
                                            <li class="active"><a href="#home">Home</a></li>
                                            <li><a href="#about">About</a></li>
                                            <li><a href="#products">products</a></li>
                                            <li><a href="#gallery">gallery</a></li>
                                            <li><a href="#contact">Contact Us</a></li>
                                            <li><a href="pages/login.php">Login</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header inner -->
            <!-- banner start-->
            <div class="layout_padding banner_section">
                <div class="container">
                    <div id="main_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row ">
                                    <div class="col-md-6 taital">
                                        <h1 class="taital">Berkualitas<strong class="banner_taital">
                                                Produk yang baik</strong></h1>
                                        <p class="lorem_text text-uppercase">produk grc pracetak teruji baik jika kualitas produk yang bertahan jangka panjang dan secara terus menerus dalam berbagai cuaca maupun suhu
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-image"><img src="assets/images/banner-image.png"
                                                style="max-width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row ">
                                    <div class="col-md-6 taital">
                                        <h1>Quality<strong class="banner_taital">Products with breads sweet Den</strong>
                                        </h1>
                                        <p class="lorem_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-image"><img src="assets/images/banner-image.png"
                                                style="max-width: 100%;"></div>
                                    </div>
                                    <!-- <div class="banner_bt">
                                        <button class="bt_main"><a href="#">Read More</a></button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row ">
                                    <div class="col-md-6 taital">
                                        <h1>Quality<strong class="banner_taital">Products with breads sweet Den</strong>
                                        </h1>
                                        <p class="lorem_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-image"><img src="assets/images/banner-image.png"
                                                style="max-width: 100%;"></div>
                                    </div>
                                    <!-- <div class="banner_bt">
                                        <button class="bt_main"><a href="#">Read More</a></button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"><i
                                    class="fa fa-angle-left"></i></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"><i
                                    class="fa fa-angle-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- banner end-->
    <!-- about start-->
    <div id="about" class="layout_padding about_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img src="assets/images/cupcake-img.png" style="max-width: 100%;"></div>
                </div>
                <div class="col-md-6">
                    <h1 class="about_text"><strong>Tentang PT Delima Karya Putra</strong></h1>
                    <p class="about_taital">Merupakan perusahaan anak bangsa yang konsisten dibidang fabrikasi dan aplikasi GRC di Indonesia. Memulai pekerjaan sejak tahun 1997 hingga saat ini PT.DELIMA KARYA PUTRA turut serta berperan dalam pembangunan di berbagai proyek yang berskala kecil maupun besar.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- product start-->
    <div id="products" class="layout_padding product_section ">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="product_text"><strong><span class="den">Produk</span> kami</strong></h1>
                </div>
            </div>
            <div class="product_section_2 images">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img1.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text croissants"><a href="#">Croissants Breakfast</a></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img2.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text"><a href="#">Roll Cake</a></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img3.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text"><a href="#">BreadFrench Toast</a></h2>
                    </div>



                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img4.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text"><a href="#">Cup Cake</a></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img5.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text"><a href="#">Donut</a></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="images"><img src="assets/images/about-img6.png"
                                style="max-width: 100%; width: 100%;">
                        </div>
                        <h2 class="den_text"><a href="#">Chocolate Cup Cake</a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product end-->
    <!-- Gallery start-->
    <div id="gallery" class="layout_padding2 gallery_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="gallery_main">
                        <h1 class="gallery_taital"><strong><span class="our_text">Our</span> Gallery</strong></h1>
                    </div>
                </div>
                <div class="col-sm-12 gallery_maain">
                    <div class="row">
                        <div class="col-sm-3 padding_0">
                            <div class="gallery_blog">
                                <img class="img-responive" src="assets/images/gallery-img1.png">
                                <div class="overlay">
                                    <h2>Breakfast Breads</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 padding_0">
                            <div class="gallery_blog">
                                <img class="img-responive" src="assets/images/gallery-img2.png">
                                <div class="overlay">
                                    <h2>Breakfast Breads</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 padding_0">
                            <div class="gallery_blog">
                                <img class="img-responive" src="assets/images/gallery-img3.png">
                                <div class="overlay">
                                    <h2>Breakfast Breads</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 padding_0">
                            <div class="gallery_blog">
                                <img class="img-responive" src="assets/images/gallery-img4.png">
                                <div class="overlay">
                                    <h2>Breakfast Breads</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Gallery-->
    <!-- Touch start-->
    <div class="layout_padding gallery_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="gallery_main">
                        <h1 class="gallery_taital"><strong><span class="our_text">Feedback</span> kami</strong></h1>
                    </div>
                </div>
            </div>
            <div class="touch_main">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="input_main">
                                <div class="container">
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Masukkan nama Anda" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="email-bt" placeholder="Masukkan e-mail Anda" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Masukkan No.Handphone Anda"
                                            name="nomor_telp" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="massage-bt" required placeholder="Masukkan deskripsi Anda" rows="5" id="deskripsi"
                                            name="deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="send_btn">
                                <input type="submit" class="btn btn-primary mt-3 w-100" name="feedback_send" value="Kirim Sekarang">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="images">
                            <img src="assets/images/bread-img.png" style="max-width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map_section">
        <div class="row">
            <div class="col-sm-12">

                <div id="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1178.6692253724277!2d106.85015788221881!3d-6.451140859450004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjcnMDQuNyJTIDEwNsKwNTEnMDEuMiJF!5e0!3m2!1sid!2sid!4v1615016225963!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </div>
    </div>
    <!-- Touch end-->
    <!-- contact start-->
    <div id="contact" class="contact_section">
        <div class="container">
            <div class="contact-taital">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="contact_text"><strong>Contact Us</strong></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <h2 class="adderess_text">Adderess</h2>
                    <div class="image-icon"><img src="assets/images/map-icon.png"><span class="email_text">Gb road 123
                            london
                            Uk </span></div>
                    <div class="image-icon"><img src="assets/images/phone-icon.png"><span class="email_text">(+71)
                            56982424536</span></div>
                    <div class="image-icon"><img src="assets/images/email-icon.png"><span
                            class="email_text">bacerim@gmail.com</span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact end-->

    <!-- Javascript files-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- javascript -->
    <script src="assets/js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function () {

                $(this).addClass('transition');
            }, function () {

                $(this).removeClass('transition');
            });
        });
    </script>



</body>

</html>