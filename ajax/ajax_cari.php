<?php
// if (session_status() == PHP_SESSION_ACTIVE) {
//     session_start();
// }
if (!isset($_SESSION['login'])) {
    session_start();
}
require '../function.php';

$jadwalkuliah = caridosen($_GET['keyword']);

?>
<table id="example" class="table tables-sm align-middle table-hover">
    <thead>
        <tr>
            <th scope="col" hidden>id</th>
            <th scope="col">Dosen</th>
            <th scope="col">Hari</th>
            <th scope="col">Waktu</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Ruangan</th>

            <?php if ($_SESSION['login'] == true or $_SESSION['role'] == 'Admin') : ?>
                <th scope="col" colspan="2">Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody class="table table-group-divider">
        <?php foreach ($jadwalkuliah as $row) : ?>
            <tr>
                <td hidden><?php echo $row['id_jadwal']; ?></td>
                <td><?php echo $row['dosen']; ?></td>
                <td><?php echo $row['hari']; ?></td>
                <td><?php echo $row['jam']; ?></td>
                <td><?php echo $row['mata_kuliah']; ?></td>
                <td><?php echo $row['ruangan']; ?></td>

                <?php if ($_SESSION['login'] == true or $_SESSION['role'] == 'Admin') : ?>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#updatematkul<?php echo $row['id_jadwal']; ?>"><i class="fas fa-edit bg-success p-2 text-white rounded"></i></a>
                    </td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deletematkul<?php echo $row['id_jadwal']; ?>"><i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i></a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>