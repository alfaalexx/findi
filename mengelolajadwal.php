<?php
if (!isset($_SESSION['login'])) {
    session_start();
}
error_reporting(0);
$page = 'mengelolajadwal';

// require_once 'config.php';
require_once 'koneksi.php';

if (isset($_POST['tombolcaridosen'])) {
    $caridosen = $_POST['caridosen'];
    $_SESSION['caridosen'] = $caridosen;
} else {
    $caridosen = $_SESSION['caridosen'];
}

$result = mysqli_query($conn, "SELECT * FROM jadwalkuliah");
$listkelas = mysqli_query($conn, "SELECT * FROM kelas");
$listkelas2 = mysqli_query($conn, "SELECT * FROM kelas");
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
            <h1 class="h2" id="headercarijadwal">MENGELOLA JADWAL</h1>
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

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php unset($_SESSION['success']);
        endif; ?>

        <?php if (isset($_SESSION['failed'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['failed'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['failed']);
        endif; ?>


        <div class="d-flex justify-content-end">
            <?php if ($_SESSION['login'] == true) : ?>
                <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahmatkul"><i class="fas fa-plus-circle mr-2"></i> TAMBAH MATA KULIAH</a>
            <?php endif; ?>
        </div>

        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
        <div class="card shadow">
            <div class="card-body">
                <div class="container-fluid table-responsive">
                    <table id="mengelolajadwal" class="table tables-sm align-middle table-hover">
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col" hidden>id</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Ruangan</th>

                                <?php if ($_SESSION['login'] == true) : ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody class="table table-group-divider">
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td hidden><?php echo $row['id_jadwal']; ?></td>
                                    <td><?php echo $row['dosen']; ?></td>
                                    <td><?php echo $row['hari']; ?></td>
                                    <td><?php echo $row['jam']; ?></td>
                                    <td><?php echo $row['kelas']; ?></td>
                                    <td><?php echo $row['mata_kuliah']; ?></td>
                                    <td><?php echo $row['ruangan']; ?></td>

                                    <?php if ($_SESSION['login'] == true) : ?>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#updatematkul<?php echo $row['id_jadwal']; ?>"><i class="fas fa-edit bg-success p-2 text-white rounded"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#deletematkul<?php echo $row['id_jadwal']; ?>"><i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i></a>
                                        </td>
                                    <?php endif; ?>
                                </tr>


                                <!-- Tambah Matkul modal -->
                                <div class="modal fade" id="tambahmatkul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mata Kuliah</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses.php" role="form">
                                                    <div class="mb-3">
                                                        <label for="dosen" class="col-form-label">Dosen</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan kode dosen" name="dosen" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kelas" class="col-form-label">Kelas</label>
                                                        <input type="text" class="form-control" placeholder="contoh : RKS 5 PAGI, ANIMASI 1A PAGI" name="kelas" value="" id="kelas" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hari" class="col-form-label">Hari</label>
                                                        <input type="text" class="form-control" placeholder="contoh : Senin" name="hari" value="" id="hari" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="waktu" class="col-form-label">Waktu</label>
                                                        <input type="text" class="form-control" placeholder="contoh : 07:00 - 09:00" name="waktu" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="matakuliah" class="col-form-label">Mata Kuliah</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan Matkul" name="mata_kuliah" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ruangan" class="col-form-label">Ruangan</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan ruangan" name="ruangan" value="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambahmatkul" class="btn btn-primary" value="tambah">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Matkul modal -->
                                <div class="modal fade" id="updatematkul<?php echo $row['id_jadwal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Mata Kuliah</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses.php" role="form">
                                                    <input type="text" class="form-control" name="id_jadwal" id="id_jadwal" value="<?php echo $row['id_jadwal']; ?>" hidden>
                                                    <div class="mb-3">
                                                        <label for="dosen" class="col-form-label">Dosen</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan nama dosen" name="dosen" value="<?php echo $row['dosen']; ?>" id="dosen">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kelas" class="col-form-label">Kelas</label>
                                                        <input type="text" class="form-control" placeholder="contoh : RKS 5 PAGI, AN 1A PAGI" name="kelas" value="<?php echo $row['kelas']; ?>" id="kelas" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hari" class="col-form-label">Hari</label>
                                                        <input type="text" class="form-control" placeholder="contoh : Senin" name="hari" value="<?php echo $row['hari']; ?>" id="hari" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="waktu" class="col-form-label">Waktu</label>
                                                        <input type="text" class="form-control" placeholder="contoh : 07:00 - 09:00" name="waktu" value="<?php echo $row['jam']; ?>" id="waktu">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mata_kuliah" class="col-form-label">Mata Kuliah</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan Matkul" name="mata_kuliah" value="<?php echo $row['mata_kuliah']; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ruangan" class="col-form-label">Ruangan</label>
                                                        <input type="text" class="form-control" placeholder="Masukkan ruangan" name="ruangan" value="<?php echo $row['ruangan']; ?>" id="ruangan">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubahmatkul" class="btn btn-primary" value="ubah">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="example-modal">
                                    <div id="deletematkul<?php echo $row['id_jadwal']; ?>" class="modal fade" role="dialog" style="display:none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 align="center">Apakah anda yakin ingin menghapus Mata Kuliah <strong><?php echo $row['mata_kuliah']; ?><span class="grt"></span></strong> Untuk Kelas <strong><?php echo $row['kelas']; ?><span class="grt"></span></strong> ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="nodelete" type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="proses.php?hapusmatkul=<?php echo $row['id_jadwal']; ?>" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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