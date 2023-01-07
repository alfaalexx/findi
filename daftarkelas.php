<?php
if (!isset($_SESSION['login'])) {
    session_start();
}
error_reporting(0);
$page = 'daftarkelas';

// require_once 'config.php';
require_once 'koneksi.php';

// if (isset($_POST['tombolcaridosen'])) {
//     $caridosen = $_POST['caridosen'];
//     $_SESSION['caridosen'] = $caridosen;
// } else {
//     $caridosen = $_SESSION['caridosen'];
// }

$result = mysqli_query($conn, "SELECT * FROM kelas");

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
            <h1 class="h2" id="headercarijadwal">LIST KELAS JURUSAN IF</h1>
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
                <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahlistkelas"><i class="fas fa-plus-circle mr-2"></i> TAMBAH KELAS</a>
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
                                <th scope="col">Kelas</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Jurusan</th>

                                <?php if ($_SESSION['login'] == true) : ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody class="table table-group-divider">
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td hidden><?php echo $row['id_kelas']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['prodi']; ?></td>
                                    <td><?php echo $row['jurusan']; ?></td>

                                    <?php if ($_SESSION['login'] == true) : ?>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#updatekelas<?php echo $row['id_kelas']; ?>"><i class="fas fa-edit bg-success p-2 text-white rounded"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#deletekelas<?php echo $row['id_kelas']; ?>"><i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i></a>
                                        </td>
                                    <?php endif; ?>
                                </tr>


                                <!-- Tambah Kelas modal -->
                                <div class="modal fade" id="tambahlistkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses.php" role="form">
                                                    <div class="mb-3">
                                                        <label for="kelas" class="col-form-label">Kelas</label>
                                                        <input type="text" class="form-control" placeholder="contoh : RKS 5 PAGI, AN 1A PAGI" name="kelas" value="" id="kelas" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prodi" class="col-form-label">Prodi</label>
                                                        <input type="text" class="form-control" placeholder="contoh : D4 - ANIMASI" name="prodi" value="" id="prodi" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jurusan" class="col-form-label">Jurusan</label>
                                                        <input type="text" class="form-control" placeholder="contoh : Teknik Informatika" name="jurusan" value="" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambahlistkelas" class="btn btn-primary" value="tambah">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit kelas modal -->
                                <div class="modal fade" id="updatekelas<?php echo $row['id_kelas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Kelas</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses.php" role="form">
                                                    <input type="text" class="form-control" name="id_kelas" id="id_kelas" value="<?php echo $row['id_kelas']; ?>" hidden>
                                                    <div class="mb-3">
                                                        <label for="kelas" class="col-form-label">Kelas</label>
                                                        <input type="text" class="form-control" placeholder="contoh : RKS 5 PAGI, AN 1A PAGI" name="kelas" value="<?php echo $row['nama']; ?>" id="kelas">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prodi" class="col-form-label">Prodi</label>
                                                        <input type="text" class="form-control" placeholder="contoh : D4 - ANIMASI" name="prodi" value="<?php echo $row['prodi']; ?>" id="prodi" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jurusan" class="col-form-label">Jurusan</label>
                                                        <input type="text" class="form-control" placeholder="contoh : Teknik Informatika" name="jurusan" value="<?php echo $row['jurusan']; ?>" id="jurusan">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubahlistkelas" class="btn btn-primary" value="ubah">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="example-modal">
                                    <div id="deletekelas<?php echo $row['id_kelas']; ?>" class="modal fade" role="dialog" style="display:none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 align="center">Apakah anda yakin ingin menghapus kelas <strong><?php echo $row['nama']; ?><span class="grt"></span></strong> ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="nodelete" type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="proses.php?hapuslistkelas=<?php echo $row['id_kelas']; ?>" class="btn btn-danger">Delete</a>
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