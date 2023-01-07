<?php
session_start();
//menyertakan file program koneksi.php pada register
require 'koneksi.php';
//inisialisasi session
$error = '';
$validate = '';
//mengecek apakah form registrasi di submit atau tidak
if (isset($_POST['submit'])) {
    // menghilangkan backshlases
    $username = stripslashes($_POST['username']);
    //cara sederhana mengamankan dari sql injection
    $username = mysqli_real_escape_string($conn, $username);
    $nama     = stripslashes($_POST['nama']);
    $nama     = mysqli_real_escape_string($conn, $nama);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $repass   = stripslashes($_POST['repassword']);
    $repass   = mysqli_real_escape_string($conn, $repass);
    //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty($nama) && !empty($username) && !empty($password) && !empty($repass)) {
        //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
        if ($password == $repass) {
            //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
            if (cek_nama($nama, $conn) == 0) {
                //hashing password sebelum disimpan didatabase
                $pass  = password_hash($password, PASSWORD_DEFAULT);
                //insert data ke database
                $query = "INSERT INTO admin (username, nama, password) VALUES ('$username','$nama','$pass')";
                $result   = mysqli_query($conn, $query);
                //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                if ($result) {
                    $_SESSION['username'] = $username;

                    header('Location: login.php');

                    //jika gagal maka akan menampilkan pesan error
                } else {
                    $error =  'Register User Gagal';
                }
            } else {
                $error =  'Username sudah terdaftar';
            }
        } else {
            $validate = 'Password tidak sama';
        }
    } else {
        $error =  'Data tidak boleh kosong';
    }
}
//fungsi untuk mengecek username apakah sudah terdaftar atau belum
function cek_nama($username, $conn)
{
    $nama = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM admin WHERE username = '$nama'";
    if ($result = mysqli_query($conn, $query)) return mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        img {
            width: 100%;
            position: fixed;
            z-index: -1;
        }
    </style>
</head>

<body>
    <img src="img/polibatam.png" alt="" class="img-fluid rounded-start" width="100%">
    <section class="container-fluid mb-4">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4"><br>
                <div class="card">
                    <div class="card-body">
                        <form class="form-container" action="register.php" method="POST">
                            <h4 class="text-center font-weight-bold"> Buat Akun Baru </h4>
                            <hr>
                            <?php if ($error != '') { ?>
                                <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                            <?php } ?>

                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">Password</label>
                                <input type="password" class="form-control" id="InputPassword" name="password">
                                <?php if ($validate != '') { ?>
                                    <p class="text-danger"><?= $validate; ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="InputRePassword" name="repassword">
                                <?php if ($validate != '') { ?>
                                    <p class="text-danger"><?= $validate; ?></p>
                                <?php } ?>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                            <div class="form-footer mt-2">
                                <p> Sudah punya account? <a href="login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_destroy();
?>