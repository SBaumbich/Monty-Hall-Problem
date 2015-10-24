
<?php
$door = rand(0,2);
switch($door)
{
        case 0:
                $door=3;
                break;
        case 1:
                $door=13;
                break;
        case 2:
                $door=52;
                break;


}
echo "Please provide the following information:";
//echo "$door";

?>
<h1><center></center></h1>
<body bgcolor="#C0C0C0"> 
<form name="input" action="State3.php?phase=0" method="post">


Current age:   <input type="text" name="age" size="1" maxlength="2"> <br/>
<br/>
Gender: <input type="radio" name="gender" value="Male">Male  or <input type="radio" name="gender" value="Female">Female<br/>
<br/>

Year:
<select name="year">

<option value="Freshman">Freshman</option>

<option value="Sophomore">Sophomore</option>

<option value="Junior">Junior</option>

<option value="Senior">Senior</option>

<option value="Other" >Other</option>

</select>

Major: <input type="text" name="major"> <br/>
<br/>
Current GPA: <input type="text" name="gpa" size="5" maxlength="5"> <br/>
<br/>
Taken a course in probability or statistics: <input type="radio" name="prereq" value="Yes">Yes  or <input type="radio" name="prereq" value="No">No<br/>
<br/>
<input type="hidden" name="door" value="<?php echo "$door"; ?> ">
<input type="hidden" name="phase" value="0">
<input type="hidden" name="trial" value="0">


Suppose you're on a game show, and you're given the choice of <?php echo "$door"; ?> doors: Behind one door is a car; behind the others, goats. You pick a door, say No. 1, and the host, who knows what's behind the doors, opens every door except the one you have picked (door No. 1) and another door. all the doors turned 	over revealed goats. He then says to you, 'Do you want to switch your choice to the other unopened door?' Is it to your advantage to switch your choice?"
<br>
<br>
What fraction of the time would you expect to win by switching to the other unopened door?<br><br>
<input type="text" name="numerator" size="1" maxlength="2"><br>
-----<br>
<input type="text" name="denominator" size="1" maxlength="2" value="<?php echo "$door"; ?> "><br><br>

<input type="submit" name="insertdata" value="Submit" >
</form>