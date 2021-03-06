<?php 

require_once("../auth.php"); 
require_once("../config.php");

//hitung semua data pelanggan
$sqlHitungPelanggan = $db->prepare("SELECT COUNT(*) hitung FROM user");
$sqlHitungPelanggan->execute();

$resultHitungPelanggan = $sqlHitungPelanggan->fetch(PDO::FETCH_ASSOC);


//hitung semua data transaksi
$sqlHitungTransaksi = $db->prepare("SELECT COUNT(*) hitung FROM transaksi");
$sqlHitungTransaksi->execute();

$resultHitungTransaksi = $sqlHitungTransaksi->fetch(PDO::FETCH_ASSOC);

//hitung semua data karyawan
$sqlHitungKaryawan = $db->prepare("SELECT COUNT(*) hitung FROM admin");
$sqlHitungKaryawan->execute();

$resultHitungKaryawan = $sqlHitungKaryawan->fetch(PDO::FETCH_ASSOC);

//hitung semua data Produk
$sqlHitungProduk = $db->prepare("SELECT COUNT(*) hitung FROM produk");
$sqlHitungProduk->execute();

$resultHitungProduk = $sqlHitungProduk->fetch(PDO::FETCH_ASSOC);

//hitung semua data Feedback
$sqlHitungFeedback = $db->prepare("SELECT COUNT(*) hitung FROM feedback");
$sqlHitungFeedback->execute();

$resultHitungFeedback = $sqlHitungFeedback->fetch(PDO::FETCH_ASSOC);

//hitung total harga transaksi keseluruhan 
$sqlHitungTotalTransaksi = $db->prepare("SELECT SUM(total_bayar) hitung FROM transaksi where status = 'selesai'");
$sqlHitungTotalTransaksi->execute();

$resultHitungTotalTransaksi = $sqlHitungTotalTransaksi->fetch(PDO::FETCH_ASSOC);

$sqlHitungTotalStok = $db->prepare("SELECT SUM(jumlah_jual) hitung FROM transaksi");
$sqlHitungTotalStok->execute();

$resultHitungTotalStok = $sqlHitungTotalStok->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="text-capitalize">Hai <?php echo $_SESSION["admin"]["nama"] ?></h3>
                        <p><?php echo $_SESSION["admin"]["email"] ?>
                            <br><small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager'?></small>
                        </p>

                        <p><a href="../logout.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="home.php" class="list-group-item list-group-item-action active" aria-current="true">
                        Dashboard
                    </a>
                    <a href="produk/list.php" class="list-group-item list-group-item-action">Produk</a>
                    <a href="karyawan/list.php" class="list-group-item list-group-item-action ">Karyawan</a>
                    <a href="transaksi/list.php" class="list-group-item list-group-item-action">Transaksi</a>
                    <a href="pelanggan/list.php" class="list-group-item list-group-item-action">Pelanggan</a>
                    <a href="feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>

            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Data Pelanggan :</h6>
                                <span style="font-size:44px;font-weight:700;color:blue"><?php echo $resultHitungPelanggan['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Data Transaksi :</h6>
                                <span style="font-size:44px;font-weight:700;color:green"><?php echo $resultHitungTransaksi['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Data Karyawan :</h6>
                                <span style="font-size:44px;font-weight:700;"><?php echo $resultHitungKaryawan['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Data Produk :</h6>
                                <span style="font-size:44px;font-weight:700;"><?php echo $resultHitungProduk['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Data Feedback :</h6>
                                <span style="font-size:44px;font-weight:700;color:red"><?php echo $resultHitungFeedback['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Harga Transaksi :</h6>
                                 <span style="font-size:44px;font-weight:700;color:green">Rp. <?php echo $resultHitungTotalTransaksi['hitung']; ?>,-</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Stok Terjual :</h6>
                                 <span style="font-size:44px;font-weight:700;color:green"><?php echo $resultHitungTotalStok['hitung']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>