<?php 
include 'config.php';
require 'header.php';
$id=$_GET['id'];
$jumlah=$_GET['jumlah'];
$nama=$_GET['nama'];

$a=mysqli_query($con,"select jumlah from barang where nama='$nama'");
$b=mysqli_fetch_array($a);
$kembalikan=$b['jumlah']+$jumlah;
$c=mysqli_query($con,"update barang set jumlah='$kembalikan' where nama='$nama'");
mysqli_query($con,"delete from barang_laku where id='$id'");
if(mysqli_affected_rows($con)>0){

    echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Data Penjualan Berhasil Dihapus',
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

}

 ?>