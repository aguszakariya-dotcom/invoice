<?php 

$koneksi = mysqli_connect("localhost", "root", "", "datakerjoan");
    function tgl_kita($tanggal) {
        $bulan = array(
            1 =>   'Jan',
            2 =>   'Feb',
            3 =>   'Mar',
            4 =>   'Apr',
            5 =>   'Mei',
            6 =>   'Jun',
            7 =>   'Jul',
            8 =>   'Agu',
            9 =>   'Sep',
            10 =>  'Okt',
            11 =>  'Nov',
            12 =>  'Des'
        );
        $hari = array(
            1 =>   'Senin',
            2 =>   'Selasa',
            3 =>   'Rabu',
            4 =>   'Kamis',
            5 =>   "Jum'at",
            6 =>   'Sabtu',
            7 =>   'Minggu'
        );
        $tgl = substr($tanggal, 8, 2);
        $bln = substr($tanggal, 5, 2);
        $thn = substr($tanggal, 0, 4);
        $bln = $bulan[(int) $bln];
        $hari = $hari[(int) date('N', strtotime($tanggal))];
        return $hari . ', ' . $tgl . ' ' . $bln . ' ' . $thn;
    }
    $terhapus = "";
if (isset($_GET['H']) == "hapusTimeline") {
    $hapus = mysqli_query($koneksi, "DELETE FROM timeline WHERE id = '$_GET[id]'");
    if($hapus) {
        $terhapus;
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }
}

?>
<div class="p-3">
    <table class="table table-sm table-hover text-white " id="tableTime" width="100%" style="border-radius: 10px; background-color: #09002073;">
        <thead class="py-3" style="background-color: #0F0000A2;">
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Style</th>
                <th>Jumlah</th>
                <th>Timeline</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include 'koneksi.php';
                $no = 1;
                $sql = "SELECT * FROM timeline ORDER BY id DESC";
                $query = mysqli_query($koneksi, $sql);
                while($data = mysqli_fetch_array($query)){
            ?>
            <tr class="">
                <th scope class"row"> <?php echo $no++; ?></th>
                <td class="text-capitalize"><?= $data['customer']; ?></td>
                <td class="text-capitalize"><?= $data['style']; ?></td>
                <td><?= $data['qty']; ?> <small>pcs</small></td>
                <td class="text-bold"><?= tgl_kita($data['finish_at']); ?></td>
                <td class="text-capitalize"><?= $data['keterangan']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-sm shadow text-info float-start"><i class="fa-solid fa-user-pen"></i>&nbsp;edit</a>
                    &nbsp;
                    <a href="delete.php?id=<?= $data['id']; ?>"
                        class="tab btn-sm text-danger shadow float-right delete" style="margin-right: 5px;"
                        onclick="return confirm('Anda yakin akan menghapus data ini?');" id="hapus"><i
                            class="fa-solid fa-trash-can"></i></span></a>
                </td>
            </tr>
            <?php } ?>
    </table>
</div>

    <script>
        $(document).ready(function() {
            $('.delete').click(function() {
                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
                        )
                    }
                })
                window.location.href = 'index.php';
            });
        } );
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>