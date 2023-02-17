<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "perpustakaan_2022"; # <---- namadatabase yang tadi kita buat


$koneksi    = mysqli_connect($host, $user, $pass, $db);

$idVendor = "";
$namaVendor = "";
$telp = "";
$alamat = "";
$email = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $idVendor     = $_GET['id_vendor'];
    $sql1       = "select * from vendor where id_vendor = '$idVendor'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $namaVendor = $r1['nama_vendor'];
    $alamat     = $r1['alamat_vendor'];
    $telp       = $r1['telp_vendor'];
    $email      = $r1['email_vendor'];

    if ($namaVendor == '') {
        $error = "Data tidak ditemukan";
    }
}

if ($op == 'delete') {
    $idVendor    = $_GET['id_vendor'];
    $sql1       = "delete from vendor where id_vendor = '$idVendor'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Gagal";
    }
}

if (isset($_POST['simpan'])) {
    // $idBuku     = $_POST['idBuku'];
    $namaVendor    = $_POST['namaVendor'];
    $alamat        = $_POST['alamat'];
    $telp          = $_POST['telp'];
    $email         = $_POST['email'];

    if ($namaVendor && $alamat && $telp && $email) {
        if ($op == 'edit') {
            $sql1   =  "update vendor set nama_vendor = '$namaVendor',alamat_vendor ='$alamat',telp_vendor ='$telp', email_vendor = '$email' where id_vendor = '$idVendor'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error = "Gagal";
            }
        } else {
            $sql1 = "insert into vendor(nama_vendor,alamat_vendor,telp_vendor,email_vendor) values ('$namaVendor','$alamat','$telp','$email')";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil";
            } else {
                $error = "Gagal";
            }
        }
    } else {
        $error = "Masukkan Semua Data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>

<body class="container">
    <div class="mt-4">
        <div class="card mt-5">
            <div class="card-header">
            <a href="Dashboard.html" class="btn btn-primary mt-2 mb-2">Dashboard</a>
            
                <a href="read_vendor.php" class="btn btn-success mt-2 mb-2">Print Data Vendor</a>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                Create / Edit Vendor
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="namaVendor" class="col-sm-2 col-form-label">Nama Vendor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaVendor" name="namaVendor" value="<?php echo $namaVendor ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat Vendor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telp" class="col-sm-2 col-form-label">NoTelp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telp" name="telp" maxlength="15" value="<?php echo $telp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Vendor
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        
                    
                        
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Vendor</th>
                            <th scope="col">Alamat Vendor</th>
                            <th scope="col">NoTelp Vendor</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM `vendor` ORDER BY id_vendor ASC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idVendor = $r2['id_vendor'];
                            $namaVendor = $r2['nama_vendor'];
                            $alamat = $r2['alamat_vendor'];
                            $telp = $r2['telp_vendor'];
                            $email = $r2['email_vendor'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?> </th>
                                <td scope="row"><?php echo $namaVendor ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $telp ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row">
                                    <a href="vendor.php?op=edit&id_vendor=<?php echo $idVendor ?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                    <a href="vendor.php?op=delete&id_vendor=<?php echo $idVendor ?>" onclick="return confirm('Yakin Hapus Data')">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                    <a href="dashboard.html" onclick="return confirm('Kembali Ke Menu Utama')">
                                        <button type="button" class="btn btn-info">Home</button>
                                    </a>
                                </td>
                            </tr>
                        <?php

                        }
                        ?>

                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>