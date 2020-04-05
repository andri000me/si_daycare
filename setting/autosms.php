<?php
$query="SELECT * from inbox where processed='false'";
$result=$mysqlisms->query($query);
$num_result=$result->num_rows;
if ($num_result > 0 ) { 
	while ($data=mysqli_fetch_assoc($result)) {
		extract($data);
		$nohp="0".substr($SenderNumber,3,15);
		$tanggalnow=date('Y-m-d');
			if(ceknomer($mysqli,$nohp)==true){ //Cek Nomer HP Terdaftar Tidak

				if($TextDecoded=='info#angsuran' || strtolower($TextDecoded)=='info#angsuran'){ //Format Benar
					
					//$angsuran='';
					$query="select * from tb_nasabah join tb_pinjaman using(idnasabah) join tb_angsuran on idpinjam=idpinjaman where notelepon='$nohp' and statuspinjam='pinjam'";
					
					if(CekExist($mysqli,$query)==true){
						//Jika Tidak Ada Angsuran
						$angsuran=caridata($mysqli,"select (angsuranpokok+angsuranbunga) from tb_nasabah join tb_pinjaman using(idnasabah) join tb_angsuran on idpinjam=idpinjaman where notelepon='$nohp' and statuspinjam='pinjam' limit 1");
						$sisa=caridata($mysqli,"select lama from tb_nasabah join tb_pinjaman using(idnasabah) join tb_angsuran on idpinjam=idpinjaman where notelepon='$nohp' and statuspinjam='pinjam' limit 1")-caridata($mysqli,"select count(*) from tb_nasabah join tb_pinjaman using(idnasabah) join tb_angsuran on idpinjam=idpinjaman where notelepon='$nohp' and statuspinjam='pinjam'");

						$jatuhtempo=caridata($mysqli,"select tgltempo from tb_nasabah join tb_pinjaman using(idnasabah) join tb_angsuran on idpinjam=idpinjaman where notelepon='$nohp' and statuspinjam='pinjam' limit 1");

						$pesan="Anda Mempunyai Angsuran Rp. $angsuran, sisa pembayran $sisa Kali, Jatuh Tempo Tanggal $jatuhtempo";

						//echo $pesan;

					}else{
						//Jika Ada Angsuran
						$pesan="Anda tidak mempunyai angsuran";
					}

				}else{ //Format Salah
					$pesan="Format Salah. silahkan ketik INFO#ANGSURAN dan kirim ulang";
				}

			}else{ //Jika Tidak Terdaftar

				$pesan="Nomor Tidak Terdaftar";
				//Nomor Tidak Terdaftar	
			}

			kirimsms($mysqlisms,$nohp,$pesan,"INFO");
			ubahproses($mysqlisms,$ID);
		}		
	}

	//echo $pesan;

	function ceknomer($mysqli,$nomer){
		$qry="SELECT * from tb_nasabah where notelepon='$nomer'";
		$row = $mysqli->query($qry)->num_rows;
		if ($row> 0){
			return true;
		}else{
			return false;
		}
	}

	function ubahproses($mysqlisms,$id){

		$stmt = $mysqlisms->prepare("UPDATE inbox  SET 
			Processed=?
			where ID=?");
		$stmt->bind_param("ss",
			mysqli_real_escape_string($mysqlisms, "true"), 
			mysqli_real_escape_string($mysqlisms, $id));	

		$stmt->execute();
	}

	function kirimsms($mysqlisms,$nohp,$pesan,$jenis){
	$stmt = $mysqlisms->prepare("INSERT INTO outbox 
		(DestinationNumber,TextDecoded,CreatorID) 
		VALUES (?, ?, ?)");

	$stmt->bind_param("sss", 
		mysqli_real_escape_string($mysqlisms, $nohp), 
		mysqli_real_escape_string($mysqlisms, $pesan), 
		mysqli_real_escape_string($mysqlisms, $jenis));	

	$stmt->execute();
}




	?>