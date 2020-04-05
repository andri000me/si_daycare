<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
//Proses penambahan keterangan
	$stmt = $mysqli->prepare("INSERT INTO tb_kelompok 
		(idkelompok,kelompok,keterangan) 
		VALUES (?,?,?)");

	$stmt->bind_param("sss", 
		mysqli_real_escape_string($mysqli, $_POST['kode']),
		mysqli_real_escape_string($mysqli, $_POST['kelompok']),
		mysqli_real_escape_string($mysqli, $_POST['keterangan']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kelompok Usia Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=kelompok';</script>";	
	} else {
		echo "<script>alert('Data Kelompok Usia Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

//Proses ubah data
	$stmt = $mysqli->prepare("UPDATE tb_kelompok  SET 
		kelompok=?,
		keterangan=?
		where idkelompok=?");
	$stmt->bind_param("sss",
		mysqli_real_escape_string($mysqli, $_POST['kelompok']),
		mysqli_real_escape_string($mysqli, $_POST['keterangan']),
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kelompok Usia Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=kelompok';</script>";	
	} else {
		echo "<script>alert('Data Kelompok Usia Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_kelompok where idkelompok=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kelompok Usia Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kelompok';</script>";	
	} else {
		echo "<script>alert('Data Kelompok Usia Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>