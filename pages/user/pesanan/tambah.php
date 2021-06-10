<?php
 require_once("../../../auth_user.php");
 require_once("../../../config.php");

 if(!isset($_GET['id'])){
    die("Error: Barang Tidak Ditemukan");
}

 //panggil data barang
 $sqlPanggilBarang = $db->prepare("SELECT * FROM produk where id = :id");
 $sqlPanggilBarang->bindParam(":id" , $_GET['id']);
 $sqlPanggilBarang->execute();

 $resultBarang = $sqlPanggilBarang->fetchAll(PDO::FETCH_ASSOC);
 
if(isset($_POST['tambah_transaksi'])){

    $nama = $resultBarang[0]['nama'];
    $jumlah_jual = filter_input(INPUT_POST, 'jumlah_jual', FILTER_SANITIZE_STRING);
    $created_at = filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_STRING);
    $id_pelanggan = filter_input(INPUT_POST, 'id_pelanggan', FILTER_SANITIZE_STRING);
    
    $ambilKodeBarang = $resultBarang[0]['kode_barang'];
    $ambilHargaBarang = $resultBarang[0]['harga'];
    $dataId = $resultBarang[0]['id'];
    $dataStok = $resultBarang[0]['stok'];


            
    //menyiapkan query
    $sql = "INSERT INTO transaksi ( tiket_trx, produk_id, kode_barang, nama, jumlah_jual, harga, total_bayar, id_admin, status, id_pelanggan, created_at ) 
    VALUES (:tiket_trx, :produk_id, :kode_barang, :nama, :jumlah_jual, :harga, :total_bayar, :id_admin , :status, :id_pelanggan,:created_at)";

    $stmt = $db->prepare($sql);

    $ran = rand(10,100) + 1000;
    // bind parameter ke query
    $params = array(
        ":tiket_trx" => $ran,
        ":produk_id" => $dataId,
        ":kode_barang" => $ambilKodeBarang,
        ":nama" => $nama,
        ":id_admin" => null,
        ":jumlah_jual" => $jumlah_jual,
        ":harga" => $ambilHargaBarang,
        ":status" => 'BELUM DIBAYAR',
        ":id_pelanggan" =>  $_SESSION["user"]['id'],
        ":total_bayar" => $jumlah_jual  * $ambilHargaBarang ,
        ":created_at" => $created_at,
    );
    
    $saved = $stmt->execute($params);

    //create table konfirmasi
    $sqlBuktiBayar = $db->prepare("INSERT INTO konfirmasi_bayar ( id_produk, id_pelanggan, tiket_trx, total_bayar) 
    VALUES (:id_produk, :id_pelanggan, :tiket_trx, :total_bayar )");

    $paramsBB = array(
        ":tiket_trx" => $ran,
        ":id_produk" => $dataId,
        ':id_pelanggan' =>   $_SESSION["user"]['id'],
        ":total_bayar" => $jumlah_jual  * $ambilHargaBarang,
    );

    $sqlBuktiBayar->execute($paramsBB);

    //pengurangan stok
    $sqlUpdateKodeBarang = $db->prepare("UPDATE produk set stok = $dataStok - $jumlah_jual where nama = '$nama' ");
    $sqlUpdateKodeBarang->execute();


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
                            <label for="jumlah_jual">Nama Barang </label>
                            <input class="form-control" type="text" 
                                value="<?php echo $resultBarang[0]['nama']; ?>" disabled placeholder="Jumlah Stok barang" />
                        </div>


                        <div class="form-group">
                            <label for="jumlah_jual">Jumlah yang dibeli</label>
                            <input class="form-control" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                name="jumlah_jual" placeholder="Jumlah yang dibeli" required />
                        </div>

                        <div class="form-group">
                            <label for="created_at">Tanggal </label>
                            <input class="form-control" type="date" name="created_at" placeholder="Tanggal"  required/>
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