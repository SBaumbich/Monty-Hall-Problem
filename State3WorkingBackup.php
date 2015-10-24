
<h2>Please select a door</h2>
<body background="background.jpg">


<?php
error_reporting(E_ALL);
ini_set('display_errors', True);

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

if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_db))
	{
		die($conn_error);
	}

if(isset($_POST['insertdata']))
{
	$mysql ="INSERT INTO info (id, prereq, major, year, gpa, age, gender, doors) VALUES
	('', '$_POST[prereq]', '$_POST[major]', '$_POST[year]', '$_POST[gpa]', '$_POST[age]', '$_POST[gender]', '$door')";
 

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
	echo "The prize is behind door:".$prizedoor."<br>";
	echo "<br>User: ".$subjectid." Trial:".$trial." Phase:".$phase."<br>";
	echo "Select a door<br>";		
	echo '<form action="State3.php" method="post">';
	for($i=0;$i<$door;$i++)
	{
		echo '<input type="image" src="door.jpg" name="door" value="'.$i.'"/>';

	}	
	echo '<input type="hidden" name="phase" value="1">';
	echo '<input type="hidden" name="trial" value="'.$trial.'">';
	echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
	echo '<input type="hidden" name="prizedoor" value="'.$prizedoor.'".>';
	echo '</form>';

	break;

case "1":
	$selecteddoor = $_POST['door'];
	$prizedoor = $_POST['prizedoor'];
	echo "The prize is behind door:".$prizedoor."<br>";

	$doornottoturnover = $prizedoor;
	if($selecteddoor == $doornottoturnover)//we must pick another door to not turn over since the user was correct
	{
		//randomly pick a leftover door
		$temp = $door-2;
		$doornottoturnover = rand(0,$door-2);
		if($doornottoturnover == $selecteddoor)
			$doornottoturnover++;
		
	}
	echo "<br>User: ".$subjectid." Trial:".$trial." Phase:".$phase."<br>";
	echo "Select a door<br>";
        for($i=0;$i<$door;$i++)
        {
		if($i==$selecteddoor)	
		{
			echo 'You picked this door->';

		}
		if(($i==$doornottoturnover)||($i==$selecteddoor))//if either the selected door or the chosen door not to turn over
		{
			echo '<img src="door.jpg"/>';
		}
		else
		{
			echo '<img src="goat.jpg"/>';

		}
		

        }
        echo '<form action="State3.php" method="post">';
	echo '<input type="hidden" name="phase" value="2">';
        echo '<input type="hidden" name="trial" value="'.$trial.'">';
        echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
	echo '<input type="hidden" name="prizedoor" value="'.$prizedoor.'".>';
	echo '<input type="hidden" name="selecteddoor" value="'.$selecteddoor.'".>';
	echo '<input type="hidden" name="doornottoturnover" value="'.$doornottoturnover.'".>';
	echo '<button name="switchdoor" type="submit" value="1">Switch</button>';
	echo '<button name="switchdoor" type="submit" value="0">Keep</button>';
        echo '</form>';


   break;

case "2":
	echo "<br>User: ".$subjectid." Trial:".$trial." Phase:".$phase."<br>";
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
		echo "<br>You won!!!<br>";
	}
	else
	{
		echo "<br>You lost.<br>";
	}
	
	for($i=0;$i<$door;$i++)
        {
                if($i==$finalselecteddoor)
                {
                        echo 'You picked this door->';

                }
                if($i==$prizedoor)//if either the selected door or the chosen door not to turn over
                {
                        echo '<img src="prize.jpg"/>';
                }
                else
                {
                        echo '<img src="goat.jpg"/>';

                }


        }

	
   	echo '<form action="State3.php" method="post">';
        echo '<input type="hidden" name="phase" value="0">';
        $trial++;
	echo '<input type="hidden" name="trial" value="'.$trial.'">';
        echo '<input type="hidden" name="id" value="'.$subjectid.'"/>';
        echo '<button type="submit">Play Again!</button>';
	echo '</form>';
	  $p2data ="INSERT INTO phase2data (id, trial, firstpickeddoor, prizedoor, altdoor, switcheddoor) VALUES
        ('$_POST[id]', '$_POST[trial]', '$_POST[selecteddoor]', '$_POST[prizedoor]', '$_POST[doornottoturnover]', '$_POST[switchdoor]')";
	echo $p2data;
	

}

?>


