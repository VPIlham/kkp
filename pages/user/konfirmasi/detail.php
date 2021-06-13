<?php
require_once("../../../auth_user.php");
require_once("../../../config.php");

if (!isset($_GET['tiket_trx'])) {
    die("Error: Konfirmasi Bayar Tidak Ditemukan");
}

//panggil data konfirmasi
$sqlPanggilKonfirmasi = $db->prepare("SELECT * FROM konfirmasi_bayar where tiket_trx = :tiket_trx");
$sqlPanggilKonfirmasi->bindParam(":tiket_trx", $_GET['tiket_trx']);
$sqlPanggilKonfirmasi->execute();

$resultKonfirmasi = $sqlPanggilKonfirmasi->fetchAll(PDO::FETCH_ASSOC);

$dataID = $resultKonfirmasi[0]['id_produk'];
$dataTotalBayar = $resultKonfirmasi[0]['total_bayar'];
$dataGambarBayar = $resultKonfirmasi[0]['image'];


//panggil data barang
$sqlPanggilBarang = $db->prepare("SELECT * FROM produk where kode_barang = $dataID ");
$sqlPanggilBarang->execute();

$resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);

$tiket_id = $resultKonfirmasi[0]['tiket_trx'];

//panggil data transaksi
$sqlPanggilTransaksi = $db->prepare("SELECT * FROM transaksi where tiket_trx = :tiket_trx ");
$sqlPanggilTransaksi->bindParam(":tiket_trx", $_GET['tiket_trx']);
$sqlPanggilTransaksi->execute();

$resultTransaksi = $sqlPanggilTransaksi->fetchAll(PDO::FETCH_ASSOC);
$status = $resultTransaksi[0]['status'];

$resultKaryawan = null; 

//panggil data karyawan
if ( $resultKonfirmasi[0]['id_admin'] != null){
    $sqlPanggilKaryawan = $db->prepare("SELECT * FROM karyawan where nip = :id_admin ");
    $sqlPanggilKaryawan->bindParam(":tiket_trx", $resultKonfirmasi[0]['id_admin']);
    $sqlPanggilKaryawan->execute();
    
    $resultKaryawan = $sqlPanggilKaryawan->fetchAll(PDO::FETCH_ASSOC);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Konfirmasi Bayar</title>

    <!-- menyisipkan bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="text-capitalize">Hai <?php echo $_SESSION["user"]["nama"] ?></h3>
                        <p><?php echo $_SESSION["user"]["email"] ?>
                            <br>Pelanggan</small>
                        </p>

                        <p><a href="../../../../logout_user.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="../../home_user.php" class="list-group-item list-group-item-action " aria-current="true">
                        Dashboard
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ">Menu Pemesanan</a>
                    <a href="../konfirmasi/list.php" class="list-group-item list-group-item-action active ">Konfirmasi Pembayaran</a>
                </div>
            </div>
            <div class="col-md-6">

                <p>&larr; <a href="../../home_user.php">Kembali</a>


                <form method="GET" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="jumlah_jual">Nama Barang </label>
                        <input class="form-control" type="text" value="<?php echo $resultBarang[0]['nama']; ?>" disabled placeholder="Jumlah Stok barang" />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Total Bayar </label>
                        <input class="form-control" type="text" value="<?php echo $dataTotalBayar; ?>" disabled />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Status </label>
                        <input class="form-control" type="text" value="<?php echo $status; ?>" disabled />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Admin </label>
                        
                        <input class="form-control" type="text" value="<?php echo $resultKaryawan == null ? '-' : $resultKaryawan[0]['nama'] ; ?>" disabled />
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah_jual">Upload Bukti Bayar</label>
                        <div class="col-sm-10">
                            <img src="<?php echo "../../../file/".$dataGambarBayar; ?>" width="120" height="120" class="mt-2">
                        </div>
                    </div>

                    <a href="list.php" class="mt-3 btn btn-primary">Kembali</a>
                    

                </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>