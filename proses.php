<?php
if (!isset($_SESSION['login'])) {
    session_start();
}
error_reporting(0);
include 'koneksi.php';

if (isset($_POST['updateProfil'])) {

    $user_id = mysqli_real_escape_string($conn, $_POST['id']);
    $username =  mysqli_real_escape_string($conn, $_POST['username']);
    $nama =  mysqli_real_escape_string($conn, $_POST['nama']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);

    // $split = explode('.', $_FILES['foto']['name']);
    // $ekstensi = $split[count($split) - 1];

    // $foto = $username . '.' . $ekstensi;

    // $dir = "img/";
    // $tmpFile = $_FILES['foto']['tmp_name'];

    // move_uploaded_file($tmpFile, $dir . $foto);

    // cek apakah form kosong
    if (empty($username) or empty($nama) or empty($email)) {
        echo "Field tidak boleh kosong";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Silakan Masukkan email yang Valid";
        } else {
            if (empty($password) && empty($foto)) {
                $user_id = $_SESSION['user_id'];
                $sql = "UPDATE admin SET username = '$username', nama = '$nama',email = '$email' WHERE id = '$user_id';";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['nama'] = $nama;
                    $_SESSION['email'] = $email;

                    $_SESSION['success'] = "Data profil <strong>berhasil</strong> diubah";
                    header("Location: profiladmin.php");
                } else {
                    echo "Eror";
                }
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user_id = $_SESSION['user_id'];
                $sql2 = "UPDATE admin SET username = '$username', nama = '$nama',email = '$email', password = '$hash' WHERE id = '$user_id';";
                if (mysqli_query($conn, $sql2)) {
                    session_unset();
                    session_destroy();

                    echo "<script>alert('Password berhasil diubah, silakan login kembali'); document.location.href='index.php';</script>";
                } else {
                    echo "Eror";
                }
            }
        }
    }
}

// edit foto profil
if (isset($_POST['updateFoto'])) {
    $foto = $_POST['foto'];

    $username = $_SESSION['username'];
    $split = explode('.', $_FILES['foto']['name']);
    $ekstensi = $split[count($split) - 1];

    $foto = $username . '.' . $ekstensi;

    $dir = "img/";
    $tmpFile = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $foto);

    $sql3 = "UPDATE admin SET foto = '$foto' WHERE username = '$username';";
    if (mysqli_query($conn, $sql3)) {
        $_SESSION['foto'] = $foto;
        $_SESSION['success'] = "Foto profil <strong>berhasil</strong> diubah";
        header("Location: profiladmin.php");
    }
}

// function getAllHari()
// {
//     global $conn;
//     $query = "SELECT DISTINCT hari FROM jadwalkuliah";
//     if (isset($_GET['hari'])) {
//         $hari = $_GET['hari'];
//         $carihari = "SELECT * from jadwalkuliah WHERE hari LIKE '%$hari%'";
//     }
//     $result = mysqli_query($conn, $carihari);

//     $result = mysqli_query($conn, $query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }


// mengelola data jadwal
if (isset($_POST['tambahmatkul'])) {
    $kelas = $_POST['kelas'];
    $hari = htmlspecialchars($_POST['hari']);
    $jam  =  htmlspecialchars($_POST['waktu']);
    $mata_kuliah =  htmlspecialchars($_POST['mata_kuliah']);
    $ruangan =  htmlspecialchars($_POST['ruangan']);
    $dosen =  htmlspecialchars($_POST['dosen']);

    if (mysqli_query($conn, "INSERT INTO jadwalkuliah VALUES('','$jam','$mata_kuliah','$hari','$ruangan','$dosen','$kelas')")) {

        $_SESSION['success'] = "Data Mata Kuliah <strong>Berhasil</strong> ditambah";

        header("Location: mengelolajadwal.php");
    } else {
        $_SESSION['failed'] = "Data Mata Kuliah <strong>Gagal</strong> ditambah";

        header("Location: mengelolajadwal.php");
    }
}


if (isset($_GET['hapusmatkul'])) {
    $id_jadwal = $_GET['hapusmatkul'];
    if (mysqli_query($conn, "DELETE FROM jadwalkuliah WHERE id_jadwal = '$id_jadwal'")) {
        $_SESSION['success'] = "Data Mata Kuliah <strong>Berhasil</strong> dihapus";

        header("Location: mengelolajadwal.php");
    } else {
        $_SESSION['failed'] = "Data Mata Kuliah <strong>Gagal</strong> dihapus";

        header("Location: mengelolajadwal.php");
    }
}

if (isset($_POST['ubahmatkul'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $kelas = $_POST['kelas'];
    $hari = htmlspecialchars($_POST['hari']);
    $jam  =  htmlspecialchars($_POST['waktu']);
    $mata_kuliah =  htmlspecialchars($_POST['mata_kuliah']);
    $ruangan =  htmlspecialchars($_POST['ruangan']);
    $dosen =  htmlspecialchars($_POST['dosen']);

    if (mysqli_query($conn, "UPDATE jadwalkuliah SET jam = '$jam', mata_kuliah= '$mata_kuliah',hari = '$hari', ruangan = '$ruangan', dosen = '$dosen', kelas = '$kelas' WHERE id_jadwal = '$id_jadwal'")) {

        $_SESSION['success'] = "Data Mata Kuliah <strong>Berhasil</strong> diupdate";
        header("Location: mengelolajadwal.php");
    } else {
        $_SESSION['failed'] = "Data Mata Kuliah <strong>Gagal</strong> diupdate";
        header("Location: mengelolajadwal.php");
    }
}



// LIST KELAS
if (isset($_POST['tambahlistkelas'])) {
    $kelas = htmlspecialchars($_POST['kelas']);
    $prodi = htmlspecialchars($_POST['prodi']);
    $jurusan  =  htmlspecialchars($_POST['jurusan']);

    if (mysqli_query($conn, "INSERT INTO kelas VALUES('','$kelas','$prodi','$jurusan')")) {

        $_SESSION['success'] = "Data Kelas <strong>Berhasil</strong> ditambah";

        header("Location: daftarkelas.php");
    } else {
        $_SESSION['failed'] = "Data Kelas <strong>Gagal</strong> ditambah";

        header("Location: daftarkelas.php");
    }
}


if (isset($_GET['hapuslistkelas'])) {
    $id_kelas = $_GET['hapuslistkelas'];
    if (mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id_kelas'")) {
        $_SESSION['success'] = "Data Kelas <strong>Berhasil</strong> dihapus";

        header("Location: daftarkelas.php");
    } else {
        $_SESSION['failed'] = "Data Kelas <strong>Gagal</strong> dihapus";

        header("Location: daftarkelas.php");
    }
}

if (isset($_POST['ubahlistkelas'])) {
    $id_kelas = $_POST['id_kelas'];
    $kelas = htmlspecialchars($_POST['kelas']);
    $prodi = htmlspecialchars($_POST['prodi']);
    $jurusan  =  htmlspecialchars($_POST['jurusan']);

    if (mysqli_query($conn, "UPDATE kelas SET nama ='$kelas', prodi ='$prodi',jurusan ='$jurusan' WHERE id_kelas = '$id_kelas'")) {

        $_SESSION['success'] = "Data Kelas <strong>Berhasil</strong> diupdate";
        header("Location: daftarkelas.php");
    } else {
        $_SESSION['failed'] = "Data Kelas <strong>Gagal</strong> diupdate";

        header("Location: daftarkelas.php");
    }
}


// DOSEN
if (isset($_POST['tambahdosen'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $nidn = htmlspecialchars($_POST['nidn']);
    $kode_dosen  =  htmlspecialchars($_POST['kode_dosen']);
    $status = htmlspecialchars($_POST['status']);
    $prodi = htmlspecialchars($_POST['prodi']);
    $email = htmlspecialchars($_POST['email']);
    $pendidikan = htmlspecialchars($_POST['pendidikan']);
    $fotodosen = $_FILES['foto']['name'];

    $dir = "profil_dosen/";
    $tmpFile = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $fotodosen);

    if (mysqli_query($conn, "INSERT INTO dosen VALUES('','$nidn','$kode_dosen','$nama','$status','$prodi','$pendidikan','$email','$fotodosen')")) {

        $_SESSION['success'] = "Data Dosen <strong>Berhasil</strong> ditambah";

        header("Location: kontakdosen.php");
    } else {
        $_SESSION['failed'] = "Data Dosen <strong>Gagal</strong> ditambah";

        header("Location: kontakdosen.php");
    }
}
if (isset($_GET['hapusdosen'])) {
    $id_dosen = $_GET['hapusdosen'];

    $queryshow = "SELECT * FROM dosen WHERE id_dosen = '$id_dosen';";
    $sqlshow = mysqli_query($conn, $queryshow);
    $row = mysqli_fetch_assoc($sqlshow);

    unlink("profil_dosen/" . $row['foto']);


    if (mysqli_query($conn, "DELETE FROM dosen WHERE id_dosen = '$id_dosen'")) {
        $_SESSION['success'] = "Data Dosen <strong>Berhasil</strong> dihapus";

        header("Location: kontakdosen.php");
    } else {
        $_SESSION['failed'] = "Data Dosen <strong>Gagal</strong> dihapus";

        header("Location: kontakdosen.php");
    }
}

if (isset($_POST['updatedatadosen'])) {
    $id_dosen = $_POST['id_dosen'];
    $nama = htmlspecialchars($_POST['nama']);
    $nidn = htmlspecialchars($_POST['nidn']);
    $kode_dosen  =  htmlspecialchars($_POST['kode_dosen']);
    $status = htmlspecialchars($_POST['status']);
    $prodi = htmlspecialchars($_POST['prodi']);
    $email = htmlspecialchars($_POST['email']);
    $pendidikan = htmlspecialchars($_POST['pendidikan']);

    if (mysqli_query($conn, "UPDATE dosen SET nama ='$nama', no_induk ='$nidn', kode_dosen ='$kode_dosen', status = '$status', prodi='$prodi', pendidikan_terakhir = '$pendidikan',email = '$email' WHERE id_dosen = '$id_dosen'")) {

        $_SESSION['success'] = "Data Dosen <strong>Berhasil</strong> diupdate";
        header("Location: kontakdosen.php");
    } else {
        $_SESSION['failed'] = "Data Dosen <strong>Gagal</strong> diupdate";

        header("Location: kontakdosen.php");
    }
}

if (isset($_POST['updateFotodosen'])) {
    $id_dosen = $_POST['id_dosen'];
    $fotodosen = $_FILES['foto']['name'];

    $dir = "profil_dosen/";
    $tmpFile = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $fotodosen);

    $sqldosen = "UPDATE dosen SET foto = '$fotodosen' WHERE id_dosen = '$id_dosen';";
    if (mysqli_query($conn, $sqldosen)) {
        $_SESSION['success'] = "Foto profil dosen <strong>berhasil</strong> diubah";
        header("Location: kontakdosen.php");
    } else {
        $_SESSION['failed'] = "Foto profil dosen <strong>Gagal</strong> dihapus";

        header("Location: kontakdosen.php");
    }
}
