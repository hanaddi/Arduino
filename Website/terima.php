<?php
require 'kon.php';

if( isset($_GET['c']) ){
	$isi = $_GET['c'];
	$request=[];
	$data=[];

	$hasil = $_db->query("SELECT * FROM request");
	while ($row = mysqli_fetch_array($hasil,1)) {
		$request[$row['nama']] = $row['nilai'];
	}

	$hasil = $_db->query("SELECT * FROM data");
	while ($row = mysqli_fetch_array($hasil,1)) {
		$data[$row['nama']] = $row['nilai'];
	}

	//exit($isi);

	if($isi[0]=='s'){
		$isi = explode(';', substr($isi, 1) );

		require 'kon.php';
		foreach ($isi as $v) {
			$val=explode(":", $v);
			if(isset($request[$val[0]]))$request[$val[0]]=$val[1];
			if(isset($data[$val[0]]))$data[$val[0]]=$val[1];
		}

		foreach ($request as $k => $v) {
			$_db->query("UPDATE request SET nilai=$v where nama='$k' ");
		}
		foreach ($data as $k => $v) {
			$_db->query("UPDATE data SET nilai=$v where nama='$k' ");
		}

		header("X-Data: OK");
	}
	else
	if($isi[0]=='g'){
		if(isset($request[ substr($isi, 1) ])){
			header("X-Data: ".$request[ substr($isi, 1) ]);
		}else
		if(isset($data[ substr($isi, 1) ])){
			header("X-Data: ".$data[ substr($isi, 1) ]);
		}else{
			header("X-Data: ERROR");
		}
	}

//	$fp = fopen("isi.txt", "w");
//	fwrite($fp, $isi);
//	fclose($fp);
}

?>