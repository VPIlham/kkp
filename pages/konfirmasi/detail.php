<?php
require_once("../../auth.php");
require_once("../../config.php");

if (!isset($_GET['tiket_trx'])) {
    die("Error: Transaksi Tidak Ditemukan");
}

//panggil data konfirmasi
$sqlPanggilKonfirmasi = $db->prepare("SELECT * FROM konfirmasi_bayar where tiket_trx = :tiket_trx");
$sqlPanggilKonfirmasi->bindParam(":tiket_trx", $_GET['tiket_trx']);
$sqlPanggilKonfirmasi->execute();

$resultKonfirmasi = $sqlPanggilKonfirmasi->fetchAll(PDO::FETCH_ASSOC);
$tiket_id = $resultKonfirmasi[0]['tiket_trx'];

$dataID = $resultKonfirmasi[0]['kode_barang'];
$dataTotalBayar = $resultKonfirmasi[0]['total_bayar'];

$dataIDAdmin=  $_SESSION["admin"]['id'];


//panggil data barang
$sqlPanggilBarang = $db->prepare("SELECT * FROM produk where kode_barang = '$dataID'");
$sqlPanggilBarang->execute();

$resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);

//panggil data transaksi
$sqlPanggilTransaksi = $db->prepare("SELECT * FROM transaksi where tiket_trx = '$tiket_id'");
$sqlPanggilTransaksi->execute();

$resultTransaksi = $sqlPanggilTransaksi->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['upload_transaksi'])) {

    $ambilKodeBarang = $resultBarang[0]['kode_barang'];
    $ambilHargaBarang = $resultBarang[0]['harga'];
    $dataStok = $resultBarang[0]['stok'];
    $dataId = $resultBarang[0]['id'];
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $namaKonfirmasiBayar = $tiket_id;

    //menyiapkan query
    $sqlUpdateKonfirmasi = $db->prepare("UPDATE konfirmasi_bayar set `id_admin` = :id_admin where tiket_trx = '$namaKonfirmasiBayar' ");

    $params = array(
        ":id_admin" => $dataIDAdmin
    );

    $sqlUpdateKonfirmasi->execute($params);

    $sqlUpdateKodeBarang = $db->prepare("UPDATE transaksi set `status` = :status, `id_admin` = :id_admin where tiket_trx = '$namaKonfirmasiBayar' ");

    $paramsTransaksi = array(
        ":status" => $status,
        ":id_admin" => $dataIDAdmin
    );

    $sqlUpdateKodeBarang->execute($paramsTransaksi);

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
                        <h3 class="text-capitalize">Hai <?php echo $_SESSION["admin"]["nama"] ?></h3>
                        <p><?php echo $_SESSION["admin"]["email"] ?>
                            <br><small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager' ?></small>
                        </p>

                        <p><a href=".../../../logout.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="../home.php" class="list-group-item list-group-item-action " aria-current="true">
                        Dashboard
                    </a>
                    <a href="../produk/list.php" class="list-group-item list-group-item-action ">Produk</a>
                    <a href="../karyawan/list.php" class="list-group-item list-group-item-action ">Karyawan</a>
                    <a href="../transaksi/list.php" class="list-group-item list-group-item-action ">Transaksi</a>
                    <a href="../konfirmasi/list.php" class="list-group-item list-group-item-action active">Konfirmasi</a>
                    <a href="../pelanggan/list.php" class="list-group-item list-group-item-action">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-6">

                <p>&larr; <a href="list.php">Kembali</a>


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
                            <img src="../../file/<?php echo $resultKonfirmasi[0]['image']; ?>" alt="" srcset="">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah_jual">Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" value="<?php echo $resultTransaksi['status'] ?>" name="status" aria-label="Default select example" required>
                                <option selected disabled><?php echo $resultTransaksi['status'] ?></option>
                                <option value="DIPROSES">DIPROSES</option>
                                <option value="SEDANG DIKRIM">SEDANG DIKIRIM</option>
                                <option value="SELESAI">SELESAI</option>
                                <option value="GAGAL">GAGAL</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-success btn-block mt-3" name="upload_transaksi" value="Update" required />
                    <input type="reset" class="btn btn-danger btn-block mt-3" name="reset" value="Kosongkan" />

                </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>