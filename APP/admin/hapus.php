<?php 
include 'config.php';
include 'header.php';
$id=$_GET['id'];
mysqli_query($con,"delete from barang where id='$id'");
if(mysqli_affected_rows($con)>0){
    echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Data Berhasil Dihapus',
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
            document.location.href='barang.php';
        }
      })
    </script>";
}
?>