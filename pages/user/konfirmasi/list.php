<?php

require_once("../../../auth_user.php");
require_once("../../../config.php");

//list semua data
$sql = $db->prepare("SELECT * FROM konfirmasi_bayar where id_pelanggan = :id ORDER BY id ASC");
$sql->bindParam(":id", $_SESSION["user"]['id']);
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

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
                            <br><small>Pelanggan</small>
                        </p>

                        <p><a href="../../../logout_user.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="../../home_user.php" class="list-group-item list-group-item-action " aria-current="true">
                        Dashboard
                    </a>
                    <a href="../pesanan/list.php" class="list-group-item list-group-item-action ">Menu Pemesanan</a>
                    <a href="#" class="list-group-item list-group-item-action active">Konfirmasi Pembayaran</a>
                </div>
            </div>

            <div class="col-md-8">

                <div class="row">
                    <?php
                    $i = 1;
                    foreach ($result as $data) { ?>

                        <div class="col-md-8 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <strong>Kode Transaksi #<?php echo $data['tiket_trx'] ?> <br>Waktu : <small> <?php echo $data['created_at'] ?></small></strong>
                                    <?php if ($data['image'] == null) { ?>
                                        <a href="upload.php?tiket_trx=<?php echo $data['tiket_trx'] ?>" class="btn btn-primary" style="float: right !important">Proses Konfirmasi Bayar</a>
                                    <?php } ?>
                                    <?php if ($data['image'] != null ){ ?>
                                        <a href="detail.php?tiket_trx=<?php echo $data['tiket_trx'] ?>" class="btn btn-success" style="float: right !important">Detail Konfirmasi Bayar</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>

                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>