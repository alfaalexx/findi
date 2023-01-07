<?php
require 'koneksi.php';
error_reporting(0);
$page = 'infodosen';

if (!isset($_SESSION['login'])) {
    session_start();
}


if (isset($_POST['tombolsearch'])) {
    $search = $_POST['search'];
    $_SESSION['search'] = $search;
} else {
    $search = $_SESSION['search'];
}

$result = mysqli_query($conn, "SELECT * FROM dosen");

// Konfigurasi Pagination
$jumlahDataPerHalaman = 6;
$jumlahData = mysqli_num_rows($result);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$jumlahLink = 3;
if ($halamanAktif > $jumlahLink) {
    $start_number = $halamanAktif - $jumlahLink;
} else {
    $start_number = 1;
}
if ($halamanAktif < ($jumlahHalaman - $jumlahLink)) {
    $end_number = $halamanAktif + $jumlahLink;
} else {
    $end_number = $jumlahHalaman;
}
$result2 = mysqli_query($conn, "SELECT * FROM dosen WHERE no_induk LIKE '%$search%' OR kode_dosen LIKE '%$search%' OR nama LIKE '%$search%' OR status LIKE '%$search%' OR prodi LIKE '%$search%' OR pendidikan_terakhir LIKE '%$search%' OR email LIKE '%$search%' LIMIT $awalData, $jumlahDataPerHalaman");


include_once 'template/header.php';
include_once 'template/navbar.php';
?>

<div class="row">
    <!-- header ada di folder template/header.php -->
    <!-- navbar ada di folder template/navbar.php -->

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">INFO DOSEN</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div> -->
            </div>
        </div>
        <!-- 
        <!-- Tombol Search -->
        <div class="row">
            <form action="kontakdosen.php" method="POST">
                <center>
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="input-group mb-3">
                            <input name="search" type="text" class="keywordkelas form-control" placeholder="Cari Dosen disini" aria-label="Cari Dosen disini" value="" autofocus autocomplete="off">
                            <button class="tombolkelas btn btn-primary" type="submit" name="tombolsearch"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </center>
            </form>
        </div>

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
                <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdosen"><i class="fas fa-plus-circle mr-2"></i> TAMBAH DOSEN</a>
            <?php endif; ?>
        </div>

        <div class="container">
            <div class="row gy-5 justify-content-center">
                <?php
                $rows[] = '';
                while ($row = mysqli_fetch_assoc($result2)) {
                    $rows = $row
                ?>
                    <div class="col-sm-6 pt-3 pb-2 mb-3">
                        <div class="card shadow">
                            <?php if ($_SESSION['login'] == true) : ?>
                                <div class="card-header row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editdosen<?php echo $row['id_dosen'] ?>"><i class="fa-solid fa-user-pen"></i> Edit Profil</a>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletedosen<?php echo $row['id_dosen'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="align-middle"><a href="#" data-bs-toggle="modal" data-bs-target="#editprofildosen<?php echo $row['id_dosen'] ?>"><img src="profil_dosen/<?php echo $row['foto'] ?>" alt="" width="100" height="100" class="rounded-circle border shadow" class="img-thumbnail"></a></th>
                                                <th scope="col" colspan="2" class="align-middle fs-5" data-bs-toggle="collapse"><a href="" data-bs-toggle="collapse" data-bs-target="#infodetaildosen<?php echo $row['id_dosen'] ?>"><?php echo $row['nama'] ?></a></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="collapse" id="infodetaildosen<?php echo $row['id_dosen'] ?>">
                                    <div class="">
                                        <p><strong>NIDN/NIK : </strong><?php echo $row['no_induk'] ?></p>
                                        <p><strong>Kode Dosen : </strong><?php echo $row['kode_dosen'] ?></p>
                                        <p><strong>Program Studi : </strong><?php echo $row['prodi'] ?></p>
                                        <p><strong>Pendidikan Terakhir : </strong><?php echo $row['pendidikan_terakhir'] ?></p>
                                        <p><strong>Email : </strong><?php echo $row['email'] ?></p>
                                    </div>
                                    <hr>
                                </div>
                                <div>
                                    <center>
                                        <p class="fs-6"><strong><?php echo $row['status'] ?></strong></p>
                                    </center>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Tambah Dosen modal -->
                    <div class="modal fade" id="tambahdosen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dosen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses.php" method="POST" role="form" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="nama" class="col-form-label">Nama Dosen</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama dosen" name="nama" value="" id="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nidn" class="col-form-label">NIDN/NIK</label>
                                            <input type="text" class="form-control" name="nidn" value="" id="nidn" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_dosen" class="col-form-label">Kode Dosen</label>
                                            <input type="text" class="form-control" placeholder="contoh : AD" name="kode_dosen" value="" id="kode_dosen" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="col-form-label">Status</label>
                                            <input type="text" class="form-control" placeholder="contoh : Dosen" name="status" value="" id="status" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodi" class="col-form-label">Program Studi</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Program Studi" name="prodi" value="" id="prodi" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pendidikan" class="col-form-label">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control" name="pendidikan" value="" id="pendidikan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="col-form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="" id="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="col-form-label">Foto Dosen</label>
                                            <input type="file" class="form-control" name="foto" id="foto" accept="images/*">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="tambahdosen" class="btn btn-primary" value="tambah">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Dosen modal -->
                    <div class="modal fade" id="editdosen<?php echo $row['id_dosen'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Dosen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses.php" method="POST" role="form" enctype="multipart/form-data">
                                        <input type="text" class="form-control" name="id_dosen" id="id_dosen=" value="<?php echo $row['id_dosen']; ?>" hidden>
                                        <div class="mb-3">
                                            <label for="nama" class="col-form-label">Nama Dosen</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama dosen" name="nama" value="<?php echo $row['nama'] ?>" id="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nidn" class="col-form-label">NIDN/NIK</label>
                                            <input type="text" class="form-control" name="nidn" value="<?php echo $row['no_induk'] ?>" id="nidn" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_dosen" class="col-form-label">Kode Dosen</label>
                                            <input type="text" class="form-control" placeholder="contoh : AD" name="kode_dosen" value="<?php echo $row['kode_dosen'] ?>" id="kode_dosen" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="col-form-label">Status</label>
                                            <input type="text" class="form-control" placeholder="contoh : Dosen" name="status" value="<?php echo $row['status'] ?>" id="status" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodi" class="col-form-label">Program Studi</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Program Studi" name="prodi" value="<?php echo $row['prodi'] ?>" id="prodi" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pendidikan" class="col-form-label">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control" name="pendidikan" value="<?php echo $row['pendidikan_terakhir'] ?>" id="pendidikan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="col-form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" id="email" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="updatedatadosen" class="btn btn-primary" value="update">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Delete Modal -->
                    <div class="modal fade" id="deletedosen<?php echo $row['id_dosen'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                                </div>
                                <div class="modal-body">
                                    <h6 align="center">Apakah anda yakin ingin menghapus Dosen <strong><?php echo $row['nama']; ?><span class="grt"></span></strong> ?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button id="nodelete" type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Cancel</button>
                                    <a href="proses.php?hapusdosen=<?php echo $row['id_dosen']; ?>" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Foto Profil modal -->
                    <div class="modal fade" id="editprofildosen<?php echo $row['id_dosen'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto dosen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="proses.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input type="text" name="id_dosen" id="id_dosen" class="form-control" value="<?php echo $row['id_dosen']; ?>" hidden>
                                        </div>
                                        <div class="mb-3">
                                            <center>
                                                <img src="profil_dosen/<?php echo $row['foto']; ?>" alt="" width="200" height="200" class="rounded-circle me-2 border" />
                                            </center>
                                        </div>
                                        <?php if ($_SESSION['login'] == true) : ?>
                                            <div class="mb-3">
                                                <label for="foto" class="col-form-label">Edit foto dosen</label>
                                                <input type="file" class="form-control" name="foto" id="foto" accept="images/*" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" name="updateFotodosen" class="btn btn-primary" value="update">Simpan</button>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php } ?>

                <!-- Navigasi Pagination -->
                <div aria-label="..." class="container">
                    <ul class="pagination justify-content-end">
                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?php echo $halamanAktif - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = $start_number; $i <= $end_number; $i++) { ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endif; ?>
                        <?php } ?>
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?php echo $halamanAktif + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

</div>
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
                Apakah Anda yakin ingin Logout dari Website ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="logout.php">Yakin :)</a>
            </div>
        </div>
    </div>
</div>
</main>
</div>
</div>
<?php include_once 'template/footer.php'; ?>