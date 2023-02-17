<html>
    <head>
    <head>
    <title>Print Data Vendor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
    </head>
    <body>
    <div class="container">
    
    <div class="mt-4">
        <div class="card mt-5">
            <div class="card-header">
            <a href="Dashboard.html" class="btn btn-primary mt-2 mb-2">Dashboard</a>
            <a href="index.php" class="btn btn-primary mt-2 mb-2">Menu Buku</a>
                <a href="vendor.php" class="btn btn-info mt-2 mb-2">Menu Vendor</a>
                <a href="jenisBuku.php" class="btn btn-success mt-2 mb-2">Menu Jenis Buku</a>
                <a href="read_vendor.php" class="btn btn-success mt-2 mb-2">Print Data Vendor</a>
            </div>
        </div>
        <div align="center">
        <h2>Print Data Vendor</hr>
     </div>
    <form method="GET">
        <div class="row">
        <div class="col-md-5">
        <div class="panel panel-default">
        <div class="panel-heading"><b>Pencarian</b></div>
        <div class="panel-body">
        <form class="form-inline" >
            <input type="text" class="form-control" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
        </div>
        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
        <a href="index.php" class="btn btn-danger">Reset</a>
        <button type="submit" name="ekspor" class="btn btn-success">Ekspor PDF</button>
        </form>
        </div>
      </div>
    </div>
  </div>
    <table style="width:95%; margin-left: 5px;" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
            <th>No</th>
            <th>Id Vendor</th>
            <th>Nama Vendor</th>
            <th>Alamat Vendor</th>
            <th>No Telepon</th>
            <th>Email</th>
            </tr>
        </thead>
        <tbody>  
        <?php
            require('koneksi.php');
            $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
            $kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : ""; 
            $limit = 5;
            $limitStart = ($page - 1) * $limit;
            if(isset($_GET['cari']))
            {
                if($kolomKataKunci==""){
                $view = mysqli_query($con, "SELECT * FROM vendor LIMIT ".$limitStart.",".$limit);
                }else{
                //kondisi jika parameter kolom pencarian diisi
                $view = mysqli_query($con, "SELECT * FROM vendor WHERE id_vendor LIKE '%$kolomKataKunci%' OR nama_vendor LIKE '%$kolomKataKunci%'
                OR alamat_vendor LIKE '%$kolomKataKunci%' OR telp_vendor LIKE '%$kolomKataKunci%' OR email_vendor LIKE '%$kolomKataKunci%' LIMIT ".$limitStart.",".$limit);
                }
            }
            else{
                $view = mysqli_query($con, "SELECT * FROM vendor LIMIT ".$limitStart.",".$limit);
                }
                $no = $limitStart + 1;
                $baris=1;
                while($row = mysqli_fetch_array($view)){
        ?>
                <tr>
                <td><?php echo $baris ?></td>
                <td><?php echo $row['id_vendor'] ?></td>
                <td><?php echo $row['nama_vendor'] ?></td>
                <td><?php echo $row['alamat_vendor'] ?></td>
                <td><?php echo $row['telp_vendor'] ?></td>
                <td><?php echo $row['email_vendor'] ?></td>
                </tr>
        <?php
                $baris++;
            }
            ?>
            </tbody>
        </table>
            <div align="right">
                <ul class="pagination">
                    <?php
                        // Jika page = 1, maka LinkPrev disable
                        if($page == 1){ 
                    ?>        
                        <!-- link Previous Page disable --> 
                        <li class="disabled"><a href="#">Previous</a></li>
                    <?php
                        }
                        else{ 
                            $LinkPrev = ($page > 1)? $page - 1 : 1;  

                            if($kolomKataKunci==""){
                    ?>
                            <li><a href="index.php?page=<?php echo $LinkPrev; ?>">Previous</a></li> 
                    <?php
                            }else{
                    ?>
                            <li><a href="index.php?KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
                    <?php
                                } 
                            }
                   ?>
                    <?php
                        //kondisi jika parameter pencarian kosong
                        if($kolomKataKunci==""){
                            $view = mysqli_query($con, "SELECT * FROM vendor");
                        }else{
                        //kondisi jika parameter kolom pencarian diisi
                            $view = mysqli_query($con, "SELECT * FROM vendor WHERE id_vendor LIKE '%$kolomKataKunci%' OR nama_vendor LIKE '%$kolomKataKunci%'
                            OR alamat_vendor LIKE '%$kolomKataKunci%' OR telp_vendor LIKE '%$kolomKataKunci%' OR email_vendor LIKE '%$kolomKataKunci%'");
                        }
                    
                        //Hitung semua jumlah data yang berada pada tabel Sisawa
                        $JumlahData = mysqli_num_rows($view);
                        
                        // Hitung jumlah halaman yang tersedia
                        $jumlahPage = ceil($JumlahData / $limit); 
                        
                        // Jumlah link number 
                        $jumlahNumber = 1; 

                        // Untuk awal link number
                        $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
                        
                        // Untuk akhir link number
                        $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
                        
                        for($i = $startNumber; $i <= $endNumber; $i++){
                            $linkActive = ($page == $i)? ' class="active"' : '';

                            if($kolomKataKunci==""){
                    ?>
                            <li<?php echo $linkActive; ?>><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                    <?php
                        }else{
                    ?>
                            <li<?php echo $linkActive; ?>><a href="index.php?KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                        }
                        }
                    ?>
                        <!-- link Next Page -->
                    <?php       
                        if($page == $jumlahPage){ 
                    ?>
                        <li class="disabled"><a href="#">Next</a></li>
                    <?php
                        }
                        else{
                        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
                        if($kolomKataKunci==""){
                            ?>
                            <li><a href="index.php?page=<?php echo $linkNext; ?>">Next</a></li>
                        <?php     
                            }else{
                    ?> 
                            <li><a href="index.php?KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a></li>
                    <?php
                        }
                        }
                        require('pdf.php');
                        if(isset($_GET['ekspor']))
            {
                        $pdf= new PDF();
                        $pdf->export($view);
            }
                    ?>
                  </ul>
                </div>
            </div>
        </form>
    </body>
</html>


