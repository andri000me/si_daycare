<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/koneksi_sms.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

//kirim_pinjaman($mysqlisms,"001");
//kirim_angsuran($mysqlisms,"001");
//reminder_angsuran($mysqlisms,"001");



function reminder_angsuran($mysqlisms,$idpeminjaman){
	//Kirim SMS//
	$nohp="085729566604";
	$pesan="Angsuran Ke 10, 500000. Mohon segera dibayarkan, jatuh tempo tanggal 01/01/2020";

	$jenis="REMINDER";
	$stmt = $mysqlisms->prepare("INSERT INTO outbox 
		(DestinationNumber,TextDecoded,CreatorID) 
		VALUES (?, ?, ?)");

	$stmt->bind_param("sss", 
		mysqli_real_escape_string($mysqlisms, $nohp), 
		mysqli_real_escape_string($mysqlisms, $pesan), 
		mysqli_real_escape_string($mysqlisms, $jenis));	

	//$stmt->execute();
}

?>