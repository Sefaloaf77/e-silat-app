<?php
// Simpan nilai ke database
if (isset($_POST['nilai']) && isset($_POST['nilaiB'])) {
    $nilai_a = $_POST['nilai'];
    $nilai_b = $_POST['nilaiB'];
    $juri_id = 1;


    $nilai_a = number_format($nilai_a, 2);
    $nilai_b = number_format($nilai_b, 2);

    $total_nilai = $nilai_a + $nilai_b;

    // Lakukan koneksi ke database
    $host = 'localhost';
    $username = 'root'; // Ganti dengan username database Anda
    $password = ''; // Ganti dengan password database Anda
    $database = 'e-silat'; // Ganti dengan nama database Anda

    $koneksi = new mysqli($host, $username, $password, $database);

    // Cek koneksi berhasil atau tidak
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query untuk menyimpan nilai ke dalam tabel
    $query = "INSERT INTO seni (juri_id, nilai_a,nilai_b,total_nilai) VALUES ('$juri_id','$nilai_a','$nilai_b','$total_nilai')";

    if ($koneksi->query($query) === TRUE) {
        echo "Nilai berhasil disimpan ke database.";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>