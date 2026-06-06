<?php
session_start();
include("../connection.php");
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
 
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
$date=isset($_REQUEST["dateatt"]) ? $_REQUEST["dateatt"] : "";
$shift=$_POST['comboshift'];
$jtype=$_POST['jtype'];
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
	function showemp(str)
{
var url="ajaxempname.php";
url=url+"?q="+str;
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

function showid(str)
{
var url="ajaxempid.php";
url=url+"?q="+str;
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
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
	function validate()
	{
	if(document.form1.jtype.value=="select")
	{
	window.alert("Select Job Type");
	return false;
	}
	if(document.form1.txtjob.value=="")
	{
	window.alert("Enter Job Position");
	document.form1.txtjob.focus();
	return false;
	}
	}
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
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
          <form id="form1" name="form1" method="post" action="staffattendanceaction.php" onsubmit="return validate();">
          <table width="359" border="0" align="center" id="tbl" cellspacing="0">
            <tr id="th">
              <th height="26" colspan="6" scope="row">ATTENDANCE</th>
            </tr>
            <tr id="td1">
              <th height="21" colspan="6" scope="row"><div align="right"></th>
            </tr>
            <tr id="td1">
              <th height="33" scope="row">Institution:</th>
              <?php 
	  if($type=='a')
	  {
	  ?>
      <td colspan="2"><select name="comboin">
        <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
        <?php
		$qry2=mysql_query("select * from ac_institution");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
        <option value="<?php echo $row[iIdx_institution]; ?>"><?php echo $row[vinstitution]; ?></option>
        <?php } ?>
      </select>      &nbsp;</td>
	  <?php
	  }
	  else
	  {
	  ?>
	  <td colspan="2"><input type="txt" name="txtins" value="<?php echo $ins;?>" readonly="true" /></td>
	  <?php
	  }
	  ?>
            </tr>
            <tr id="td1">
              <th height="33" scope="row"><div align="right">Date</div></th>
              <td id="td1"><?php
	 echo date('d-m-Y',strtotime($date));;
	  ?>&nbsp;</td>
              <td width="38"><div align="center"><strong>Shift&nbsp;</strong></div></td>
              <td width="189" >	  <?php if($shift==1){$sh="First Shift";} if($shift==2){$sh="Second Shift";}?>
                <select name="comboshift" readonly>
                  <option value="<?php echo $shift;?>" readonly><?php echo $sh;?></option>
                </select></td>
              <td width="113" ><div align="right"><strong><span class="style18"> Job Type </span></strong></div></td>
              <td width="212" ><select name="jtype" readonly>
                <?php if($jtype==1){$jt="Teaching Staffs";} if($jtype==2){$jt="Non Teaching Staffs";} if($jtype==3){$jt="Other Staffs";}?>
                <option value="<?php echo $jtype;?>" readonly><?php echo $jt;?></option>
              </select></td>
            </tr>
            <tr id="td1">
              <th height="33" scope="row"><div align="right">ID</div></th>
              
              <td id="td1"><div id="txtHint2">
                <select name="comboid" onchange="showemp(this.value)">
                  <option value="select">-SELECT-</option>
				  <?php
				  $q1=mysql_query("select * from emp_details where vemp_designation='".$jtype."'");
				  while($rr=mysql_fetch_assoc($q1))
				{
				?>
				<option value="<?php echo $rr[iId_emp];?>"><?php echo $rr[vemp_id];?></option>
				
				}
				<?php
				}
				?>
                </select>
              </div></td>
              <td><div align="center"><strong>Name</strong></div></td>
              <td><input type="text" name="txtname" readonly="true"/></td>
              <td><div align="right"><strong>Designation</strong></div></td>
              <td><label>
                <input type="text" name="txtpos" readonly="true" />
              </label></td>
            </tr>
            <tr id="td1">
              <th height="27" scope="row"><div align="right">Status</div></th>
              <td><div align="left"><strong>
                <input type="radio" name="ratt" value="P" />
                Present</strong>
                  <div align="left"><strong>
                    <input type="radio" name="ratt" value="A" />
                    Absent</strong></div>
              </div>              <label></label></td>
              <td colspan="4"><label></label></td>
            </tr>
            <tr id="td1">
              <th height="26" scope="row">&nbsp;</th>
              <td>&nbsp;</td>
              <td colspan="4"><input name="submit2" type="submit" value="Save" align="middle"/>
              <input name="submit" type="reset" value="Reset" align="middle"/></td>
            </tr>
            <tr id="td1">
              <th width="79" height="62" scope="row">&nbsp;</th>
              <td width="155"><strong>
  <label></label>
              </strong></td><td colspan="4">&nbsp;</td>
            </tr>
            <tr id="td1">
              <th height="34" scope="row">&nbsp;</th>
              <th scope="row"><p>
                <label></label>
                <label></label>
                </p></th>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr id="td1">
              <th scope="row">&nbsp;</th>
              <th scope="row">&nbsp;</th>
              <td colspan="4">&nbsp;</td>
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
