<?php 
// include 'koneksi.php';
include 'proses.php';
session_start();


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diary| Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swal.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/swal.js"></script>

    <style>
    body{
        font-family: 'Roboto Slab', serif;
        font-family: 'Roboto', sans-serif;
        background-image: url("bg.avif");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;

    }
    .active {
        text-decoration: underline !important;
        font-size: 16px;
        color: #F62A01;
        text-shadow: #F73218 3px 6px 10px;
        /* text-overflow: ellipsis; */
    }
    .card{
    width : 100%;
    height : 100%;
    color : #fff;
    border: 1px solid #3B6258DD;
    border-radius : 10px;
    box-shadow : 0px 0px 10px 0px rgba(0,0,0,0.5);
    background-color : #021639A9;
    padding : 10px;
    margin-bottom : 10px;
}
.card-body{
    padding : 10px;
    background-color : #021A2FCB;
    border-radius : 10px;
    box-shadow : 0px 0px 10px 0px rgba(0,0,0,0.5);
    color : white;
}
    </style>
</head>

<body>
    <?php if(@$_SESSION['sukses']){ ?>
    <script>
        swal.fire("Good job!",
            "<?php echo $_SESSION['sukses']; ?>",
            "success"
        );
    </script>
    <?php unset($_SESSION['sukses']); } ?>
    <!--  -->
    <?php 
    if(isset($_POST['save'])){
        if(upload($_POST) > 0){
            echo "<script>
            swal.fire({
                title: 'Success!',
                text: 'Gambar Berhasil Di Simpan',
                icon: 'success',
                confirmButtonText: 'Oke'
            }).then(function() {
                window.location = 'upload.php';
            });
            </script>";
        }else{
            echo "<script>
            swal.fire({
                title: 'Oops!',
                text: 'Gambar Gagal Di Simpan',
                icon: 'error',
                confirmButtonText: 'Oke'
            }).then(function() {
                window.location = 'upload.php';
            });
            </script>";
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #0C0005">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="bismillah.png" alt="Bismillah" height="40px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse float-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="http://127.0.0.1:8080/project/index.php">Home</a>
                    <a class="nav-link" href="http://127.0.0.1:8080/project/sample.php">Sample</a>
                    <a class="nav-link " href="http://127.0.0.1:8080/project/produksi.php">Produksi</a>
                    <a class="nav-link" href="http://127.0.0.1:8080/project/harian.php">Diary</a>
                    <a class="nav-link " href="http://127.0.0.1:8080/project/time.php">Timeline</a>
                    <a class="nav-link" href="http://127.0.0.1:8080/project/spech.php">Spechsheets</a>
                    <a class="nav-link active" href="upload.php">Upload</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-4 col-md-10 col-sm-12">
                <div class="card shadow">
                    <div class="card-header">Form Sample</div>
                    <div class="card-body">
                        <form action="" class="form-input text-sm" id="form-upload" method="post" enctype="multipart/form-data">                        
                            <div class="mb-2 row">
                                <div class="row start-50">
                                    <div class="px-3">
                                        <center>
                                            <img src="https://data.becik.my.id/img/<?= $vgambar; ?>" class="img-thumbnail  mb-2" id="tampil1"
                                                onerror="if (this.src != 'img/nophoto.jpg') this.src = 'img/nophoto.jpg';"
                                                width="100px">
                                            <br>
                                            <div class="input-group mb-3 text-start">
                                                <input type="file" class="form-control"  accept="image/*" id="inGambar" name="gambar" style="display: none;" multyple>
                                                <label for="inGambar"  class="form-control col-sm-11" aria-label="gambar" aria-describedby="basic-addon2" >Seret File Kesini!</label>
                                                <span class="input-group-text" for="inGambar">Brouse</span>
                                            </div>
                                            <!-- <input class="form-control form-control-sm"type="file" name="gambar" style="display: none;" multyple /> -->
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center" id="tombol">
                            <button class="btn btn-sm btn-info" id="save" name="save">Save | Tambahkan</button> &nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9 col-sm-12 col-md-12 mt-3">
            <div class="message float-start btn btn-outline-light" id="message">(.Y.)</div>
            <div id="percent" class="btn btn-outline-info percent float-end">(.Y.)</div>
            </div>
            <div class="col-lg-9 col-sm-12 col-md-12 mt-3">
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                </div>
                <div class="" id="bar"></div>
            </div>
        </div>
    </div>
<!-- Modal -->

    <!-- end canvas -->
    <script>
        $(document).ready(function () {
            // preview gambar
            $('#inGambar').change(function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            // end preview gambar    
        });
        
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    <!-- spechsheet  -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>