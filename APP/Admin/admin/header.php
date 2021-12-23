<?php
session_start();
include 'cek.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>IndoGameStore</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
	<script src="../assets/sweetalert2/dist/sweetalert2.all.min.js"> </script>
	<script src="../assets/js/Chart.js"></script>
	<script src="../assets/sweetalert2/dist/sweetalert2.min.js"> </script>
</head>

<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Kasir</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span> Pesan</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , <?php echo $_SESSION['uname']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php
					$periksa = mysqli_query($con, "SELECT * from barang where jumlah <=3");
					while ($q = mysqli_fetch_array($periksa)) {
						if ($q['jumlah'] <= 3) {
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>" . $q['nama'] . "</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>

			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="row">
			<?php
			$use = $_SESSION['uname'];
			$fo = mysqli_query($con, "SELECT foto from admin where uname='$use'");
			while ($f = mysqli_fetch_array($fo)) {
			?>
				<?php
				var_dump($f['foto']);
				die;

				?>

				<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="foto/<?= $f['foto']; ?> ?>">
					</a>
				</div>
			<?php
			}
			?>
		</div>
		<div class="row"></div>
		<?php $level = $_SESSION['level'];
		if ($level == 'manajemen_toko') { ?>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<li><a href="barang.php"><span class="glyphicon glyphicon-briefcase"></span> Data Barang</a></li>
				<li> <a href="regis_admin.php"><span class="glyphicon glyphicon-user" style="margin-right:2px;"></span>Tambah Admin </a> </li>
				<li><a href="barang_laku.php"><span class="glyphicon glyphicon-briefcase"></span> Entry Penjualan</a></li>
				<li><a href="lap_penjualan.php"><span class="glyphicon glyphicon-signal"></span> Grafik Penjualan</a></li>
				<li><a href="ganti_foto.php"><span class="glyphicon glyphicon-picture"></span> Ganti Foto</a></li>
				<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		<?php } elseif ($level == 'kasir') { ?>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="index_toko.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<li><a href="barang.php"><span class="glyphicon glyphicon-briefcase"></span> Stok Barang</a></li>
				<li><a href="trx_penjualan.php"><span class="glyphicon glyphicon-briefcase"></span> Transaksi Penjualan</a></li>
				<li><a href="lappenjualan.php"><span class="glyphicon glyphicon-briefcase"></span> Laporan Penjualan</a></li>
				<li> <a href="stokmasuk.php"><span class="glyphicon glyphicon-log-in" style="margin-right:5px;"></span>Stok Masuk </a> </li>
				<li><a href="stokkeluar.php"><span class="glyphicon glyphicon-log-out" style="margin-right:5px;"></span>Stok Keluar</a></li>
				<li><a href="ganti_foto.php"><span class="glyphicon glyphicon-picture"></span> Ganti Foto</a></li>
				<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>



		<?php } else { ?>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href=""><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<li><a href="barang.php"><span class="glyphicon glyphicon-briefcase"></span> Stok Barang</a></li>
				<li><a href="lapstok.php"><span class="glyphicon glyphicon-signal"></span> Laporan Stok</a></li>
				<li><a href="blacklist.php"><span class="glyphicon glyphicon-remove"></span> Blacklist Supplier </a></li>
				<li><a href="kirim.php"><span class="glyphicon glyphicon-share-alt"></span> Kirim Barang </a></li>
				<li><a href="ganti_foto.php"><span class="glyphicon glyphicon-picture"></span> Ganti Foto</a></li>
				<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		<?php } ?>
	</div>
	<div class="col-md-10">