<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item border-bottom" id="tombolprofil">
                <div class="dropdown nav-link">
                    <?php if ($_SESSION['login'] == true) : ?>
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none" data-bs-toggle="collapse" data-bs-target="#btnlogout" aria-expanded="false">
                            <img src="img/admin3.png" alt="" width="50" height="50" class="rounded-circle me-2 border" />
                            <strong><?php echo $_SESSION['username']; ?></strong>
                        </a>
                        <div class="collapse" id="btnlogout">
                            <br>
                            <a type="button" class="btn btn-outline-danger d-grid" href="logout.php" data-bs-target="#modallogoutbtn" data-bs-toggle="modal">Logout</a>
                        </div>
                    <?php else : ?>
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false">
                            <img src="img/userprofil2.png" alt="" width="50" height="50" class="rounded-circle me-2 border" />
                            <strong>Login as Admin</strong>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <br>
                            <a type="button" class="btn btn-outline-success d-grid" href="login.php">Login</a>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
            <li class="nav-item" id="sidebarmenu">
                <a class="nav-link <?php if ($page == 'carijadwal') {
                                        echo 'active';
                                    } ?>" href="index.php">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cari Jadwal
                </a>
            </li>
            <?php if ($_SESSION['login'] == true) : ?>
                <li class="nav-item" id="sidebarmenu">
                    <a class="nav-link <?php if ($page == 'mengelolajadwal') {
                                            echo 'active';
                                        } ?>" href="mengelolajadwal.php">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Mengelola Jadwal
                    </a>
                </li>

                <li class="nav-item" id="sidebarmenu">
                    <a class="nav-link <?php if ($page == 'daftarkelas') {
                                            echo 'active';
                                        } ?>" href="daftarkelas.php">
                        <i class="fa-regular fa-calendar-days"></i>
                        List Kelas
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item" id="sidebarmenu">
                <a class="nav-link <?php if ($page == 'infodosen') {
                                        echo 'active';
                                    } ?>" href="kontakdosen.php">
                    <i class="fa-regular fa-address-card"></i>
                    Info Dosen
                </a>
            </li>
            <li class="nav-item" id="sidebarmenu" id="tomboltentangfindi">
                <a class="nav-link <?php if ($page == 'tentangfindi') {
                                        echo 'active';
                                    } ?>" href="tentangfindi.php">
                    <i class="fa-solid fa-circle-info"></i>
                    Tentang Findi
                </a>
            </li>
        </ul>
    </div>
</nav>