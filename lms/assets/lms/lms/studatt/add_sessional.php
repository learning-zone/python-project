<?php
session_start();
require("../db.php");
$date1=explode("-",date("d-m-Y"));
echo "$firstyear";
echo "$first_course";
echo "$Type";
$academic_year=date("Y");
if(trim($Type) == "Add")
{
	if($Course ==0)
	{
		$sql= "SELECT * FROM sessional_master where  Course_Year_ID=$CYear and Academic_Year=$academic_year and Sessional_ID='$sessional_name'";
	}
	else
	{
		$sql= "SELECT * FROM sessional_master where Course_ID=$Course and Course_Year_ID=$CYear and Academic_Year=$academic_year and Sessional_ID='$sessional_name'";

	}
     $rs23=execute($sql);
	  if(rowcount($rs23)==0)
	{
		if(!checkdate($from_mon,$from_day,$from_year))
		{
			echo "<font color=royalblue;><b>Invalid Start Date .</b> </font>";
			die("</td></tr></table>");
		}
		$start_date = "$from_year-$from_mon-$from_day";

		if(!checkdate($to_mon,$to_day,$to_year))
		{
			echo "<font color=royalblue;><b>Invalid End Date .</b> </font>";
			die("</td></tr></table>");
		}
		$end_date = "$to_year-$to_mon-$to_day";

		if($sessional_name=='SL1')
		{
			$Sessional='First';
		}
		elseif($sessional_name=='SL2')
		{
			$Sessional='Second';
		}
		elseif($sessional_name=='SL3')
		{
			$Sessional='Third';
		}
		elseif($sessional_name=='SL4')
		{
			$Sessional='Fourth';
		}
		elseif($sessional_name=='SL5')
		{
			$Sessional='Fifth';
		}
		elseif($sessional_name=='SL6')
		{
			$Sessional='Sixth';
		}
		elseif($sessional_name=='SL7')
		{
			$Sessional='Seventh';
		}
		elseif($sessional_name=='SL8')
		{
			$Sessional='Eighth';
		}
		$Sessional_ID=$sessional_name;
		if($Course ==0)
		{
		$query  = "INSERT INTO sessional_master(Sessional_ID, Sessional_Name, Course_ID, ";
		$query .= "Course_Year_ID, Academic_Year, From_Date, To_Date, Activated) VALUES(";
		$query .= "'$Sessional_ID', '$Sessional', '$Course', '$CYear', ";
		$query .= "$academic_year, '$start_date', '$end_date', 'On')";

		}
		else
		{
		$query  = "INSERT INTO sessional_master (Sessional_ID, Sessional_Name, Course_ID, ";
		$query .= "Course_Year_ID, Academic_Year, From_Date, To_Date, Activated) VALUES(";
		$query .= "'$Sessional_ID', '$Sessional', '$Course', '$CYear', ";
		$query .= "$academic_year, '$start_date', '$end_date', 'On')";
		}
		
		$msg= 'Inserted Successfully';
		execute($query) or die("QUERY $query " . error_description());

	}
	else
	{
		$msg='Already Entered This Sessional Details';
	}
	header("Location:Sessional_Master.php?Course=" . $Course . "&CYear=" . $CYear."&academic_year=".$academic_year ."&msg=".$msg."&ctype=".$ctype);
}
elseif(trim($Type) == "Mod")
{

	while( list(,$Value) = each($check) )
	{
  		$sessional_name_id = "sessional_name".$Value;
		$sessional_id = trim($$sessional_name_id);
		if($sessional_id=='SL1')
		{
			$Sessional='First';
		}
		elseif($sessional_id=='SL2')
		{
			$Sessional='Second';
		}
		elseif($sessional_id=='SL3')
		{
			$Sessional='Third';
		}
		elseif($sessional_id=='SL4')
		{
			$Sessional='Fourth';
		}
		elseif($sessional_id=='SL5')
		{
			$Sessional='Fifth';
		}
		elseif($sessional_id=='SL6')
		{
			$Sessional='Sixth';
		}
		elseif($sessional_id=='SL7')
		{
			$Sessional='Seventh';
		}
		elseif($sessional_id=='SL8')
		{
			$Sessional='Eighth';
		}
		$from_mon_temp = "from_mon".$Value;
		$from_mon_temp = trim($$from_mon_temp);
		$from_day_temp = "from_day".$Value;
		$from_day_temp = trim($$from_day_temp);
		$from_year_temp = "from_year".$Value;
		$from_year_temp = trim($$from_year_temp);
		$to_mon_temp = "to_mon".$Value;
		$to_mon_temp = trim($$to_mon_temp);
		$to_day_temp = "to_day".$Value;
		$to_day_temp = trim($$to_day_temp);
		$to_year_temp = "to_year".$Value;
		$to_year_temp = trim($$to_year_temp);
	
		if(!checkdate($from_mon_temp,$from_day_temp,$from_year_temp))
		{
			echo "<font color=royalblue;><b>Invalid Start Date .</b> </font>";
			die("</td></tr></table>");
		}
		$start_date = "$from_year_temp-$from_mon_temp-$from_day_temp";
		if(!checkdate($to_mon_temp,$to_day_temp,$to_year_temp))
		{
			echo "<font color=royalblue;><b>Invalid End Date .</b> </font>";
			die("</td></tr></table>");
		}
		$end_date = "$to_year_temp-$to_mon_temp-$to_day_temp";
		$query  = "UPDATE sessional_master SET From_Date='$start_date', To_Date='$end_date' " ;
		$query .= "WHERE Course_ID='$Course' AND Course_Year_ID='$CYear' AND Sessional_ID='$sessional_id' AND ";
		$query .= "Sessional_Name='$Sessional' AND Activated='On'";
        execute($query) or die(error_description());
		$msg= 'Modified Successfully';
	}
	header("Location:Sessional_Master.php?Course=" . $Course . "&CYear=" . $CYear."&academic_year=".$academic_year ."&msg=".$msg."&ctype=".$ctype);
}
elseif(trim($Type) == "Del")
{
	while(list(,$Value) = each($check))
	{
		$qry="delete from sessional_master where Sl_No=$Value";
		execute($qry) or die("Erron in deletion".error_description());
	}
	$msg='Deleted Successfully';
	header("Location:Sessional_Master.php?Course=" . $Course . "&CYear=" . $CYear."&academic_year=".$academic_year ."&msg=".$msg."&ctype=".$ctype);
}
?>
