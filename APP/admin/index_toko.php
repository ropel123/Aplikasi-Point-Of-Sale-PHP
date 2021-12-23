<?php include 'header.php';
date_default_timezone_set('Asia/Jakarta');
$sekarang = date('Y-m-d');
function jml()
{
    global $sekarang;
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM trx_toko WHERE tanggal='$sekarang'");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
$p = mysqli_query($con, "SELECT sum(total_transaksi)as tod From trx_toko WHERE tanggal='$sekarang'");
$q = mysqli_fetch_assoc($p);
$l = mysqli_query($con, "SELECT * FROM trx_toko order by id desc limit 1");
$m = mysqli_fetch_assoc($l);
?>
<style>
    .box {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        font-size: 14px;
        line-height: 1.42857143;
        margin-top: 30px;
        color: #333;
        font-family: 'fontku';
        box-sizing: border-box;
        background-color: #07c9c9;
        padding: 5px;
    }

    .box-title {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        font-family: 'fontku';
        box-sizing: border-box;
        padding: 7px 0px 10px;
        line-height: 1;
        font-weight: bold;
        color: rgb(0, 78, 70);
        font-size: 16px;
    }

    .box-content {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        font-family: 'fontku';
        box-sizing: border-box;
        padding: 5px;
        background-color: #d9ffff;
    }

    .box-btn {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        color: #333;
        font-family: 'fontku';
        box-sizing: border-box;
        position: absolute;
        font-size: 55px;
        line-height: 1;
        left: 38px;
    }
</style>
<?php
$tanggal = mysqli_query($con, "SELECT nama FROM barang_laris order by jumlah desc limit 5");
$hasil = mysqli_query($con, "SELECT jumlah FROM barang_laris order by jumlah desc limit 5");
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Produk Terlaris </h3>
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>

        <div class="row">
            <div class="col-sm-4 col-md-offset-2">
                <div class="box">
                    <div class="box-title">
                        <h3><i class="fa fa-money"> Transaksi Hari Ini </i> </h3>
                        <hr style="width:100%; background:black; font-weight:bold;">
                        <?php if (count(jml()) == 0) { ?>
                            <p style="font-size: 18pt;"><i class="fa fa-money">Tidak Ada Transaksi</i></p>
                        <?php } else { ?>
                            <p style="font-size: 18pt;"><?= count(jml()); ?> Transaksi</p>
                        <?php } ?>
                    </div>
                    <div class="box-content">
                        <?php if (count(jml()) == 0) { ?>
                            <p style="font-size: 18pt;">Rp.0,-</p>
                        <?php } else { ?>
                            <p style="font-size: 15pt;">Pendapatan Rp.<?= number_format($q['tod']); ?>,-</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-offset-2">
                <div class="box">
                    <div class="box-title">
                        <h3><i class="fa fa-money"> Transaksi Terakhir </i> </h3>
                        <hr style="width:100%; background:black; font-weight:bold;">
                        <p style="font-size: 18pt;"><?= $m['trx_thr']; ?> </p>
                    </div>
                    <div class="box-content">
                        <p style="font-size: 15pt;">Produk <?= $m['nama']; ?> Total Transaksi Rp.<?= number_format($m['total_transaksi']); ?>,' </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($tanggal)) {
                                echo '"' . $b['nama'] . '",';
                            } ?>],
                datasets: [{
                    label: 'Total',
                    data: [<?php while ($f = mysqli_fetch_array($hasil)) {
                                echo '"' . $f['jumlah'] . '",';
                            } ?>],
                    backgroundColor: [
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
                        'rgba(255, 159, 64, 1)'
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