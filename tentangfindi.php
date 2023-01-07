<?php
if (!isset($_SESSION['login'])) {
    session_start();
}
error_reporting(0);
$page = 'tentangfindi';


include_once 'template/header.php';
include_once 'template/navbar.php';
?>
<div class="row">
    <!-- header ada di folder template/header.php -->
    <!-- navbar ada di folder template/navbar.php -->

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div> -->
            </div>
        </div>

        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

        <div class="row featurette" id="aboutfindi">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Jadwal Web<br><span class="text-muted">Tentang Findi</span></h2>
                <br>
                <p class="lead">Findi adalah aplikasi untuk membantu mahasiswa atau dosen menemukan jadwal belajar atau mengajarnya.</p>
            </div>
            <div class="col-md-5">
                <img src="img/logo_findi.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></img>

            </div>
        </div>

        <hr class="featurette-divider">


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