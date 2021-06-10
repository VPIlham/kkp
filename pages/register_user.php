<?php

require_once("../config.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $nomor_telp = filter_input(INPUT_POST, 'nomor_telp', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
    $jk = filter_input(INPUT_POST, 'jk', FILTER_SANITIZE_STRING);
    $kota = filter_input(INPUT_POST, 'kota', FILTER_SANITIZE_STRING);
    $prov = filter_input(INPUT_POST, 'provinsi', FILTER_SANITIZE_STRING);
    
    
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO user (nama, email, password, nomor_telp , jk, alamat, kota, provinsi  ) 
            VALUES (:nama, :email, :password, :nomor_telp, :jk, :alamat, :kota, :provinsi)";


    $stmt = $db->prepare($sql);


    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":email" => $email,
        ":password" => $password,
        ":nomor_telp" => $nomor_telp,
        ":jk" => $jk,
        ":alamat" => $alamat,
        ":kota" => $kota,
        ":provinsi" => $prov,

    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    
print_r($saved);
return;

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- menyisipkan bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <p>&larr; <a href="../index.php">Home</a>
                    
                    <p>Sudah punya akun? <a href="login_user.php">Login di sini</a></p>

                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama kamu" />
                        </div>

                        <div class="form-group">
                            <label for="nama">Alamat</label>
                            <input class="form-control" type="text" name="alamat" placeholder="Alamat kamu" />
                        </div>

                        <div class="form-group">
                            <label for="usernama">Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email kamu" />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" />
                        </div>

                        <div class="form-group">
                            <label >Jenis Kelamin</label>
                            <select class="form-select" name="jk" aria-label="Default select example">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="0">Laki Laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nomor Telepon</label>
                            <input class="form-control" type="text" name="nomor_telp" placeholder="Nomor Telepon Kamu" />
                        </div>

                        <div class="form-group">
                            <label >Provinsi</label>
                            <input class="form-control" type="text" name="provinsi" placeholder="Provinsi" />
                        </div>


                        <div class="form-group">
                            <label >Kota</label>
                            <input class="form-control" type="text" name="kota" placeholder="Kota" />
                        </div>
                        
                        <input type="submit" class="btn btn-success btn-block mt-3" name="register" value="Daftar" />

                    </form>

            </div>

            <div class="col-md-6">
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>