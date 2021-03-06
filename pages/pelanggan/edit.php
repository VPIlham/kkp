<?php
    
    require_once("../../auth.php");
    require_once("../../config.php");

    if(!isset($_GET['id'])){
        die("Error: ID Tidak Dimasukkan");
    }
    
    $query = $db->prepare("SELECT * FROM pelanggan WHERE id = :id");
    $query->bindParam(":id", $_GET['id']);
    $query->execute();

    if($query->rowCount() == 0){
        die("Error: Nama user tidak ditemukan!");
    } else {
        $data = $query->fetch();
    }

    if(isset($_POST['submit'])){
       
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $jkt = filter_input(INPUT_POST, 'jk', FILTER_SANITIZE_STRING);
        $kota = filter_input(INPUT_POST, 'kota', FILTER_SANITIZE_STRING);
        //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $created_at = filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_STRING);
        

       
        
        // enkripsi password
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        
        // menyiapkan query
        $sql = "UPDATE pelanggan set `nama` =:nama , `alamat` =:alamat, `nomor_telp` =:nomor_telp, `jk` =:jk,  `kota` =:kota , `email` =:jk, `file_img` =:email, `created_at` =:created_at where id=:id";

        $params = array(
            ":nama" => $nama,
            ":alamat" => $alamat,
            ":nomor_telp" => $nomor_telp,
            ":jk" => $jk,
            ":kota" => $kota,
            ":email" => $email,
            ":created_at" => $created_at,
            
        );
    
        // eksekusi query untuk menyimpan ke database
        
        $stmt = $db->prepare($sql);
        $saved = $stmt->execute($params);

        header("location: list.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
            <div class="card">
                    <div class="card-body text-center">
                        <h3 class="text-capitalize" >Hai <?php echo $_SESSION["admin"]["nama"] ?></h3>
                        <p><?php echo $_SESSION["admin"]["email"] ?>
                        <br><small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager'?></small>
                        </p>
                        <small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager'?></small>
                        <p><a href=".../../../logout.php">Logout</a></p>
                    </div>
                </div>
                <div class="list-group">
                    <a href="../home.php" class="list-group-item list-group-item-action " aria-current="true">
                        Dashboard
                    </a>
                    <a href="../produk/list.php" class="list-group-item list-group-item-action">Produk</a>
                    <a href="../karyawan/list.php" class="list-group-item list-group-item-action ">Karyawan</a>
                    <a href="../transaksi/list.php" class="list-group-item list-group-item-action">Transaksi</a>
                    <a href="list.php" class="list-group-item list-group-item-action active">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <h5 class="text-capitalize">Data User <?php echo $data['nama'] ?></h5>
                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">No</label>
                                <div class="col-sm-10">
                                    <label class="mt-2"><strong><?php echo $data['id'] ?></strong></label>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data['nama'] ?>"
                                        name="nama">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data['alamat'] ?>"
                                        name="alamat">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">No Telp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data['nomor_telp'] ?>"
                                        name="nomor_telp">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data['kota'] ?>"
                                        name="kota">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?php echo $data['email'] ?>"
                                        name="email">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="<?php echo $data['created_at'] ?>"
                                        name="created_at">
                                </div>
                            </div>

                            
                            
                            
                            <input class="btn btn-primary mt-3 mb-3 col-md-3" style="float:right !important"
                                type="submit" name="submit"> 
                                <a href="../karyawan/list.php" class="mt-3 mb-3 btn btn-warning " style="float:right !important;margin-right:15px !important">Kembali</a>
                        </form>

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