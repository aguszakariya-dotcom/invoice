<?php 
// koneksi ke ftp
$ftp_server = "ftp.becik.my.id";
$ftp_user_name = "becikmyi";
$ftp_user_pass = "ftp=//462152zA?";
$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// function query($query) {
//     global $koneksi;

//     $result = mysqli_query($koneksi, $query);
//     $row = [];
//     while( $row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// };

function saveDiary($data) {
    global $koneksi;
    // cek penambahan data
    $customer = htmlspecialchars(ucwords($data["customer"]));
    $style = htmlspecialchars(ucwords($data["style"]));
    $warna = htmlspecialchars(ucwords($data["warna"]));
    $jumlah = $data["jumlah"];
    $keterangan = htmlspecialchars(ucwords($data["keterangan"]));
    $tanggal = $data["tanggal"];
    $gambarLama = $data["gambarLama"];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // UPLOAD ================================]] 

    $query = "INSERT INTO harianku
                VALUES
                ('', '$customer', '$style', '$warna', '$jumlah', '$keterangan', '$tanggal', '$gambar')
                ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


// UPDATE ====================== Harianku//
function updateDiary($data) {
    global $koneksi;
    // cek penambahan data
    $id = $data["id"];
    $customer = htmlspecialchars(ucwords($data["customer"]));
    $style = htmlspecialchars(ucwords($data["style"]));
    $warna = htmlspecialchars(ucwords($data["warna"]));
    $jumlah = $data["jumlah"];
    $keterangan = htmlspecialchars(ucwords($data["keterangan"]));
    $tanggal = $data["tanggal"];
    $gambarLama = $data["gambarLama"];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // UPLOAD ================================]] 

    $query = "UPDATE harianku SET
                customer = '$customer',
                style = '$style',
                warna = '$warna',
                jumlah = '$jumlah',
                keterangan = '$keterangan',
                tanggal = '$tanggal',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
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
    // lokasi tempat upload ftp ftp//data.becik.my.id/img/

    // upload to ftp
    move_uploaded_file($tmpName, './img/' . $namaFile);

    
    return $namaFile;
}
?>