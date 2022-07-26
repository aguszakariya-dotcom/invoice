<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db = "sovana";
// ==========================================/
$host = "becik.my.id:3306";
$user = "workshop_zack77";
$pass = "workshop467791zA";
$db = "workshop_";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Koneksi Gagal".mysqli_connect_error());
}else{
    // echo "Koneksi Berhasil";
}

$up = $_GET["up"];
switch ($up) {
    case 'upload': upload(); break;
}


function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>
            ";
        return false;
    }
    // CEKGAMBAR yg boleh diupload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>
            ";
        return false;
    }
    
    if ($ukuranFile > 6000000) {
        echo "<script>
                alert('Maaf, ukuran gambar terlalu besar!');
            </script>
            ";
        return false;
    }
    
    move_uploaded_file($tmpName, 'img/' . $namaFile);
        $_SESSION['sukses'] = 'Gambar berhasil diupload';
        header("Location: upload.php");
        exit;
}
?>