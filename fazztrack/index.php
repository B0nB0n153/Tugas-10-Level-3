
<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
    <?php
        function rupiah($angka)
              {
                $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                return $hasil_rupiah;
              }  
    ?>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>CRUD</h1>
  <p>level 3 Tugas 10 (Bonus Tugas)</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" >Id discord : B0nB0n</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button> 
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
    <button type="button" class="btn btn-success"data-toggle="modal" data-target="#tambah">
      Tambah Data
    </button>
    <hr>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Keterangan</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <?php
    $no = 1;
    $que = mysqli_query($con,"SELECT * FROM `produk` ");
    while ($dt = mysqli_fetch_assoc($que))
    {
      $id = $dt['id_produk'];
      
    ?>
    <tbody>
      <tr>
        <td><?php echo $no++;?></td>
        <td><?php echo $dt['nama_produk']; ?></td>
        <td><?php 
          if($dt['keterangan'] == 1)
          {
            echo "Stok Ada";
          }
          elseif($dt['keterangan'] == 2)
          {
            echo "Expired";
          }
          elseif($dt['keterangan'] == 3 )
          {
            echo "Stok Habis";
          }
          else
          {
            echo "error";
          } 
        ?></td>
        <td><?php echo rupiah($dt['harga']); ?></td>
        <td><?php echo $dt['jumlah']; ?></td>
        <td>
         <div class="dropdown">
              <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                Aksi
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mod<?php echo $id;?>">Edit</a>
                <a class="dropdown-item" href="index.php?delid=<?php echo $id;?>">Hapus</a>
              </div>
          </div> 
        </td>
      </tr>
      <!-- edit data -->
    <!-- The Modal -->
    <div class="modal fade" id="mod<?php echo $id; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form  method="POST" action="">
          <?php
            $id = $dt['id_produk'];
            $que1 = mysqli_query($con,"SELECT * FROM `produk` WHERE `id_produk` = '$id'");
            $data = mysqli_fetch_array($que1);
            ?>
            <div class="form-group">
              <label for="">Nama Produk:</label>
              <input type="text" class="form-control" name="np1" value="<?php echo $data['nama_produk'];?>">
            </div>
            <div class="form-group">
              <label for="">Keterangan:</label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket1" value="1" <?php if($data['keterangan'] == 1){ echo'checked=""';} ?>>Stok Ada
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket1" value="2" <?php if($data['keterangan'] == 2){ echo'checked=""';} ?>>Stok Habis
              </label>
            </div>
            <div class="form-check-inline disabled">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket1" value="3" <?php if($data['keterangan'] == 3){ echo'checked=""';} ?>>Expired
              </label>
            </div> 
            <div class="form-group">
              <label for="">Harga:</label>
              <input type="text" class="form-control" name="harga1" value="<?php echo $data['harga']; ?>">
            </div>
            <div class="form-group">
              <label for="">Jumlah:</label>
              <input type="text" class="form-control" name="jumlah1" value="<?php echo $data['jumlah']; ?>">
            </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" name="edit" value="Simpan">
        </div>
          </form> 
        </div>
        
        <!-- Modal footer -->
        
        <?php 
          if(isset($_POST['edit']))
          {
            $np1 = $_POST['np1'];
            $ket1 = $_POST['ket1'];
            $harga1 = $_POST['harga1'];
            $jumlah1 = $_POST['jumlah1'];

              $que = mysqli_query($con, "UPDATE `produk` SET `nama_produk` = '$np1',`keterangan` = '$ket1',`harga` = '$harga1',`jumlah` = '$jumlah1' WHERE `produk`.`id_produk` = '$id'");
            if($que)
            {
              echo"<script>window.location='index.php?Berhasil';</script>";
            }
            else
            {
            echo"<script>window.location='index.php?Gagal';</script>";
            }
          }
        ?>
      </div>
    </div>
  </div>
  <?php
    }
    ?>
<!-- edit data -->
    </tbody>
  </table>
<?php
  if (isset($_GET['delid']))
{
  $del = $_GET['delid'];
        $que = mysqli_query($con,"DELETE FROM `produk` WHERE `id_produk`='$del'");
        if($que)
        {
            echo"<script>window.location='index.php?berhasil';</script>";
           
        }
        else
        {
            echo"<script>window.location='index.php?&erro';</script>";
        }
}
?>
    </div>
  </div>
</div>




<!-- Tambah Data -->
    <!-- The Modal -->
  <div class="modal" id="tambah">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label for="">Nama Produk:</label>
              <input type="text" class="form-control" name="np">
            </div>
            <div class="form-group">
              <label for="">Keterangan:</label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket" value="1">Stok Ada
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket" value="2">Stok Habis
              </label>
            </div>
            <div class="form-check-inline disabled">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ket" value="3">Expired
              </label>
            </div> 
            <div class="form-group">
              <label for="">Harga:</label>
              <input type="text" class="form-control" name="harga">
            </div>
            <div class="form-group">
              <label for="">Jumlah:</label>
              <input type="text" class="form-control" name="jumlah">
            </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" name="tambah" value="Simpan">
        </div>
          </form> 
        </div>
        
        <!-- Modal footer -->
        
        <?php 
          if(isset($_POST['tambah']))
          {
            $np = $_POST['np'];
            $ket = $_POST['ket'];
            $harga = $_POST['harga'];
            $jumlah = $_POST['jumlah'];

              $que = mysqli_query($con, "INSERT INTO `produk` (`id_produk`,`nama_produk`,`keterangan`,`harga`,`jumlah`) VALUES (Null,'$np','$ket','$harga','$jumlah')");
            if($que)
            {
              echo"<script>window.location='index.php?Berhasil';</script>";
            }
            else
            {
            echo"<script>window.location='index.php?Gagal';</script>";
            }
          }
        ?>
      </div>
    </div>
  </div>
<!-- Tambah Data -->

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>

  <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.datatab').DataTable();
  } );
  </script>

</body>
</html>
