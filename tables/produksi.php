<?php
require "../koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, pro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card-body">
        <?php
        $produksi = mysqli_query($koneksi, "SELECT * FROM produksi ORDER BY id DESC");
        ?>
        <div class="table-responsive">
            <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Style</th>
                        <th>Code</th>
                        <th>Month</th>
                        <th>Bahan</th>
                        <th>Warna</th>
                        <th>Size</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>keterangan</th>
                        <th>Jht</th>
                        <th>Potong</th>
                        <th>Naskat</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_array($produksi)) : ?>
                        <tr>
                            <td>
                                <?= $i; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row["nama_customer"]; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row["style"]; ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $row["code"]; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row["bulan"]; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row["bahan"]; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row["warna"]; ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $row["size"]; ?>
                            </td>
                            <td>
                                <?= $row["qty"]; ?>
                            </td>
                            <td>
                                <?= $row["harga"]; ?>
                            </td>
                            <td>
                                <?= $row["keterangan"]; ?>
                            </td>
                            <td>
                                <?= $row["jahit"]; ?>
                            </td>
                            <td>
                                <?= $row["motong"]; ?>
                            </td>
                            <td>
                                <?= $row["naskat"]; ?>
                            </td>
                            <td>
                                <?= $row["tahun"]; ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>