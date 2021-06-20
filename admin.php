<?php
/**
 * using mysqli_connect for database connection
 */
 
$databaseHost = 'localhost';
$databaseName = 'db_kkp';
$databaseUsername = 'melis';
$databasePassword = '12345ms';
 
$koneksi = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
//simpanbtn
if(iset($_POST['simpan'])){
    //pengjuian ada yg akan diedit
    if($_GET['hal'] == "edit"){
        //logika penyimpanan
    if(isset($_POST['edit'])){
        $edit = mysqli_query($koneksi, "UPDATE produk set
         id ='$_POST[id]',kode_barang =  '$_POST[kode_baranng]', nama = '$_POST[nama]', deskripsi = '$_POST[deskripsi]',
         stok = '$_POST[stok]', harga = '$_POST[harga]', file_img = '$_POST[file_img]', created_by = '$_POST[created_by]', 
         created_at = '$_POST[created_at]' WHERE id = '$_GET[id]");

//jika penyimpanan sukses        
if(isset($_GET['pesan'])){
    $pesan = $_GET['pesan'];
    if($pesan == "input"){
        echo "Data Berhasil diinput";
    }elseif($pesan == "update"){
        echo "Data berhasil dirubah.";
    }elseif($pesan == "hapus"){
        echo "Data berhasil di hapus";
    }
}
    }

    //btn edit dan hapus
    if(isset($_GET['hal'])){
        //edit data
        if($_GET['hal'] == "edit"){
            //show data yg diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM 'produk') WHERE id = '$_GET[id]");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $nid-=-$data['id'];
                $nnip-=-$data['nip'];
                $nemail-=-$data['email'];
                $npassword-=-$data['password'];
                $nrol-=-$data['rol'];
                $nnotelp-=-$data['nomor_telp'];
                $njk-=-$data['jk'];
                $ncreate-=-$data['create_at'];
            }
        }
    }
    }
}

//images
    $simpangambar ="image"; 
    //folder save
    if(!empty($_FILES['file_img']['tmp_name'])){
        $jenisimg=$_FILES['file_img']['type'];
        //format gambar
        if($jenisimg=="image/jpeg" || $jenisimg=="image/jpg" || $jenisimg=="image/gif" || $jenisimg=="image/png"){
            $lampiran = $namafolder . basename($_FILES['file_img']['name']);

            //upload gambar
            if(move_uploaded_file($_FILES['file_img']['tmp_name'], $lampiran)){
                $insert = mysql_query($query_insert);
                echo "Gambar berhasil disimpan";
            }else{
                echo "Gambar gagal dikirim";
            }
        }
    } 



//logika penyimpanan
    if(isset($_POST['simpan'])){
        $simpan = mysqli_query($koneksi, "INSERT INTO produk (id, kode_barang, nama, deskripsi, stok, harga,
        file_img, created_by, created_at) 
        VALUES (id ='$_POST(id)',kode_barang =  '$_POST(kode_baranng)', nama = '$_POST(nama)', 
        deskripsi = '$_POST(deskripsi)', stok = '$_POST(stok)', harga = '$_POST(harga)', file_img = '$_POST(file_img)', 
        created_by = '$_POST(created_by)', created_at = '$_POST(created_at)' ");

//jika penyimpanan sukses        
if(isset($_GET['pesan'])){
    $pesan = $_GET['pesan'];
    if($pesan == "input"){
        echo "Data Berhasil diinput";
    }elseif($pesan == "update"){
        echo "Data berhasil di runah.";
    }elseif($pesan == "hapus"){
        echo "Data berhasil dihapus";
    }
}
    }

    //btn edit dan hapus
    if(isset($_GET['hal'])){
        //edit data
        if($_GET['hal'] == "edit"){
            //show data yg diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = '$_GET[id]");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $nid-=-$data['id'];
                $nkb-=-$data['kode_barang'];
                $nnama-=-$data['nama'];
                $ndeskripsi-=-$data['deskripsi'];
                $nstok-=-$data['stok'];
                $ngambar-=-$data['file_gambar'];
                $nharga-=-$data['harga'];
                $ndibuat-=-$data['created_by'];
                $ncreate-=-$data['create_at'];
            }
        }elseif(isset($_GET['hapus'])){
                            $hapus = $_GET['hapus'];
                            if($hapus == "input"){
                                echo "Data berhasil dihapus";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>KKP</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
        <h1 class="text-center">PT. Delima Karya Putra GRC</h1><br/>
            <!--form card produk-->
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    Form Input Data Barang
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group <?php echo (!empty($nid)) ?  'has-error' : '';?>">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control" placeholder="Masukan ID Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($nkb)) ?  'has-error' : '';?>">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Masukan Kode Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($nnama)) ?  'has-error' : '';?>">
                            <label>Nama Barang</label>
                            <input type="text" name="nama"  class="form-control" placeholder="Masukan Nama Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($ndeskripsi)) ?  'has-error' : '';?>">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi"  class="form-control" placeholder="Masukan Deskripsi Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($nstok)) ?  'has-error' : '';?>">
                            <label>Stok</label>
                            <input type="text" name="stok"  class="form-control" placeholder="Masukan Jumlah Stok" required>
                        </div>
                        <div class="form-group <?php echo (!empty($nharga)) ?  'has-error' : '';?>">
                            <label>Harga</label>
                            <input type="text" name="harga"  class="form-control" placeholder="Masukan Harga Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($ngambar)) ?  'has-error' : '';?>">
                            <label>Gambar</label>
                            <input type="file" name="file-img" id="File-img" class="form-control" placeholder="Masukan File Gambar Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($nndibuat)) ?  'has-error' : '';?>">
                            <label>Dibuat Oleh</label>
                            <input type="text" name="created_by"  class="form-control" placeholder="Masukan Pembuat Barang" required>
                        </div>
                        <div class="form-group <?php echo (!empty($ncreate)) ?  'has-error' : '';?>">
                            <label>Tanggal</label>
                            <input type="date" name="created_at"  class="form-control" >
                        </div>

                        <!--buttonn-->
                        <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                        <button type="reset" class="btn btn-danger" name="reset">Kosongkan</button>
                    </form>
                </div>
            </div>

            <!--awal card tabel-->
            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    Daftar Inputan Stok Produk
                </div>
                <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-grey">
                                  <tr class="text-center">
                                        <th scope="col">ID</th>
                                        <th scope="col">Koe Barang</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Dibuat Oleh</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                            </thead>
                        <?php
                           include "koneksi.php";
                            $tampil = mysqli_query($koneksi, "SELECT * from produk order id desc")or die(mysql_error());
                            $id = 1;
                            while($data = mysqli_fetch_array($tampil)){

                            
                        
                        ?>
                    <tbody>
                    <tr>
                        <td><?php echo $id++; ?></td>
                        <td><?php echo $data['nip']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['rol']; ?></td>
                        <td><?php echo $data['nomor_telp']; ?></td>
                        <td><?php echo $data['jk'];?></td>
                        <td><?php echo $data['created_at'];?></td>        
                        <td>
                                <a href="index.php?hal=edit&id=<?$data['id']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus&id=<?$data['id']?>" oneclick="retrun confirm(
                                   'Apakah yakin ingin menghapus data?' )" class="btn btn-danger">Hapus<a>

                            </td>
                    </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
                        

        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>    