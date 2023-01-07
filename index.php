<?php
if (!isset($_SESSION['login'])) {
    session_start();
}
error_reporting(0);
$page = 'carijadwal';

// require_once 'config.php';
require_once 'koneksi.php';

if (isset($_POST['tombolcaridosen'])) {
    $caridosen = $_POST['caridosen'];
    $_SESSION['caridosen'] = $caridosen;
} else {
    $caridosen = $_SESSION['caridosen'];
}

$result = mysqli_query($conn, "SELECT * FROM jadwalkuliah");

// Konfigurasi Pagination
// $jumlahDataPerHalaman = 10;
// $jumlahData = mysqli_num_rows($result);
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// $jumlahLink = 3;
// if ($halamanAktif > $jumlahLink) {
//     $start_number = $halamanAktif - $jumlahLink;
// } else {
//     $start_number = 1;
// }
// if ($halamanAktif < ($jumlahHalaman - $jumlahLink)) {
//     $end_number = $halamanAktif + $jumlahLink;
// } else {
//     $end_number = $jumlahHalaman;
// }
// $result2 = mysqli_query($conn, "SELECT * FROM jadwalkuliah WHERE jam LIKE '%$caridosen%' OR mata_kuliah LIKE '%$caridosen%' OR hari LIKE '%$caridosen%' OR ruangan LIKE '%$caridosen%' OR dosen LIKE '%$caridosen%' LIMIT $awalData, $jumlahDataPerHalaman");

include_once 'template/header.php';
include_once 'template/navbar.php';
?>

<div class="row">
    <!-- header ada di folder template/header.php -->
    <!-- Navbar ada di folder template/navbar.php -->

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" id="headercarijadwal">CARI JADWAL</h1>
        </div>

        <!-- Tombol caridosen -->
        <!-- <div class="row">
            <form action="mengelolajadwal.php" method="POST">
                <center>
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="input-group mb-3">
                            <input name="caridosen" type="text" class="keywordkelas form-control" placeholder="Cari..." aria-label="Cari dosen pengajar kamu disini" value="" autofocus autocomplete="off">
                            <button class="tombolkelas btn btn-primary" type="submit" name="tombolcaridosen"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </center>
            </form>
        </div> -->


        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
        <div class="card shadow">
            <div class="card-body">
                <div class="container-fluid table-responsive">
                    <table id="mengelolajadwal" class="table tables-sm align-middle table-hover">
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col" hidden>id</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Dosen</th>
                            </tr>
                        </thead>

                        <tbody class="table table-group-divider">
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td hidden><?php echo $row['id_jadwal']; ?></td>
                                    <td><?php echo $row['kelas']; ?></td>
                                    <td><?php echo $row['hari']; ?></td>
                                    <td><?php echo $row['jam']; ?></td>
                                    <td><?php echo $row['mata_kuliah']; ?></td>
                                    <td><?php echo $row['ruangan']; ?></td>
                                    <td><?php echo $row['dosen']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- logout Modal -->
                <div class="modal fade" id="modallogoutbtn" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="logoutModalLabel">Peringatan!!!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <center>
                                    Apakah Anda yakin ingin Logout dari Website ini?
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a class="btn btn-primary" href="logout.php">Yakin :)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>

<script src="assets/js/jquery-3.6.3.min.js"></script>

<script>
    $(document).ready(function() {
        $('#mengelolajadwal').DataTable();
    });
</script>
<?php include_once 'template/footer.php'; ?>