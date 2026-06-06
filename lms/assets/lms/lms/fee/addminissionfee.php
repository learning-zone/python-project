<?php
	session_start();
	include("../db1.php");
	
	$ttransopotation_no_month=10; //enter the number of month 

	$stud_id=$_REQUEST['stud_id'];
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$adm_id=$_REQUEST['adm_id'];
	
	$stud_yr=$_REQUEST['stud_yr'];  //student current accadamic year
	$admited_yr=$_REQUEST['admited_yr']; //student admited year
	$a_year=$_REQUEST['a_year']; //student paying accadamic year where he is going to pay fee
	
	if($_POST['amt'])
	$amt=$_POST['amt'];
	else
	$amt='5000.00';
	
	$count=fetchrow(execute("SELECT id FROM `fee_m_collect_admission` where studentId='$stud_id' and status=1 "));
	if($count[0])
	{
		header("Location: addminissionfee2.php?stud_id=$stud_id");
	}

$r=fetcharray(execute("select id, student_id, first_name, last_name, admission_type, course_admitted, course_yearsem, academic_year, class_section_id, adm_yr, nationality from student_m_online  where id='$stud_id'"));
$nationality=fetcharray(execute("SELECT nation FROM `nationality` where id='$r[nationality]'"));


	$admitedyear=$r[adm_yr];

	

// To get master information from the master table
	
/*	
	$installid=fetchrow(execute("select count(installmentId) from fee_m_collect  where studentId='$stud_id' and accYear=$a_year and status=1"));
	
		if(!$installid[0])
		$instalment=1;
		elseif($installid[0]==$no_of_instal)
		die("No Due");// all the installment amount cleared
		else
		$instalment=$installid[0]+1;

*/


$currentclass=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));


	
	//fetching installmentId key
	
		
	
	// reciving post data
	$oexeamt=$_POST['oexeamt'];
	$oldbalamt=$_POST['oldbalamt'];
	$pydt=$_POST['pydt'];
	$pymt=$_POST['pymt'];
	$pyyr=$_POST['pyyr'];
	$paymenttype=$_POST['paymenttype'];
	$fnamt=$_POST['fnamt'];
	$cenamt=$_POST['cenamt'];
	
	
	
	
	// to get currency code
	$currencydes=fetchrow(execute("select codeL , codeR from fee_m_currency_code where id='$currency'"));
	
	//find the total amount and payment date  
		$sql=execute("select amount, f_due_date, t_due_date from  fee_m_descrption_inst_total where inst_id='$instalment' and uid='$uid' and sts=1 ");
	while($rm1=fetcharray($sql))
	{
		$amt=$rm1[0];
		$f_due_date=$rm1[1];
		$t_due_date=$rm1[2];
	}
	

	
	$systemdate=date("Y-m-d");


?>
<!DOCTTYPE html>
<html>
<head>
<title>Fee Receipt</title>
<script type="text/javascript">
function reloadMe()
{
	document.frm.action="addminissionfee.php";
	document.frm.submit();
}
</script>
<script type="text/javascript">
function genrpt1()
{

		document.frm.action="addminissionfee1.php";
}

function totcal()
{
	var tot=parseInt(document.getElementById("amt1").value);
	var fine=parseInt(document.getElementById("fine").value);
	if(isNaN(fine))
	{
		alert("Invalid amount");
		document.getElementById("fine").value=0;
	}
	else
	{
		var m=tot+fine;
		//document.getElementById("amt").value=m;
	}

}
function addcheck(str,paymenttype)
{
	
	var url="sessionfile1.php";
	url=url+"?q="+str;
	url=url+"&sid="+Math.random();
	url=url+"&paymenttype="+paymenttype;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

</script>
<link href="../mistStyle.css">
</head>

<form name="frm"  action="" method="post">
<body>
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='stud_yr' value='<?=$stud_yr?>'>

<input type='hidden' name='a_year' value='<?=$a_year?>'>
<input type='hidden' name='currencyType' value='<?=$currency?>'>
<input type='hidden' name='admited_yr' value='<?=$admited_yr?>'>
<input type='hidden' name='installmentId' value='<?=$instalment?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>


<?php
$cdt=date('d');
$cmt=date('m');
$cyr=date('Y');
$cyr1=$stud_yr;
$sel1="";
$sel2="";
$sel3="";
$sel4="";
$sel5="";
if($paymenttype==1 or $paymenttype==2 or $paymenttype==3)
{
	$disname='No of Cheque';
}
if($paymenttype==4)
{
	$disname='No of Transaction';
}
if($paymenttype==5)
{
	$disname='No of Transaction';
}
 
if($paymenttype==2)
{
	$disname1='DD';
	$sel2="selected";
}
elseif($paymenttype==3)
{
	$disname1='Cheque';
	$sel3="selected";
}
elseif($paymenttype==4)
{
	$disname1='Tele Transfer';
	$sel4="selected";
}
elseif($paymenttype==5)
{
	$disname1='TID';
	$sel5="selected";
}
	


?>
<input type='hidden' name='oexeamt' value='<?=$oexeamt?>'>
<input type='hidden' name='oldbalamt' value='<?=$oldbalamt?>'>

<br>
<table border='1' width='70%' align='center' cellspacing='0' cellpadding='1' class='forumline'>
	<tr>
    	<td colspan='4' align='center' class='head'>Admission Fee  Payment Details</td>
    </tr>
	<tr>
    	<td colspan="2">Student Name : <?=$r[2].' '.$r[3]?></td>
   
    	<td colspan="2" nowrap>Applying for  <?=$_SESSION['semname']?> : <?=$currentclass[0]?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nationality : <?=$nationality[0]?> </td>
    </tr>
	

	<tr>
   	  <td nowrap>&nbsp;&nbsp;Payment Date</td>
		<td nowrap>
        	<select name='pydt'>
			<?php
			if($pydt=='')
				$pydt=$cdt;
			for($i=1;$i<=31;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pydt)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select><select name='pymt'>
			<?php
			if($pymt=='')
				$pymt=$cmt;
			for($i=1;$i<=12;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pymt)
					echo "<option value=$i selected>" . MonthName($i) . "</option>";
				else
					echo "<option value=$i>" . MonthName($i) . "</option>";
			}
			?>
			</select><select name='pyyr'>
			<?php
			if($pyyr=='')
				$pyyr=$cyr;
			for($i=$cyr-8;$i<=$cyr+2;$i++)
			{
				if($i==$pyyr)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select>
		</td>
	  <td align='center' nowrap>Mode of Payment</td>
        <td nowrap>
        	<select name="paymenttype" onChange="reloadMe()">
                <option value="">-- Select --</option>
                <option value="1" <?=$sel1?>>Cash</option>
                <option value="2" <?=$sel2?>>Demand Draft</option>
                <option value="3" <?=$sel3?>>Bank Cheque</option>
                <option value="4" <?=$sel4?>>Tele Transfer</option>
                <option value="5" <?=$sel5?>>Credit Card</option>
            </select>
        	<select name="noofcheck" onChange="addcheck(this.value,<?=$paymenttype?>)">
                <option value="0"><?=$disname?></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select>

		</td>
	</tr>
    <tr>
              <td colspan="1" align='right'>Total&nbsp;&nbsp;</td>
               <td align='' colspan="3" nowrap><?=$currencydes[0]?><input type="text" name="amt" id="amt" value="<?=$amt?>" style="text-align:right" width="10" size='10' ><?=$currencydes[1]?>&nbsp;&nbsp;
            	</td>
            </tr>
    <tr>
              <td colspan="1" valign="middle" align="center">Remarks </td><td colspan="3" align="center"><textarea name="remk" cols="50" rows="5"></textarea></td>
            </tr></table>

<div id="txtHint9" class="inline">   
</div>
<!--<br>
<div align="center">
<input type='button' class='bgbutton' name='sub1' value='Submit'>
</div>-->
<br>
<?php
if(!$paymenttype)
die();

	?>
       
           
<br>
<div align="center">
<input type="submit" name="submit" class="bgbutton" value="   Print   " onClick="genrpt1()">
</div>
<?php
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}

?>
</body>
</form>

</html>