<!DOCTYPE html>
<html>
<body bgcolor="#C0C0C0"> 
<h1><center>Thank you for your participation! <br><br> Please Be sure to click the Finished button to submit all your information. </center></h1>

<?php






        		$id = "$_POST[id]";
   				$anumerator = "$_POST[anumerator]";
				$adenominator = "$_POST[adenominator]";
				$afterpercentage = $anumerator/$adenominator*100;
				//echo "$afterpercentage",'<br>';
				//echo "$id",'<br>';
				$con=mysqli_connect("localhost","scott","econ499","scott");
				mysqli_query($con,"UPDATE info SET afterpercentage='$afterpercentage'
				WHERE id='$id'");







   	   	echo '<form action="disclaimer.php" method="post">';
       	echo '<center><button type="submit">Finished</center></button>';
		echo '</form>';

?>

</body>
</html> 

