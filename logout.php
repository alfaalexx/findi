<?php
session_start();
// menghapus semua varible sesi
session_unset();
// menghancurkan sesi
session_destroy();

header("Location: index.php");
