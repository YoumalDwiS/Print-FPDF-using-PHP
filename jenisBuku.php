<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "perpustakaan_2022"; # <---- namadatabase yang tadi kita buat


$koneksi    = mysqli_connect($host, $user, $pass, $db);

$idJenisBuku = "";
$nama = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $idJenisBuku     = $_GET['id_jenis_buku'];
    $sql1       = "select * from jenisbuku where id_jenis_buku = '$idJenisBuku'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama_jenis_buku'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if ($op == 'delete') {
    $idJenisBuku    = $_GET['id_jenis_buku'];
    $sql1       = "delete from jenisbuku where id_jenis_buku = '$idJenisBuku'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Gagal";
    }
}

if (isset($_POST['simpan'])) {
    // $idBuku     = $_POST['idBuku'];
    $nama    = $_POST['nama'];

    if ($nama) {
        if ($op == 'edit') {
            $sql1   =  "update jenisbuku set nama_jenis_buku = '$nama' where id_jenis_buku = '$idJenisBuku'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error = "Gagal";
            }
        } else {
            $sql1 = "insert into jenisbuku(nama_jenis_buku) values ('$nama')";
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
    <link rel="stylesheet" href="style.css" />
</head>

<body class="container">
    <div class="mt-4">
        <div class="card mt-5">
            <div class="card-header">
            <a href="Dashboard.html" class="btn btn-primary mt-2 mb-2">Dashboard</a>
            <a href="index.php" class="btn btn-primary mt-2 mb-2">Menu Buku</a>
                <a href="vendor.php" class="btn btn-info mt-2 mb-2">Menu Vendor</a>
                <a href="jenisBuku.php" class="btn btn-success mt-2 mb-2">Menu Jenis Buku</a>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                Create / Edit Jenis Buku
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
                        <label for="nama" class="col-sm-2 col-form-label">Jenis Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
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
                Data Jenis Buku
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Buku</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM `jenisbuku` ORDER BY id_jenis_buku ASC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idJenisBuku = $r2['id_jenis_buku'];
                            $nama = $r2['nama_jenis_buku'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?> </th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row">
                                    <a href="jenisBuku.php?op=edit&id_jenis_buku=<?php echo $idJenisBuku ?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                    <a href="jenisBuku.php?op=delete&id_jenis_buku=<?php echo $idJenisBuku ?>" onclick="return confirm('Yakin Hapus Data')">
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