<?php
require_once("../../../auth_user.php");
require_once("../../../config.php");

if (!isset($_GET['tiket_trx'])) {
    die("Error: Transaksi Tidak Ditemukan");
}

//panggil data konfirmasi
$sqlPanggilKonfirmasi = $db->prepare("SELECT * FROM konfirmasi_bayar where tiket_trx = :tiket_trx");
$sqlPanggilKonfirmasi->bindParam(":tiket_trx", $_GET['tiket_trx']);
$sqlPanggilKonfirmasi->execute();

$resultKonfirmasi = $sqlPanggilKonfirmasi->fetchAll(PDO::FETCH_ASSOC);

$dataID = $resultKonfirmasi[0]['id_produk'];
$dataTotalBayar = $resultKonfirmasi[0]['total_bayar'];


//panggil data barang
$sqlPanggilBarang = $db->prepare("SELECT * FROM produk where id = $dataID ");
$sqlPanggilBarang->execute();

$resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);

$tiket_id = $resultKonfirmasi[0]['tiket_trx'];

//  echo '<pre>';
//  print_r($resultKonfirmasi[0]['tiket_trx']);
//  echo '</pre>';
//  return;

if (isset($_POST['upload_transaksi'])) {

    $ambilKodeBarang = $resultBarang[0]['kode_barang'];
    $ambilHargaBarang = $resultBarang[0]['harga'];
    $dataStok = $resultBarang[0]['stok'];
    $dataId = $resultBarang[0]['id'];

    $ekstensi_diperbolehkan = array('png', 'jpg');
    $namaKonfirmasiBayar = $tiket_id;
    
    $namaKodeBarang = $namaKonfirmasiBayar.'_'.$_FILES['file_img']['name'];

    $x = explode('.', $namaKodeBarang);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file_img']['size'];
    $file_img = $_FILES['file_img']['tmp_name'];

    move_uploaded_file($file_img, '../../../file/' .$namaKodeBarang);

    //menyiapkan query
    $sql = "UPDATE konfirmasi_bayar set `image` = :image where tiket_trx = '$namaKonfirmasiBayar' ";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":image" => $namaKodeBarang,
    );

    $saved = $stmt->execute($params);

    //pengurangan stok
    $sqlUpdateKodeBarang = $db->prepare("UPDATE transaksi set status = 'DIPROSES' where tiket_trx = '$namaKonfirmasiBayar' ");
    $sqlUpdateKodeBarang->execute();

    header("Location: list.php");
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

                        <p><a href="../../../logout.php">Logout</a></p>
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


                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="jumlah_jual">Nama Barang </label>
                        <input class="form-control" type="text" value="<?php echo $resultBarang[0]['nama']; ?>" disabled placeholder="Jumlah Stok barang" />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Total Bayar </label>
                        <input class="form-control" type="text" value="<?php echo $dataTotalBayar; ?>" disabled />
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah_jual">Upload Bukti Bayar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" name="file_img">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-success btn-block mt-3" name="upload_transaksi" value="Upload" required />
                    <input type="reset" class="btn btn-danger btn-block mt-3" name="reset" value="Kosongkan" />

                </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>