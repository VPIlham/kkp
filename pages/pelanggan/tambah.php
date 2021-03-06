<?php

require_once("../../config.php");
require_once("../../auth.php");

if(isset($_POST['user'])){

    // filter data yang diinputkan
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $nomor_telp = filter_input(INPUT_POST, 'nomor_telp', FILTER_SANITIZE_STRING);
        $jk = filter_input(INPUT_POST, 'jk', FILTER_SANITIZE_STRING);
        $kota = filter_input(INPUT_POST, 'kota', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $created_at = filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_STRING);
        
    
    // enkripsi password
     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO admin (id, nama, alamat,nomor_telp, jk, kota,  email, created_at ) 
            VALUES (:id, :nama, :alamat, :nomor_telp, :jk, :kota, :email, :created_at)";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":id" => $id,
        ":nama" => $nama,
        ":alamat" => $alamat,
        ":nomor_telp" => $nomor_telp,
        ":jk" => $jk,
        ":kota" => $kota,
        ":email" => $email
        
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);


    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman list
    if($saved) header("Location: list.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar User</title>

    <!-- menyisipkan bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg-light">

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
                    <a href="../home.php" class="list-group-item list-group-item-action " aria-current="true">
                        Dashboard
                    </a>
                    <a href="../produk/list.php" class="list-group-item list-group-item-action">Produk</a>
                    <a href="../produk/list.php" class="list-group-item list-group-item-action ">Karyawan</a>
                    <a href="../transaksi/list.php" class="list-group-item list-group-item-action">Transaksi</a>
                    <a href="../pelanggan/list.php" class="list-group-item list-group-item-action active">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-6">

                <p>&larr; <a href="list.php">Kembali</a>


                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="id">No</label>
                            <input class="form-control" type="text" name="id" placeholder="ID User" />
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama User" />
                        </div>

                        <div class="form-group">
                            <label for="nomor_telp">No Telp</label>
                            <input class="form-control" type="text" name="nomor_telp" placeholder="No Telp User" />
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-select" name="role">
                                <option selected>Jenis Kelamin</option>
                                <option value="0">Laki-Laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input class="form-control" type="text" name="kota" placeholder="Kota User" />
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="text" name="email" placeholder="E-mail User" />
                        </div>

                        <div class="form-group">
                            <label for="created_at">Tanggal</label>
                            <input class="form-control" type="date" name="created_at"  />
                        </div>

                        

                        <input type="submit" class="btn btn-success btn-block mt-3" name="register" value="Daftar" />

                    </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>