<?php
require_once("../../auth.php");
require_once("../../config.php");

if(!isset($_GET['id'])){
    die("Error: Barang Tidak Ditemukan");
}

$query = $db->prepare("SELECT * FROM transaksi WHERE id =:id");
$query->bindParam(":id" , $_GET['id']);
$query->execute();

if($query->rowCount() == 0){
    die("Error:  Barang Tidak Ditemukan");
} else {
    $data = $query->fetch();
}

if(isset($_POST['submit'])){
    
    $kode_barang = filter_input(INPUT_POST, 'kode_barang', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $jumlah_jual = filter_input(INPUT_POST, 'jumlah_jual', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
    $total_bayar = filter_input(INPUT_POST, 'total_bayar', FILTER_SANITIZE_STRING);
    $createdat = filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    
    
    //menyiapkan sql
    $sql = "UPDATE transaksi set `kode_barang` =:kode_barang, `nama`=:nama, `status` = :status,`jumlah_jual` =:jumlah_jual, `harga` =:harga,
     `total_bayar` =:total_bayar, `created_at` =:created_at WHERE kode_barang =:kode_barang";
    
    $params = array(
        ":kode_barang" =>$kode_barang,
        ":nama" =>$nama,
        ":status" => $status,
        ":jumlah_jual"=>$jumlah_jual,
        ":harga"=>$harga,
        ":total_bayar"=>$total_bayar,
        ":created_at"=> $createdat,
    );
    
    //ekseskui quert untuk menyimpan ke database
    $stmt = $db->prepare($sql);
    $saved = $stmt->execute($params);

    header("Location: list.php");
      
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTP-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewvort" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="text-capitalize">Hai <?php echo $_SESSION["admin"]["nama"]?></h3>
                        <p><?php echo $_SESSION["admin"]["email"]?>
                            <br><small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager' ?></small>
                        </p>
                        <small><?php echo $_SESSION["admin"]["role"] == 0 ? 'Karyawan' : 'Manager'?></small>
                    </div>
                </div>
                <div class="list-group">
                    <a href="../home.php" class="list-group-item list-group-actin ">Dasboard</a>
                    <a href="../produk/list.php" class="list-group-item list-group-actin  ">Produk</a>
                    <a href="../karyawan/list.php" class="list-group-item list-group-actin ">Karyawan</a>
                    <a href="list.php" class="list-group-item list-group-actin active ">Transaksi</a>
                    <a href="../pelanggan/list.php" class="list-group-item list-group-item-action">Pelanggan</a>
                    <a href="../feedback/list.php" class="list-group-item list-group-item-action">Feedback</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <h5 class="text-capitalize">Data Transakasi
                                <?php echo isset($data['nama']) ? $data['nama'] : ''; ?></h5>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kode Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="<?php echo isset($data['kode_barang']) ? $data['kode_barang'] : 'tidak ada'; ?>"
                                        name="kode_barang">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="<?php echo isset($data['nama']) ? $data['nama'] : 'tidak ada'; ?>"
                                        name="nama">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="<?php echo isset($data['jumlah_jual']) ? $data['jumlah_jual'] : ''; ?>"
                                        name="jumlah_jual">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" name="harga">
                                </div>
                            </div>


                            <div class="mb-2 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="<?php echo isset($data['total_bayar']) ? $data['total_bayar'] : ''; ?>"
                                        name="total_bayar">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" value="<?php echo $data['status'] ?>" name="status" aria-label="Default select example"
                                        required>
                                        <option selected disabled ><?php echo $data['status'] ?></option>
                                        <option value="DIPROSES">DIPROSES</option>
                                        <option value="SEDANG DIKRIM">SEDANG DIKIRIM</option>
                                        <option value="SELESAI">SELESAI</option>
                                        <option value="GAGAL">GAGAL</option>
                                    </select>
                                </div>
                            </div>

                            <input class="btn btn-primary mt-3 col-md-3" style="float:right !important" type="submit"
                                name="submit">
                            <a href="list.php" class="mt-3 mb-3 btn btn-warning "
                                style="float:right !important;margin-right:15px !important">Kembali</a>
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