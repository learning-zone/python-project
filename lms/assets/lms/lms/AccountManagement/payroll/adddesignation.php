<?php
session_start();
include("../connection.php");
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
 
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['ior'];
$qy=mysql_query("select vorgname from ac_organization where iIdx_organization='$org'");
$re=mysql_fetch_row($qy);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="../scripts/jquery.min.js"></script> 
<script type="text/javascript" src="../scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	<script language="javascript">
	function showdept(str)
{
var url="ajaxdept.php";
//var str1=document.form1.comboin.value;
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
    document.getElementById("1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
	function validate()
	{
	
	if(document.form1.txtjob.value=="")
	{
	window.alert("Enter Job Position");
	document.form1.txtjob.focus();
	return false;
	}
	if(document.form1.comboin.value=="select")
	{
	window.alert("Select Organization");
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
          <form id="form1" name="form1" method="post" action="addjobaction.php" onsubmit="return validate();">
          <table width="359" border="0" align="center">
            <tr>
              <th height="26" colspan="4" scope="row"><div align="center" id="hd"></a>ADD JOB POSITIONS </div></th>
            </tr>
            <tr>
              <th height="15" colspan="4" scope="row"><div align="right"></div></th>
            </tr>
            <tr>
              <th height="33" scope="row">Organization</th>
              <td><?php 
	  if($type=='a')
	  {
	  ?>
                   <select name="comboin" onchange="showdept(this.value)">
        <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
        <?php
		$qry2=mysql_query("select * from ac_organization");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
        <option value="<?php echo $row[iIdx_organization]; ?>"><?php echo $row[vorgname]; ?></option>
        <?php } ?>
      </select>      &nbsp;
	  <?php
	  }
	  else
	  {
	  ?>
	 <input type="txt" name="txtins" value="<?php echo $re[0];?>" readonly="true" />
	  <?php
	  }
	  ?></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            
            <tr>
              <th width="109" height="33" scope="row"><strong>Job Position </strong></th>
              <td width="190"><input type="text" name="txtjob" /></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <th scope="row">&nbsp;</th>
              <th scope="row"><input name="submit" type="submit" value="Save" align="middle"/>
                <label>
                <input type="reset" name="Submit" value="Reset" />
                </label>
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewjobs.php&quot;' value='View' /></th>
              <td colspan="2">&nbsp;</td>
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

