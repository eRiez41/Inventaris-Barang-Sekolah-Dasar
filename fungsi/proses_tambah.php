<?php 
include '../config/database.php';

$kode     = $_POST['kode'];
$nama     = $_POST['nama'];
$merk     = $_POST['merk'];
$kategori = $_POST['kategori'];
$lokasi   = $_POST['lokasi'];
$stok     = $_POST['stok'];
$sumber   = $_POST['sumber'];

// Handle Upload Foto
$rand = rand();
$filename = $_FILES['foto']['name'];

if($filename != "") {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed = array('png','jpg','jpeg');
    
    if(in_array($ext, $allowed)){
        // Rename file biar unik
        $nama_file = $rand.'_'.$filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/'.$nama_file);
        $gambar = $nama_file;
    } else {
        header("location:../staf/tambah_barang.php?pesan=gagal_ekstensi");
        exit();
    }
} else {
    // Kalau gak upload foto
    $gambar = "no-image.jpg";
}

// Insert Database
$query = "INSERT INTO barang VALUES (NULL, '$kode', '$nama', '$merk', '$kategori', '$lokasi', '$stok', '$sumber', 'baik', '$gambar', CURRENT_TIMESTAMP)";
$result = mysqli_query($conn, $query);

if($result){
    header("location:../staf/data_barang.php?pesan=sukses");
} else {
    header("location:../staf/tambah_barang.php?pesan=gagal");
}
?>