<?php
session_start();
include("../connection.php");
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
$name=$_SESSION['name'];
$type=$_SESSION['type'];
$btn=$_POST['S1'];
if($type=='a')
{
$org=$_POST['comboin'];
}
else
{
$org=$_SESSION['ior'];
}
$date=isset($_REQUEST["dateatt"]) ? $_REQUEST["dateatt"] : "";
$shift=$_POST['comboshift'];
$dept=$_POST['cmbdep'];
//echo $org.$dept.$shift.$date;
$qq=mysql_query("select vorgname from ac_organization where iIdx_organization='".$org."'");
 $obj=mysql_fetch_row($qq);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="../scripts/jquery.min.js"></script> 
<script language="javascript" src="../calendar.js"></script>
<script language="javascript" src="../calendar1.js"></script>
<script type="text/javascript" src="../scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	<script language="javascript">
	function saveatt(str,id)
{
var url="ajaxatt.php";
var ins=document.form1.ins1.value;
var date=document.form1.atdate.value;
var shft=document.form1.shiftid.value;
var dept=document.form1.deptid.value;
url=url+"?q="+str;
url=url+"&r="+date;
url=url+"&s="+shft;
url=url+"&t="+dept;
url=url+"&u="+id;
url=url+"&v="+ins;
url=url+"&sid="+Math.random();

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
	//var sss=xmlhttp.responseText.split(',');
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style3 {
	color: #CC3300;
	font-weight: bold;
}
-->
    </style>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="../logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 class="style2">Account Management</h1>
     </div>
    </div>
    <div id="body">
	<?php
	if($type=='u')
	{
	include("pusermenu.php");
	}
	else
	{
	 include("padminmenu.html");
	}
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="attendance.php" onsubmit="return validate();">
          <table width="823" border="0" align="center" id="tbl" cellspacing="0">
            <tr id="th">
              <th height="26" colspan="7" scope="row">ATTENDANCE</th>
            </tr>
            <tr id="td1">
              <th height="21" colspan="7" scope="row"><div align="center"><?php echo $obj[0];?><input type="hidden" name="ins1" value="<?php echo $org;?>" /></div></th>
            </tr>
            <tr id="td1">
              <th height="32" scope="row"><div align="right">Date</div></th>
              <td id="td1"><?php
	 echo date('d-m-Y',strtotime($date));;
	  ?>&nbsp;<input type="hidden" name="atdate" value="<?php echo $date;?>" /></td>
              <td width="35"><div align="center"><strong>Shift&nbsp;</strong></div></td>
              <td width="169" >	  <?php if($shift==1){$sh="First Shift";} if($shift==2){$sh="Second Shift";}?>
			  <input type="text" name="comboshift" value="<?php echo $sh;?>" readonly="true"/>
			  <input type="hidden" name="shiftid" value="<?php echo $shift;?>" />                </td>
              <td width="103" ><div align="right"><strong><span class="style18"> Department </span></strong></div></td>
              <td colspan="2" >
			  <?php
			  $q3=mysql_query("select * from ac_institution where iIdx_institution='".$dept."'");
			  $w3=mysql_fetch_object($q3);
			  ?>
			   <input type="text" name="jtype" value="<?php echo $w3->vinstitution;?>" readonly="true" />
			  <input type="hidden" name="deptid" value="<?php echo $dept;?>" />			  </td>
            </tr>
            
            <tr id="th1">
              <th height="15" scope="row">Sl.No.</th>
              <td><div align="center">EMPLOYEE ID </div></td>
              <td colspan="2"><div align="center">EMPLOYEE NAME </div></td>
              <td><div align="center">DESIGNATION</div></td>
              <td><div align="center">STATUS</div></td>
              <td>FULL DAY/HALF DAY </td>
            </tr>
			<?php
			$q1=mysql_query("select * from emp_details1 where iIdx_institution='".$dept."'");
			while($row1=mysql_fetch_assoc($q1))
			{
			$q2=mysql_query("select * from emp_job where iId_job='".$row1[iemp_designation]."'");
			$w2=mysql_fetch_object($q2);
			?>
            <tr id="td1">
              <th width="54" height="22" scope="row"><?php echo $row1[iId_emp];?></th>
              <td width="125"><?php echo $row1[vemp_id];?> <input type="hidden" name="empid" value="<?php echo $row1[vemp_id];?>" /></td>
			  <td colspan="2"><?php echo $row1[vemp_name];?> <input type="hidden" name="empname" value="<?php echo $row1[vemp_name];?>" /></td>
              <td><?php echo $w2->vjob;?> <input type="hidden" name="empjob" value="<?php echo $row1[iemp_designation];?>" /></td>
              <td width="178">
			 <?php
			 $q4=mysql_query("select * from emp_attendance where att_department='".$dept."' and att_date='".$date."' and att_empid='".$row1[vemp_id]."' and att_shift='".$shift."'");
			
			$w4=mysql_fetch_object($q4);
		 
			 
			 $q4=mysql_query("select count(*) from emp_attendance where att_date='".$date."' and att_shift='".$shift."' and att_empid='".$row1[vemp_id]."' ");
$num=mysql_fetch_row($q4);
if($btn=='Edit')
{
?><?php if($w4->att_status=='P')
	{?>
	<select name="ratt" onchange="saveatt(this.value,<?php echo $row1[vemp_id];?>)">
	
		<option value="<?php echo $w4->att_status;?>">Present</option>
		<option value="A">Absent</option></select>
	<?php } ?>
	<?php if($w4->att_status=='A'){?>
	<select name="ratt" onchange="saveatt(this.value,<?php echo $row1[vemp_id];?>)">
	<option value="<?php echo $w4->att_status;?>">Absent</option>
		<option value="P">Present</option></select>
	<?php } ?>
	
<?php
}
if($btn=='GO>')
{
			 if($w4->att_status=='P')
			 {
			 echo "<b>Present</b>";
			 }
			 else if($w4->att_status=='A')
			 {
			 echo "<b><font color=red>Absent</font></b>";
			 }
			 
			else
			{
			 ?>
			  <select name="ratt" onchange="saveatt(this.value,<?php echo $row1[vemp_id];?>)"><option value="0">-SELECT-</option><option value="P">Present</option><option value="A">Absent</option></select>
			  <?php
			  }
			  }
			  ?>
<div id="txtHint1"></div><div align="left"></div></td>
              <td width="120"><div id="b">
                <label>
                <select name="rh">
				<option value="f">Full Day</option>
				<option value="f">Half Day</option>
                </select>
                </label>
               </div></td>
            </tr>
			<?php
			}
			?>
            <tr id="td1">
              <th height="59" colspan="7" scope="row"><p>
                <label></label>
                <label></label>
              </p><div id="txtHint"></div>
                <div align="right">
                  <label>
                  <input type="submit" name="Submit" value="Save" onclick='javascript:window.alert("Data Saved Successfully");'/>
                  </label>
                  <input name="button" type='button' onclick='javascript:window.location.href=&quot;attendance.php&quot;' value='Back' />
              </div></th>
            </tr>
          </table>
		  </form>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><strong> </strong></p>
          <p></p><br/><br/><br/><br/><br/><br/><br/>
			<p></p>
			
                    
        </div>
      </div>
      
      <div class="clear"> </div>
      <div id="seas">
        
        <div class="clear"> </div>
      </div>
    </div>
    <div id="copyright">
      <p></p>
    </div>
  </div>
</body>
</html>

