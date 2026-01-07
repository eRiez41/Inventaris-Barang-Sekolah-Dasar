<?php
include '../config/database.php';

// Logic Filter
$title = "Laporan Aset Sekolah";
$query_string = "SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori";

if(isset($_GET['filter']) && $_GET['filter'] == 'rusak'){
    $query_string .= " WHERE kondisi = 'rusak'";
    $title = "Laporan Barang Rusak";
} elseif(isset($_GET['lokasi'])){
    $lokasi = $_GET['lokasi'];
    $query_string .= " WHERE lokasi = '$lokasi'";
    $title = "Kartu Inventaris Ruangan (KIR): " . $lokasi;
}

$query_string .= " ORDER BY lokasi ASC";
$result = mysqli_query($conn, $query_string);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak - <?php echo $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0; }
        
        /* Table Data */
        .table-data { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table-data th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        
        /* Table Tanda Tangan (Layout khusus ttd) */
        .table-ttd { width: 100%; margin-top: 50px; border-collapse: collapse; border: none; }
        .table-ttd td { border: none; text-align: center; padding: 10px; }
        
        /* Hapus tombol saat print */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak Laporan</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

    <div class="header">
        <h1>SDN EMPANGSARI</h1>
        <p>Alamat: Jl. Contoh No. 123, Desa Empangsari</p> <p>Email: sdn.empangsari@contoh.com</p>
        <br>
        <h2 style="margin:0; font-size: 16px; text-decoration: underline;"><?php echo $title; ?></h2>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Barang</th>
                <th width="25%">Nama Barang</th>
                <th width="15%">Merk</th>
                <th width="15%">Kategori</th>
                <th width="15%">Lokasi</th>
                <th width="5%">Stok</th>
                <th width="5%">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if(mysqli_num_rows($result) > 0){
                while($d = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $no++; ?></td>
                <td><?php echo $d['kode_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo $d['merk']; ?></td>
                <td><?php echo $d['nama_kategori']; ?></td>
                <td><?php echo $d['lokasi']; ?></td>
                <td style="text-align:center;"><?php echo $d['stok']; ?></td>
                <td style="text-align:center; text-transform:capitalize;"><?php echo $d['kondisi']; ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center; padding: 20px;'>Tidak ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <table class="table-ttd">
        <tr>
            <td width="50%">
                Mengetahui,<br>
                Kepala Sekolah SDN Empangsari
                <br><br><br><br><br>
                <strong>( ............................................ )</strong><br>
                NIP. ............................................
            </td>
            <td width="50%">
                Tasikmalaya, <?php echo date('d F Y'); ?><br> Staf Tata Usaha
                <br><br><br><br><br>
                <strong>( ............................................ )</strong><br>
                NIP. ............................................
            </td>
        </tr>
    </table>

</body>
</html>