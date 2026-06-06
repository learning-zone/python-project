<?php
session_start();
include("../db.php");
unset($_SESSION['name']);
$ms=$_REQUEST['ms'];
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$msgg=$_REQUEST['msgg'];
$org=$_REQUEST['org'];
$uname=$_REQUEST['uname'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	<script language="javascript">
	function showins(str)
{
var url="ajaxins.php";
//var str1=document.form1.ins3.value;
url=url+"?q="+str;
//url=url+"&p="+str1;
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function validate()
{
	if(document.form1.txtuname.value=="")
	{
		window.alert("Enter User Name");
		document.form1.txtuname.focus();
		return false;
	}
	if(document.form1.txtpass.value=="")
	{
		window.alert("Enter Password");
		document.form1.txtpass.focus();
		return false;
	}
}
</script>
    <style type="text/css">
<!--
.style5 {
	color: #660033;
	font-size: 12px;
}
-->
    </style>
</head>

<body >
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
            <div id="cart-cart" align="right">
              <p> <?php echo $ms;?></p>
            </div>
         
      </div>
	  <div id="logo">
      <h1>Account Management</h1>
     </div>
    </div>
    <div id="body1">
     <div id="categories">
	  
	  </div>
      <div id="seasonal">
        <div class="inner">
		<form  name="form1" id="form1" method="post" action="loginaction.php" onsubmit="return validate();">
				<table width="496" border="0"  style="position:absolute; left: 341px; top: 156px; width: 443px; height: 155px;">
     
     <tr>
       <th colspan="3" scope="row">&nbsp;</th>
       </tr>
     <tr>
       <th width="92" scope="row"><div align="left"></div></th>
       <th width="152" scope="row"><span class="style5">LOGIN</span></th>
       <th width="185" scope="row">&nbsp;</th>
     </tr>
     
     <tr>
       <th height="16" scope="row">&nbsp;</th>
       <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
       <th height="39" scope="row"><div align="right">USERNAME </div></th>
       <td colspan="2"><input type="text" name="txtuname" value="master" />
           <font color="red"><?php echo $msg2;?></font></td>
     </tr>
     <tr>
       <th scope="row"><div align="right">PASSWORD</div></th>
       <td colspan="2"><input type="password" name="txtpass" value="master!@#"/>
         &nbsp;<font color="red"><?php echo $msg1;?></font></td>
     </tr>
     <tr>
       <th scope="row">&nbsp;</th>
       <td colspan="2"><font color="red"><?php echo $msg3;?></font></td>
     </tr>
     <tr>
       <th scope="row">&nbsp;</th>
       <td colspan="2"><input type="submit" name="btnlogin" value="Login" />
         &nbsp;</td>
     </tr>
     <tr>
       <th scope="row">&nbsp;</th>
       <td colspan="2"> <div align="center"></div> </td>
     </tr>
   </table>
  
   </form>
          <h2>&nbsp;</h2>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><strong> </strong></p>
          <p></p><br/><br/><br/><br/>
          <br/>
          <br/><br/>
			<p></p>
			
                    
        </div>
      </div>
      
      <div class="clear"> </div>
      <div id="seas">
        
        <div class="clear"> </div>
      </div>
    </div>
    <div><table width='100%'>
	<tr><td width='40%'></td><td>
      All rights reserved </td></tr>
    </div>
  </div>
</body>
</html>