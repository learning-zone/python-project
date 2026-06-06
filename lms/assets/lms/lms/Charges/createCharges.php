<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<?php
session_start();
include("../db.php");
$action=$_REQUEST['action'];
$update=$_POST['update'];
$course=$_POST['course'];
$FromYear=$_POST['FromYear'];
$save=$_POST['save'];
$chargesName=$_POST['chargesName'];
$price=$_POST['price'];
$price=$_POST['price'];
$stu_id=$_REQUEST['stu_id'];
$subid=$_POST['subid'];
$rcot=$_POST['rcot'];
$descr=$_POST['descr'];
$date1 = date("d/m/Y");
$date3=$_POST['date3'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$ename=$_POST['ename'];

$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="createCharges.php";
	document.frm.submit();
}
function selectMe(i)
{
	var a = parseInt(document.getElementById("max_"+i).value);
	if(isNaN(a))
	{
		document.getElementById("m_"+i).checked=false;
		document.getElementById("max_"+i).value='';
	}
	else
	{
		if(a<1)
		{
			document.getElementById("m_"+i).checked=false;
			document.getElementById("max_"+i).value='';
		}
		else
		{
			document.getElementById("m_"+i).checked=true;
		}
	}
}
function selectMe1(i)
{
	var a = parseInt(document.getElementById("maxm_"+i).value);
	if(isNaN(a))
	{
		document.getElementById("mm_"+i).checked=false;
		document.getElementById("maxm_"+i).value='';
	}
	else
	{
		if(a<1)
		{
			document.getElementById("mm_"+i).checked=false;
			document.getElementById("maxm_"+i).value='';
		}
		else
		{
			document.getElementById("mm_"+i).checked=true;
		}
	}
}
</SCRIPT>
<BODY>
<?php
if($action=='' and $stu_id=='') 
{	?>
    <a href="createCharges.php?action=mod">Modify</a><br>
    <?php
}
if($action=='mod' and $stu_id=='') 
{?>
    <a href="createCharges.php">Add New</a><br>
    <?php
	$sytemdate=date("Y-m-d");
	?>
    <table  class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Modify Charges </td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic">Charges Name</td>
    <td align="center" class="rowpic">Price</td
    ><td align="center" class="rowpic">From</td>
    <td align="center" class="rowpic">To</td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from charges");
	while($r=fetcharray($temsql3))
	{
		echo "<tr height='25'>
    <td align='center'>$inc</td>
    <td nowrap>&nbsp;&nbsp;<a href='createCharges.php?stu_id=$r[id]'>$r[charge_name]</a></td>
    <td nowrap>&nbsp;&nbsp;$r[price]</td>
	<td align='center' nowrap>$r[from_date]</td>
    <td align='center' nowrap>$r[to_date]</td>
  </tr>";
  $inc++;
	}
	
	?>
	</table>
    <?
}
if(isset($update))
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
	
	$vct=0;
	$subidstr='';
	$mmks='';
	
	//echo "update exam_m set descr='$descr',sub_id='$subidstr',f_date='$fdate' , t_date='$tdate', exam_name='$ename', max_mark='$mmks',vct='$vct' where id='$stu_id'";
			
		execute("update charges set narration='$descr' , from_date='$fdate' , to_date='$tdate' where id='$stu_id' ");
	
	$course='';
	$FromYear='';
	$adate='';
	$date3='';
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	
}
if($stu_id!='')
{
		?>
    <a href="createCharges.php">Add New</a>
    <?php
	$temsql4=execute("select * from charges where id='$stu_id'");
	while($r1=fetcharray($temsql4))
	{
		$chargesName=$r1['charge_name'];
		$price=$r1['price'];
		$adate=$r1['from_date'];
		$bdate=$r1['to_date'];
		$descr=$r1['narration'];
		$status=$r1['status'];
	}
	$tfdate=explode('-',$adate);
	$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
	$ttdate=explode('-',$bdate);
	$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];
	
?>
	<FORM NAME='frm' METHOD=POST >
    <input type="hidden" name='stu_id' value="<?=$stu_id?>">
	<table class='forumline' align='center' width="40%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Modify Charges </td>
	</tr>
	<tr height='25'>
	<td nowrap>&nbsp;&nbsp;Charges Name</td>
	<td align="left" nowrap>&nbsp;&nbsp;
	<?
		echo $chargesName;
	?></td></tr>
	<tr height='25'>
	<td>&nbsp;&nbsp;Price</td>
	<td >&nbsp;&nbsp;
	<?php
	echo $price;
	?></td></tr>
	
		<tr>
		<td>&nbsp;&nbsp;From</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td nowrap>&nbsp;		<textarea name="descr" id="descr" rows="3" cols="20" ><?=$descr?></textarea>
</td>
		</tr></table>
		
	  <br>
	  <div align="center">
		<input type="submit" name="update" value="UPDATE" class="bgbutton">
	  </div>

</FORM>
	<?php
}

if(isset($save))
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
	$temsql=execute("select * from exam_m where curriculam='$course' and class='$FromYear' and f_date='$fdate' and t_date='$tdate' and exam_name='$ename'");
	$accyear=date("Y");
	if(date('m')<6)
		$accyear--;
	/*$temsql12=execute("select max(exam_count) from exam_m where curriculam='$course' and class='$FromYear' and accyear='$accyear'");
	$examid=fetchrow($temsql12);
	$examidcount=$examid[0]+1;
	if(rowcount($temsql)>0)
		echo "<font color='#FF0000'>Duplicate entry not allowed</font> <br>";
	else
	{*/
		$date1=date("Y-m-d");
		execute("insert into charges (charge_name, narration, from_date, to_date, price) values('$chargesName','$descr','$fdate','$tdate','$price')");
		
		//ledger creation 
		
		execute("INSERT INTO `ac_ledger` (`vledger`, `iIdx_group`, `vcode`, `vdescription`, `vcontactperson`, `vdesignation`, `imobile`, `itype`, `fopbal`, `date`, `iIdx_organization`) VALUES
('$chargesName', 18, '', '$descr', '', '', 0, 'Dr', 0.00, '$date1', 1)");

execute("INSERT INTO `ac_opbal` (`opdate`, `Vledger`, `fopbal`, `iId_grp`, `vins`, `Dr_Cr`, `iIdx_organization`) VALUES
('$date1', '$chargesName', 0.00, 18, 'Bangalore School', 'Dr', 1)");
		
		//ledger creation end
		$course='';
		$FromYear='';
		$adate='';
		$date3='';
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		</script>
		<?php
		
	//}
}
if($action=='' and $stu_id=='') 
{
	?>
	<FORM NAME=frm METHOD=POST >
	<table class='forumline' align='center' width="40%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare Charges </td>
	</tr>
	<tr>
	<td width="60%" nowrap>&nbsp;&nbsp;Charges Name </td>
	<td  align="left">&nbsp;
	<input type="text" name="chargesName" id="chargesName">
	</td></tr>
	
	  <tr>
	<td>&nbsp;&nbsp;Price</td>
	<td colspan="2">&nbsp;
	<input type="text" name="price" id="price"> </td></tr>
	
		<tr>
		<td nowrap>&nbsp;&nbsp;From</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly="" name="adate" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly="" name="bdate" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td colspan='2' nowrap align="center">&nbsp;
		
		<textarea name="descr" id="descr" rows="3" cols="20" ><?=$descr?></textarea></td>
		</tr></table>
		<br>
	  <div align="center">
		<input type="submit" name="save" value="SAVE" class="bgbutton">
	  </div>
		
</FORM>
	<?php
}
?>

</BODY>
</HTML>