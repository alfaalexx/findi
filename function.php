<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_findi');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword)
{
    $query = "SELECT * FROM jadwalkuliah 
                WHERE
                jam LIKE '%$keyword%' OR 
                mata_kuliah LIKE '%$keyword%' OR 
                hari LIKE '%$keyword%' OR 
                ruangan LIKE '%$keyword%' OR 
                dosen LIKE '%$keyword%'
                ";
    return query($query);
}


function caridosen($keyword)
{
    $query = "SELECT * FROM jadwalkuliah 
                WHERE
                jam LIKE '%$keyword%' OR 
                mata_kuliah LIKE '%$keyword%' OR 
                hari LIKE '%$keyword%' OR 
                ruangan LIKE '%$keyword%' OR 
                dosen LIKE '%$keyword%'
                ";
    return query($query);
}
