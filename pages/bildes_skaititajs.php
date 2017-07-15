<?php

$select_bildes_skaititaju = mysql_query("SELECT * FROM bildes") or die(mysql_error());
while($bildes_skaititajs = mysql_fetch_array($select_bildes_skaititaju))
{

echo "<div class='pagination'>".$bildes_skaititajs['bildes_kods'].'<br>bilde izvadas<br>';
		
	$select_counter_bildes = mysql_query("SELECT COUNT(id) FROM bildes_gruppa WHERE bildes_id = '".$bildes_skaititajs['id']."' ") or die(mysql_error());
	$counter_bildes = mysql_fetch_array($select_counter_bildes);
	
	echo 'Izvada ka ciparus<br>bildi izmanto '.$counter_bildes['COUNT(id)'].' cilveki<br>';
	
	echo "<br>Izvada cik lieto kad uzbrauc bildes<br><a href='http://faks.sytes.net'><img src='http://faks.sytes.net/ics.gif' width='88' height='31' title='bildi izmanto {$counter_bildes['COUNT(id)']} cilveki' /></a><br>";
	
}

		
echo "</div>"

?>