<?php include 'header.php'; 
require 'fungsi.php';
$per_hal = 10;
$jum = count(ambil7());
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;

?>


<form action="" method="get">
<div class="input-group col-md-2 ">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-tasks"></span></span>
		<select type="submit" name="pil" class="form-control" style="margin-right:120px;">
			<option >Pilih Laporan</option>	
            <option >Tabel</option>	
            <option >Grafik</option>			
        </select>
        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-tasks"></span></span>
		<select type="submit" name="pilbr" class="form-control" style="margin-right:120px;" onchange="this.form.submit()">
			<option >Pilih Barang</option>	
            <option >Semua</option>	
            <?php 
				$pil=mysqli_query($con,"SELECT nama from rpt_stok order by id desc");
				while($p=mysqli_fetch_array($pil)){
					?>
					<option><?php echo $p['nama'] ?></option>
					<?php
				}
				?>						
        </select>

	</div>
    

</form>
<?php 
if(isset($_GET['pil'])){
if($_GET['pil'] == 'Tabel'){ ?>
	<h3><span  class="glyphicon glyphicon-signal" style="margin-left:10px; margin-top:10px; margin-bottom:10px;"></span> Laporan Stok</h3>
<table class="table">
	<tr>
		<th class="col-md-1">Id</th>
		<th class="col-md-3">Nama</th>
		<th class="col-md-3">Stok Awal</th>
		<th class="col-md-3">Stok Akhir</th>
		<th class="col-md-2">Tanggal</th>		
	</tr>
    <?php 
    $pilbr = $_GET['pilbr'];
    if($pilbr == 'Semua'){
    $brg=mysqli_query($con,"SELECT * from rpt_stok order by id asc limit $start, $per_hal ");
    }else{
        $brg=mysqli_query($con,"SELECT * from rpt_stok  WHERE nama='$pilbr' ");
    }
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['stok_awal'] ?></td>
			<td><?php echo $b['stok_akhir'] ?></td>
			<td><?php echo $b['tanggal']; ?></td>					
     <?php } ?>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<?php 
}else{ ?>

<?php 
$pilbr = $_GET['pilbr'];
if($pilbr == 'Semua'){
$tanggal = mysqli_query($con, "SELECT  tanggal FROM rpt_stok order by id asc");
$awal =mysqli_query($con, "SELECT stok_awal FROM rpt_stok order by id asc ");
$akhir =mysqli_query($con, "SELECT stok_akhir FROM rpt_stok order by id asc");
$nama =mysqli_query($con, "SELECT distinct nama FROM rpt_stok order by id asc"); 
}else{
    $tanggal = mysqli_query($con, "SELECT  tanggal FROM rpt_stok WHERE nama='$pilbr' ");
    $awal =mysqli_query($con, "SELECT stok_awal FROM rpt_stok WHERE nama='$pilbr' ");
    $akhir =mysqli_query($con, "SELECT stok_akhir FROM rpt_stok WHERE nama='$pilbr' ");
    $nama =mysqli_query($con, "SELECT nama FROM rpt_stok WHERE nama='$pilbr' "); 
}
?>
<div style="padding: 80px; margin-right:20px;" >

            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
<?php }}?>
<script>
        var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($l=mysqli_fetch_array($nama)){ echo '"'.$l['nama'].'",';}?>],
                    
                    datasets: [{
                            label: 'StokAwal',
                         data: [<?php  while($p =mysqli_fetch_array($awal)){ echo '"'.$p['stok_awal'].'",'; } ?>],
                            backgroundColor:"#dd4b39",
                    },{
                        label: 'StokAkhir',
                         data: [<?php  while($p =mysqli_fetch_array($akhir)){ echo '"'.$p['stok_akhir'].'",'; } ?>],
                            backgroundColor:'#4d90fe',
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });

        </script>





