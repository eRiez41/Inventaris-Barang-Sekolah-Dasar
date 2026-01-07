<?php 
include '../config/database.php';

$id       = $_POST['id'];
$nama     = $_POST['nama'];
$merk     = $_POST['merk'];
$kategori = $_POST['kategori'];
$lokasi   = $_POST['lokasi'];
$stok     = $_POST['stok'];
$kondisi  = $_POST['kondisi']; // Ini yang penting

// Cek ganti foto atau gak
$filename = $_FILES['foto']['name'];

if($filename != "") {
    // Kalau upload foto baru
    $rand = rand();
    $allowed = array('png','jpg','jpeg');
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(in_array($ext, $allowed)){
        $foto_baru = $rand.'_'.$filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/'.$foto_baru);
        
        // Update dengan foto baru
        $query = "UPDATE barang SET nama_barang='$nama', merk='$merk', id_kategori='$kategori', lokasi='$lokasi', stok='$stok', kondisi='$kondisi', gambar='$foto_baru' WHERE id_barang='$id'";
    }
} else {
    // Kalau gak ganti foto (Update data text aja)
    $query = "UPDATE barang SET nama_barang='$nama', merk='$merk', id_kategori='$kategori', lokasi='$lokasi', stok='$stok', kondisi='$kondisi' WHERE id_barang='$id'";
}

$result = mysqli_query($conn, $query);

if($result){
    header("location:../staf/data_barang.php?pesan=update_sukses");
} else {
    echo "Gagal Update: " . mysqli_error($conn);
}
?>