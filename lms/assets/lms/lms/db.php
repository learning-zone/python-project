<?php
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
session_start();

$user=$_SESSION['user'];
$per00=$_SESSION['per00'];
$_DATABASE_=$_SESSION['_DATABASE_'];
if($user=='')
{
  die("Session timed out log in again!");
}
$temp_year_detalis=$_SESSION['AcademicYear'];
?>

<link rel="stylesheet" href="mistStyle.css">
<link rel="stylesheet" href="../mistStyle.css">
<link rel="stylesheet" href="../../mistStyle.css">
<script type="text/javascript">
function goBack()
  {
  window.history.back()
  }
</script>
<?php

	$con  = mysql_pconnect("localhost","root","")
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("oms")

	 or die("<b>could not select database</b>...");
	 //or die(mysql_error());

function execute($sql)
{
	$rs = mysql_query($sql);
	return($rs);
}
function rowcount($rs)
{
	return(mysql_num_rows($rs));
}
function fetchrow($recordset)
{
	return( mysql_fetch_row($recordset));
}
function fetcharray($recordset)
{
	return( mysql_fetch_array($recordset));
}
function collegename()
{
 $name=mysql_query("SELECT col_name  FROM college");
 $colname=mysql_fetch_row($name);
 return($colname[0]);
}
function collegecode()
{
 $name=mysql_query("SELECT col_code  FROM college");
 $colname=mysql_fetch_row($name);
 return($colname[0]);
}

  function scscat1()
  {
	  $temname='DIV';
	  return($temname);
  }
   function scscat2()
  {
	  $temname1='Class';
	  return($temname1);
  }
 function branchname($branch)
{
		$sql=execute("select coursename from course_m where course_id='$branch'");
	$branchname=mysql_fetch_row($sql);
	return($branchname[0]); 
}
 function semname($sem)
{
$rs=execute("SELECT year_name FROM course_year where year_id='$sem'");
	$classname=mysql_fetch_row($rs);
	return($classname[0]); 
}
 function secname($sec)
{
$rs=execute("select section_name from class_section where id='$sec'");
	$section_name=mysql_fetch_row($rs);
	return($section_name[0]); 
}
function collegeadress()
{
 $name=mysql_query("SELECT col_addr , col_pin  FROM college");
 while($rt=mysql_fetch_array($name))
 {
  $addres=$rt[0]." ".$rt[1];
 }
 return($addres);
}



function data_seek($rs,$index)
{
	return (mysql_data_seek($rs,$index))
        or die("Error While Data Seek.<br><i>" . error_description() . "</i>");
}
function error_description()
{
	return("[" . error_no() . "];" );
}
function error_no()
{
	return mysql_errno();
}
function BeginTrans()
{
	mysql_query($con,"begin");
}
function CommitTrans()
{
	mysql_query($con,"commit");
}
function RollBack()
{
	mysql_query($con,"rollback");
}
function numfields($rs)
{
        return(mysql_num_fields($rs));
}
function aphostropi1($rs)
{
       $rs1=str_replace("'","~^:",$rs);
	   return($rs1);
}
function aphostropi2($rs)
{
       $rs1=str_replace("~^:","'",$rs);
	   return($rs1);
}
function fieldname($rs,$i)
{
        return(mysql_field_name($rs,$i));
}
function fetchInsertId()
{
        return( mysql_insert_id() );
}
function DateForm($Curr_Date)
{
$CCur_Date=explode("-",$Curr_Date);
$CDay=$CCur_Date[2];
$CMonth=$CCur_Date[1];
$CYear=$CCur_Date[0];
return $CDay."-".$CMonth."-".$CYear;
}
/*function date_diff($a,$b,$t)
{
	if($t=="d")
	{
		$sql=execute("select to_days('$a')-to_days('$b')") or die(error_description());
		
		$rs=fetcharray($sql,0);
		$NoOfDays=$rs[0];
		return $NoOfDays;
	}
	elseif($t=="m")
	{
		$ToDate=explode("-",$a);
		$NowDate=$ToDate[0].$ToDate[1];

		$LnEndDate=explode("-",$b);
		$LnEDate=$LnEndDate[0].$LnEndDate[1];

		$sql=execute("select period_diff('$NowDate','$LnEDate')") or die(error_description());
		$rs=fetcharray($sql,0);
		$NoOfMonths=($rs[0]);
		return $NoOfMonths;
	}
}*/
function getLastDay($M)
{
	$month=$M;

	if($month=='01')
	{
		$LastDay=31;
	}
	else if($month=='02')
	{
		$LastDay=28;
	}
	else if($month=='03')
	{
		$LastDay=31;
	}
	else if($month=='04')
	{
		$LastDay=30;
	}
	else if($month=='05')
	{
		$LastDay=31;
	}
	else if($month=='06')
	{
		$LastDay=30;
	}
	else if($month=='07')
	{
		$LastDay=31;
	}
	else if($month=='08')
	{
		$LastDay=31;
	}
	else if($month=='09')
	{
		$LastDay=30;
	}
	else if($month=='10')
	{
		$LastDay=31;
	}
	else if($month=='11')
	{
		$LastDay=30;
	}
	else if($month=='12')
	{
		$LastDay=31;
	}
	return $LastDay;
}
function MonthName1($mon)
{
        if($mon == 1) return("January");
        if($mon == 2) return("Febraury");
        if($mon == 3) return("March");
        if($mon == 4) return("April");
        if($mon == 5) return("May");
        if($mon == 6) return("June");
        if($mon == 7) return("July");
        if($mon == 8) return("August");
        if($mon == 9) return("September");
        if($mon == 10) return("October");
        if($mon == 11) return("November");
        if($mon == 12) return("December");
}
function DayName($dd)
{
        if($dd == 1) return("one");
        if($dd == 2) return("two");
        if($dd == 3) return("three");
        if($dd == 4) return("four");
        if($dd == 5) return("five");
        if($dd == 6) return("six");
        if($dd == 7) return("seven");
        if($dd == 8) return("eight");
        if($dd == 9) return("nine");
        if($dd == 10) return("ten");
        if($dd == 11) return("eleven");
        if($dd == 12) return("twelve");
        if($dd == 13) return("thirteen");
        if($dd == 14) return("fourteen");
        if($dd == 15) return("fifteen");
        if($dd == 16) return("sixteen");
        if($dd == 17) return("seventeen");
        if($dd == 18) return("eighteen");
        if($dd == 19) return("nineteen");
        if($dd == 20) return("twenty");
        if($dd == 21) return("twenty_one");
        if($dd == 22) return("twenty_two");
        if($dd == 23) return("twenty_three");
        if($dd == 24) return("twenty_four");
        if($dd == 25) return("twenty_five");
        if($dd == 26) return("twenty_six");
        if($dd == 27) return("twenty_seven");
        if($dd == 28) return("twenty_eight");
        if($dd == 29) return("twenty_nine");
        if($dd == 30) return("thirty");
        if($dd == 31) return("thirty_one");
}
function Sessional_Date($sessional, $course, $acayr, $courseyear)
{
	if($course == 0)
	{
		$query  = "SELECT from_date, to_date FROM sessional_master WHERE course_ID=0";
		$query .= " AND Course_Year_ID='$courseyear'  AND ";
		$query .= "Sessional_Name='$sessional' AND Activated='On'";
	}
	else
	{
		$query  = "SELECT from_date, to_date FROM sessional_master WHERE course_ID='$course'";
		$query .= " AND course_year_id='$courseyear'  AND ";
		$query .= "sessional_name='$sessional' AND activated='On'";
	}
	$rs = execute($query) or die("QUERY $query " . error_description());
	$row = mysql_fetch_array($rs);
	$from_date = $row["from_date"];
	$to_date = $row["to_date"];
	$ses_date = $from_date . ":" . $to_date;
	return $ses_date;
}

function Company_Id($database)
{
	
	$query  = "SELECT * FROM working_year WHERE Activated='On'";
	$rs = execute($query);
	if (rowcount($rs) != 0)
	{
		$row = fetcharray($rs);
		$year1 = substr($row["from_date"],0,4);
		$year2 = substr($row["to_date"],0,4);
		$compid = $row["company_id"] . substr($year1,2,2) . substr($year2,2,2);
		mysql_free_result($rs);
	}
	else
	{
		echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000 SIZE=3><B>";
		
	}
	return $compid;
}
// ENDS
function Check_Date()
{
	$curr_date = date("Y-m-d");
	$query  = "SELECT company_id FROM college";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) > 0)
	{
		$row = fetcharray($rs);
		$college_id = $row["company_id"];
		mysql_free_result($rs);

		$query  = "SELECT * FROM company WHERE ID=$college_id";
		$rs = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($rs) > 0)
		{
			$query  = "SELECT from_date, to_date FROM working_year WHERE company_id=$college_id ";
			$query .= "AND '$curr_date' BETWEEN From_Date AND To_Date";
			$result = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($result) > 0)
			{
				$row1 = fetcharray($result);
				$query  = "UPDATE working_year SET Activated='On' WHERE Company_ID=$college_id ";
				$query .= "AND '$curr_date' BETWEEN From_Date AND To_Date";
				execute($query) or die("UPDATE QUERY : $query " . error_description());

				$query  = "DELETE FROM enter_date";
				execute($query) or die("QUERY $query " . error_description());

				$query  = "INSERT INTO enter_date(Date) VALUES('$curr_date')";
				execute($query) or die("DATE INSERT QUERY : $query " . error_description());
			}
			else
			{
				echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000 SIZE=3><B>Financial Year not Selected !!</B></FONT></DIV>";
				//die();
			}
		}
	}
}
function marks_color($max,$obtained)
{
	if($max >0)
	{
		$marks_percent=number_format((($obtained/$max)*100),1);

		$query  = "SELECT color_code FROM statistics_marks WHERE percent_from  >=0 ";
		$query .= " AND percent_from  <=$marks_percent ";

		$rs = execute($query) or die("QUERY $query " . error_description());
		$row_count=rowcount($rs);
		$row_count=$row_count-1;

		for($kk=0;$kk<rowcount($rs);$kk++)
		{
			$r_color = fetcharray($rs,$kk);
		}
		$color_code = $r_color["color_code"];
		return $color_code;
	}
}
function convert_Amount($amt)
{
	$temp = explode(".", $amt);
	$rupees = $temp[0];
	$paise = $temp[1];

	$amt_array1 = array("adst0m1st", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine");
	$amt_array2 = array("Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
	$amt_array3 = array("adst0m1st", "adst0m1st", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");

	// FOR RUPEES COLUMN.
	// BEGINS HERE.
	$rupees_size = strlen($rupees);
	$temp_size = 1;
	for ($i=$rupees_size-1;$i>=0;$i--)
	{
		if ($temp_size == 1)		// FOR TENS.
		{
			if ($rupees[$i-1] == "0") $amount[$temp_size] = $amt_array1[$rupees[$i]];		// FOR AMOUNT 00 - 09.
			elseif ($rupees[$i-1] == "1") $amount[$temp_size] = $amt_array2[$rupees[$i]];	// FOR AMOUNT 10 - 19.
			elseif ($rupees[$i-1] >= "2")
				$amount[$temp_size] = $amt_array3[$rupees[$i-1]] . " " . $amt_array1[$rupees[$i]];// FOR Amount 20 - 99.
			$i--;
		}
		if ($temp_size == 2)		// FOR HUNDREDS.
		{
			if ($rupees[$i] != 0)
				$amount[$temp_size] = $amt_array1[$rupees[$i]] . " Hundred ";
			if ($amount[$temp_size-1] != "adst0m1st")
				$amount[$temp_size] .= "and ";
		}
		if ($temp_size == 3)		// FOR THOUSANDS.
		{
			if ($rupees[$i-1] == "0") $amount[$temp_size] = $amt_array1[$rupees[$i]];		// FOR AMOUNT 00 - 09.
			elseif ($rupeeOs[$i-1] == "1") $amount[$temp_size] = $amt_array2[$rupees[$i]];	// FOR AMOUNT 10 - 19.
			elseif ($rupees[$i-1] >= "2")
				$amount[$temp_size] = $amt_array3[$rupees[$i-1]] . " " . $amt_array1[$rupees[$i]];// FOR Amount 20 - 99.
			$amount[$temp_size] .= " Thousand ";
			$i--;
		}
		if ($temp_size == 4)		// FOR LAKHS.
		{
			if ($rupees[$i-1] == "0") $amount[$temp_size] = $amt_array1[$rupees[$i]];		// FOR AMOUNT 00 - 09.
			elseif ($rupees[$i-1] == "1") $amount[$temp_size] = $amt_array2[$rupees[$i]];	// FOR AMOUNT 10 - 19.
			elseif ($rupees[$i-1] >= "2")
				$amount[$temp_size] = $amt_array3[$rupees[$i-1]] . " " . $amt_array1[$rupees[$i]];// FOR Amount 20 - 99.
			$amount[$temp_size] .= " Lakh ";
			$i--;
		}
		if ($temp_size == 5)		// FOR CRORES.
		{
			if ($rupees[$i-1] == "0") $amount[$temp_size] = $amt_array1[$rupees[$i]];		// FOR AMOUNT 00 - 09.
			elseif ($rupees[$i-1] == "1") $amount[$temp_size] = $amt_array2[$rupees[$i]];	// FOR AMOUNT 10 - 19.
			elseif ($rupees[$i-1] >= "2")
				$amount[$temp_size] = $amt_array3[$rupees[$i-1]] . " " . $amt_array1[$rupees[$i]];// FOR Amount 20 - 99.
			$amount[$temp_size] .= " Crore ";
			$i--;
		}
		$temp_size++;
	}
	// ENDS HERE.
	/*// FOR PAISE COLUMN.
	// BEGINS HERE.
	if ($paise != "00")
	{
		$paise_amount = " AND ";
		if ($paise[0] == "0") $paise_amount .= $amt_array1[$paise[1]];
		elseif ($paise[0] == "1") $paise_amount .= $amt_array2[$paise[1]];
		elseif ($paise[0] >= "2")
			$paise_amount .= $amt_array3[$paise[0]] . " " . $amt_array1[$paise[1]];
		$paise_amount.= " Paise ";
	}
	else $paise_amount = " ";
	// ENDS HERE.*/

	$amt_in_words = "adst0m1st";
	for ($j=$temp_size;$j>=0;$j--)
	{
		$amt_in_words .= $amount[$j];
	}
	$amt_in_words .= $paise_amount . " Only ";
	return $amt_in_words;
}
function r_singlequote($str)
{
	$str=explode("'",$str) ;
	for ($kl=0;$kl<sizeof($str);$kl++)
	{
		if($strkll=='')
		{
			$strkll=$str[$kl];
		}
		else
		{
		$strkll=$strkll."!^?".$str[$kl] ;
		}
	}
	$str=$strkll ;
	return $str ;
}
function add_singlequote($str)
{
	$str=explode("!^?",$str) ;
	for ($kl=0;$kl<sizeof($str);$kl++)
	{
		if($strkll=='')
		{
			$strkll=$str[$kl];
		}
		else
		{
		$strkll=$strkll."'".$str[$kl] ;
		}
	}
	$str=$strkll ;
	return $str ;
}
function r_comma($str)
{
	$str=explode(",",$str) ;
	for ($kl=0;$kl<sizeof($str);$kl++)
	{
		$strkll=$strkll." ".$str[$kl] ;
	}
	$str=$strkll ;
	return $str ;
}
function remove_sp_cha($str)
{
	$sp="'(),.+=-*;%:>/<?php" ;
	$data=$str ;
	$len=strlen($data) ;
	for($k=0;$k<strlen($sp);$k++)
	{
		for($i=0;$i<strlen($data);$i++)
		{	
			if ($sp[$k]==$data[$i])
			{
				$data[$i]=" ";
			}
			$str=$str.$data[$i] ;
		}
	}
	return substr($str,-$len);
}
function remove_sp_cha1($str)
{
	$sp="'()," ;
	$data=$str ;
	$len=strlen($data) ;
	for($k=0;$k<strlen($sp);$k++)
	{
		for($i=0;$i<strlen($data);$i++)
		{	
			if ($sp[$k]==$data[$i])
			{
				$data[$i]=" ";
			}
			$str=$str.$data[$i] ;
		}
	}
	return substr($str,-$len);
}
?>