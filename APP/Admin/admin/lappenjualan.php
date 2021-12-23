<?php include 'header.php';
require 'fungsi.php';

$per_hal = 10;
$jum = count(ambil2());
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;


?>
<h3><span class="glyphicon glyphicon-stats" style="margin-left:10px; margin-top:10px; margin-bottom:10px;"></span> Laporan Penjualan</h3>
<table class="table">
	<tr>
		<th class="col-md-1">Id</th>
		<th class="col-md-3">Tanggal</th>
		<th class="col-md-2">Nota</th>
		<th class="col-md-2">Jumlah Uang</th>
		<th class="col-md-2">Total Transaksi</th>
		<th class="col-md-2">Kembali</th>
	</tr>
	<?php
	$brg = mysqli_query($con, "SELECT * from trx_toko order by id desc limit $start, $per_hal ");
	$no = 1;
	while ($b = mysqli_fetch_array($brg)) {

	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['jumlah_uang']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total_transaksi']) ?>,-</td>
			<td><?php echo "Rp." . number_format($b['kembali']) . ",-" ?></td>
		<?php } ?>
</table>
<ul class="pagination">
	<?php
	for ($x = 1; $x <= $halaman; $x++) {
	?>
		<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
	<?php
	}
	?>
</ul>






<?php include 'footer.php' ?>