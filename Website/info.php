<?php
	require 'kon.php';
	$request=[];

	$hasil = $_db->query("SELECT * FROM request");
	while ($row = mysqli_fetch_array($hasil,1)) {
		$request[$row['nama']] = $row['nilai'];
	}

	$hasil = $_db->query("SELECT * FROM data");

	echo '<table class="table" id="t1" >';
	while ($row = mysqli_fetch_array($hasil,1)) {
		echo '<tr  onmouseover=\'pause=true\' onmouseout=\'pause_false()\'>';
		echo "<td width='50%''>{$row['nama']}</td>";

		echo '<td>';

		if($row['nama']=="Status pembuatan"){
			echo $row['nilai']==0? "Sudah jadi" : ($row['nilai']==1? "Sedang membuat" : "Menganggur");
			if($row['nilai']>=2){
				echo " <br/>";
				echo " <select class='input'  onmouseover='pause=true'>";
				echo " <option selected>Kopi</option>";
				echo " <option>Susu</option>";
				echo " <option>Sirup</option>";
				echo " </select>";
				echo " <button class='input1' onmouseover='pause=true'  onclick='terima(\"sminum:1\")' >Buat</button>";
			}
		}
		else
		if($row['nama']=="Suhu air"){
			echo $row['nilai'] . " <sup>o</sup>C ";
		}
		else
		if($row['nama']=="Sisa air"){
			echo $row['nilai'] . " Liter ";
		}
		else
		if($row['nama']=="Sisa bubuk"){
			echo $row['nilai'] . " Liter ";
		}
		else
		if($row['nama']=="Status pemanas"){
			if ($row['nilai']==0){
				echo "Mati";
				echo $request['panas']==1?" <span class='working'>[Menyalakan...]</span>":"";
				echo " <button class='input1' onmouseover='pause=true' onclick='terima(\"spanas:1\")' >Nyalakan</button>";
			}else{
				echo "Nyala";
				echo $request['panas']==0?" <span class='working'>[Mematikan...]</span>":"";
				echo " <button class='input1' onmouseover='pause=true' onclick='terima(\"spanas:0\")' >Matikan</button>";
			}
		}
		else
		{
			echo $row['nilai'];
		}
		echo '</td>';
		echo '</tr>';
	}
	echo '</table">';
?>