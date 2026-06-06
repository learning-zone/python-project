<?php
session_start();
include("../connection.php");
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
$name=$_SESSION['name'];
 
$type=$_SESSION['type'];
$org=$_SESSION['ior'];
$qy=mysql_query("select vorgname from ac_organization where iIdx_organization='$org'");
$re=mysql_fetch_row($qy);
$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
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
	function validate()
	{
	if(document.form1.cmbdep.value=="select")
	{
	window.alert("Slect Department");
	return false();
	}
	if(document.form1.combomonth.value=="select")
	{
	window.alert("Select Month");
	return false;
	}
	if(document.form1.txtwdays.value=="")
	{
	window.alert("Enter Number Of working days");
	document.form1.txtwdays.focus();
	return false;
	}
	}
	function showdept(str)
{
var url="ajaxdept1.php";
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
    document.getElementById("2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function validate()
{

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
          <form id="form1" name="form1" method="post" action="salarycalaction" onsubmit="return validate();">
            <div align="center">
              <table width="530" border="0" align="center" cellspacing="1" >
                <tr >
                  <th height="26" colspan="4" scope="row">&nbsp;</th>
                </tr>
                <tr>
                  <th height="26" colspan="4" scope="row">&nbsp;</th>
                </tr>
                <tr>
                  <th height="26" colspan="4" scope="row">&nbsp;</th>
                </tr>
                <tr id="hd">
                  <th height="26" colspan="4" scope="row">SALARY CALCULATION </th>
              </tr>
                
                <tr>
                  <th height="33" scope="row">&nbsp;</th>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <th height="33" scope="row"><div align="center">Organization:</div></th>
                  <td colspan="3"><div align="left"><b>
                    <?php 
	  if($type=='a')
	  {
	  ?>
                    <select name="comboin" onchange="showdept(this.value)" >
                      <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <?php
		$qry2=mysql_query("select * from ac_organization");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
                      <option value="<?php echo $row[iIdx_organization]; ?>"><?php echo $row[vorgname]; ?></option>
                      <?php } ?>
                                 </select>      
                    &nbsp;
                    <?php
	  }
	  else
	  {
	  echo $re[0];
	 
	  }
	  ?>
                  </b></div></td>
                </tr>
                <tr>
                  <th height="33" scope="row">Department:</th>
                  <td colspan="3">
				  <div align="left">
				    <?php
				  if($type=='a')
	 			  {
				  ?>
				    </div>
				  <div id="2">
				    <div align="left">
				      <select name="cmbdep">
				          <option value="select">-SELECT-</option>
			          </select>
			        </div>
				  </div>
				  <div align="left">
				    <?php
				  }
				  else
				  {
				 
				   $qry21=mysql_query("select * from ac_institution where iIdx_organization='$org'");  
				   ?>
				    <select name="cmbdep"> 
				      <option value="select">-SELECT-</option>
				      <?php
	  while ($row1 = mysql_fetch_assoc($qry21))
      {
				  ?>
				      
				      
				                  <option value="<?php echo $row1[iIdx_institution]; ?>"><?php echo $row1[vinstitution]; ?></option>
	                  <?php } ?>
			                      </select> 
			        <?php
				  }?>				  
			      </div></td>
                </tr>
                <tr>
                  <th width="187" height="33" scope="row">Month:</th>
                  <td colspan="3"><div align="left"><b>&nbsp;
                    <select name="combomonth" onchange="showpdays(this.value)">
                       <option value="select">-SELECT-</option>
                      <?php
				  for($i=0;$i<12;$i++)
		 			{
		 
					?>
                      <option value="<?php echo $i+1;?>"><?php echo $array[$i];?></option>
                      <?php
					}
					?>
                            </select>
                  </b></div></td>
                </tr>
               <!-- <tr>
                  <th height="33" scope="row"><div align="center"><strong>Shift&nbsp;</strong>:</div></th>
                
              <td colspan="3">&nbsp;<div align="left">
                <select name="comboshift" disabled="disabled">
                    <option value="select">GENERAL SHIFT</option>
                    <option value="1">First Shift</option>
                    <option value="2">Second Shift</option>
                  </select></div></td>
                </tr>-->
                
                <tr>
                  <th height="33" scope="row">Year:</th>
                  <th scope="row">
                    <div align="left">
                      <select name="comboyr">
                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                        <?php
		for($i=2005;$i<2038;$i++)
		{
		?>
                        <option value="<?php echo $i; ?>" <?php if($y==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
                        <?php
		}
		?>
                      </select>
                  </div></th>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <th height="35" scope="row">No: Of working days: </th>
                  <th scope="row">
                    <div align="left">
                      <input type="text" name="txtwdays" />
                     </div></th>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <th width="210" scope="row">&nbsp;</th>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <th colspan="2" scope="row"><input name="S1" type="submit" value="View" align="middle"/>
                    <input name="submit" type="reset" value="Reset" align="middle"/>
                    <label>                    </label></th>
                <td width="123" colspan="2">&nbsp;</td>
              </tr>
              </table>
            </div>
          </form>
          
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
		   <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p> <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p> <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center"><strong> </strong></p>
          <p align="center"></p>
          
          <p align="center"></p>
        </div>
      </div>
      
      <div class="clear"> </div>
      <div id="seas">
        
       <div class="clear"> </div>
      </div>
    
    
  </div></div>
</body>
</html>

