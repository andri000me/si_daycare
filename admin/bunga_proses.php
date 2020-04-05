<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
//Proses penambahan bunga
	$stmt = $mysqli->prepare("INSERT INTO tb_bunga 
		(idbunga,lamapinjam,bunga) 
		VALUES (?,?,?)");

	$stmt->bind_param("sss", 
		mysqli_real_escape_string($mysqli, $_POST['kode']),
		mysqli_real_escape_string($mysqli, $_POST['lamapinjam']),
		mysqli_real_escape_string($mysqli, $_POST['bunga']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Bunga Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=bunga';</script>";	
	} else {
		echo "<script>alert('Data Bunga Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

//Proses ubah data
	$stmt = $mysqli->prepare("UPDATE tb_bunga  SET 
		lamapinjam=?,
		bunga=?
		where idbunga=?");
	$stmt->bind_param("sss",
		mysqli_real_escape_string($mysqli, $_POST['lamapinjam']),
		mysqli_real_escape_string($mysqli, $_POST['bunga']),
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Bunga Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=bunga';</script>";	
	} else {
		echo "<script>alert('Data Bunga Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_bunga where idbunga=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Bunga Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=bunga';</script>";	
	} else {
		echo "<script>alert('Data Pegawai Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>