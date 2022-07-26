<?php 
require './koneksi.php';
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function ubahTimeline($data)
{
    global $koneksi;
    $id = $data['id'];
    $customer = $data['customer'];
    $style = $data['style'];
    $qty = $data['qty'];
    $finish_at = $data['finish_at'];
    $keterangan = $data['keterangan'];
    $query = "UPDATE timeline SET customer = '$customer', style = '$style', qty = '$qty', finish_at = '$finish_at', keterangan = '$keterangan' WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

