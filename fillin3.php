<html><head>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type">  
</head>

<?php
$con=mysql_connect("localhost", "dipak", "tmp123") or die(mysql_error());
mysql_set_charset("UTF8",$con) or die(mysql_error());
mysql_select_db ("hwn_linking") or die(mysql_error());

$query = "SELECT * from imageeval";

echo $query;
$exec=mysql_query($query) or die(mysql_error());

while($fetchdata=mysql_fetch_array($exec)){
	
	$id=$fetchdata['hinid'];
	//echo "</br>".$id;
	//$exec2=mysql_query("SELECT english_id from english_hindi_id_mapping where hindi_id=$id");
	//$fetchdata2=mysql_fetch_row($exec2);
	//$english_id=$fetchdata2[0];
	//echo $english_id."</br>";
	//$exec2=mysql_query("UPDATE imageeval SET engid='$english_id' WHERE hinid='$id'");
	$exec2=mysql_query("SELECT synset from iwn_web_unicode.tbl_all_synset where synset_id=$id");
	$fetchdata2=mysql_fetch_row($exec2);
	$words=$fetchdata2[0];
	$exec3=mysql_query("UPDATE imageeval SET hindi_words='$words' WHERE hinid='$id'");
}
echo "Done!";
mysql_close($con);
?>


