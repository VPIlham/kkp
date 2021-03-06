<?php
 require_once("../../auth.php");
 require_once("../../config.php");

 //panggil data barang
 $sqlPanggilBarang = $db->prepare("SELECT * FROM produk ORDER BY nama ASC");
 $sqlPanggilBarang->execute();

 $resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);
 
 //panggil data pelanggan
 $sqlPanggilUser = $db->prepare("SELECT * FROM user ORDER BY nama ASC");
 $sqlPanggilUser->execute();

 $resultUser = $sqlPanggilUser->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['tambah_transaksi'])){

    $tiket_trx = filter_input(INPUT_POST, 'tiket_trx', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $jumlah_jual = filter_input(INPUT_POST, 'jumlah_jual', FILTER_SANITIZE_STRING);
    $created_at = filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_STRING);
    $id_pelanggan = filter_input(INPUT_POST, 'id_pelanggan', FILTER_SANITIZE_STRING);

    //cek kode barang 
    $sqlKodeBarang = $db->prepare("SELECT * FROM produk where nama = '$nama'");
    $sqlKodeBarang->execute();
    $dataBarang = $sqlKodeBarang->fetch();

    echo '<pre>';
    print_r($sqlKodeBarang);
    echo '</pre>';
    
    $ambilKodeBarang = $dataBarang['kode_barang'];
    $ambilHargaBarang = $dataBarang['harga'];
    $dataStok = $dataBarang['stok'];

    //cek pelanggan
    $sqlIdUser = $db->prepare("SELECT * FROM user where id = $id_pelanggan");
    $sqlIdUser->execute();
    $dataUser = $sqlIdUser->fetch();
            
    //menyiapkan query
    $sql = "INSERT INTO transaksi ( tiket_trx, kode_barang, nama, jumlah_jual, harga, total_bayar, id_admin, status, id_pelanggan, created_at ) 
    VALUES (:tiket_trx, :kode_barang, :nama, :jumlah_jual, :harga, :total_bayar, :id_admin , :status, :id_pelanggan,:created_at)";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":tiket_trx" => $tiket_trx,
        ":kode_barang" => $ambilKodeBarang,
        ":nama" => $nama,
        ":id_admin" => $_SESSION["admin"]["nip"],
        ":jumlah_jual" => $jumlah_jual,
        ":harga" => $ambilHargaBarang,
        ":status" => 'DIPROSES',
        ":id_pelanggan" => $dataUser['id'],
        ":total_bayar" => $jumlah_jual  * $ambilHargaBarang ,
        ":created_at" => $created_at,
    );
    
    $saved = $stmt->execute($params);

    //pengurangan stok
    $sqlUpdateKodeBarang = $db->prepare("UPDATE produk set stok = $dataStok - $jumlah_jual where nama = '$nama' ");
    $sqlUpdateKodeBarang->execute();

    // eksekusi query untuk menyimpan ke database
    

    // jika query simpan berhasil, maka produk sudah terdaftar
    // maka alihkan ke halaman list
     header("Location: list.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Transaksi</title>

    <!-- menyisipkan bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>

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
                    <a href="../produk/list.php" class="list-group-item list-group-item-action ">Produk</a>
                    <a href="../karyawan/list.php" class="list-group-item list-group-item-action ">Karyawan</a>
                    <a href="list.php" class="list-group-item list-group-item-action active">Transaksi</a>
                    <a href="../pelanggan/list.php" class="list-group-item list-group-item-action">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-6">

                <p>&larr; <a href="list.php">Kembali</a>


                    <form method="POST" action="">

                        <div class="form-group">
                            <label for="kode_barang">Kode Transaksi</label>
                            <input class="form-control" type="text" name="tiket_trx" placeholder="Kode barang " />
                        </div>

                        <div class="form-group">
                            <label for="nama">Pilih Barang</label>
                            <select class="form-select" aria-label="Default select example" name="nama">
                                <option selected disabled>Pilih Barang</option>

                                <?php foreach ($resultBarang as $barang) {?>
                                <option value="<?php echo $barang['nama']  ?>"><?php echo $barang['nama'] ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama">Pilih Pelanggan</label>
                            <select class="form-select" aria-label="Default select example" name="id_pelanggan">
                                <option selected disabled>Pilih Pelanggan</option>

                                <?php foreach ($resultUser as $user) {?>
                                <option value="<?php echo $user['id']  ?>"><?php echo $user['nama'] ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_jual">Jumlah </label>
                            <input class="form-control" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                name="jumlah_jual" placeholder="Jumlah Stok barang" />
                        </div>

                        <div class="form-group">
                            <label for="created_at">Tanggal </label>
                            <input class="form-control" type="date" name="created_at" placeholder="Tanggal" />
                        </div>

                        <input type="submit" class="btn btn-success btn-block mt-3" name="tambah_transaksi"
                            value="Simpan" required />
                        <input type="reset" class="btn btn-danger btn-block mt-3" name="reset" value="Kosongkan" />

                    </form>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>