<?php
header('Content-Type: text/html;charset=UTF-8');
$con=mysql_connect("localhost", "dipak", "tmp123") or die(mysql_error());
mysql_set_charset("UTF8",$con) or die(mysql_error());
mysql_select_db ("hwn_linking") or die(mysql_error());

$id=$_GET['synsetid'];
$winnerimage=$_GET['winnerimage'];
$precision=$_GET['precision'];

$query="UPDATE imageeval SET winner_image=$winnerimage WHERE hinid=$id";
$exec=mysql_query($query);
$query1="UPDATE imageeval SET p3=$precision WHERE hinid=$id";
$exec1=mysql_query($query1);
$query2="UPDATE imageeval SET eval=1 WHERE hinid=$id";
$exec2=mysql_query($query2);
