<?php
session_start();
if (isset($_FILES['attachments'])) {
    $msg = "";
    $targetFile = "uploads/" . basename($_FILES['attachments']['name'][0]);
    if (file_exists($targetFile))
        $msg = array("status" => 0, "msg" => "File already exists!");
    else if (move_uploaded_file($_FILES['attachments']['tmp_name'][0], $targetFile))
        $msg = array("status" => 1, "msg" => "File Has Been Uploaded", "path" => $targetFile);

    exit(json_encode($msg));
}
?>
    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload| Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="swal.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <script src="jquery.min.js"></script> -->
    <script src="js/swal.js"></script>
    
    
<style>
    body{
        font-family: 'Roboto Slab', serif;
        font-family: 'Roboto', sans-serif;
        background-image: url("https://images.unsplash.com/photo-1489875347897-49f64b51c1f8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80");
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
        border-radius : 10px;
        box-shadow : 0px 0px 10px 0px rgba(0,0,0,0.5);
        background-color : #03443F35;
        padding : 10px;
        margin-bottom : 10px;
    }
    .card-body{
        padding : 14px;
        background-color : #01080E34;
    }
    form div label{
            width: 96%;
        background-color : #fff;
        display : block;
        padding : 12px;
        box-sizing : border-box;
        font-family : 'Roboto', sans-serif;
        font-size : 14px;
        border-radius : 5px;
        color : #000;
        position : relative;

    }
    form div label:before{
        content : 'Brouse';
        position : absolute;
        padding-top : 12px;
        top : -1px;
        right : -2px;
        width : 30%;
        height : 102%;
        background-color : #B0BBF8DE;
        text-align : center;
        line-height : 30px;
        border-radius : 0 5px 5px 0;
    }
    strong{
        width : 100%;
        height : 50%;
        display : flex;
        align-items : center;
        justify-content : space-between;
    }
    strong h4{
        background-color : #09021380;
        font-size : 14px;
        font-weight : bold;
        color : #FFFFFF;
        padding : 8px 10px;
        
    }
    #dropZone {
        border: 3px dashed #0088cc;
        padding: 50px;
        width: 500px;
        margin-top: 20px;
    }

    #files {
        border: 1px dotted #0088cc;
        padding: 20px;
        width: 200px;
        display: none;
    }

    #error {
        color: red;
    }
</style>
</head>

<body>
<?php if(@$_SESSION['msg']){ ?>
    <script>
        swal.fire("Good job!",
            "<?php echo $_SESSION['msg']; ?>",
            "success"
        );
    </script>
<?php unset($_SESSION['msg']); } ?>
<?php if(@$_SESSION['gagal']){ ?>
    <script>
        swal.fire("Sorry!",
            "<?php echo $_SESSION['gagal']; ?>",
            "error"
        );
    </script>
<?php unset($_SESSION['gagal']); } ?>
    <!--  -->
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #0C0005">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="bismillah.png" alt="Bismillah" height="40px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse float-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="sample.php">Sample</a>
                    <a class="nav-link " href="produksi.php">Produksi</a>
                    <a class="nav-link" href="harian.php">Diary</a>
                    <a class="nav-link " href="time.php">Timeline</a>
                    <a class="nav-link" href="spech.php">Spechsheets</a>
                    <a class="nav-link active" href="upload.html">Upload file</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5 text-light">
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Upload</div>
                    <div class="card-body" >
                        <center>
                            <img class="img-thumbnail m-2" onerror="if (this.src != 'nophoto.png') this.src = 'nophoto.png';" src="" id="tampil" alt="" width="100" height="160">
                            <div id="dropzone" class="mb-3">
                                <input type="file" id="fileupload" name="attachments[]" multiple style="display: none;">
                                <label for="fileupload">Seret file kesini!</label>
                            </div>
                        </center> 
                            <button class="upload btn btn-outline-danger mt-2 mb-3" id="error">(.y.)</button><button  id="progress" class="btn btn-outline-info float-end mt-2 mb-3">(.Y.)</button>
                            <div class="row">
                                <div class="col">
                                    <div id="files"></div>
                                </div>
                            </div>
                            
                            <div class="progress mt-3">
                                <div class="progress progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                        
                    </div>
                </div>
            </div>
    </div>
<!-- Model -->
<script src="js/jquery.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="js/jquery.fileupload.js" type="text/javascript"></script>
    <!-- end canvas -->
    <script type="text/javascript">
        $(function () {
            var files = $("#files");

            $("#fileupload").fileupload({
                url: 'index.php',
                dropZone: '#dropZone',
                dataType: 'json',
                autoUpload: false
            }).on('fileuploadadd', function (e, data) {
                var fileTypeAllowed = /.\.(gif|jpg|png|jpeg|pdf)$/i;
                var fileName = data.originalFiles[0]['name'];
                var fileSize = data.originalFiles[0]['size'];

                if (!fileTypeAllowed.test(fileName))
                    $("#error").html('Only images are allowed!');
                else if (fileSize > 6000000)
                    $("#error").html('Your file is too big! Max allowed size is: 5.MB');
                else {
                    $("#error").html("");
                    data.submit();
                }
            }).on('fileuploaddone', function (e, data) {
                var status = data.jqXHR.responseJSON.status;
                var msg = data.jqXHR.responseJSON.msg;

                if (status == 1) {
                    var path = data.jqXHR.responseJSON.path;
                    $("#files").fadeIn().append('<p><img style="width: 60px; height: 85px;" src="' +
                        path + '" /></p>');
                } else
                    $("#error").html(msg);
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $("#progress").html("Completed: " + progress + "%");
                // progress-bar progress-bar-striped progress-bar-animated
                $(".progress-bar").css("width", progress + "%").attr("aria-valuenow", progress);
                if (progress == 100) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your image has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $(".progress-bar").removeClass("progress progress-bar-striped progress-bar-animated");
                    $("#progress").html("Completed");
                }

            });
        });
    </script>
    <!-- spechsheet  -->
    <!-- <script type="text/javascript">
    $(document).ready(function () {        
        $('#fileupload').click(function () {
            upload.onchange = function() {
                var reader = new FileReader();
                reader.onload = function() {
                    document.getElementById("tampil").src = reader.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    </script> -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <!-- <script src="main.js"></script> -->
</body>
</html>
<script>

</script>