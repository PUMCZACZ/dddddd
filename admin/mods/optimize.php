<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY	PRO				*/
/*	WERSJA:						1.31							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('ADMIN_FILE')) die ("Access Denied");

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'")->fetch_array(MYSQLI_ASSOC);
if ($row['radminsuper'] == 1) {

	$adminClass->OpenTableAdmin();
	echo '<h3 class="text-center">Optymalizacja bazy danych</h3>';
	echo '<h4 class="text-center">Optymalizuję bazę danych: <strong>'.$dbname.'</strong></h4>'
	.'<table class="table table-striped"><tr><th>Tabela</th><th>Rozmiar</th><th>Status</th><th>Wykonano</th></tr>';
	$db_clean = $dbname;
	$tot_data = 0;
	$tot_idx = 0;
	$tot_all = 0;
	$local_query = 'SHOW TABLE STATUS FROM '.$dbname;
	$result = $db->query($local_query);
	if ($result->num_rows)
	{
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$tot_data = $row['Data_length'];
			$tot_idx  = $row['Index_length'];
			$total = $tot_data + $tot_idx;
			$total = $total / 1024 ;
			$total = round ($total,3);
			$gain= $row['Data_free'];
			$gain = $gain / 1024 ;
			$total_gain += $gain;
			$gain = round ($gain,3);
			$local_query = 'OPTIMIZE TABLE '.$row['Name'];
			$resultat  = $db->query($local_query);
			if ($gain == 0) echo '<tr><td>'.$row['Name'].'</td><td>'.$total.' Kb</td><td>Już zoptymalizowane</td><td>0 Kb</td></tr>';
			else echo '<tr><td><b>'.$row['Name'].'</b></td><td><b>'.$total.' Kb</b></td><td><b>Zoptymalizowane!</b></td><td><b>'.$gain.' Kb</b></td></tr>';
		}
	}
	echo "</table>";
	echo "</center>";
	echo "<br>";
	$total_gain = round ($total_gain,3);
	echo '<h4 class="text-center">Wyniki optymalizacji</h4>'
	.'<p class="text-center">'
	.'Zaoszczędzono: <strong>'.$total_gain.' Kb</strong><br>';
	$sql_query = "CREATE TABLE IF NOT EXISTS ".$prefix."_optimize_gain(gain decimal(10,3))";
	$result = $db->query($sql_query);
	$sql_query = "INSERT INTO ".$prefix."_optimize_gain (gain) VALUES ('$total_gain')";
	$result = $db->query($sql_query);
	$sql_query = "SELECT * FROM ".$prefix."_optimize_gain";
	$result = $db->query ($sql_query);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$histo += $row['gain'];
		$cpt += 1;
	}
	echo 'Uruchomiłeś ten skrypt <strong>'.$cpt.' razy</strong><br>'
	.'<strong>'.number_format($histo,2,'.', ' ').'</strong> kB oszczędzono od pierwszej optymalizacji!'
	.'</p>';
	$adminClass->CloseTableAdmin();

} else {
	echo "Access Denied";
}

?>
