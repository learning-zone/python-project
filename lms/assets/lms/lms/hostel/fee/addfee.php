<?php
session_start();
include("../../db.php");

$hostel = $_POST['hostel'];
$fee = $_POST['fee'];
$amt = $_POST['amt'];
$amt1 = $_POST['amt1'];

$inst = $_POST['inst'];
$insert = $_POST['insert'];
$view  = $_POST['view'];


$sel = $_POST['sel'];
$due_day = $_POST['due_day'];
$due_month = $_POST['due_month'];
$due_year = $_POST['due_year'];

$modify = $_POST['modify'];
$delete = $_POST['delete'];

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
?>
  <script language="javascript">
  function isnum(e)
  {
     var charCode=(navigator.appname == "Netscape") ? e.which : e.keyCode;
	 //alert(charCode);
	 if((charCode>=48 && charCode <=57)||(charCode>=96 && charCode<=105)||(charCode>=35 && charCode<=40)||(charCode==8)||(charCode==9))
	 {
	   return true;
	 }
	 else
	 {
	   return false;
	 }

  }
  </script>
<?php
$query  = "SELECT * FROM hostel_m ORDER BY id";
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	//echo "<DIV ALIGN='CENTER'>";
	//echo "Enter Hostel Details !!</DIV>";
	?>
    <script type="text/javascript">
	alert("Enter Hostel Details")
	</script>
    <?php
	die();
}

$query  = "SELECT * FROM hostel_fee_type WHERE status=1";
$res = execute($query) or die("QUERY $query " . error_description());
if (rowcount($res) == 0)
{
	//echo "<DIV ALIGN='CENTER'>";
	//echo "Enter the Fee Type Details !!</DIV>";
	?>
    <script type="text/javascript">
	alert("Enter the Fee Type Details !!")
	</script>
    <?php
	die();
}

	if ((!empty($fee)) && (!empty($hostel)))
{
	$query  = "SELECT SUM(amt) AS sum1, COUNT(*) AS count1 FROM hostel_fee_m WHERE ";
	$query .= "hostel_id='$hostel' AND fee_id=$fee GROUP BY amt";
	$result = execute($query) or die("QUERY $query " . error_description());
	if(rowcount($result) != 0)
	{
		$row = fetcharray($result);
		$amt = $row["sum1"];
		$inst = $row["count1"];
		if ($inst == 1) $inst = 0;
		mysql_free_result($result);
	}

	
}

// THIS PART IS FOR INSERTING THE FEE STRUCTURE
if (isset($insert))
{	
	$amt = trim($amt);
	$inst = trim($inst);
	if ( $amt == 0)
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Enter the Fees Amount in Rupees !!</DIV>";
		?>
    <script type="text/javascript">
	alert("Enter the Fees Amount in Rupees !!")
	</script>
    <?php

	}
	else
	{
		$ar = getdate(time());
		$year = $ar[year];
		$month = $ar[mon];
		$day = $ar[mday];
		$dt = $ar["year"] . "-" . $ar["mon"] . "-" . $ar["mday"];

		if ((strlen($inst) == 0) || ($inst == 0))
		{
			$query  = "SELECT * FROM hostel_fee_m WHERE hostel_id=$hostel AND fee_id=$fee";
			$result = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($result) != 0)
			{
				//echo "<DIV ALIGN='CENTER'>";
				//echo "Already Entered !!</DIV>";
				?>
    			<script type="text/javascript">
				alert("Already Entered !!")
				</script>
    			<?php
			}
			else
			{
				$query  = "INSERT INTO hostel_fee_m(hostel_id, fee_id, amt, due_date) VALUES ";
				$query .= "($hostel, $fee, $amt, '$dt')";
				execute($query) or die("QUERY $query " . error_description());
			}
		}
		elseif ($inst > 0)
		{
			$query  = "SELECT * FROM hostel_fee_m WHERE hostel_id=$hostel AND fee_id=$fee";
			$result = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($result) != 0)
			{
				//echo "<DIV ALIGN='CENTER'>";
				//echo "Already Entered !!</DIV>";
				?>
    			<script type="text/javascript">
				alert("Already Entered !!")
				</script>
    			<?php
			}
			else
			{
				for($i=1;$i<=$inst;$i++)
				{
					$am = $amt / $inst;
					$query  = "INSERT INTO hostel_fee_m (hostel_id, fee_id, amt, installment, ";
					$query .= "due_date) VALUES($hostel, $fee, $am, $i, '$dt')";
					execute($query) or die("QUERY $query " . error_description());
					$dt = date("Y-m-d", mktime(0,0,0,$month+$i,$day,$year));
				}
			}
		}
	}
}
// ENDS HERE

// THIS PART IS FOR MODIFYING THE FEE STRUCTURES.
if (isset($modify))
{
    $array=gettype($sel);
	if($array=='array')
	{
		while(list($key, $value) = each($sel))
		{
		
			$amt = $_POST["amt".$value];
            
			$day_temp = $_POST["due_day".$value];
	
			$month_temp = $_POST["due_month".$value];
	
			$year_temp = $_POST["due_year".$value]; 
	
			//$due = $year_temp."-".$month_temp."-".$day_temp;
            //$due = date("Y-m-d", mktime(0,0,0,$due_month,$due_day,$due_year));
            $due = date("Y-m-d", mktime(0,0,0,$month_temp,$day_temp,$year_temp));	
			
			
			$query  = "UPDATE hostel_fee_m SET amt='$amt', due_date='$due' WHERE id=$value";
			execute($query) or die("QUERY $query " . error_description());
			//echo "<DIV ALIGN='CENTER'><B>";
			//echo "Fee Structure modified Successfully !!</B><DIV>";
			?>
            <script type="text/javascript">
			alert("Fee Structure modified Successfully !");
			</script>
            <?php
		}
      }
	  else
	  {?>
	  <script language="javascript">
          alert("Please Select The Fee Name");
	  </script>
	      
	 <?php }
}
// ENDS HERE

// THIS PART IS FOR DELETING THE FEE STRUCTURE FROM THE TABLE.
if (isset($delete))
{
	$array=gettype($sel);
	if($array=='array')
	{
		while(list($key, $value) = each($sel))
		{
			$sql = "DELETE FROM hostel_fee_m WHERE id=$value";
			execute($sql) or die("QUERY $sql " . error_description());
		}

		// RE-INDEX THE INSTALLMENT NUMBERS, IF ANY.
		$sql  = "SELECT * FROM hostel_fee_m WHERE  hostel_id=$hostel AND fee_id=$fee ";
		$result = execute($sql) or die("QUERY $sql " . error_description());
		if(rowcount($result) == 1)
		{
			$query  = "UPDATE hostel_fee_m SET installment=0 WHERE hostel_id=$hostel AND fee_id=$fee";
			execute($query) or die("QUERY $query " . error_description());
		}
		else if (rowcount($result) > 1)
		{
			$i = 0;
			while ($row = fetcharray($result))
			{
				$inst = $i++;
				$i++;
				$query  = "UPDATE hostel_fee_m SET installment=$inst WHERE id=$row[id]";
				execute($query) or die("QUERY $query " . error_description());
			}
			mysql_free_result($result);
		}
     }
	 else
	  {?>
	  <script language="javascript">
          alert("Please Select The Fee Name");
	  </script>
	      
	 <?php }

}
// ENDS HERE.
?>
<HTML>
<HEAD>
<TITLE>DESCRIBE FEE STRUCTURE</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="frm" METHOD="POST" ACTION="addfee.php">
<TABLE CLASS="forumline" CELLPADDING="0" CELLSPACING="0" WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="2">ENTER HOSTEL FEE STRUCTURE</TD></TR>
<TR>
	<TD WIDTH="30%">&nbsp;Hostel</TD>
	<TD WIDTH="50%">
		<SELECT NAME="hostel" SIZE="1" >
        <OPTION VALUE="0">-- Select --</OPTION>
		<?
		while ($row = fetcharray($rs))
		{
			if ($row["id"] == $hostel)
				echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
			else
				echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
		}
		mysql_free_result($rs);
		?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD WIDTH="30%">&nbsp;Fee Type</TD>
	<TD WIDTH="50%">
		<SELECT NAME="fee" SIZE="1">
        <OPTION VALUE="0">-- Select --</OPTION>
		<?
		while ($row = fetcharray($res))
		{
			if ($row["fee_id"] == $fee)
				echo "<OPTION VALUE='$row[fee_id]' SELECTED>$row[fee_name]</OPTION>";
			else
				echo "<OPTION VALUE='$row[fee_id]'>$row[fee_name]</OPTION>";
		}
		mysql_free_result($res);
		?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD WIDTH="30%">&nbsp;Amount (Rs.)</TD>
	<TD WIDTH="50%">&nbsp;<INPUT TYPE="TEXT" NAME="amt" SIZE="10" VALUE="<?=$amt;?>" onKeyDown="return isnum(event)"></TD>
</TR>
<TR>
	<TD WIDTH="30%">&nbsp;Installments</TD>
	<TD WIDTH="50%">&nbsp;<INPUT TYPE="TEXT" NAME="inst" SIZE="2" MAXLENGTH="2" VALUE="<?=$inst;?>" onKeyDown="return isnum(event)"></TD>
</TR>
</TBODY>
</TABLE>
<br>
<div>
<center>
	<INPUT TYPE="SUBMIT" NAME="insert" VALUE="Add Fee" CLASS="bgbutton">
    &nbsp;
	<INPUT TYPE="SUBMIT" NAME="view" VALUE="View Fee" CLASS="bgbutton">
</center>
</div>


<br>
<?
$query  = "SELECT a.*, b.fee_name FROM hostel_fee_m a, hostel_fee_type b WHERE hostel_id=";
$query .= "'$hostel' AND a.fee_id=b.fee_id ORDER BY a.id";
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	//echo "<DIV ALIGN='CENTER'>";
	//echo "Fee Details have not been entered !!</DIV>";
	?>
    <script type="text/javascript">
	alert("Fee Details have not been entered !!");
	</script>
    <?php
	
	die();
}
?>
<TABLE CELLPADDING="0" CELLSPACING="0" WIDTH="90%"  CLASS="forumline">
<TBODY>
<TR>
	<TD CLASS="row2" ALIGN="CENTER">Select</TD>
	<TD CLASS="row2" ALIGN="CENTER">Fee Name</TD>
	<TD CLASS="row2" ALIGN="CENTER">Amount (Rs.)</TD>
	<TD CLASS="row2" ALIGN="CENTER">Due Date</TD>
</TR>
<?php
$i=0;
while ($row = fetcharray($rs))
{
	if($row["installment"] > 0)
		$name = $row["fee_name"] . " - Inst " . $row["installment"] ;
	else
		$name = $row["fee_name"] ;

	$due_date_temp = explode("-", $row["due_date"]);
	$dd=$due_date_temp[2];
	$mm=$due_date_temp[1];
	$yy=$due_date_temp[0];
	 if($i%2)
	 echo "        <tr class='clsname'> ";
	 else
	 echo "        <tr> ";
	 $i++;
	?>
	
		<TD  ALIGN="CENTER"><INPUT TYPE="CHECKBOX" NAME="sel[]" VALUE="<?=$row[id];?>"></TD>
		<TD  ALIGN="CENTER"><?=$name;?></TD>
		<TD  ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" NAME="amt<?=$row[id];?>" VALUE="<?=$row[amt];?>" onKeyDown="return isnum(event)"></TD>
		<TD  ALIGN="CENTER" nowrap>
			<INPUT TYPE="TEXT" NAME="due_day<?=$row[id];?>" SIZE="2" MAXLENGTH="2" VALUE="<?=$dd;?>">
			<INPUT TYPE="TEXT" NAME="due_month<?=$row[id];?>" SIZE="2" MAXLENGTH="2" VALUE="<?=$mm;?>">
			<INPUT TYPE="TEXT" NAME="due_year<?=$row[id];?>" SIZE="4" MAXLENGTH="4" VALUE="<?=$yy;?>">
		</TD>
	</TR>
	<?php
}
mysql_free_result($rs);
?>
</TBODY>
</TABLE>
<br>
<div>
<center>
	<INPUT TYPE="SUBMIT" NAME="modify" VALUE="Modify" CLASS="bgbutton">
    &nbsp;
	<INPUT TYPE="SUBMIT" NAME="delete" VALUE="Delete" CLASS="bgbutton">
    </center>
    </div>
</br>

</FORM>
</CENTER>
</BODY>
</HTML>