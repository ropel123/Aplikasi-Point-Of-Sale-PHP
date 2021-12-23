<?php
require 'config.php';
function ambil()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM barang");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil1()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM barang_toko");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil5()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM brg_manajemen_pst ");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil2()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM trx_toko");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil3()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM tmp_data");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil4()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM tmp_data");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function pmbr()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM trx_toko");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil6()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM blacklist");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
function ambil7()
{
    global $con;
    $qry = mysqli_query($con, "SELECT * FROM rpt_stok");
    $por = [];
    while ($list = mysqli_fetch_assoc($qry)) {
        $por[] = $list;
    }
    return $por;
}
