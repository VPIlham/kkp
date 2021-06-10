<?php
require_once("../../../auth_user.php");
require_once("../../../config.php");

if (!isset($_GET['id'])) {
    die("Error: Barang Tidak Ditemukan");
}

//panggil data barang
$sqlPanggilBarang = $db->prepare("SELECT * FROM transaksi where id = :id");
$sqlPanggilBarang->bindParam(":id", $_GET['id']);
$sqlPanggilBarang->execute();

$resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Transaksi</title>

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
                    <a href="#" class="list-group-item list-group-item-action active">Menu Pemesanan</a>
                    <a href="../konfirmasi/list.php" class="list-group-item list-group-item-action ">Konfirmasi Pembayaran</a>
                </div>
            </div>
            <div class="col-md-6">

                <p>&larr; <a href="../../home_user.php">Kembali</a>


                <form method="POST" action="">

                    <div class="form-group">
                        <label for="jumlah_jual">Transaksi ID</label>
                        <input class="form-control" type="text" value="<?php echo $resultBarang[0]['tiket_trx']; ?>" disabled placeholder="Jumlah Stok barang" disabled />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Nama Barang </label>
                        <input class="form-control" type="text" value="<?php echo $resultBarang[0]['nama']; ?>" disabled placeholder="Jumlah Stok barang" disabled />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Kode Barang </label>
                        <input class="form-control" type="text" value="<?php echo $resultBarang[0]['kode_barang']; ?>" disabled placeholder="Jumlah Stok barang" disabled />
                    </div>


                    <div class="form-group">
                        <label for="jumlah_jual">Jumlah yang dibeli</label>
                        <input class="form-control" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="jumlah_jual" value="<?php echo $resultBarang[0]['jumlah_jual']; ?>" disabled placeholder="Jumlah yang dibeli" />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Total Bayar</label>
                        <input class="form-control" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="jumlah_jual" value="<?php echo $resultBarang[0]['total_bayar']; ?>" disabled placeholder="Jumlah yang dibeli" />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_jual">Status</label>
                        <input class="form-control" type="text" name="jumlah_jual" value="<?php echo $resultBarang[0]['status']; ?>" disabled placeholder="Jumlah yang dibeli" />
                    </div>

                    <div class="form-group">
                        <label for="created_at">Tanggal </label>
                        <input class="form-control" disabled name="created_at" value="<?php echo $resultBarang[0]['created_at']; ?>" placeholder="Tanggal" />
                    </div>

                    <input type="submit" class="btn btn-success btn-block mt-3" name="tambah_transaksi" value="Simpan" required />
                    <a class="btn btn-danger btn-block mt-3" href="list.php">Kembali</a>

                    <a href="" class="mt-3 btn btn-primary">CETAK</a>

                </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>