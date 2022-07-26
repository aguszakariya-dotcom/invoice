<?php 
include 'koneksi.php';
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
        1 =>   'Sen',
        2 =>   'Sel',
        3 =>   'Rab',
        4 =>   'Kam',
        5 =>   "Jum'",
        6 =>   'Sab',
        7 =>   'Min'
    );
    $tgl = substr($tanggal, 8, 2);
    $bln = substr($tanggal, 5, 2);
    $thn = substr($tanggal, 0, 4);
    $bln = $bulan[(int) $bln];
    $hari = $hari[(int) date('N', strtotime($tanggal))];
    return $hari . ', ' . $tgl . ' ' . $bln . ' ' . $thn;
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Diary| Project</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/swal.css">
        <link rel="stylesheet" href="css/style.css"> -->
        <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
        <script src="js/jquery-3.5.1.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap5.min.js"></script>
        <!-- <script src="js/swal.js"></script> -->
    
    
    
        <style>
            .zoom {
                transition: transform .2s;
            }
            .zoom:hover {
                transform: scale(3.1);
            }

        </style>
</head>

<body>
    <div class="container mt-5 justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card  shadow">
                <div class="card-header">Diaryku</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped" id="tbDiary">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>No.</th>
                                    <th class="col-sm-2">Date</th>
                                    <th>Customer</th>
                                    <th>Style</th>
                                    <th>Warna</th>
                                    <th>Jumlah</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM harianku ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <th scope="col"><?= $no++ ?></th>
                                    <td><?= tgl_kita($row['tanggal']) ?></td>
                                    <td><?= $row['customer'] ?></td>
                                    <td><?= $row['style'] ?></td>
                                    <td><?= $row['warna'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><img src="https://data.becik.my.id/img/<?= $row['gambar'] ?>" alt="<?= $row['gambar'] ?>" class="zoom" onerror="if (this.src != '../img/nophoto.jpg') this.src = '../img/nophoto.jpg';"
                                    width="28px"></td>
                                    <td><?= $row['keterangan'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#tbDiary').DataTable();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>