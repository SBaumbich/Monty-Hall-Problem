<!DOCTYPE html>
<html>

<body background="background.jpg">


<?php
//error_reporting(E_ALL);
//ini_set('display_errors', True);


if(isset($_POST['door']))
	$door= $_POST['door'];
else
	$door=3;

if(isset($_POST['phase']))
	$phase= $_POST['phase'];
else
	$phase = 0;
if(isset($_POST['trial']))
	$trial=$_POST['trial'];
else
	$trial= 0;

$conn_error = 'Could not connect.';

$mysql_host = 'localhost';
$mysql_user = 'scott';
$mysql_pass = 'econ499';

$mysql_db = 'scott';

$numerator = "$_POST[numerator]";
$denominator = "$_POST[denominator]";
$beforepercentage = $numerator/$denominator*100;


$con=mysqli_connect("localhost","scott","econ499","scott");

if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_db))
	{
		die($conn_error);
	}

if(isset($_POST['insertdata']))
{
	$mysql ="INSERT INTO info (id, prereq, major, year, gpa, age, gender, doors, beforepercentage, afterpercentage) VALUES
	('', '$_POST[prereq]', '$_POST[major]', '$_POST[year]', '$_POST[gpa]', '$_POST[age]', '$_POST[gender]', '$door', '$beforepercentage', ' ')";
 

		if(!mysql_query($mysql))
			die (mysql_error());

			$subjectid = mysql_insert_id();
}	
else
{
		if(isset($_POST['id']))
        	$subjectid= $_POST['id'];
		else
        	$subjectid = 0;

}
	
mysql_close();

switch ($phase)

{
case "0":

	$prizedoor = rand(0,$door-1);
	//echo "The prize is behind door:".$prizedoor."<br>";
	echo "Suppose you're on a game show, and you're given the choice of $door doors: Behind one door is a car; behind the others, goats. You pick a door, say No. 1, and the host, who 	knows what's behind the doors, opens every door except the 	one you have picked (door No. 1) and another door. all the doors turned 	over revealed goats. He then says to you, 'Do you want to switch your choice to the other unopened door?' Is it 	to your advantage to switch your 	choice?"."<br>"."<br>";

	echo "<font size= 14>Please Select A Door</font><br>";	
	echo '<br>';	
	echo '<form action="State3.php" method="post">';
	echo "User: ".$subjectid." Trial: ".$trial." out of 20 <br>";
	
	switch($door)
{
        case 3:
                //$door=3;
				$temp = 0;
			for($i=0;$i<$door;$i++)
				{
					echo '<img src="door.jpg"/>';
				}
					echo '<br/>';					
			for($i=0;$i<$door;$i++)
				{
					$temp++;
					echo '<button name="selecteddoor" type="submit" style="height: 20px; width: 74px;" value="'.$i.'" > Door '.$temp.'</button>';
				}

                break;
        case 13:
                //$door=13;
				$temp = 0;
			for($i=0;$i<$door;$i++)
				{
					echo '<img src="door.jpg"/>';
				}
					echo '<br/>';					
			for($i=0;$i<$door;$i++)
				{
					$temp++;
					echo '<button name="selecteddoor" type="submit" style="height: 20px; width: 74px;" value="'.$i.'" > Door '.$temp.'</button>';
				}
                break;

        case 52: // 13 * 4
                //$door=52;
        		$tempUser = 0;
        		$tempServer = 0;
				$doorR = 4;
				$doorC = 13;
			for($j=0;$j<$doorR;$j++){
			for($i=0;$i<$doorC;$i++)
				{
					echo '<img src="door.jpg"/>';
				}
					echo '<br/>';					
			for($i=0;$i<$doorC;$i++)
				{
					$tempUser++;
					echo '<button name="selecteddoor" type="submit" style="height: 20px; width: 74px;" value="'.$tempServer.'" > Door '.$tempUser.'</button>';
					$tempServer++;
				}
				echo '<br/>';
			}
				
                break;
}	


	echo '<input type="hidden" name="phase" value="1">';
	echo '<input type="hidden" name="trial" value="'.$trial.'">';
	echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
	echo '<input type="hidden" name="prizedoor" value="'.$prizedoor.'".>';
	echo '<input type="hidden" name="door" value="'.$door.'".>';
	echo '</form>';

	break; //end case 0

case "1":
	$selecteddoor = $_POST['selecteddoor'];
	$prizedoor = $_POST['prizedoor'];
	$correctDoorValue = $selecteddoor + 1;
	
	//echo "The prize is behind door:".$prizedoor."<br>";

	$doornottoturnover = $prizedoor; //don't turn over door they picked, don't turn over the door that is a prize; below if completes this logic
	if($selecteddoor == $doornottoturnover)//we must pick another door to not turn over since the user was correct
	{
		//randomly pick a leftover door
		$temp = $door-2;
		$doornottoturnover = rand(0,$door-2);
		if($doornottoturnover == $selecteddoor)
			$doornottoturnover++;
	}
	$alternativeDoor = $doornottoturnover + 1;
	  
	  echo "We have opened all but one unchosen doors such that each opened door revealed a goat.  Do you wish to maintain 	your original door choice or to switch your choice to the 	other unopened door?"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>";
	  //echo "<br>";
	  echo "User:".$subjectid." Trial:".$trial." First Selected Door:".$correctDoorValue." Alternative Door:".$alternativeDoor."<br>";


      

switch($door)
{
        case 3:

 		for($i=0;$i<$door;$i++)
        	{
				if($i==$selecteddoor)	
					{
						echo "<font color='red'>You picked this door--> </font>";
					}
				if(($i==$doornottoturnover)||($i==$selecteddoor))//if either the selected door or the chosen door not to turn over
					{
						echo '<img src="door.jpg"/>';
					}
					else
						{
						echo '<img src="goat.jpg"/>';
						}
        }//end for


        break;
        case 13:

 		for($i=0;$i<$door;$i++)
        	{
				if($i==$selecteddoor)	
					{
						echo "<font color='red'>You picked this door--> </font>";
					}
				if(($i==$doornottoturnover)||($i==$selecteddoor))//if either the selected door or the chosen door not to turn over
					{
						echo '<img src="door.jpg"/>';
					}
					else
						{
						echo '<img src="goat.jpg"/>';
						}
        }//end for


        break;
        case 52:

                //$door=52;
        		$tempUser = 0;
        		$tempServer = 0;
				$doorR = 4;
				$doorC = 13;
			for($j=0;$j<$doorR;$j++){
				for($i=0;$i<$doorC;$i++)
					{
						if($tempServer==$selecteddoor)	
							{
								echo "<font color='red'>You picked this door--> </font>";
							}
						if(($tempServer==$doornottoturnover)||($tempServer==$selecteddoor))//if either the selected door or the chosen door not to turn over
							{
							echo '<img src="door.jpg"/>';
							}
							else
								{
									echo '<img src="goat.jpg"/>';
								}
					$tempServer++;
					}//inner for goes 0-12
					echo '<br/>'.'<br/>';	
			}//outter for goes 0-4


        break;
}//end switch






    echo '<form action="State3.php" method="post">';
	echo '<input type="hidden" name="phase" value="2">';
    echo '<input type="hidden" name="trial" value="'.$trial.'">';
    echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
	echo '<input type="hidden" name="prizedoor" value="'.$prizedoor.'".>';
	echo '<input type="hidden" name="selecteddoor" value="'.$selecteddoor.'".>';
	echo '<input type="hidden" name="doornottoturnover" value="'.$doornottoturnover.'".>';
	echo '<input type="hidden" name="door" value="'.$door.'".>';
	echo '<button name="switchdoor" type="submit" value="1">Switch Doors</button>';
	echo '<button name="switchdoor" type="submit" value="0">Keep Door</button>';
    echo '</form>';


   break; //end case 1

case "2":
	$time = time();
	$timestamp = date ('M d, Y H:i:s', $time);
	//echo "the times is".$actualtime."<br>";
	//echo "<br>User: ".$subjectid." Trial:".$trial." Phase:".$phase."<br>";
	$selecteddoor = $_POST['selecteddoor'];
    $prizedoor = $_POST['prizedoor'];
	$switched = $_POST['switchdoor'];
	$doornottoturnover = $_POST['doornottoturnover'];
		if($switched == 1)
			{
			$finalselecteddoor = $doornottoturnover;
			}
			else
				{
					$finalselecteddoor = $selecteddoor;
				}
	
		if($finalselecteddoor == $prizedoor)
		{
			echo "<font size= 14>You Won</font><br><br>";
			$winloss = 1;
		}
			else
				{
					echo "<font size= 14>You Lost</font><br><br>";
					$winloss = 0;
				}

		echo "<br>"."<br>"."<br>"."<br>";

switch($door)
{
        case 3:

        $correctDoorValue = $selecteddoor + 1;
		$alternativeDoor = $doornottoturnover + 1;
        echo "User:".$subjectid." Trial:".$trial." First Selected Door:".$correctDoorValue." Alternative Door:".$alternativeDoor."<br>";
 		for($i=0;$i<$door;$i++)
        	{
				if($i==$finalselecteddoor)
                	{
                        echo "<font color='red'>You picked this door--> </font>";

                	}
                if($i==$prizedoor)//if either the selected door or the chosen door not to turn over
                	{
                        echo '<img src="prize.jpg"/>';
                	}
                	else
                		{
                        	echo '<img src="goat.jpg"/>';
               			}
        }//end for


        break;
        case 13:
        $correctDoorValue = $selecteddoor + 1;
		$alternativeDoor = $doornottoturnover + 1;
		echo "User:".$subjectid." Trial:".$trial." First Selected Door:".$correctDoorValue." Alternative Door:".$alternativeDoor."<br>";
 		for($i=0;$i<$door;$i++)
        	{
				if($i==$finalselecteddoor)
                	{
                        echo "<font color='red'>You picked this door--> </font>";

                	}
                if($i==$prizedoor)//if either the selected door or the chosen door not to turn over
                	{
                        echo '<img src="prize.jpg"/>';
                	}
                	else
                		{
                        	echo '<img src="goat.jpg"/>';
               			}
        }//end for


        break;
        case 52:
        $correctDoorValue = $selecteddoor + 1;
		$alternativeDoor = $doornottoturnover + 1;
		echo "User:".$subjectid." Trial:".$trial." First Selected Door:".$correctDoorValue." Alternative Door:".$alternativeDoor."<br>";

                //$door=52;
  
        		$tempServer = 0;
				$doorR = 4;
				$doorC = 13;
			for($j=0;$j<$doorR;$j++){
				for($i=0;$i<$doorC;$i++)
					{
				
					if($tempServer==$finalselecteddoor)
                		{
                        	echo "<font color='red'>You picked this door--> </font>";
    	            	}
                	if($tempServer==$prizedoor)//if either the selected door or the chosen door not to turn over
                		{
                        	echo '<img src="prize.jpg"/>';
                		}
                		else
                			{
                        		echo '<img src="goat.jpg"/>';
               				}
					$tempServer++;
					}//inner for goes 0-12
					echo '<br/>'.'<br/>';	
			}//outter for goes 0-4

}



	if($trial < 19) 
		{
   			echo '<form action="State3.php" method="post">';
       		echo '<input type="hidden" name="phase" value="0">';
       		$trial++;
			echo '<input type="hidden" name="trial" value="'.$trial.'">';
       		echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
			echo '<input type="hidden" name="door" value="'.$door.'".>';
       		echo '<button type="submit">Play Again!</button>';
			echo '</form>';

			$p2data = "INSERT INTO phase2data (id, trial, firstpickeddoor, prizedoor, altdoor, switcheddoor, winloss, timestamp) VALUES('$_POST[id]', '$_POST[trial]', '$_POST[selecteddoor]', '$_POST[prizedoor]', '$_POST[doornottoturnover]', '$_POST[switchdoor]','$winloss','$timestamp')";

			mysqli_query ($con, $p2data);
		}
	
		else if ($trial = 19) 
			{

   				echo '<form action="test.php" method="post">';
   				echo '<input type="hidden" name="phase" value="0">';
   				$trial++;
   				echo '<input type="hidden" name="trial" value="'.$trial.'">';
   				echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
   				echo '<input type="hidden" name="door" value="'.$door.'".>';
   				echo 'Now that you have played the game 20 times through, I ask you again, what fraction of the time would you expect to win by switching to the other unopened door?';
   				echo '<br><br>';
   				echo '<input type="text" name="anumerator" size="1" maxlength="2"><br>';
   				echo '-----';
   				echo '<br>';
   				echo '<input type="text" name="adenominator" size="1" maxlength="2" value='.$door.'><br><br>';
   				echo '<button type="submit">Submit</button>';
   				echo '</form>';


   				$anumerator = "$_POST[anumerator]";
				$adenominator = "$_POST[adenominator]";
				$afterpercentage = $anumerator/$adenominator*100;
				$id = "$_POST[id]";


				//mysqli_query($con,"UPDATE info SET afterpercentage='$afterpercentage'
				//WHERE id='$id'");
				//mysqli_close($con);

   			
				$p2data = "INSERT INTO phase2data (id, trial, firstpickeddoor, prizedoor, altdoor, switcheddoor, winloss, timestamp) VALUES('$_POST[id]', '$_POST[trial]', '$_POST[selecteddoor]', '$_POST[prizedoor]', '$_POST[doornottoturnover]', '$_POST[switchdoor]','$winloss','$timestamp')";

   				mysqli_query ($con, $p2data);
   				mysqli_close($con);
			}
}
?> <!--end php-->

<body/>
<html/>
