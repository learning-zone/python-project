
<?php
session_start();
include("../../db.php");
$hostel = $_POST['hostel']; 
$apply = $_POST['apply'];
$student = $_POST['student'];
$fee = $_POST['fee'];
if(!$_POST['fee'])
{
	?>
    <script language="javascript">
	alert("Please select FEE TYPE");
    </script>
    <?php
}
/*
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}
*/
/*

					$query  = "SELECT b.*, a.fee_name,c.doc_id,d.id,d.s_id,g.student_id FROM hostel_fee_type a, fee_h_det b,doc_m c, h_stud_m d,student_m g  ";

					$query .= "WHERE b.hostel_type='Y' AND  b.stud_id=d.id and a.fee_id=b.fee_id  and b.doc_id=c.doc_id and d.s_id=g.student_id";

					$query .= " ORDER BY b.doc_id DESC";

					$result = execute($query) or die("QUERY $query " . error_description());




if (rowcount($result) != 0)

{
//$MyArray=array();


	while ($rw1 = fetcharray($result))
	{
			$id=$rw1[stud_id];
			$query  = "SELECT DISTINCT(a.doc_id) AS doc,d.id, a.* FROM doc_m a,h_stud_m d, ";
				    $query .= "doc_amt b WHERE a.stud_id=$id  AND a.doc_type='R' AND ";
				    $query .= "a.doc_id=b.doc_id AND b.hostel_type='Y' AND b.fee_id=$rw1[fee_id] ";

				    $query .= " ORDER BY a.doc_date ASC";

					//echo $query;
				    $rs = execute($query) or die("QUERY $query " . error_description());


					$query  = "SELECT DISTINCT(a.doc_id) AS doc, a.* FROM $database.doc_m a, ";

				    $query .= "$database.doc_amt b WHERE a.stud_id=$id AND a.doc_type='R' AND ";

				    $query .= "a.doc_id=b.doc_id AND b.hostel_type='Y' AND b.fee_id=$rw1[fee_id] ";

					$query .= " ORDER BY a.doc_date ASC";




if ($rw1["installment"] != 0)

		    $feename = $rw1["fee_name"] ." - Inst ". $rw1["installment"];


else

		    $feename = $rw1["fee_name"];

		    $academic_term = $rw1["academic_term"];



if ($rw1["paid"] == "No")

{
		    $demand = number_format($rw1["fee_amount"],2,".","");

		    $paid = number_format(($rw1["fee_amount"] - $rw1["amt"]),2,".","");

		    $balance = number_format($rw1["amt"],2,".","");
}
elseif ($rw1["paid"] == "Yes")
{

if (($rw1["fee_amount"] - $rw1["amt"]) == 0)

{

		    $paid = number_format($rw1["amt"],2,".","");

		    $balance = number_format(0,2,".","");



}

else

{

		    $paid= number_format(($rw1["fee_amount"] - $rw1["amt"]),2,".","");


		    $balance = number_format($rw1["amt"],2,".","");




}

}


if($rw1["fee_id"]==4 )
{
	$temp1 = $rw1["fee_amount"];

	//$MyArray[$rw1["s_id"]]=$temp1;

}
elseif($rw1["fee_id"]==7)
{
	$temp2 =$rw1["fee_amount"];

}

}

}

	                mysql_free_result($result);




while(list($key,$val)=each($MyArray))
{
	echo "Key == ".$key."    val == ".$val."<br>";
}


//$tem=$temp1-$temp2;

?>

*/
//<?


// THIS PART IS FOR APPLYING THE FEES BY HOSTEL STUDENTS.

$messbll=0;
if (isset($apply))
{
	while(list($key, $value) = each($student))
	{
		//echo "start";
		//echo $value;
		$a=$value;
		$query  = "SELECT * FROM student_m WHERE id='$value'";
		//echo $query;
		$res1 = execute($query) or die("QUERY $query " . error_description());
		/*$query  = "SELECT a.id,a.student_id,a.first_name, a.last_name ";
		$query .= " FROM  $database.$table1 a,$database.$table2 b  WHERE $field1='$row13[s_id]' AND a.$field1='$uni_id'";
		echo $query;
		$stud_det1=execute($query);
		$stud_det=fetcharray($stud_det1);
		$uni_id    = $stud_det["id"];*/
		//$s_id=$stud_det["student_id"];
		//echo $s_id;
		if (rowcount($res1) == 0)
		{			
			$query  = "SELECT * FROM additional_student WHERE student_id='$value'";
			$res1 = execute($query) or die("QUERY $query " . error_description());
			$row1 = fetcharray($res1);
			$stud_id = $row1["id"];
			//$stud_id=$row["student_id"];
			//echo $stud_id;
			$uni_id=$stud_id;
			mysql_free_result($res1);
		}
		else
		{			
			$row1 = fetcharray($res1);
			$stud_id = $row1["id"];
			//echo $stud_id;
			mysql_free_result($res1);
		}
		//print_r($fee);
		while(list($key, $val) = each($fee))
		{
			//echo "inside while loop";
			// DO NOT APPLY FEE IF THE FEE HAS NOT BEEN PAID.
			//$fee_amt = "fee_amt$val";
			//$fee_amt = $$fee_amt;
			$fee_amt = $_POST["fee_amt".$val];
//			echo $fee_amt;
			//$day_temp = "due_dd$val";
			//$day_temp = $$day_temp;
			$day_temp = $_POST["due_dd".$val];
			//$doc_temp = "doc_id$val";
			//$doc_temp = $$doc_temp;
			//$month_temp = "due_mm$val";
			//$month_temp = $$month_temp;
			$month_temp = $_POST["due_mm".$val];
			//$year_temp = "due_yy$val";
			//$year_temp = $$year_temp;
			$year_temp = $_POST["due_yy".$val];
			$due_date=$year_temp."-".$month_temp."-".$day_temp;
			//$inst = "installment$val";
			//$inst = $$inst;
			$inst  = $_POST["installment".$val];
			//$term = "term$val";
			//$term = $$term;
			$term  = $_POST["term".$val];
			$query  = "SELECT * FROM hostel_fee_m WHERE fee_id=3";
//			echo $query;
			$res1 = execute($query) or die("QUERY $query " . error_description());
			$row1 = fetcharray($res1);
			$fee_id = $row1["fee_id"];
			//echo $fee_id;
			mysql_free_result($res1);
			$query  = "SELECT * FROM fee_h_det  WHERE stud_id=$stud_id AND fee_id=3 and paid='Yes' ";
			//echo $query;
			//$query  = "SELECT * FROM fee_h_det WHERE stud_id=$stud_id AND fee_id=$fee_id and ";
			//$query .= " installment=$inst AND paid='No' AND hostel_type='Y'";
			$res1 = execute($query) or die("QUERY $query " . error_description());
			if(rowcount($res1) >= 0)
			{
				$sql  = "INSERT INTO fee_h_det(stud_id,fee_id,fee_amount,amt,paid,due_date,hostel_type)  VALUES ($stud_id,'3','$fee_amt','$fee_amt','Yes','$due_date','Y') ";				
					//echo $sql."<br>";
					//echo $sql;
					execute($sql) or die("QUERY $sql " . error_description());
					$lst = 1;
			}
			/*
			else
			{
				//echo "Inside Else...<br>";
				//$sql  = "UPDATE fee_h_det SET fee_amount=$fee_amt1,amt=$fee_amt1 WHERE stud_id='$stud_id' and fee_id=7";
				$sql  = "UPDATE fee_h_det SET fee_amount=$fee_amt1,amt=$fee_amt1,paid='Yes' WHERE stud_id='$stud_id' and fee_id=7";
				//echo $sql;
				execute($sql) or die("QUERY $sql " . error_description());
				$lst = 1;
			}*/
			}
			reset($fee);
			if($lst)
			{
				// FEES ALREADY APPLIED.
				$app++;
			}
			$lst = 0;
			}
			//echo "<DIV ALIGN='CENTER'><B>";
			//echo "Fees Applied Successfully !!</B></DIV>";
			?>
            <script type="text/javascript"?
			alert(Fees Applied Successfully !!);
			</script>
            <?
			//	echo "<BR><DIV ALIGN='LEFT'><B>";
			//	echo "Selected Fees applied to $app of $num_student Students !!</B></DIV>";
			//	echo "<BR><DIV ALIGN='LEFT'><B>";
			//	echo "The figure indicates a collective figure, all the fees might not have been applied ";
			//	echo "to the above listed number of students. The reason being that the fees might already ";
			//	echo "have been applied to that student !!</B></DIV>";
			}
			// ENDS HERE.
			$mesg  = "<BR><BR><DIV ALIGN='CENTER' SIZE='2'>";
			$mesg .= "To Add the fee Amount to <U>all</U> students, Please Check the Details and  then click Apply button.";
			$mesg .= "</DIV><HR>";
//?>

<HTML>

<HEAD>

<TITLE>APPLY FEE BY HOSTEL</TITLE>

<SCRIPT LANGUAGE="JavaScript">

<!--


function formSubmit(frm)
{
	if(document.frm.hostel.selectedIndex != 0)
	{
		document.frm.submit();
		return true;
	}
	else
	{
		alert("Please select a Hostel!!");
		return false;
	}
	}


//-->
function getvalue()
{
document.frm.action="messbill.php";
document.frm.submit();
}

</SCRIPT>

</HEAD>

<BODY>

<CENTER>

<FORM METHOD="POST" ACTION="messbill.php" NAME="frm" onSubmit="return formSubmit(this.form)">

<TABLE CLASS="forumline" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="30%">

<TBODY>

<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="3">APPLY MESSBILL BY HOSTEL</TD></TR>

<TR>

	<TD>Hostel</TD>

	<TD><SELECT NAME="hostel" SIZE="1">

		<OPTION VALUE="0">-- Select Hostel--</OPTION>

		<?php

		$query = "SELECT * FROM hostel_m";

		$rs = execute($query) or die("QUERY $query " . error_description());

		if (rowcount($rs) != 0)

		{

			while ($row = fetcharray($rs))

			{

				if ($row["id"] == $hostel)

					echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";

				else

					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";

			}

			mysql_free_result($rs);

		}

		?>

		</SELECT>

	</TD>
</TBODY>

</TABLE>
<br>
	<center><INPUT TYPE="SUBMIT" NAME="<< SUBMIT >>" CLASS="bgbutton" VALUE="Submit"></center>





<?=$mesg?>


<?

if ((!empty($hostel)) || ($hostel != 0))
{
	// FOR TAKING HOSTEL NAME
	$query  = "SELECT hostel_name FROM hostel_m WHERE id=$hostel";
	$rs = execute($query) or die("QUERY $query " . error_description());
	$row = fetcharray($rs);
	$HostelName = $row["hostel_name"];
	mysql_free_result($rs);
	// ENDS HERE.
	echo "<TABLE CLASS='forumline' CELLPADDING='0' CELLSPACING='0' BORDER='1' WIDTH='90%'>";
	echo "<TBODY>";
	echo "<TR><TD CLASS='head' WIDTH='40%' COLSPAN='5' ALIGN='CENTER'>APPLY MESSBILL BY HOSTEL<TD></TR>";
	echo "<TR>";
	echo "<TD CLASS='rowpic' WIDTH='10%' ALIGN='CENTER'>Select</TD>";
	echo "<TD CLASS='rowpic' WIDTH='25%' ALIGN='CENTER'>Fees</TD>";
	echo "<TD CLASS='rowpic' WIDTH='25%' ALIGN='CENTER'>Amount (Rs.)</TD>";
	echo "<TD CLASS='rowpic' WIDTH='40%' ALIGN='CENTER'>Date/Month/Year</TD>";
	//echo "<TD CLASS='rowpic' WIDTH='20%' ALIGN='CENTER'><B>Term</B></TD>";
	echo "</TR>";
	// FOR DISPLAYING THE FEES STRUCTURE FOR ACTUAL DATABASE,
	$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id FROM  ";
	$sql .= " h_stud_m a,student_m b WHERE a.h_id=$hostel AND a.archive='N' AND a.s_id=b.id  ";
	//echo $sql;
	$result = execute($sql) or die("QUERY $sql " . error_description());
	$stud_det=fetcharray($result);
	$uni_id    = $stud_det["id"];
	if (rowcount($result) != 0)
	{
		$query  = "SELECT a.*, b.fee_name FROM hostel_fee_m a, hostel_fee_type b WHERE ";
		$query .= "b.status=1 AND a.hostel_id=$hostel AND a.fee_id=b.fee_id ORDER BY ";
		$query .= "a.due_date";
		//$query ="select * from hostel_fee_type WHERE fee_id=6";
		//echo $query;
		$res1 = execute($query) or die("QUERY $query " . error_description());
		//here
		$i=0;
		while ($rw = fetcharray($res1))
		{
		  if($i%2)
		  echo "        <tr class='clsname'> ";
		  else
		  echo "        <tr> ";
		  $i++;
		  echo "<TD WIDTH='10%' ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='fee[]' VALUE='$rw[id]'></TD>";
		  echo "<INPUT TYPE='HIDDEN' NAME='installment$rw[id]' VALUE='$rw[installment]'>";
		  if($rw["installment"] > 0)
			 $name = $rw["fee_name"] . " - Installment No. " . $rw["installment"] ;
		  else
			  $name = $rw["fee_name"] ;
		  echo "<TD WIDTH='40%' ALIGN='CENTER'>$name</TD>";
		  echo "<TD WIDTH='20%' ALIGN='CENTER'><INPUT TYPE='TEXT' NAME='fee_amt$rw[id]' VALUE='$rw[amt]'>";
				$due_date=explode("-",$rw["due_date"]);
				$dd=$due_date[2];
				$mm=$due_date[1];
				$yy=$due_date[0];
			echo "<TD WIDTH='20%' ALIGN='CENTER'>";
			echo "<INPUT TYPE='TEXT' NAME='due_dd$rw[id]' VALUE='$dd' MAXLENGTH='2' SIZE='2'>-";
			echo "<INPUT TYPE='TEXT' NAME='due_mm$rw[id]' VALUE='$mm' MAXLENGTH='2' SIZE='2'>-";
			echo "<INPUT TYPE='TEXT' NAME='due_yy$rw[id]' VALUE='$yy' MAXLENGTH='4' SIZE='4'>";
			echo "</TD>";
//echo "<TD WIDTH='20%' ALIGN='CENTER'><INPUT TYPE='TEXT' NAME='term$rw[id]' SIZE='10'></TD>";
			echo "</TR>";
		}
		mysql_free_result($res1);
	}
	
// FOR DISPLAYING THE FEE STRUCTURE FOR ADDITIONAL COLLEGES.

						$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id FROM  ";

						$sql .= "h_stud_m a, additional_student b WHERE a.h_id=$hostel AND a.archive='N' ";

						$sql .= "AND a.s_id=b.student_id";
						//echo $sql;
						$result = execute($sql) or die("QUERY $sql " . error_description());
						$stud_det=fetcharray($result);

						$uni_id    = $stud_det["id"];

						$s_id=$stud_det["s_id"];



	// ENDS HERE.

						echo "</TBODY>";

						echo "</TABLE>";

						echo "<BR><BR>";

						echo "<table>";

						echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='1' WIDTH='90%' CLASS='forumline'>";

						//echo "<TBODY>";

						echo "<TR><TD WIDTH='100%' COLSPAN='12' CLASS='head' ALIGN='CENTER'>LIST OF STUDENTS OF $HostelName</TD></TR>";

						echo "<TR>";

						echo "<TD WIDTH='10%' CLASS='row2' ALIGN='CENTER'>Select</TD>";

						echo "<TD WIDTH='10%' CLASS='row2' ALIGN='CENTER'>Student_id</TD>";

						echo "<TD WIDTH='10%' CLASS='row2' ALIGN='CENTER'>StudentName</TD>";

						echo "<TD WIDTH='05%' CLASS='row2' ALIGN='CENTER'>MessAdvancebalance</TD>";

						echo "<TD WIDTH='05%' CLASS='row2' ALIGN='CENTER'>Messbill</TD>";

						echo "</TR>";
						
						$i=0;
						
						//echo"<tr>";
						echo"<td width='10%' CLASS=row2>";
						//echo "<INPUT TYPE='SUBMIT' NAME='apply' VALUE='ClearAll' CLASS='bgbutton'></TD>";
						echo"<input type=submit name=apply value=ClearAll CLASS='bgbutton'>";
						echo"</td><td width=10% CLASS=row2></td><td width=0% CLASS=row2></td><td width=0% CLASS=row2></td><td width=100% CLASS=row2></td></tr>";

// FOR DISPLAYING THE LIST OF STUDENTS IN ACTUAL DATABASE.

$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id,b.id as StudID FROM  ";
$sql .= "h_stud_m a, student_m b WHERE a.h_id=$hostel AND a.archive='N' AND a.s_id=b.id";
$sql .= " ORDER BY a.id ASC";
						//echo $sql;
$result = execute($sql) or die("QUERY $sql " . error_description());
$stud_det=fetcharray($result);
$uni_id    = $stud_det["id"];
$s_id1=$stud_det["s_id"];
//echo $stud_det["s_id"];
//reset($MyArray);
	if (rowcount($result) != 0)
	{

		$num = rowcount($result);

		echo "<INPUT TYPE='HIDDEN' NAME='num_student' VALUE='$num'>";
		$result = execute($sql);
		
		while ($row = mysql_fetch_array($result))
		{
			if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr> ";

			$i++;
			//echo " inside ";
			$s_id=$row["s_id"];
			//$s_id1=$stud_det["s_id"];
			//echo $s_id1;
			echo "<INPUT TYPE='HIDDEN' NAME='domain$row[s_id]' VALUE='$row[domain]'>";
			if(!isset($apply))
			{
				//echo "inside if ";
				echo "<TD WIDTH='10%'><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]' ></TD>";
			}
			else
			{
				echo "<TD WIDTH='10%'><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]'></TD>";
			}
			//echo "<TD WIDTH='20%'><B>$row[stud_id]</B></TD>";
			echo "<TD WIDTH='20%'>$row[s_id]</TD>";
			echo "<TD WIDTH='60%'>$row[first_name] $row[last_name]</TD>";
			$MStr=execute("select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=3 and paid='Yes' ") or die(error_description()."e1");
			$MAdvance=fetcharray($MStr);			
			if(is_null($MAdvance[0]))
			{
				$MessAdvance=0;
			}
			else
			{
				$MessAdvance=$MAdvance[0];
 			}			
			$MStr1=execute("select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=3 and paid='Yes'" ) or die(error_description()."e2");			
			$MBill=fetcharray($MStr1);
			if(is_null($MBill[0]))
			{
				$MessBill=0;
			}
			else
			{
				$MessBill=$MBill[0];
				//echo $MessBill;
			}
			$MAdvance=$MessAdvance-$MessBill;
			//echo $MAdvance;
			if($MAdvance < 0 )
			{
				
				$MAdvance = 0;
			}
//echo $MAdvance;
			
			/*if($MAdvance < 0)
			{
			 echo "You cannot apply the fees";
			 }*/
/*
			 if($MAdvance < 0)
			 {
				 //$team=$tem;
				 ?>
				 <SCRIPT LANGUAGE="JavaScript">
				 alert(" NETBALANCE EXCEEDS!!")
				 </SCRIPT>
			 		   <?
			 		   }*/
			//$MAdvance+=$MAdvance;
			//echo $MessAdvance;
			echo "<td>$MAdvance</td><td>$MessBill</td>";
			echo "</TR>";
		}
		mysql_free_result($result);
		}
// ENDS HERE.
// FOR DISPLAYING THE LIST OF STUDENTS IN ADDITIONAL COLLEGES.
$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id,b.id as StudID FROM  ";
$sql .= "h_stud_m a, additional_student b WHERE a.h_id=$hostel AND a.archive='N' ";
$sql .= "AND a.s_id=b.student_id";
//echo $sql;
$result = execute($sql) or die("QUERY $sql " . error_description());						$stud_det=fetcharray($result);
$uni_id    = $stud_det["id"];
$s_id1=$stud_det["s_id"];
if (rowcount($result) != 0)
{
	$num += rowcount($result);
	echo "<INPUT TYPE='HIDDEN' NAME='num_student' VALUE='$num'>";
	$i=0;
	while ($row = fetcharray($result))
	{
		$s_id=$row["s_id"];
		echo "<INPUT TYPE='HIDDEN' NAME='domain$row[s_id]' VALUE='$row[domain]'>";
		if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr> ";
		$i =$i+1;
		if(!isset($apply))
		{
			echo "<TD WIDTH='10%'><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]' checked ></TD>";
		}
		else
		{
			echo "<TD WIDTH='10%'><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]'></TD>";
		}
		echo "<TD>$row[student_id]</TD>";
		echo "<TD>$row[first_name] $row[last_name]</TD>";
		//echo "select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=4 and Paid='Yes' ";
		$MStr=execute("select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=3 and Paid='Yes' ") or die(error_description()."e1");
		$MAdvance=fetcharray($MStr);
		if(is_null($MAdvance[0]))
			{
				$MessAdvance=0;
			}
			else
			{
				$MessAdvance=$MAdvance[0];
			}
			//echo "select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=6 and Paid='Yes' ";
			$MStr1=execute("select sum(amt) from fee_h_det where stud_id=$row[StudID] and fee_id=3 and Paid='Yes' ") or die(error_description()."e2");
			//echo$MStr1=execute("select * from fee_h_det where stud_id=$row[StudID] and fee_id=7 and Paid='Yes' ") or die(error_description()."e2");

			$MBill=fetcharray($MStr1);

			if(is_null($MBill[0]))
			{
				$MessBill=0;
			}
			else
			{	//echo $MBill[0];
				$MessBill=$MBill[0];
				//echo $MessBill;
			}

			$MAdvance=$MessAdvance-$MessBill;
	/*if($MAdvance < 0)
    {
	//$team=$tem;
	?>
	<SCRIPT LANGUAGE="JavaScript">
	$MAdvance=0;
	alert(" NETBALANCE EXCEEDS!!")
	</SCRIPT>
	<?
	}*/
	echo "<td>$MAdvance</td><td>$MessBill</td>";
	echo "</TR>";
	}						
	mysql_free_result($result);
	}

// ENDS HERE.
echo "</TBODY>";
echo "</TABLE>";
echo "<br>";
echo "<center>";
echo "<TD COLSPAN='3' ALIGN='CENTER'><INPUT TYPE='SUBMIT' NAME='apply' VALUE='Apply Fees' CLASS='bgbutton'></TD>";
echo "</center>";

//echo "<INPUT TYPE='HIDDEN' NAME='hostel' VALUE='$hostel'>";
}
?>

</FORM>
</CENTER>
</BODY>
</HTML>