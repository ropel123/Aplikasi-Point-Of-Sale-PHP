<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Data Barang Terjual</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Entry</button>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php
			$pil = mysqli_query($con, "SELECT distinct tanggal from barang_laku order by tanggal desc");
			while ($p = mysqli_fetch_array($pil)) {
			?>
				<option><?php echo $p['tanggal'] ?></option>
			<?php
			}
			?>
		</select>
	</div>

</form>
<br />
<?php
if (isset($_GET['tanggal'])) {
	$tanggal = mysqli_real_escape_string($con, $_GET['tanggal']);
	$tg = "lap_barang_laku.php?tanggal='$tanggal'";
?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a><?php
																																									} else {
																																										$tg = "lap_barang_laku.php";
																																									}
																																										?>

<br />
<?php
if (isset($_GET['tanggal'])) {
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> " . $_GET['tanggal'] . "</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Nama Barang</th>
		<th>Harga Terjual /pc</th>
		<th>Total Harga</th>
		<th>Jumlah</th>
		<th>Laba</th>
		<th>Opsi</th>
	</tr>
	<?php
	if (isset($_GET['tanggal'])) {
		$tanggal = mysqli_real_escape_string($con, $_GET['tanggal']);
		$brg = mysqli_query($con, "select * from barang_laku where tanggal like '$tanggal' order by tanggal desc");
	} else {
		$brg = mysqli_query($con, "select * from barang_laku order by tanggal desc");
	}
	$no = 1;
	while ($b = mysqli_fetch_array($brg)) {

	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
			<td><?php echo $b['jumlah'] ?></td>
			<td><?php echo "Rp." . number_format($b['laba']) . ",-" ?></td>
			<td>
				<a href="edit_laku.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a href="hapus_laku.php?id=<?php echo $b['id']; ?>&jumlah=<?php echo $b['jumlah'] ?>&nama=<?php echo $b['nama']; ?>" class="btn btn-danger hps" id="hps">Hapus</a>
			</td>
		</tr>

	<?php
	}
	?>
	<tr>
		<?php
		if (isset($_GET['tanggal'])) { ?>
			<td colspan="7">Total Pemasukan</td>
		<?php $tanggal = mysqli_real_escape_string($con, $_GET['tanggal']);
			$x = mysqli_query($con, "SELECT sum(total_harga) as total from barang_laku where tanggal='$tanggal'");
			$xx = mysqli_fetch_array($x);
			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>";
		} else { ?>
			<td colspan="7">Total Keseluruhan Pemasukan</td>
		<?php
			$x = mysqli_query($con, "SELECT sum(total_harga) as total from barang_laku ");
			$xx = mysqli_fetch_array($x);
			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>";
		}

		?>
	</tr>
	<tr>
		<?php
		if (isset($_GET['tanggal'])) { ?>
			<td colspan="7">Total Laba</td>
		<?php $tanggal = mysqli_real_escape_string($con, $_GET['tanggal']);
			$x = mysqli_query($con, "SELECT sum(laba) as total from barang_laku where tanggal='$tanggal'");
			$xx = mysqli_fetch_array($x);
			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>";
		} else { ?>
			<td colspan="7">Total Keseluruhan Laba</td>
			<?php
			$x = mysqli_query($con, "SELECT sum(laba) as total from barang_laku ");
			$xx = mysqli_fetch_array($x);

			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>"; ?>
		<?php }
		?>

	</tr>
	<tr>
		<?php
		if (isset($_GET['tanggal'])) {
			$tanggal = mysqli_real_escape_string($con, $_GET['tanggal']);
			$xy = mysqli_query($con, "SELECT sum(laba) as total from barang_laku where tanggal='$tanggal'");
		} else {
			$xy = mysqli_query($con, "SELECT sum(laba) as total from barang_laku ");
		}
		$xr = mysqli_fetch_array($xy);
		if ($xr['total'] < 0) { ?>
			<td colspan="7">Status :<p style="color:red; float:right; font-weight:bold;margin-right:1000px;"> <?= 'Rugi'; ?> </p>
				</p>
			</td>
		<?php	} elseif ($xr['total'] == 0) { ?>
			<td colspan="7">Status :<p style="color:black; font-weight:bold; float:right; margin-right:990px;"> <?= 'Modal'; ?> </p>
			</td>
		<?php } else { ?>
			<td colspan="7">Status :<p style="color:green; float:right; font-weight:bold; margin-right:980px;"> <?= 'Untung'; ?> </p>
			</td>
		<?php } ?>


	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Penjualan
			</div>
			<div class="modal-body">
				<form action="barang_laku_act.php" method="post">
					<div class="form-group">
						<label>Tanggal</label>
						<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<select class="form-control" name="nama">
							<?php
							$brg = mysqli_query($con, "SELECT * from barang");
							while ($b = mysqli_fetch_array($brg)) {
							?>
								<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off">
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<input type="reset" class="btn btn-danger" value="Reset">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		const btn = document.querySelectorAll('.hps');
		btn.forEach(function(r) {
			r.addEventListener('click', function(por) {
				por.preventDefault();
				const href = $(this).attr('href');
				Swal.fire({
					title: 'Apakah Kamu Yakin ?',
					text: "Kamu Akan Kehilangan Data Penjualan !!!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Hapus'
				}).then((result) => {
					if (result.value) {
						document.location.href = href;
					}
				})
			})
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tgl").datepicker({
			dateFormat: 'yy/mm/dd'
		});
	});
</script>
<?php include 'footer.php'; ?>