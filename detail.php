<?php 
      require_once("config.php");
  
      if(!isset($_GET['kode_barang'])){
          die("Error: Barang Tidak Ditemukan");
      }
  
      $query = $db->prepare("SELECT * FROM produk WHERE kode_barang =:kode_barang");
      $query->bindParam(":kode_barang" , $_GET['kode_barang']);
      $query->execute();
  
      if($query->rowCount() == 0){
          die("Error: Data Barang Tidak Ditemukan");
      } else {
          $data = $query->fetch();

          $add = $data['view'] + 1;
          $kode =  $data['kode_barang']; 
          
          $sqlUpdateView  ="UPDATE produk set view = :view WHERE kode_barang = :kode_barang ";
          
          $params = array(
            ':view' => $add,
            ':kode_barang' => $kode
          );

          $stmt = $db->prepare($sqlUpdateView);
          $stmt->execute($params);
      }
          
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?php echo $data['nama'] ?></title>
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="assets/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <!-- <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css"> -->
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
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
                                    <div class="logo"><a href="#home"><img src="assets/images/logo.jpg" width="130"
                                                height="80"></a>
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

        </div>
    </header>

    <div id="about" class="layout_padding about_section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&larr; <a href="index.php" class="btn btn-warning">Kembali</a></p>
                </div>
                <div class="col-md-5">
                    <img src="/file/<?php echo $data['file_img'] ?>" class="img-fluid">
                </div>
                <div class="col-md-7">
                    <h3 style="font-size: 45px;font-weight:700"><?php echo $data['nama'] ?></h3>
                    <h7>Kode Barang : <strong><?php echo $data['kode_barang'] ?></strong> </h7>
                    <br>
                    <h7>Stok Barang : <strong><?php echo $data['stok'] ?></strong> </h7>
                    <br>
                    <h7>Dibuat oleh : <strong><?php echo $data['created_by'] ?></strong> </h7>
                    <br>
                    <label>Deskripsi</label>
                    <p class="p-0"> <span style="color:red">*</span> <?php echo $data['deskripsi'] ?></p>
                    <a href="https://api.whatsapp.com/send?phone=6281904995866&text=Halo, Apakah stok barang *<?php echo $data['nama']; ?>* tersedia?"
                        class="btn btn-success">PESAN SEKARANG</a>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact_section ">
        <div class="container">
            <div class="contact-taital">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="contact_text"><strong>Kontak</strong></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h2 class="adderess_text">Alamat</h2>
                    <div class="image-icon"><img src="assets/images/map-icon.png"><span class="email_text">Jl. Raya Bogor, Km. 40,5 Cibinong - Bogor</span></div>
                    <div class="image-icon"><img src="assets/images/phone-icon.png"><span class="email_text">+62 819-0499-5866 | Telp. (021) 8763218, 87915247</span></div>
                    <div class="image-icon"><img src="assets/images/email-icon.png"><span
                            class="email_text"> dmk_grc@yahoo.com</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript files-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/plugin.js"></script>
    <!-- sidebar -->
    <!-- <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script> -->
    <!-- <script src="assets/js/custom.js"></script> -->
</body>

</html>