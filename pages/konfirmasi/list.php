<?php

require_once("../../auth.php");
require_once("../../config.php");

//list semua data
$sql = $db->prepare("SELECT * FROM konfirmasi_bayar ORDER BY id DESC ");
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

//list hasil search
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>
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
                    <a href="../list.php" class="list-group-item list-group-item-action active">Konfirmasi</a>
                    <a href="../pelanggan/list.php" class="list-group-item list-group-item-action">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card p-3" style="overflow: auto;width:100%;white-space: nowrap">
                    <div class="card-body">
                        <br>
                        <h5 class="text-center">Data Konfirmasi</h5>
                        <form action="" method="get" style="float:right">
                            <input type="text" name="cari" placeholder="Cari Nama Produk">
                            <input type="submit" class="btn btn-primary" value="CARI">
                            <a href="list.php" class="btn btn-success">RESET</a>
                        </form>

                        <?php
                        if (isset($_GET['cari'])) {

                            $cari = $_GET['cari'];
                            $data = $db->prepare("SELECT * from konfirmasi_bayar where tiket_trx like '%" . $cari . "%'");

                            $data->execute();
                            $resultSearch = $data->fetchAll(PDO::FETCH_ASSOC);

                        ?>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scop="col">Tiket Transakasi</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col"> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($resultSearch == null) { ?>
                                        <tr>
                                            <td scope="row">Data yang Anda cari kosong</td>
                                        </tr>
                                    <?php } ?>

                                    <?php
                                    $i = 1;
                                    foreach ($resultSearch as $user) { ?>

                                        <tr>
                                            <td><?php echo $user['tiket_trx'] ?></td>
                                            <td><?php echo $user['kode_barang'] ?></td>
                                            <td><?php echo $user['total_bayar'] ?></td>
                                            <td><?php echo $user['status'] ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($user['created_at']));  ?></td>

                                            <td>
                                                <?php
                                                if ($_SESSION["admin"]["role"] == 1) { ?>
                                                    <a class="btn btn-warning" href="edit.php?id=<?php echo $user['id']; ?>">Edit</a> |

                                                <?php } ?>
                                                <a class="btn btn-success" href="detail.php?id=<?php echo $user['id'] ?>">Lihat</a>

                                                <?php
                                                if ($_SESSION["admin"]["role"] == 1) { ?>
                                                    | <a class="btn btn-danger" href="hapus.php?id=<?php echo $user['id']; ?>">Hapus</a>
                                                <?php } ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


                        <?php } else { ?>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scop="col">Tiket Transakasi</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col"> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($result as $user) { ?>
                                        <tr>

                                            <td><?php echo $user['tiket_trx'] ?></td>
                                            <td><?php echo $user['kode_barang'] ?></td>
                                            <td><?php echo $user['total_bayar'] ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($user['created_at']));  ?></td>
                                            <td>
                                               
                                                <a class="btn btn-success" href="detail.php?tiket_trx=<?php echo $user['tiket_trx'] ?>">Lihat</a>

                                                <?php
                                                if ($_SESSION["admin"]["role"] == 1) { ?>
                                                    | <a class="btn btn-danger" href="hapus.php?tiket_trx=<?php echo $user['tiket_trx']; ?>">Hapus</a>
                                                <?php } ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        <?php } ?>

                        <a href="cetak.php" target="_blank" class="btn btn-primary">Cetak PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>