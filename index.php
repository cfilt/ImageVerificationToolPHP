<html><head>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type"> 
<link rel="stylesheet" href="src/css/bootstrap.css">

<script language="javascript" type="text/javascript" src="src/js/jquery.js"></script>
<script>
    $(document).ready(function(){
			$("#submit").click(function(event) {
				event.preventDefault();
				//alert("asdadsd");
				var synsetid = $("#id").val();
				var start = $("#start").val();
				var counter = $("#counter").val();
				var winnerimage = 6;
				
				if ($("#winnerimage0").length){
					if (document.getElementById('winnerimage0').checked) {
						winnerimage = 0;
					}
				}
				if ($("#winnerimage1").length){
					if (document.getElementById('winnerimage1').checked) {
						winnerimage = 1;
					}
				}	
				if ($("#winnerimage2").length){
					if (document.getElementById('winnerimage2').checked) {
						winnerimage = 2;
					}
				}
				if ($("#winnerimage3").length){
					if (document.getElementById('winnerimage3').checked) {
						winnerimage = 3;
					}
				}
				
				var p0 = 0;
				if ($('#check0').is(":checked"))
				{
					p0=1;
				}
				
				var p1 = 0;
				if ($('#check1').is(":checked"))
				{
					p1=1;
				}
				
				var p2 = 0;
				if ($('#check2').is(":checked"))
				{
					p2=1;
				}
				var precision = 0.0;
				precision = (p0+p1+p2)/counter;
				//alert(p0);
				//alert(p1);
				//alert(p2);
				//alert(winnerimage);
				//alert(precision);
				//alert(start);
				//alert(counter);	
				if(winnerimage!=6){
					$.ajax({
						type: "GET",
						url: "submit.php",
						data: "synsetid=" + synsetid + "&winnerimage=" + winnerimage + "&precision=" + precision,
						success: function(response){
							start=parseInt(start)+1;
							window.location = '?start='+start;
							//alert(response);
						}
					});
				}else{
					alert("Please select an option!");
				}
				});
			});
			$(document).ready(function(){
				$("#pass").click(function(event) {
					event.preventDefault();
					var start = $("#start").val();
					start=parseInt(start)+1;
					window.location = '?start='+start;
				});
			});
			$(document).ready(function(){
				$("#move").click(function(event) {
					event.preventDefault();
					var start = $("#start").val();
					start=parseInt(start)+1;
					window.location = '?start='+start;
				});
			});
    </script>
<style>
#aboutimages {
    background:#ddd;
    position:relative;
}

#aboutimgleft {
    float:left;
    margin-left:30px;
} 

#aboutimgcenter {
    margin: 0 auto;
}
#aboutimgright {
    position:absolute;
    top:0;
    right:30px;
} 
#aboutimages > div{
    width:100px;
    height:100px;
    
    /* added for style */
    background:#333;
    color:#fff;
    font-size:90px;
}
.fblogo {
    display: inline-block;
    margin-left: 3%;
    margin-right: auto;
    height: 25px; 
}

#images{
    text-align:center;
}
</style>
</head>

<?php
$con=mysql_connect("localhost", "dipak", "tmp123") or die(mysql_error());
mysql_set_charset("UTF8",$con) or die(mysql_error());
mysql_select_db ("hwn_linking") or die(mysql_error());

$start=$_GET['start'];

//echo $start;

$query = "SELECT * from imageeval WHERE srno=".$start." AND eval=0";

//echo $query;
$exec=mysql_query($query) or die(mysql_error());

while($fetchdata=mysql_fetch_array($exec)){
	
	$id=$fetchdata['hinid'];
	//echo "</br>".$id;
	
}

if($id!=null){

echo "<div id='container'>";

echo "<input type=hidden id=id name=id value=$id></input>";
echo "<input type=hidden id=start name=start value=$start></input>";

$query = "SELECT * from imageeval WHERE hinid=$id";
$exec=mysql_query($query) or die(mysql_error());
while($fetchdata=mysql_fetch_array($exec)){
	
	$hinwords=$fetchdata['hindi_words'];
	$gloss=$fetchdata['gloss'];
	$engwords=$fetchdata['eng_words'];
	
}

$counter=0.0;
	
if(file_exists("images/$id/0")==1){
echo "<div id='image1' class='fblogo' id='aboutimgleft'>

		<img src='images/$id/0' alt='0' >
		<br/>
		<br/>
		<input type='radio' id='winnerimage0' name='winnerimage' value='0'>
		<input type='checkbox' id='check0' name='image0'>


	</div>";
$counter=$counter+1;
}
if(file_exists("images/$id/1")==1){

echo "<div id='image2' class='fblogo' id='aboutimgcenter'>

		<img src='images/$id/1' alt='1'>
		<br/>
		<br/>
		<input type='radio' id='winnerimage1' name='winnerimage' value='1'>
		<input type='checkbox' id='check1' name='image1'>


	</div>";
$counter=$counter+1;

}

if(file_exists("images/$id/2")==1){

echo "<div id='image3' class='fblogo' id='aboutimgright'>

		<img src='images/$id/2' alt='2' >
		<br/>
		<br/>
		<input type='radio' id='winnerimage2' name='winnerimage' value='2'>
		<input type='checkbox' id='check2' name='image2'>


	</div>";
$counter=$counter+1;

}

if(file_exists("images/NOT.png")==1){

echo "<div id='image3' class='fblogo'>

		<img src='images/NOT.png' alt='3' style='width:150px;height:150px;'>
		<br/>
		<br/>
		<input type='radio' id='winnerimage3' name='winnerimage' value='3'>

	</div>";
	
}
echo "<input type=hidden id=counter name=counter value=$counter></input>";

echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br><h2 align=center>";
echo $engwords."</br>";
echo $hinwords."</br>";
echo $gloss."</br>";
echo "</h2></br>
<center><a class='btn btn-lg btn-success' style='margin:2px;' id='submit' target='_blank'>Submit and proceed</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class='btn btn-lg btn-danger' style='margin:2px;' id='pass' target='_blank'>I can't decipher!</a>
</center>
";

echo "</div>";


}
else{
	echo "<input type=hidden id=start name=start value=$start></input>";
	echo "This image has been tagged! Please continue.
	<a class='btn btn-lg btn-success' style='margin:2px;' id='move' target='_blank'>Move on!</a>
	";
}
?>


