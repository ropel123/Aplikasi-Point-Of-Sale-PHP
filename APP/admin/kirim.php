<?php include 'header.php';
require 'fungsi.php';
date_default_timezone_set('Asia/Jakarta');
$sekarang = date('Y-m-d H:i:s');
if(isset($_POST['reset'])){
	mysqli_query($con,"DELETE FROM tmp_data");
}
if(isset($_POST['cari'])){
	$cari =  $_POST['por'];
	$jumlah =$_POST['jml'];
	$nama1 = $_GET['nama'];
	$pp=mysqli_query($con,"SELECT * FROM tmp_data WHERE nama='$nama1'");
	if(mysqli_affected_rows($con)> 0){
$ll = mysqli_fetch_assoc($pp);
$jmlbr = $jumlah + $ll['banyak'];
mysqli_query($con,"UPDATE tmp_data SET banyak ='$jmlbr' WHERE nama ='$nama1'");
	}else{
        $bm=mysqli_query($con,"SELECT * FROM brg_manajemen_pst WHERE nama='$nama1'");
        $pit =mysqli_fetch_assoc($bm);
        $harga = $pit['modal'];
	mysqli_query($con,"INSERT INTO tmp_data VALUES('','$nama1','$harga','$jumlah','-')");
	}
}
if(isset($_POST['kirim'])){
$ff =mysqli_query($con,"SELECT * FROM tmp_data");
while($gg= mysqli_fetch_assoc($ff)){
    $nama = $gg['nama'];
    $jumlah = $gg['banyak'];
    $hrgk= $gg['harga'];
$ki=mysqli_query($con ,"SELECT * FROM brg_manajemen_pst WHERE nama='$nama' ");
if(mysqli_affected_rows($con)>0){
$pth = mysqli_fetch_assoc($ki);
$jmlak= $pth['jumlah']-$jumlah;
mysqli_query($con,"UPDATE brg_manajemen_pst SET jumlah ='$jmlak' WHERE nama='$nama'");
}
$ti=mysqli_query($con,"SELECT * FROM barang_toko WHERE nama='$nama'");
if(mysqli_affected_rows($con) > 0){
$hu =mysqli_fetch_assoc($ti);
$jjg = $jumlah + $hu['jumlah'];
mysqli_query($con,"UPDATE barang_toko SET jumlah='$jjg' WHERE nama='$nama'");
}else{
$hrgkb=$hrgk + 2000;
mysqli_query($con,"INSERT INTO barang_toko VALUES ('','$nama','$hrgkb',$jumlah)");
}
}
mysqli_query($con,"DELETE FROM tmp_data");
if(mysqli_affected_rows($con)> 0){
    echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Berhasil Mengirim Barang Ke Gudang Toko',
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
            document.location.href='kirim.php';
        }
      })
    </script>";
    exit;
}
}
?>
<form action="" method="post">
<div class="container">
	<div class="form-group">
	<div class="col-md-2"><p style="margin-top: 10px; font-weight:bold; margin-left:45px;" >Cari Barang</p></div>
	<div class="input-group col-md-3 col-md-offset-2">
		<span class="input-group-addon" id="basic-addon1"><a data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-search"></span></a></span>
		<?php  if(isset($_GET['nama'])){ 
			$nama = $_GET['nama'];
			$pol = mysqli_query($con,"SELECT * FROM brg_manajemen_pst WHERE nama='$nama'");
			$por = mysqli_fetch_array($pol);
			?>
			
			<input type="text" class="form-control" id="brg" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="por" value="<?= $_GET['nama'];?>">
<?php }else{ ?>

	<input type="text" class="form-control" id="brg" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari" value="">
<?php }?>	
	</div>
	</div>
	<div class="form-group">
	<div class="col-md-2"><p style="margin-top: 10px; font-weight:bold; margin-left:45px;" >Banyak</p></div>
	<div class="input-group col-md-1 col-md-offset-2">
<input type="number" name="jml" min="1" max="<?= $por['jumlah']; ?>" class="form-control">
	</div>
	</div>
	<div class="row">
		<div class="col-md-1">
<button name="cari" class="btn btn-primary hps"> Tambah</button>
		</div>
		<div class="col-md-offset-1 ">
        <button name="kirim" class="btn btn-primary hps"> Kirim</button>
		<button name="reset" class="btn btn-primary hps"> Reset</button>
		</div>
   
	</div>
</div>
</form>
<table class="table table-hover" style="margin-top:30px;">
	<tr>
		<th class="col-md-1" >No</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-3">Modal</th>
		<th class="col-md-3">Banyak</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
	</tr>
 <?php if(count(ambil3()) > 0 ){
	 $pl = mysqli_query($con,"SELECT * FROM tmp_data");
	 $i=1;
    while($pok = mysqli_fetch_assoc($pl)){
	 ?>
		<tr>
			<td><?= $i ?></td>
			<td><span id="nama" ><?= $pok['nama']; ?></span></td>
			<td><span id="harga">Rp.<?php echo number_format($pok['harga']); ?>,-</span></td>
			<td><?php echo $pok['banyak']; ?></td>
		</tr>
 <?php $i++;  } } else{ ?>
	<tr class="odd">
	<td valign="top" colspan="8" class="dataTables_empty">Belum Ada Data</td>
	</tr>

<?php } ?>
	</table>
<!-- Pilihan -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Pilih Barang
				</div>
				<div class="modal-body">
				<table class="table table-hover">
	<tr>
		<th class="col-md-1" >No</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-3">Modal</th>
		<th class="col-md-3">Stok</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-2">Opsi</th>
<?php		
$brg = mysqli_query($con,"SELECT * FROM brg_manajemen_pst where jumlah >=1");
$no=1;
	while($b=mysqli_fetch_array($brg)){
		?>
		<tr>
			<td><?php echo $no++ ;?></td>
			<td><span id="nama" ><?php echo $b['nama']; ?></span></td>
			<td><span id="harga"><?php echo number_format($b['modal']); ?>,-</span></td>
			<td><?php echo $b['jumlah']; ?></td>
			<td><a href="kirim.php?nama=<?=$b['nama'] ?>" class="btn btn-primary hps"  ><span class ="glyphicon glyphicon-plus-sign" style="margin-right:5px;"> </span>Pilih</a></td>
		</tr>
	<?php } ?>
	</table>
	<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
 <!-- end -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	<script>
jumlah = document.getElementById('uang');
total = document.getElementById('total');
total1 = total.value;
jumlah.addEventListener('keyup',function(){
jumlah1 = jumlah.value;
pol = parseInt(jumlah1) - parseInt(total1);
document.getElementById('kembali').value= pol;
})

</script>

<?php include 'footer.php' ?> 