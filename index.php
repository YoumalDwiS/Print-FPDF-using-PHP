<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "perpustakaan_2022"; # <---- namadatabase yang tadi kita buat


$koneksi    = mysqli_connect($host, $user, $pass, $db);
// if(!$koneksi){
//     die("Gagal Terkoneksi");
// }else{
//     echo "Koneksi Berhasil";
// }
$idBuku = "";
$namaBuku = "";
$idVendor = "";
$jenisBuku = "";
$stokBuku = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $idBuku     = $_GET['id_buku'];
    $sql1       = "delete from buku where id_buku = '$idBuku'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Buku berhasil dihapus";
    } else {
        $error = "Gagal";
    }
}

if ($op == 'edit') {
    $idBuku     = $_GET['id_buku'];
    $sql1       = "select * from buku where id_buku = '$idBuku'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $namaBuku   = $r1['nama_buku'];
    $jenisBuku  = $r1['id_jenis_buku'];
    $idVendor   = $r1['id_vendor'];
    $stokBuku   = $r1['jml_stok'];

    if ($namaBuku == '') {
        $error = "Buku tidak ditemukan";
    }
}



if (isset($_POST['simpan'])) {
    // $idBuku     = $_POST['idBuku'];
    $namaBuku   = $_POST['namaBuku'];
    $idVendor   = $_POST['idVendor'];
    $jenisBuku  = $_POST['jenisBuku'];
    $stokBuku   = $_POST['stokBuku'];

    if ($namaBuku && $idVendor && $jenisBuku && $stokBuku) {
        if ($op == 'edit') {
            $sql1   =  "update buku set nama_buku = '$namaBuku',id_vendor ='$idVendor',id_jenis_buku ='$jenisBuku', jml_stok = '$stokBuku' where id_buku = '$idBuku'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error = "Gagal";
            }
        } else {
            $sql1 = "insert into buku(nama_buku,id_jenis_buku,id_vendor,jml_stok) values ('$namaBuku','$jenisBuku','$idVendor','$stokBuku')";
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
                <a href="index.php" class="btn btn-primary mt-2 mb-2">Master Buku</a>
                <a href="vendor.php" class="btn btn-info mt-2 mb-2">Master Vendor</a>
                <a href="jenisBuku.php" class="btn btn-success mt-2 mb-2">Master Jenis Buku</a>
                
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                Create / Edit Buku
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
                        <label for="namaBuku" class="col-sm-2 col-form-label">Nama Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaBuku" name="namaBuku" value="<?php echo $namaBuku ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenisBuku" class="col-sm-2 col-form-label">Jenis Buku</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="jenisBuku" name="jenisBuku" value="<?php echo $jenisBuku ?>">
                                <option value="">-- Pilih Jenis Buku --</option>
                                <?php
                                $query = $koneksi->query("SELECT * FROM jenisbuku");
                                while ($data = $query->fetch_assoc()) { ?>
                                    <option value="<?= $data['nama_jenis_buku']; ?>" <?php if ($jenisBuku == $data['nama_jenis_buku']) echo "selected"; ?>><?= $data['nama_jenis_buku']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="idVendor" class="col-sm-2 col-form-label">Vendor</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="idVendor" name="idVendor" value="<?php echo $idVendor ?>">
                                <option value="">-- Pilih Vendor --</option>
                                <?php
                                $query = $koneksi->query("SELECT * FROM vendor");
                                while ($data = $query->fetch_assoc()) { ?>
                                    <option value="<?= $data['nama_vendor']; ?>" <?php if ($idVendor == $data['nama_vendor']) echo "selected"; ?>><?= $data['nama_vendor']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stokBuku" class="col-sm-2 col-form-label">Stok Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stokBuku" name="stokBuku" value="<?php echo $stokBuku ?>">
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
                Data Buku
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Jenis Buku</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">Stok Buku</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM `buku` ORDER BY id_buku ASC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idBuku = $r2['id_buku'];
                            $namaBuku = $r2['nama_buku'];
                            $jenisBuku = $r2['id_jenis_buku'];
                            $idVendor = $r2['id_vendor'];
                            $stokBuku = $r2['jml_stok'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?> </th>
                                <td scope="row"><?php echo $namaBuku ?></td>
                                <td scope="row"><?php echo $jenisBuku ?></td>
                                <td scope="row"><?php echo $idVendor ?></td>
                                <td scope="row"><?php echo $stokBuku ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id_buku=<?php echo $idBuku ?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                    <a href="index.php?op=delete&id_buku=<?php echo $idBuku ?>" onclick="return confirm('Yakin Hapus Data')">
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