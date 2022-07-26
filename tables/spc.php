<?php 
if (isset($_GET['spc']) == "hapusSpc") {
    $hps = mysqli_query($koneksi, "DELETE FROM spc WHERE id = '$_GET[id]'");
    if ($hps > 0) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Dihapus',
            showConfirmButton: false,
            timer: 1500
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1;url=sample.php'>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Data Gagal Dihapus',
            showConfirmButton: false,
            timer: 1500
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1;url=sample.php'>";
    }
}

// if(isset($_GET['spc']) == "editSpc") {
//     $id = $_GET['id'];
//     $edit = mysqli_query($koneksi, "SELECT * FROM spc WHERE id = '$id'");
//     $data = mysqli_fetch_array($edit);
//     if($data) {
//         $sid_sample = $data['id_sample'];$
//         $simage = $data['image'];
//         $sid = $data['id'];
//     }
// }
?>
<table class="table table-hover" id="tableSpc" width="100%">
    <thead class="text-light" style="background-color: #0F000083;">
        <tr>
            <th>No</th>
            <th class="col-sm-3">Nama Customer</th>
            <th class="col-sm-3">Style</th>
            <th>Code</th>
            <th class="col-sm-2">Penghabisan</th>
            <th class="col-sm-3">Image/ Download</th>
            <th class="col-sm-1">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            // inner join sample.spc on sample.id = spc.id_sample
            $sql = "SELECT * FROM sample INNER JOIN spc ON spc.id_sample = sample.id ORDER BY spc.id DESC";
            $query = mysqli_query($koneksi, $sql); 
            while($row = mysqli_fetch_array($query)){
            ?>
        <tr>
            <th> <?php echo $no++; ?></th>
            <td><?php echo $row['nama_customer']; ?></td>
            <td><?php echo $row['style']; ?></td>
            <td><?php echo $row['code']; ?></td>
            <td class=""><?php echo $row['habis']; ?> &nbsp;Meter</td>
            <td>
                <img src="https://data.becik.my.id/img/<?php echo $row['gambar']; ?>"
                    alt="kosong"
                    onerror="if (this.src != 'img/nophoto.png') this.src = 'img/nophoto.png';"
                    class="zoom"
                    style="height:40px; width:30px;">&nbsp;&nbsp;

                <img src="./spc/<?php echo $row['image']; ?>" alt="Spechsheet"
                    onerror="if (this.src != 'img/nophoto.jpg') this.src = 'img/nophoto.jpg';"
                    class="zoom"
                    style="height:40px; width:30px;">&nbsp;&nbsp;
                <a href="https://data.becik.my.id/spc/<?php echo $row['image']; ?>"
                    class="text-info"><i
                        class="fa-solid fa-download"></i>download</a>
            </td>
            <td>
                <a href="editspc.php?id=<?= $row['id']; ?>"
                    class="icon icon-pencil btn btn-sm btn-outline-primary" id="editSpc">edit</a>
                &nbsp;
                <a href="sample.php?spc=hapusSpc&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin akan menghapus <?php echo $row['nama_customer']; ?>?');"><i class="fa fa-trash"></i> Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>