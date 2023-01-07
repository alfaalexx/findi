<?php
session_start();
require 'koneksi.php';
error_reporting(0);

if (isset($_POST['login'])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($username == '' or $password == '') {
    $err .= "Masukkan Username dan Password";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    // cek username
    if (mysqli_num_rows($result) === 1) {

      // cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        // set session
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION["username"] = $row["username"];
        $_SESSION["nama"] = $row["nama"];


        header("Location: index.php");
      } else {
        $err .= "Username atau Password salah";
      }
    } else {
      $err .= "Username tidak ditemukan :(";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login - Findi</title>
  <link rel="stylesheet" type="text/css" href="css/style_login.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Loader -->
  <link rel="stylesheet" href="css/fakeLoader.css">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="img/logo_findi.png" />
</head>

<body>
  <img class="wave" src="img/wave.png" />
  <div class="container">
    <div class="img">
      <img src="img/bg2.svg.svg" />
    </div>
    <div class="login-content">
      <form method="POST">
        <img src="img/logo_findi.png" />
        <h2 class="title">Welcome</h2>
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <label for="username" class="form-label"></label>
            <!-- <label for="username">Username</label> -->
            <input type="text" class="input" name="username" id="username" placeholder="Username" autofocus autocomplete="off" />
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <label for="password"></label>
            <input type="password" class="input" name="password" id="password" placeholder="Password" />
          </div>
        </div>
        <?php if ($err) { ?>
          <div>
            <p style="color: red;"><?php echo $err; ?></p>
          </div>
        <?php } ?>
        <br>
        <button type="submit" name="login" class="btn">LOGIN</button>
      </form>
    </div>
  </div>

  <!-- javascript form login -->
  <script type="text/javascript" src="js/main_login.js"></script>
  <!-- javascript loading -->
  <script src="js/fakeLoader.js"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- feather -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <!-- CDN JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>