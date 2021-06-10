<?php

require_once("../../../auth_user.php");
require_once("../../../config.php");

//list semua data
$sql = $db->prepare("SELECT * FROM transaksi where id_pelanggan = :id ORDER BY nama ASC");
$sql->bindParam(":id", $_SESSION["user"]['id']);
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($result);
// echo '</pre>';
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
                    <a href="#" class="list-group-item list-group-item-action active">Menu Pemesanan</a>
                    <a href="../konfirmasi/list.php" class="list-group-item list-group-item-action ">Konfirmasi Pembayaran</a>
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
                                    <label for="">Transaksi ID : <?php echo $data['tiket_trx']?></label>
                                    <br>
                                    <label for="">Nama Barang : <?php echo $data['nama']?></label>
                                    <br>
                                    <label for="">Kode Barang : <?php echo $data['kode_barang']?></label>
                                    <br>
                                    <label for="">Jumlah Beli : <?php echo $data['jumlah_jual']?></label>
                                    <br>
                                    <label for="">Total Pembayaran : <?php echo $data['total_bayar']?></label>
                                    <br>
                                    <label for="">Status Pembayaran : <strong><?php echo $data['status']?></strong> </label>
                                    <br>
                                    <?php 
                                    if($data['status'] == 'BELUM DIBAYAR'){ ?>
                                        <a href="../konfirmasi/upload.php?tiket_trx=<?php echo $data['tiket_trx'] ?>" class="btn btn-warning mt-2 w-100">Upload Konfirmasi Bukti Bayar Anda</a>
                                    <?php } ?>
                                    
                                    <?php 
                                        if($data['status'] == 'DIPROSES' || $data['status'] == 'SEDANG DIKIRIM' || $data['status'] == 'SELESAI') {  ?>
                                            <a href="detail.php?id=<?php echo $data['id']; ?>" class="btn btn-primary mt-2 w-100">Lihat Konfirmasi Bukti Bayar Anda</a>
                                    <?php } ?>


                                    
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>