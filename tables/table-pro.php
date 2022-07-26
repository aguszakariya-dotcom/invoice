
<?php $produksi = mysqli_query($koneksi, "SELECT * FROM produksi ORDER BY id DESC");  ?>
<table class="table table-responsive" id="tProduksi" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>Finish</th>
            <th>Customer</th>
            <th>Style</th>
            <th>Code</th>
            <th>Warna</th>
            <th>QTY</th>
            <th>Image</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php while ($data = mysqli_fetch_array($produksi)) : ?>
        <tr>

            <td><?= $i; ?> </td>
            <td style="text-transform: capitalize;">
                <?= tgl_kita($data["bulan"]); ?> </td>
            <td style="text-transform: capitalize;"> <?= $data["nama_customer"]; ?>
            </td>
            <td style="text-transform: capitalize;"><?= $data["style"]; ?> </td>
            <td> <?= $data["code"]; ?> </td>
            <td style="text-transform: capitalize;"> <?= $data["warna"]; ?> </td>
            <td> <?= $data["qty"]; ?> </td>
            <td> <img class="" src="img/<?= $data['gambar'];?>" alt="kosong"
                    width="40px" height="50"></td>
            <td>
                <a href="produksi.php?p=edit&id=<?= $data['id']; ?>"
                    class="icon icon-pencil budge btn-sm btn-outline-primary"></a>
                &nbsp;
                <a href="hapus/produksi.php?id=<?= $data['id']; ?>" class=" btn-sm btn-outline-danger
    float-right" id="delete" style="margin-right: 5px;" onclick="return confirm('Anda yakin akan menghapus data ini?');"><span
                        class="icon icon-trash text-danger"></span></a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endwhile; ?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    // reload table every 5 seconds
    setInterval(function() {
        $('#tProduksi').DataTable().reload();
    }, 5000);
    $('#tProduksi').DataTable();
	window.onload = function() {
    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        myFunction();
    }
}

function reloadP() {
    sessionStorage.setItem("reloading", "true");
    document.location.reload();
}
});
</script>
