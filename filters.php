<?php
include("koneksi.php");
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $query = "SELECT * FROM jadwalkuliah WHERE hari = '$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
}
?>
<table class="table table-hover table-sm align-middle">
    <?php
    if ($count) {
    ?>
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col" hidden>id</th>
                <th scope="col">Hari</th>
                <th scope="col">Waktu</th>
                <th scope="col">Kode Matkul</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Dosen</th>
                <?php if ($_SESSION['login'] == true or $_SESSION['role'] == 'Admin') : ?>
                    <th scope="col" colspan="2">Aksi</th>
                <?php endif; ?>
            </tr>
        <?php
    } else {
        echo "Sorry! Data tidak ditemukan";
    }
        ?>
        </thead>

        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td hidden><?php echo $data['id_jadwal']; ?></td>
                    <td><?php echo $data['hari']; ?></td>
                    <td><?php echo $data['jam']; ?></td>
                    <td><?php echo $data['kode_matkul']; ?></td>
                    <td><?php echo $data['mata_kuliah']; ?></td>
                    <td><?php echo $data['ruangan']; ?></td>
                    <td><?php echo $data['dosen']; ?></td>
                    <?php if ($_SESSION['login'] == true or $_SESSION['role'] == 'Admin') : ?>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#updatematkul<?php echo $data['id_jadwal']; ?>"><i class="fas fa-edit bg-success p-2 text-white rounded"></i></a>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deletematkul<?php echo $data['id_jadwal']; ?>"><i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php } ?>

        </tbody>
</table>