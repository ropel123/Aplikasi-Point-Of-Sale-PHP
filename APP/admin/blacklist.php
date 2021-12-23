<?php include 'header.php';
require 'fungsi.php';

$per_hal = 10;
$jum = count(ambil6());
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;


?>
<h3><span class="glyphicon glyphicon-remove" style="margin-left:10px; margin-top:10px; margin-bottom:10px;"></span> Daftar Blacklist Supplier</h3>
<table class="table">
	<tr>
		<th class="col-md-1">Id</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-3">Jenis Barang</th>
		<th class="col-md-3">Nama Supplier</th>
		<th class="col-md-2">Total Retur</th>
	</tr>
	<?php
	$brg = mysqli_query($con, "SELECT * from blacklist order by id asc limit $start, $per_hal ");
	$no = 1;
	while ($b = mysqli_fetch_array($brg)) {

	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['jenis'] ?></td>
			<td><?php echo $b['supplier'] ?></td>
			<td><?php echo $b['retur']; ?></td>
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