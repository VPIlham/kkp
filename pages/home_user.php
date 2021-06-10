<?php 

require_once("../auth_user.php"); 
require_once("../config.php");

//list semua data produk
$sqlGetProduk = $db->prepare("SELECT * FROM produk ORDER BY nama ASC");
$sqlGetProduk->execute();

$result = $sqlGetProduk->fetchAll(PDO::FETCH_ASSOC);

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
                        <h3 class="text-capitalize">Hai <?php echo $_SESSION["user"]["nama"] ?></h3>
                        <p><?php echo $_SESSION["user"]["email"] ?>
                            <br><small>Pelanggan</small>
                        </p>

                        <p><a href="logout_user.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="home.php" class="list-group-item list-group-item-action active" aria-current="true">
                        Dashboard
                    </a>
                    <a href="user/pesanan/list.php" class="list-group-item list-group-item-action">Menu Pemesanan</a>
                    <a href="user/konfirmasi/list.php" class="list-group-item list-group-item-action ">Konfirmasi Pembayaran</a>
                </div>
            </div>

            <div class="col-md-8">

                <div class="row">
                <?php foreach($result as $data) { ?>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                            <div class="images"><img src="../../file/<?php echo $data['file_img'] ?>"
                                style="max-width: 100%;">
                                <h4 class="den_text croissants"><?php echo $data['nama'] ?></h4>
                                <a class="btn btn-success" href="user/pesanan/tambah.php?id=<?php echo $data['id']; ?>">pesan</a>
                                
                            </div>
                        </div>
                        
                        </div>
                    </div>
                   <?php } ?>
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>