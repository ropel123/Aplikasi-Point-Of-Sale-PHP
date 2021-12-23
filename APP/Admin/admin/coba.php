<?php include 'header.php';

if(isset($_POST['cari'])){
	$cari =  $_POST['por'];
	$jumlah =$_POST['jml'];
	$pp = mysqli_query($con,"SELECT * FROM barang_toko where nama='$cari'");
	$b= mysqli_fetch_array($pp);
	$nama = $b['nama'];
	$harga = $b['harga'];
	$total = $harga * $jumlah;

}
?>
<form action="" method="post">
<div class="container">
	<div class="form-group">
	<div class="col-md-2"><p style="margin-top: 10px; font-weight:bold; margin-left:45px;" >Cari Barang</p></div>
	<div class="input-group col-md-3 col-md-offset-2">
		<span class="input-group-addon" id="basic-addon1"><a data-toggle="modal" data-target="#bayar1" ><span class="glyphicon glyphicon-search"></span></a></span>
		<?php  if(isset($_GET['nama'])){ 
			$nama = $_GET['nama'];
			$pol = mysqli_query($con,"SELECT * FROM barang_toko WHERE nama='$nama'");
			$por = mysqli_fetch_array($pol);
			?>
			
			<input type="text" class="form-control" id="brg" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="por" value="<?= $_GET['nama'];?>">
<?php }else{ ?>

	<input type="text" class="form-control" id="brg" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari" value="">
<?php }?>	
	</div>
	</div>
	<div class="form-group">
	<div class="col-md-2"><p style="margin-top: 10px; font-weight:bold; margin-left:45px;" >Qty</p></div>
	<div class="input-group col-md-1 col-md-offset-2">
<input type="number" name="jml" min="1" max="<?= $por['jumlah'];?>" class="form-control">
	</div>
	</div>
	<div class="row">
		<div class="col-md-1">
<button name="cari" class="btn btn-primary hps"> Tambah</button>
		</div>
		<div class="col-md-offset-1 ">
<a href="#bayar" class="btn btn-primary hps" data-toggle="modal"  > Bayar</a>
		</div>
   
	</div>
</div>
</form>
<!-- modal Pilihan -->
<div id="bayar" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Transaksi Penjualan
				</div>
				<div class="modal-body">
					<form action="" method="post">
				<table class="table table-hover">
	<tr>
		<th class="col-md-1" >No</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-3">Harga</th>
		<th class="col-md-3">Stok</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-2">Opsi</th>
<?php		
$brg = mysqli_query($con,"SELECT * FROM barang_toko where jumlah >=1");
$no=1;
	while($b=mysqli_fetch_array($brg)){
		?>
		<tr>
			<td><?php echo $no++ ;?></td>
			<td><span id="nama" ><?php echo $b['nama']; ?></span></td>
			<td><span id="harga"><?php echo number_format($b['harga']); ?>,-</span></td>
			<td><?php echo $b['jumlah']; ?></td>
			<td><a href="trx_penjualan.php?nama=<?=$b['nama'] ?>" class="btn btn-primary hps"  ><span class ="glyphicon glyphicon-plus-sign" style="margin-right:5px;"> </span>Pilih</a></td>
		</tr>
	<?php } ?>
	</table>
			</div>
		</div>
	</div>
	<div id="bayar1" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Transaksi Penjualan
				</div>
				<div class="modal-body">
					<form action="" method="post">
				<table class="table table-hover">
	<tr>
		<th class="col-md-1" >No</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-3">Harga</th>
		<th class="col-md-3">Stok</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-2">Opsi</th>
<?php		
$brg = mysqli_query($con,"SELECT * FROM barang_toko where jumlah >=1");
$no=1;
	while($b=mysqli_fetch_array($brg)){
		?>
		<tr>
			<td><?php echo $no++ ;?></td>
			<td><span id="nama" ><?php echo $b['nama']; ?></span></td>
			<td><span id="harga"><?php echo number_format($b['harga']); ?>,-</span></td>
			<td><?php echo $b['jumlah']; ?></td>
			<td><a href="trx_penjualan.php?nama=<?=$b['nama'] ?>" class="btn btn-primary hps"  ><span class ="glyphicon glyphicon-plus-sign" style="margin-right:5px;"> </span>Pilih</a></td>
		</tr>
	<?php } ?>
	</table>
			</div>
		</div>
	</div>
	
	
	
<!-- end -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>

<?php include 'footer.php' ?>