<?php
include 'config.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$time = date('d M Y , H:i')." WIB";

if(isset($_POST['kirim'])){

    $dari = mysqli_real_escape_string($konek, $_POST['dari']);
    $kepada = mysqli_real_escape_string($konek, $_POST['kepada']);
    $pesan = mysqli_real_escape_string($konek, $_POST['pesan']);
    $sql = "INSERT INTO data(dari, kepada, pesan, time) VALUES ('$dari', '$kepada', '$pesan', '$time');";

    if(empty($dari)){
        $_SESSION['gagal'] = "Gagal menambahkan pesan gan! Isi kolom dulu gan.";
        header('Location: index.php');
    }

    elseif(empty($kepada)){
        $_SESSION['gagal'] = "Gagal menambahkan pesan gan! Isi kolom dulu gan.";
        header('Location: index.php');
    }

    elseif(empty($pesan)){
        $_SESSION['gagal'] = "Gagal menambahkan pesan gan! Isi pesan dulu gan.";
        header('Location: index.php');
    }

    else {
        $query = mysqli_query($konek, $sql);
        if(!empty($query)){
            $_SESSION['sukses'] = "Pesan sudah dikirim gan, tunggu aja balesannya.";
            header('Location: index.php');
        }

        if(empty($query)){
            $_SESSION['gagal'] = "Hold UP! kayaknya ada kesalahan nih";
            header('Location: index.php');
        }
    } }
    
if(isset($_POST['request'])){

    $fitur = mysqli_real_escape_string($konek, $_POST['req']);
    $msg = $fitur;
    $headers = "From: emalikamu@email.com". "\r\n" ;
    $kirim = mail("emalikamu@email.com", "Request Fitur Bos", $msg, $headers);

    if(empty($kirim)){
        $_SESSION['gagal'] = "Gagal mengirim pesan gan.";
    header('location: index.php'); }

    if(!empty($kirim)){
        $_SESSION['sukses'] = "Sukses mengirim pesan gan.";
    header('location: index.php'); }
}

else {
    header('location: index.php');
}
