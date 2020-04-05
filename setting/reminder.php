<?php

$query="SELECT * FROM tb_pinjaman join tb_nasabah using(idnasabah) WHERE tgltempo BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) and statuspinjam='pinjam'";

$result=$mysqli->query($query);
$num_result=$result->num_rows;
if ($num_result > 0 ) { 
	while ($data=mysqli_fetch_assoc($result)) {
		extract($data);

		$angsuranke=caridata($mysqli,"select count(*) from tb_angsuran where idpinjam='$idpinjaman'")+1;
		$dibayar=$angsuranpokok+$angsuranbunga;
		$pesan="Angsuran Ke $angsuranke Rp. $dibayar Segera dibayarkan, Jatuh Tempo Tanggal ".tgl_indo($tgltempo);


		if (cekkirim($mysqlisms,$idpinjaman,$angsuranke)==false){
			$kode=$idpinjaman.$angsuranke;
			kirimsms($mysqlisms,$notelepon,$pesan,$kode);
		}
	}		
}

function cekkirim($mysqlisms,$idpinjaman,$angsuranke){
	$kode=$idpinjaman.$angsuranke;
	$qry="SELECT * from sentitems where CreatorID='$kode'";
	$row = $mysqlisms->query($qry)->num_rows;
	if ($row> 0){
		return true;
	}else{
		return false;
	}
}

//7 Hari Kesini
?>