<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';
require_once 'setting/tanggal.php';

$user=$_POST['username'];
$pass=$_POST['password']; 

  //Pengecekan ada data dalam login tidak
$sqlpetugas="Select idpegawai from tb_pegawai where username='$user' and password='$pass' and level='petugas'";
$sqlkepala="Select idpegawai from tb_pegawai where username='$user' and password='$pass' and level='kepala'";


if (CekExist($mysqli,$sqlpetugas)== true){

    //JIka data ditemukan
	$_SESSION['petugas']=caridata($mysqli,$sqlpetugas);
	echo "<script>alert('Anda login sebagai Petugas')</script>";
	echo "<script>window.location='petugas/index.php?hal=beranda';</script>";

}else if (CekExist($mysqli,$sqlkepala)== true){

    //JIka data ditemukan
	$_SESSION['petugas']=caridata($mysqli,$sqlkepala);
	echo "<script>alert('Anda login sebagai Kepala')</script>";
	echo "<script>window.location='kepala/index.php?hal=beranda';</script>";

}else{
    //Jika tidak ditemukan
	echo "<script>alert('Username atau Password tidak terdaftar')</script>";
	echo "<script>window.location='index.php';</script>";

}

?>