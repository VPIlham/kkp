<?php 
    
    require_once("../../auth.php");
    require_once("../../config.php");

    if(!isset($_GET['id'])){
        die("Error: ID Tidak Dimasukkan");
    }
    
    //list semua data
    $sql = $db->prepare("SELECT * FROM user where id=:id ");
    $sql->bindParam(":id", $_GET['id']);
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telp</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Kota</th>
                <th scope="col"> Email</th>
                <th scope="col">Tgl Masuk</th>

            </tr>
        </thead>
        <tbody>
            <?php 
                            $i = 1;
                            foreach ($result as $user) {?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $user['nama'] ?></td>
                <td><?php echo $user['alamat'] ?></td>
                <td><?php echo $user['nomor_telp'] ?></td>
                <td><?php echo $user['jk'] == 0 ? 'Laki-Laki': 'Perempuan' ?></td>
                <td><?php echo $user['kota'] ?></td>
                <td><?php echo $user['email']?></td>
                <td><?php echo date("d/m/Y", strtotime($user['created_at']));  ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>


    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>