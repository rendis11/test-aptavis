<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "aptavis";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama_klub  = "";
$kota_klub  = "";
$ma         = "";
$me         = "";
$s          = "";
$k          = "";
$gm         = "";
$gk         = "";
$point      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from klasemen where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from klasemen where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama_klub  = $r1['nama_klub'];
    $ma         = $r1['ma'];
    $me         = $r1['me'];
    $s          = $r1['s'];
    $k          = $r1['k'];
    $gm         = $r1['gm'];
    $gk         = $r1['gk'];
    $point      = $r1['point'];

    if ($nama_klub == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama_klub  = $_POST['nama_klub'];
    $ma         = $_POST['ma'];
    $me         = $_POST['me'];
    $s          = $_POST['s'];
    $k          = $_POST['k'];
    $gm         = $_POST['gm'];
    $gk         = $_POST['gk'];
    $point      = $_POST['point'];

    if ($nama_klub && $ma && $me && $s && $k && $gm && $gk && $point ) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update klasemen set nama_klub = '$nama_klub',ma = '$ma',me = '$me',s = '$s',k = '$k',gm = '$gm',gk = '$gk',point = '$point' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into klub(nama_klub,ma,me,s,k,gm,gk,point) values ('$nama_klub','$ma','$me','$s','$k','$gm','$gk','$point')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Klasemen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=soal_3.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=soal_3.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nama Klub</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_klub" name="nama_klub" value="<?php echo $nama_klub ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Main</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ma" name="ma" value="<?php echo $ma ?>">
                        </div>
                    </div>
                    <script type="text/javascript"> 
                    <?php echo $jsArray; ?>
                    function changeValue(id){
                    var point = (parseInt(me)+parseInt(gm));
                    document.getElementById('point').value = point;
                    };
                    </script>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Menang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="me" name="me" value="<?php echo $me ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Seri</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="s" name="s" value="<?php echo $s ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Kalah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="k" name="k" value="<?php echo $k ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Goal Menang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gm" name="gm" value="<?php echo $gm ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Goal Kalah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gk" name="gk" value="<?php echo $gk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Point</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="point" name="point" value="<?php echo $point ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Klub
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Klub</th>
                            <th scope="col">Ma</th>
                            <th scope="col">Me</th>
                            <th scope="col">S</th>
                            <th scope="col">K</th>
                            <th scope="col">GM</th>
                            <th scope="col">GK</th>
                            <th scope="col">Point</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from klasemen order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama_klub  = $r2['nama_klub'];
                            $ma         = $r2['ma'];
                            $me         = $r2['me'];
                            $s          = $r2['s'];
                            $k          = $r2['k'];
                            $gm         = $r2['gm'];
                            $gk         = $r2['gk'];
                            $point      = $r2['point'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_klub ?></td>
                                <td scope="row"><?php echo $ma ?></td>
                                <td scope="row"><?php echo $me ?></td>
                                <td scope="row"><?php echo $s ?></td>
                                <td scope="row"><?php echo $k ?></td>
                                <td scope="row"><?php echo $gm ?></td>
                                <td scope="row"><?php echo $gk ?></td>
                                <td scope="row"><?php echo $point ?></td>
                                <td scope="row">
                                    <a href="soal_3.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="soal_3.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>
