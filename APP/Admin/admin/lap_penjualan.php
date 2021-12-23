<?php
include 'header.php';
?>
  <script src="../assets/js/Chart.js"></script> 
 <style type="text/css">
     .container {
         width: 50%;
         margin: 15px auto;
     }
 </style>
<form action="" method="get">
<div class="input-group col-md-2 ">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" style="margin-right:120px;">
			<option >Tanggal Awal</option>
			<?php 
			$pil=mysqli_query($con,"SELECT distinct tanggal from barang_laku order by tanggal desc");
			while($p=mysqli_fetch_array($pil)){
				?>
				<option><?php echo $p['tanggal'] ?></option>
				<?php
			}
			?>			
        </select>
        <span class="input-group-addon"id="basic-addon1"> S.D</span>
        <span class="input-group-addon"id="basic-addon1"><span class="glyphicon glyphicon-calendar" ></span></span>
		<select type="submit" name="tanggal1" class="form-control" style="margin-right:120px;" onchange="this.form.submit()">
			<option>Tanggal Akhir</option>
			<?php 
			$pil=mysqli_query($con,"SELECT distinct tanggal from barang_laku order by tanggal desc");
			while($p=mysqli_fetch_array($pil)){
				?>
				<option><?php echo $p['tanggal'] ?></option>
				<?php
			}
			?>			
        </select>
	</div>

</form>
<?php
if(isset($_GET['tanggal'])){
$awal = mysqli_escape_string($con,$_GET['tanggal']);
$akhir =mysqli_escape_string($con, $_GET['tanggal1']);
$tanggal = mysqli_query($con, "SELECT  tanggal FROM barang_laku WHERE tanggal between '$awal' and '$akhir' order by id asc");
$hasil = mysqli_query($con, "SELECT laba FROM barang_laku WHERE tanggal between '$awal' and '$akhir' order by id asc");
$num = mysqli_query($con, "SELECT nama FROM barang_laku WHERE tanggal between '$awal' and '$akhir' order by id asc");

?>   <div class="container">
            <canvas id="myChart"  style ="margin-right:200px;" width="80" height="80"></canvas>
     </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($tanggal)and $o= mysqli_fetch_assoc($num)){ echo '"'.$b['tanggal'].$o['nama'].'",';}?>],
                    datasets: [{
                            label: 'Laba',
                            data: [<?php while ($p = mysqli_fetch_array($hasil)) { echo '"'.$p['laba'].'",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
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
<?php }else{?>
    <?php
$tanggal = mysqli_query($con, "SELECT  tanggal FROM barang_laku order by id asc");
$hasil =mysqli_query($con, "SELECT laba FROM barang_laku order by id asc");
$nam =mysqli_query($con, "SELECT nama FROM barang_laku order by id asc");
?>   
        <div style="padding: 80px; margin-right:20px;" >

            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($tanggal)and $l=mysqli_fetch_array($nam)){ echo '"' .$b['tanggal'].$l['nama'].'",';}?>],
                    
                    datasets: [{
                            label: 'laba',
                         data: [<?php  while($p =mysqli_fetch_array($hasil)){ echo '"'.$p['laba'].'",'; } ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
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



<?php }?>



