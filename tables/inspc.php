<?php 
// require '../koneksi.php';
// session_start ();
// function query($query) {
//     global $koneksi;
//     $result = mysqli_query($koneksi, $query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }
// TAMBAH PRODUKSI =============//
if(isset($_POST['simpanSpc'])) {
    $image = uploadSpc();
    if (!$image) {
        return false;
    }
    $id_sample = $_POST['id_sample'];
    $insert = mysqli_query($koneksi, "INSERT INTO spc VALUES ('','$image','$id_sample')");
    if ($insert) {
        $_SESSION["sukses"]= "Data Berhasil Disimpan!";
        
    } else {
        $_SESSION["sukses"]= "Data Gagal Disimpan!";
        
    }
}


function uploadSpc () {
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>
            ";
        return false;
    }
    // CEKGAMBAR yg boleh diupload
    $ekstensiImageValid = ['jpg', 'jpeg', 'png'];
    $ekstensiImage = explode('.', $namaFile);
    $ekstensiImage = strtolower(end($ekstensiImage));
    if (!in_array($ekstensiImage, $ekstensiImageValid)) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>
            ";
        return false;
    }
    
    move_uploaded_file($tmpName, './spc/' . $namaFile);
    return $namaFile;
}
?>
<center>
    <div class="row p-1">
            <div class="card-header">
                <h3 class="card-title"> Input Data Spechsheets</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php 
                    // select option db spc by id_sample
                    // $id = $_GET['id'];
                    $query = mysqli_query($koneksi,"SELECT * FROM sample");
                    $data = mysqli_fetch_assoc($query);

                    ?>
                    <div class="mb-2 row px-5">
                        <label class="col-sm-5 col-form-label">Customer | Style</label>
                            <select name="id_sample" class="col-sm-5 form-select " aria-label="Default select example">
                            <option value="0" selected="selected" class="text-black">Customer | Style</option>
                            <?php
                            // $id = $_GET['id'];
                            $query = mysqli_query($koneksi,"SELECT * FROM sample ORDER BY id DESC");
                            while($data = mysqli_fetch_assoc($query)){
                                echo "<option value='$data[id]'>
                                $data[nama_customer] | $data[style] : $data[id]
                                </option>";
                            }
                            ?>
                            </select>
                    </div>
                    <div class="mb-2 row">
                        <center>
                            <img class="img-thumbnail zoom mb-2" id="tampilkan3"
                                src="./img/nophoto.png"
                                onerror="if (this.src != './images/Coming-Soon.jpg') this.src = './images/Coming-Soon.jpg';"
                                width="100px">
                            <br>
                            <div class="col-sm-2 text-center">
                                <input class="form-control form-control-sm" id="imgInp3" name="image" type="file">
                            </div>
                        </center>
                    </div>
                    <button type="submit" class="btn btn btn-outline-primary float-end" id="simpanSpc" name="simpanSpc">Simpan</button> &nbsp; &nbsp;
                    <!-- <button type="submit" class="btn btn btn-outline-info float-end" id="updateSpc" name="updateSpc">update</button> -->
                </form>
            </div>
    </div>
</center>
<script>
    $(document).ready(function() {

        $("#imgInp3").change(function() {
            readURL(this);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampilkan3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>