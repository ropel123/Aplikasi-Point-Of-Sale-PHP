<?php
require 'header.php';
include 'config.php';
$tgl = $_POST['tgl'];
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$dt = mysqli_query($con, "select * from barang where nama='$nama'");
$data = mysqli_fetch_array($dt);
$harga = $data['harga'];
$modal = $data['modal'];
$laba = $harga - $modal;
$labaa = $laba * $jumlah;
$total_harga = $harga * $jumlah;
mysqli_query($con, "insert into barang_laku values('','$tgl','$nama','$jumlah','$harga','$total_harga','$labaa')") or die(mysqli_error($con));
if (mysqli_affected_rows($con) > 0) {
  echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Data Penjualan Berhasil DiTambahkan',
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
            document.location.href='barang_laku.php';
        }
      })
    </script>";
} else {
  echo "<script> alert('Data Tidak Berhasil Di Update'); </script>";
}
