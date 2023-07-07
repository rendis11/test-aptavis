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
$skor       = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from klub where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from klub where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama_klub  = $r1['nama_klub'];
    $kota_klub  = $r1['kota_klub'];
    $skor       = $r1['skor'];

    if ($nama_klub == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama_klub  = $_POST['nama_klub'];
    $kota_klub  = $_POST['kota_klub'];
    $skor       = $_POST['skor'];

    if ($nama_klub && $kota_klub && $skor) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update klub set nama_klub = '$nama_klub',kota_klub='$kota_klub',skor = '$skor' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into klub(nama_klub,kota_klub,skor) values ('$nama_klub','$kota_klub','$skor')";
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
    <title>Data Klub</title>
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
                    header("refresh:5;url=soal_2.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=soal_2.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="col-12">
                        <input type="button" name="tambah_form" value="Tambah Form" class="btn btn-warning" />
                        <input type="button" name="reset_form" value="Reset Form" class="btn btn-danger" />
                    </div><br>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nama Klub</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_klub" name="nama_klub" value="<?php echo $nama_klub ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Kota Klub</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kota_klub" name="kota_klub" value="<?php echo $kota_klub ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Skor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="skor" name="skor" value="<?php echo $skor ?>">
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
                            <th scope="col">Kota Klub</th>
                            <th scope="col">Skor</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from klub order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama_klub  = $r2['nama_klub'];
                            $kota_klub  = $r2['kota_klub'];
                            $skor       = $r2['skor'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_klub ?></td>
                                <td scope="row"><?php echo $kota_klub ?></td>
                                <td scope="row"><?php echo $skor ?></td>
                                <td scope="row">
                                    <a href="soal_2.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="soal_2.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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
