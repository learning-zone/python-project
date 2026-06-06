<?php

session_start();
require("../../db.php");
if($_REQUEST)
{
	$hostel = $_REQUEST['hostel'];
	$id = $_REQUEST['id'];
	$m = $_REQUEST['m'];
}
else
{
$id = $_POST['id'];
$stud_id = $_POST['stud_id'];
$register_no = $_POST['register_no'];
$name = $_POST['name'];
$course_id = $_POST['course_id'];
$crs = $_POST['crs'];
$year_id = $_POST['year_id'];
$yr = $_POST['yr'];
$save_rc = $_POST['save_rc'];
$accno = $_POST['accno'];
$rcno = $_POST['rcno'];
$comp_no = $_POST['comp_no'];

$fee = $_POST['fee'];
$sel1 = $_POST['sel1'];
$ledger = $_POST['ledger'];
$sel = $_POST['sel'];
$amt = $_POST['amt'];
$tot = $_POST['tot'];
$payment = $_POST['payment'];
$bank = $_POST['bank'];
$branch = $_POST['branch'];
$instr_no = $_POST['instr_no'];

$date3 = $_POST['date3'];
$date4 = $_POST['date4'];

$instr_amt = $_POST['instr_amt'];
$remark = $_POST['remark'];
$save = $_POST['save'];
}
//echo $hostel;
//echo $m;
//echo $id;
//$hostel = 1;
//$m=0;
//$id = 001857;

if (empty($id))

{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 1: Unauthorized Entry !!</DIV>";
	die();
}

// FOR FETCHING THE HOSTEL NAME.

					$query  = "SELECT * FROM hostel_m WHERE id=$hostel";
					$rs = execute($query) or die("QUERY $query " . error_description());
					$row = fetcharray($rs);
					$hostel_name = $row["hostel_name"];

//echo $hostel_name;
					mysql_free_result($rs);
// ENDS HERE.
//echo $id ='001857';
if ($m == 0)
{
	$query  = "SELECT b.first_name, b.last_name, a.coursename, c.year_name, b.id, ";
	$query .= "b.course_admitted, b.course_yearsem, b.student_id FROM course_m a, student_m b, ";
	$query .= "course_year c WHERE b.id='$id' AND b.course_admitted=a.course_id AND ";
	$query .= "b.course_yearsem=c.year_id";
	//echo $query;
}

else	// FOR ADDITIONAL COLLEGES.
{
	$query  = "SELECT b.first_name, b.last_name, a.coursename, c.year_name, b.student_id, ";
	$query .= "b.course_admitted, b.course_yearsem FROM additional_course a, additional_student b, ";
	$query .= "additional_term c WHERE b.id='$id' AND b.course_admitted=a.course_id AND ";
	$query .= "b.course_yearsem=c.year_id";
}

$rs = execute($query) or die("QUERY $query " . error_description());

if (rowcount($rs) == 0)
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 2: Student Details Not Found !!";
	die();
}

$row = fetcharray($rs);
$stud_name   = $row["first_name"] ." ". $row["last_name"];
$course_id = $row["course_admitted"];
$course_name = $row["coursename"];
$term_id = $row["course_yearsem"];
$term_name   = $row["year_name"];
//$student_id     = $row["student_id"];
$student_id     = $row["id"];

//if (!empty($row["student_id"]))
if (!empty($row["id"]))
	$adm_id = $row["id"];
else
	$adm_id = "";

mysql_free_result($rs);


					$query  = "SELECT a.*, a.id AS aid, b.fee_name, b.fee_id AS id FROM fee_h_det a, fee_type b ";
					$query .= "WHERE a.stud_id='$id' AND a.paid='No' AND a.fee_id=b.fee_id AND b.exam=0 AND ";
					$query .= "a.hostel_type='Y' AND b.fee_name NOT LIKE 'Advance%' ORDER BY due_date";
					//echo $query;

					$rs = execute($query) or die("QUERY $query " . error_description());

if (rowcount($rs) == 0)
{
	$query  = "SELECT a.*, a.id AS aid, b.fee_name, b.fee_id AS id FROM fee_h_det a, ";
	$query .= "hostel_fee_type b WHERE a.stud_id='$id' AND a.paid='No' AND a.fee_id=b.fee_id ";
	$query .= "AND a.hostel_type='Y' AND b.fee_name NOT LIKE 'Advance%' ORDER BY a.due_date";
	//echo $query;
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<DIV ALIGN='CENTER'>";
		echo "Message 3: $stud_name has paid the Hostel Fees already !!</DIV>";
		die();
	}
}

?>

<HTML>
<HEAD>
<TITLE>GENERAL RECEIPT FOR HOSTEL FEES</TITLE>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<SCRIPT LANGUAGE="JavaScript">

var total = 0;

function addTotal(i,flag)
{
	//alert(i);
	//alert(flag);
	total = parseInt(document.frm.tot.value);
	//alert(i);
	document.frm.tot.value=0;
	var tot = 0;
	//alert(document.frm.amt);
	tot = parseInt(eval("document.frm.amt"+i+".value"));
	//alert(tot)
	if(flag)
	{
		total += parseInt(tot);
		temp_ref="document.frm.amt"+i;
		temp_ref.value=3232;
    }
    else
    {
		total -= parseInt(tot);
    }
    document.frm.tot.value = total;
	document.frm.instr_amt.value = total;
}

function saveme()
{
	if(document.frm.rcno.value=="" || document.frm.comp_no.value=="")
	{
		alert("Enter the details");
		document.frm.accno.focus();
	}
	else
	{
		document.frm.save_rc.value = 1;
		document.frm.submit();
	}
}

function selectMe()
{
	i = document.frm.length;
	document.frm.tot.value = 0;
	var total = 0;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].type == "checkbox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;

    	if(document.frm[j].checked)
		{
			tot = parseInt(eval("document.frm.amt" + document.frm[j].value + ".value"));
			total += parseInt(tot);
		}
	}
}

			document.frm.tot.value = total;

}

function changeMs(i)

{

	if(i)

	{

			document.all.sl.style.cursor='hand';

			document.all.sl.style.color='blue'

	}

	else

	{

			document.all.sl.style.cursor='default';

			document.all.sl.style.color='ivory'

	}

}

function frm_reload()

{

			document.frm.action="generalreceipts.php";

			document.frm.submit();

}

//-->


</SCRIPT>

</HEAD>

<BODY>

<CENTER>

<FORM METHOD="POST" ACTION="receipt.php" NAME="frm">

<INPUT TYPE="HIDDEN" NAME="id" VALUE="<?=$id;?>">

<INPUT TYPE="HIDDEN" NAME="stud_id" VALUE="<?=$adm_id;?>">

<INPUT TYPE="HIDDEN" NAME="register_no" VALUE="<?=$student_id;?>">

<INPUT TYPE="HIDDEN" NAME="name" VALUE="<?=$stud_name;?>">

<INPUT TYPE="HIDDEN" NAME="course_id" VALUE="<?=$course_id;?>">

<INPUT TYPE="HIDDEN" NAME="crs" VALUE="<?=$course_name;?>">

<INPUT TYPE="HIDDEN" NAME="year_id" VALUE="<?=$term_id;?>">

<INPUT TYPE="HIDDEN" NAME="yr" VALUE="<?=$term_name;?>">

<INPUT TYPE="HIDDEN" NAME="hostel" VALUE="<?=$hostel;?>">

<INPUT TYPE="HIDDEN" NAME="save_rc" VALUE="0">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" WIDTH="90%" CLASS="forumline">

<TBODY>

<TR>
	<TD   WIDTH="20%" align ="center">Name</TD>
	<TD   WIDTH="30%" align ="center"><?=$stud_name;?></TD>
</TR>
<TR>
	<TD   WIDTH="20%" align ="center">Register No.</TD>
	<TD  WIDTH="30%" align ="center"><?=$student_id;?></TD>
</TR>
<TR>
	<TD   WIDTH="20%" align ="center">Course</TD>
	<TD   WIDTH="30%" align ="center"><?=$course_name;?></TD>
</TR>
<TR>
	<TD  WIDTH="20%" align ="center">Term / Year</TD>
	<TD   WIDTH="30%" align ="center"><?=$term_name;?></TD>
</TR>

</TBODY>

</TABLE><BR>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%" CLASS="forumline">

<TBODY>

<TR>

	<TD  WIDTH="25%">&nbsp;Bank A/C No.</TD>

	<TD  WIDTH="45%">

	<SELECT  SIZE="1"  NAME="accno" >

			<OPTION VALUE="0">--- SELECT BANK ACCOUNT ---</OPTION>

			<?

					$query  = "SELECT * FROM bank_details ";

					$rs = execute($query) or die("QUERY $query " . error_description());

if (rowcount($rs) != 0)

{
		while ($row = fetcharray($rs))

		{
					echo "<OPTION VALUE='$row[ledger_id]'>$row[bank_name]</OPTION>";

		}

				mysql_free_result($rs);

		}

?>

	</SELECT>

	</TD>

</TR>

<?
/*$query  = "SELECT bank_name FROM bank_details";
$rs = execute($query) or die("QUERY $query " . error_description());
$bank_name = $row["bank_name"];*/

//mysql_free_result($rs);

/*if(accno==1)

{*/

?>

<TR>

<TD  WIDTH="25%">&nbsp;Challan No.</TD>

<TD  WIDTH="45%"><INPUT TYPE="TEXT" NAME="rcno" SIZE="10"></TD>

</TR>

<TR>

	<TD  WIDTH="25%">&nbsp;Receipt_ No.</TD>

	<TD  WIDTH="45%"><INPUT TYPE="TEXT" NAME="comp_no" SIZE="10">

	</TD>

<tr>
		<td align="LEFT">&nbsp;DATE</td>
		<td nowrap align="LEFT">
		<input type="text" readonly="" name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>      <!--
 <?/*}else{*/?></*?}*/?>
 -->

</TBODY>

</TABLE>

<BR>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%" CLASS="forumline">

<TBODY>

<TR><TD COLSPAN="3" ALIGN="CENTER" CLASS="row3" WIDTH="70%">FEE DETAILS</TD></TR>

<TR>

	<TD WIDTH="10%" ALIGN="CENTER" CLASS="rowpic">
	<DIV ID="sl" onClick="selectMe()" onMouseOver="changeMs(1)" onmouseOut="changeMs(0)">Select</DIV></TD>

	<TD WIDTH="40%" ALIGN="CENTER" CLASS="rowpic">Fees</TD>
	<TD WIDTH="20%" ALIGN="CENTER" CLASS="rowpic">Amount (Rs.)</TD>

</TR>

<?php

for($k=2;$k<=2;$k++)
{
	if($k==1)
	{
		$query  = "SELECT a.*, a.id AS aid, b.fee_name, b.fee_id AS id FROM fee_h_det a, ";
		$query .= "fee_type b WHERE a.stud_id='$id' AND a.paid='No' AND a.fee_id=b.fee_id ";
		$query .= "AND a.hostel_type='Y' AND b.fee_name NOT LIKE 'Advance%' ORDER BY a.due_date";
//echo $query;
	}
	else
	{
		$query  = "SELECT a.*, a.id AS aid, b.fee_name, b.fee_id AS id FROM fee_h_det a, ";
		$query .= "hostel_fee_type b WHERE a.stud_id='$id' AND a.paid='No' AND a.fee_id=b.fee_id ";
		$query .= "AND a.hostel_type='Y' AND b.fee_name NOT LIKE 'Advance%' ORDER BY a.due_date";
	//	echo $query;
	}
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) != 0)
	{
		//echo $rowcount($rs);
		$i=0;
		while ($row = fetcharray($rs))
		{
			//echo $row;
			if ($row["hostel_type"] == "N")
			{
				if ($row["installment"])
				$name = $row["fee_name"] ." - Inst ". $row["installment"];
				else
				$name = $row["fee_name"];
			}
			else
			{
				if ($row["installment"])
				$name = $row["fee_name"] ." - Inst ". $row["installment"] ."- Term: ". $row["academic_term"];
				else
				$name = $row["fee_name"] ."- Term: ". $row["academic_term"];
			}

			?>

			<INPUT TYPE="HIDDEN" NAME="fee<?=$row[aid];?>" VALUE="<?=$name;?>">

			<INPUT TYPE="HIDDEN" NAME="sel1[]" VALUE="<?=$row[id];?>">

			<INPUT TYPE="HIDDEN" NAME="ledger<?=$row[aid];?>" VALUE="<?=$row[ledger_id];?>">

			<?php
			 if($i%2)
               echo "        <tr class='clsname' height='25'> ";
               else
               echo "        <tr height='25'> ";
			   $i++;
			?>

				<TD WIDTH="10%" ALIGN="CENTER"><INPUT TYPE="CHECKBOX" NAME="sel[]" VALUE="<?=$row[aid];?>" onClick="addTotal(<?=$row[id];?>, this.checked)"></TD>

				<TD WIDTH="40%" ALIGN="CENTER"><?=$name;?></TD>

				<TD WUDTG="20%" ALIGN="CENTER">
                <INPUT TYPE="TEXT" NAME="amt<?=$row[id];?>" VALUE="<?=$row[amt];?>">
				<?php
                //echo "amt".$row[aid];?>

			</TR>

			<?

		}

		mysql_free_result($rs);

	}

}

?>

<TR>

	<TD COLSPAN="2" WIDTH="50%" ALIGN="RIGHT">Total</TD>

	<TD WIDTH="20%" ALIGN="CENTER"><INPUT TYPE="TEXT" NAME="tot" VALUE="0" DISABLED></TD>

</TR>

</TBODY>

</TABLE>

<BR>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%" CLASS="forumline">

<TBODY>

<TR>

	<TD  WIDTH="20%">&nbsp;Payment Type</TD>
	<TD WIDTH="50%">
		<SELECT NAME="payment" SIZE="1">
			<OPTION VALUE="0">-- SELECT --</OPTION>
            <OPTION VALUE="CASH">CASH</OPTION>
			<OPTION VALUE="CHEQUE">CHEQUE</OPTION>
			<OPTION VALUE="DD">DD</OPTION>
			<?
			/*

					$query  = "SELECT id, m_desc FROM money_type ORDER BY id ASC";
					$rs = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					echo "<OPTION VALUE='$row[id]-$row[m_desc]'>$row[m_desc]</OPTION>";
				}
				mysql_free_result($rs);
			}
			*/
			?>
		</SELECT>

	</TD>

</TR>

<TR>

	<TD COLSPAN="2" CLASS="rowpic" ALIGN="LEFT" WIDTH="70%">

	If payment type is Cheque / DD, fill the

	following details</TD>

</TR>

<TR>

	<TD WIDTH="20%" >&nbsp;Bank Name</TD>

	<TD WIDTH="50%"><INPUT TYPE="TEXT" NAME="bank" SIZE="20"></TD>

</TR>

<TR>

	<TD WIDTH="20%" >&nbsp;Branch</TD>

	<TD WIDTH="50%" ><INPUT TYPE="TEXT" NAME="branch" SIZE="20"></TD>

</TR>

<TR>

	<TD WIDTH="20%" >&nbsp;Cheque / DD No.</TD>

	<TD WIDTH="50%" ><INPUT TYPE="TEXT" NAME="instr_no" SIZE="10"></TD>

</TR>

<tr>
		<td align="LEFT">&nbsp;DATE</td>
		<td nowrap align="LEFT">
		<input type="text" readonly="" name="date4" value="<?php echo $date4?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar4')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  

<TR>

	<TD WIDTH="20%" >&nbsp;Amount (Rs.)</TD>

	<TD WIDTH="50%" ><INPUT TYPE="TEXT" NAME="instr_amt" SIZE="12" readonly></TD>

</TR>

<TR>

	<TD WIDTH="20%" >&nbsp;Remarks</TD>

	<TD WIDTH="50%" ><TEXTAREA NAME="remark" ROWS="3" COLS="15">---</TEXTAREA></TD>

</TR>

</TBODY>

</TABLE>

<BR>

<DIV ALIGN="CENTER">

<INPUT TYPE="BUTTON" CLASS="bgbutton" VALUE="Save Receipt" NAME="save" onClick="saveme()">

</DIV>

</FORM>

</CENTER>
</BODY>
</HTML>
