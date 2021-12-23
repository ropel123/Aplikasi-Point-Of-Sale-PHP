<?php include 'header.php';
require 'fungsi.php';
require 'config.php';

?>
<?php if ($_SESSION['level'] == 'manajemen_toko') { ?>
	<h3><span class="glyphicon glyphicon-briefcase" style="margin-left:10px; margin-top:10px;"></span> Data Barang</h3>
	<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
<?php } elseif ($_SESSION['level'] == 'kasir') { ?>
	<h3><span class="glyphicon glyphicon-briefcase" style="margin-left:10px; margin-top:10px;"></span> Stok Barang</h3>
	<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus">
		</span>Tambah Stok</button>
<?php } else { ?>
	<h3><span class="glyphicon glyphicon-briefcase" style="margin-left:10px; margin-top:10px;"></span> Stok Barang</h3>
	<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Sortir Barang</button>
	<button style="margin-bottom:20px; width:100px; margin-left:10px;" data-toggle="modal" data-target="#cekstok" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-search">
		</span>Cek Stok</button>

<?php } ?>
<br />
<br />
<?php
if ($_SESSION['level'] == 'manajemen_toko') {
	$periksa = mysqli_query($con, "select * from brg_manajemen_pst where jumlah <=10");
} elseif ($_SESSION['level'] == 'kasir') {
	$periksa = mysqli_query($con, "SELECT * FROM  barang_toko where jumlah <=10");
} else {
	$periksa = mysqli_query($con, "SELECT * FROM  brg_manajemen_pst where jumlah <=10");
}
while ($q = mysqli_fetch_array($periksa)) {
	if ($q['jumlah'] <= 10 and $_SESSION['level'] != 'manajemen_toko') {
?>
		<script>
			$(document).ready(function() {
				$('#pesan_sedia').css("color", "red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
	<?php
		echo "<div style='padding:5px;' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red;'>"
			. $q['nama'] .
			"</a> yang tersisa sudah kurang dari 10 . silahkan pesan lagi !!</div>";
	} elseif ($_SESSION['level'] == 'manajemen_toko') { ?>
		<script>
			$(document).ready(function() {
				$('#pesan_sedia').css("color", "red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
<?php
		echo "<div style='padding:4px;' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red;'>" .
			$q['nama'] . "</a> yang tersisa digudang kurang dari 10 . silahkan pesan lagi !!</div>";
	}
}
?>
<?php
$per_hal = 10;
if ($_SESSION['level'] == 'manajemen_toko') {
	$jum = count(ambil());
} elseif ($_SESSION['level'] == 'kasir') {
	$jum = count(ambil1());
} else {
	$jum = count(ambil5());
}
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<?php if (isset($_GET['puk'])) {
	$nim = $_GET['puk'];
	$jj = mysqli_query($con, "SELECT * FROM brg_manajemen_pst WHERE nama ='$nim'");
	if (mysqli_affected_rows($con) > 0) {
		$por = mysqli_fetch_assoc($jj);
?>
		<div class="col-md-12">
			<h2>Jumlah Stok <?= $_GET['puk']; ?> Tersisa : <?= $por['jumlah']; ?> </h1>
		</div>
	<?php } else { ?>
		<div class="col-md-12">
			<h2>Anda Belum Mempunyai Barang Ini</h1>
		</div>
<?php  }
} ?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Produk</td>
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<?php if ($_SESSION['level'] == 'manajemen_toko') { ?>
		<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a>
	<?php } else { ?>
		<a style="margin-bottom:10px" href="lap_barang_toko.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a>
	<?php } ?>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">
	</div>
</form>
<br />
<?php $level = $_SESSION['level'];
if ($level == 'manajemen_toko') { ?>
	<table class="table table-hover">
		<tr>
			<th class="col-md-1">No</th>
			<th class="col-md-2">Nama Barang</th>
			<th class="col-md-2">Harga Jual</th>
			<th class="col-md-1">Stok</th>
			<th class="col-md-2">Modal</th>
			<!-- <th class="col-md-1">Sisa</th>		 -->
			<th class="col-md-3">Opsi</th>
		</tr>
		<?php
		if (isset($_GET['cari'])) {
			$cari = mysqli_real_escape_string($con, $_GET['cari']);
			$brg = mysqli_query($con, "SELECT * from barang where nama like '$cari' or jenis like '$cari'");
		} else {
			$brg = mysqli_query($con, "SELECT * from barang limit $start, $per_hal");
		}
		$no = 1;
		while ($b = mysqli_fetch_array($brg)) {

		?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $b['nama'] ?></td>
				<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
				<td><?php echo $b['jumlah'] ?></td>
				<td><?php echo $b['modal'] ?></td>

				<td>
					<a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
					<a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
					<a href="tambah_stok.php?id=<?php echo $b['id']; ?>" class="btn btn-primary">Restock</a>
					<a id="hps" href="hapus.php?id=<?php echo $b['id']; ?>" class="btn btn-danger hps">Hapus</a>
				</td>
			</tr>

		<?php

		}
	} elseif ($_SESSION['level'] == 'kasir') { ?>
		<table class="table table-hover">
			<tr>
				<th class="col-md-3">No</th>
				<th class="col-md-3">Nama Barang</th>
				<th class="col-md-3">Harga Jual</th>
				<th class="col-md-3">Sisa Stok</th>
				<!-- <th class="col-md-1">Sisa</th>		 -->
			</tr>
			<?php
			if (isset($_GET['cari'])) {
				$cari = mysqli_real_escape_string($con, $_GET['cari']);
				$brg = mysqli_query($con, "SELECT * from barang_toko where nama LIKE '%$cari%' OR jumlah LIKE '%$cari'");
			} else {
				$brg = mysqli_query($con, "SELECT * from barang_toko limit $start, $per_hal");
			}
			$no = 1;
			while ($b = mysqli_fetch_assoc($brg)) {
			?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $b['nama'] ?></td>
					<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
					<td><?php echo $b['jumlah'] ?></td>
				</tr>
			<?php }
		} else { ?>
			<table class="table table-hover">
				<tr>
					<th class="col-md-2">No</th>
					<th class="col-md-2">Nama Barang</th>
					<th class="col-md-2">Jenis Barang</th>
					<th class="col-md-2">Supplier</th>
					<th class="col-md-2">Modal</th>
					<th class="col-md-2">Stok</th>
					<!-- <th class="col-md-1">Sisa</th>		 -->
				</tr>
				<?php
				if (isset($_GET['cari'])) {
					$cari = mysqli_real_escape_string($con, $_GET['cari']);
					$brg = mysqli_query($con, "SELECT * from brg_manajemen_pst where nama LIKE '%$cari%' OR jumlah LIKE '%$cari'");
				} else {
					$brg = mysqli_query($con, "SELECT * from brg_manajemen_pst limit $start, $per_hal");
				}
				$no = 1;
				while ($b = mysqli_fetch_assoc($brg)) {
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $b['nama'] ?></td>
						<td><?php echo $b['jenis'] ?></td>
						<td><?php echo $b['supplier'] ?></td>
						<td>Rp.<?php echo number_format($b['modal']) ?>,-</td>
						<td><?php echo $b['jumlah'] ?></td>
					</tr>

			<?php }
			} ?>
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
			<!-- modal input -->
			<?php if ($_SESSION['level'] == 'manajemen_toko') { ?>
				<div id="myModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Tambah Barang Baru</h4>
							</div>
							<div class="modal-body">
								<form action="tmb_brg_act.php" method="post">
									<div class="form-group">
										<label>Nama Barang</label>
										<input name="nama" type="text" class="form-control" placeholder="Nama Barang .." required>
									</div>
									<div class="form-group">
										<label>Jenis</label>
										<input name="jenis" type="text" class="form-control" placeholder="Jenis Barang .." required>
									</div>
									<div class="form-group">
										<label>Suplier</label>
										<input name="suplier" type="text" class="form-control" placeholder="Suplier .." required>
									</div>
									<div class="form-group">
										<label>Harga Modal</label>
										<input name="modal" type="text" class="form-control" placeholder="Modal per unit" required>
									</div>
									<div class="form-group">
										<label>Harga Jual</label>
										<input name="harga" type="text" class="form-control" placeholder="Harga Jual per unit" required>
									</div>
									<div class="form-group">
										<label>Jumlah</label>
										<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" required>
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
							</form>
						</div>
					</div>
				</div>
				<!--- Modal Toko -->
			<?php } elseif ($_SESSION['level'] == 'kasir') { ?>
				<div id="myModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Tambah Stok barang</h4>
							</div>
							<div class="modal-body">
								<form action="tmb_brg_toko.php" method="post">
									<div class="form-group">
										<label>Tanggal</label>
										<input name="tgltko" type="text" id="tgltko" class="form-control" placeholder="Tanggal" required autocomplete="off">
									</div>
									<div class="form-group">
										<label>Nama Barang</label>
										<select name="brtoko" class="form-control" style="margin-right:120px;">
											<option>Pilih Barang</option>
											<?php
											$pil = mysqli_query($con, "SELECT nama from brg_manajemen_pst order by id desc");
											while ($p = mysqli_fetch_array($pil)) {
											?>
												<option><?php echo $p['nama'] ?></option>
											<?php
											}
											?>
										</select>

									</div>
									<div class="form-group">
										<label>Harga Jual</label>
										<input name="hargatko" type="text" class="form-control" placeholder="Harga Jual per unit" required>
									</div>
									<div class="form-group">
										<label>Stok</label>
										<input name="jumlahtko" type="text" class="form-control" placeholder="Jumlah" required>
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
							</form>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div id="myModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Sortir barang</h4>
							</div>
							<div class="modal-body">
								<form action="tmb_brg_manajemen.php" method="post">
									<div class="form-group">
										<label>Tanggal</label>
										<input name="tgltko" type="text" id="tgltko" class="form-control" placeholder="Tanggal" required>
									</div>
									<div class="form-group">
										<label>Nama Barang</label>
										<select name="brtoko" id="brtoko" class="form-control" style="margin-right:120px;">
											<option>Pilih Barang</option>
											<?php
											$pil = mysqli_query($con, "SELECT * from barang where jumlah > 0 order by id desc");
											while ($p = mysqli_fetch_array($pil)) {
												if ($p['jumlah'] > 0) {      ?>
													<option><?php echo $p['nama'] ?></option>
												<?php } ?>
											<?php
											}
											?>

										</select>

									</div>
									<div class="form-group">
										<label>Barang Cacat</label>
										<input name="brgcct" type="text" class="form-control" placeholder="Barang Cacat" required>
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
							</form>
						</div>
					</div>
				</div>
				<div id="cekstok" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Cek Stok barang</h4>
							</div>
							<div class="modal-body">
								<form action="?status=sukses" method="get">
									<div class="form-group">
										<label>Nama Barang</label>
										<select name="puk" class="form-control" style="margin-right:120px;" onchange="this.form.submit()">
											<option>Pilih Barang</option>
											<?php
											$pil = mysqli_query($con, "SELECT * from barang where jumlah >=0 order by id desc");
											while ($p = mysqli_fetch_assoc($pil)) {
											?>
												<option><?php echo $p['nama'] ?></option>
											<?php
											}
											?>
										</select>

									</div>

							</div>
							<div class="modal-footer">
							</div>
							</form>
						</div>
					</div>
				</div>
			<?php } ?>
			<script>
				$(document).ready(function() {
					const btn = document.querySelectorAll('.hps');
					btn.forEach(function(r) {
						r.addEventListener('click', function(por) {
							por.preventDefault();
							const href = $(this).attr('href');
							Swal.fire({
								title: 'Apakah Kamu Yakin ?',
								text: "Kamu Akan Kehilangan Data Postingan !!!",
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
				$(document).ready(function() {
					$("#tgltko").datepicker({
						dateFormat: 'yy/mm/dd'
					});
				});
			</script>


			<?php
			include 'footer.php';

			?>