<?php include 'config.php'; 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Salam Pesan</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-blue fixed-top" id="mainNav">
      <div class="container text-white">
        <a class="navbar-brand text-white js-scroll-trigger" href="#page-top"><i class="far fa-comments"></i> Salam Pesan</a>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#req">Request Fitur</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-warning text-white">
      <div class="container text-center align-top">
        <h1><i class="far fa-comments"></i></h1>
        <p class="lead">Yang mau curhat, yang mau nitip salam, yang mau kirim pesan, tapi gak berani, di sini tempatnya!</p>
        <div class="container">
          <form action="post.php" method="POST">
          <div class="container text-center">
          <label>Dari</label>
          <input type="text" class="form-control" name="dari" placeholder="Tulis di sini gan"><br>
          <label>Kepada</label>
          <input type="text" class="form-control" name="kepada" placeholder="Tulis di sini gan"><br>
          <label>Pesan</label>
          <textarea class="form-control form-control-lg" name="pesan" placeholder="Tulis di sini gan"></textarea><br>
          <button class="btn btn-lg btn-success" name="kirim" type="submit"><i class="far fa-share-square"></i> Kirim Gan!</button>
        </div>
        </form>
        </div>
      </div>
    </header>

    <?php

        if(isset($_GET['hal'])){
          $dataHal = $_GET['hal'];
        }
        else {
          $dataHal = 1;
        }
          $perHal = 2;
          $hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
          $awal = ($hal > 1) ? ($hal * $perHal) - $perHal : 0;
          $sql = "SELECT * FROM data ORDER BY id DESC LIMIT $awal, $perHal";
          $query = mysqli_query($konek, $sql);
          $hasil = mysqli_num_rows($query);
          $sql2 = mysqli_query($konek, "SELECT * FROM data");
          $totalHal = mysqli_num_rows($sql2);
          $pages = ceil($totalHal/$perHal);
          $prev = $dataHal - 1;
          $next = $dataHal + 1;
    ?>

    <section class="<?php if($hasil != 0){echo'full';} ?> align-top">
      <div class="container text-center mt-5 mb-5">

      <?php 

      if(isset($_SESSION['gagal'])){ ?>
        
        <div class="alert alert-danger" role="alert">
      
      <?php echo $_SESSION['gagal']."</div>"; 
      unset($_SESSION['gagal']); } ?>

      <?php 

      if(isset($_SESSION['sukses'])){ ?>
  
          <div class="alert alert-success" role="alert">

        <?php echo $_SESSION['sukses']."</div>"; 
      unset($_SESSION['sukses']); } ?>
      
      <?php 
      if($hasil == 0){
        echo "<h4><i class='far fa-times-circle'></i> Tidak ada Pesan Gan!</h4></div>";
      }

      if($hasil > 0){
      ?>
      <h4><i class="far fa-comment"></i></h4>
      <h4>Salam dan Pesan buat Kamu</h4>
      </div>
      <div class="container mt-4">
        <?php
        while($a = mysqli_fetch_assoc($query)){
          $dari = $a['dari'];
          $kepada = $a['kepada'];
          $pesan = $a['pesan'];
          $waktu = $a['time'];
        ?>

        <div class="card mb-3">
        <div class="card-body">
          <h6><b>Dari : </b> <?php echo $dari ?></h6>
          <h6><b>Untuk: </b> <?php echo $kepada ?></h6>
          <blockquote class="blockquote mb-0">
            <p><?php echo $pesan ?></p>
            <footer class="blockquote-footer"><?php echo $waktu ?> </footer>
          </blockquote>
        </div>
        </div>

        <?php } echo '</div>'; } ?>

        <center><nav aria-label="Pages">
              <ul class="pagination p-5 justify-content-center">
                <?php if($dataHal != 1 || $dataHal == ''){ ?>
                <li class="page-item"><a class="page-link" href="?hal=<?php echo $prev ?>">Sebelumnya</a></li>
                <?php } ?>
                <?php if($dataHal < $pages){ ?>
                <li class="page-item"><a class="page-link" href="?hal=<?php echo $next ?>">Selanjutnya</a></li>
                <?php } ?>
              </ul>
            </nav>
        </center>
        
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Salam Pesan 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

    <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="about" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="about">Tentang Situs Ini</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="lead pr-4 pl-4" style="text-align: justify;">Situs ini sebenarnya dibuat untuk menghilangkan kegabutan. Tahukan gimana gabutnya jadi Mahasiswa kalau gak ada kerjaan.
              Nah dari pada ngelamun nantinya kesurupan jadinya kepikiran nih bikin ginian. Tujuan pembuatan situs ini hanya just for fun yak, jangan kesinggung, baper boleh.
              Siapa tahu dari situs ini ada yang jadian terus nikah, kan. Keep bikin pesan dan salam yak. Salam itu baik loh. 
            </p>
            <p>- Mimin 2018</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="req" tabindex="-1" role="dialog" aria-labelledby="requ" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="requ">Request Fitur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Kira-kira situs ini enaknya dikasih apa aja yak gan? Tulis dibawah gan!</p>
            <form method="POST" action="post.php">
              <textarea name='req' class="form-control form-control-lg" placeholder="Tulis requestnya di sini gan!"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" name="request" class="btn btn-success">Kirim</button></form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>

</html>
