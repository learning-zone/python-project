<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$date=date("d/m/Y");
$msg=$_REQUEST['msg'];
$ms=$_REQUEST['ms'];
$n=$_REQUEST['name1'];
$d=$_REQUEST['date'];
$m=$_REQUEST['month'];
$y=$_REQUEST['year'];
$add=$_REQUEST['add'];
$c=$_REQUEST['country'];
$pin=$_REQUEST['pin'];
/*$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
echo "tomorrow is :".date("d/m/y",$tomorrow);*/
$array=array('01','02','03','04','05','06','07','08','09','10','11','12');
try
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<script language="javascript">
	function showdep(str)
{
var url="ajaxdepp.php";
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
    document.getElementById("t11").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function validate()
{
	var illegalChars = /\W/;
  // allow only letters, numbers, and underscores
    if (illegalChars.test(document.form1.txtuname.value))
    {
       error = "Username contains Illegal Characters.\n";
	   window.alert(error);
	   return false;
    } 
	<?php /*?>if(isNaN(document.form1.txtname.value))
	{
		window.alert("Enter Alphabet");
		document.form1.txtname.focus();
		return false;
	}<?php */?>
	if(document.form1.cmbin.value=="select")
	{
		window.alert("Select Department");
		return false;
	}
	if(document.form1.utype.value=="select")
	{
		window.alert("Select User Type");
		return false;
	}
	if(document.form1.txtname.value=="")
	{
		window.alert("Enter Name");
		document.form1.txtname.focus();
		return false;
	}
	if(document.form1.combodate.value=="date")
	{
		window.alert("Select DOB Date");
		return false;
	}
	if(document.form1.combomonth.value=="month")
	{
		window.alert("Select DOB Month");
		return false;
	}
	if(document.form1.comboyear.value=="year")
	{
		window.alert("Select DOB Year");
		return false;
	}
	if(document.form1.txtaddress.value=="")
	{
		window.alert("Enter Address");
	    document.form1.txtaddress.focus();
		return false;
	}
	if(document.form1.txtcountry.value=="")
	{
		window.alert("Enter Country");
		document.form1.txtcountry.focus();		
		return false;
	}
	if(document.form1.txtpin.value=="")
	{
		window.alert("Enter pin Code");
		document.form1.txtpin.focus();
		return false;
	}
	if(document.form1.txtpin.value.length<6)
	{
		window.alert("Enter Valid pin Code");
		document.form1.txtpin.focus();
		return false;
	}
	if(isNaN(document.form1.txtpin.value))
	{
		window.alert("Enter a Valid Pin");
		document.form1.txpin.focus();
		return false;
	}
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
	if(document.form1.txtpass.value.length<6)
	{
		window.alert("Password Too Short");
		document.form1.txtpass.focus();
		return false;
	}
	if(document.form1.txtcpass.value=="")
	{
		window.alert("Re enter Password");
		document.form1.txtcpass.focus();
		return false;
	}
	if(document.form1.txtpass.value!=document.form1.txtcpass.value)
	{
		window.alert("Password Mismatch");
		document.form1.txtcpass.focus();
		return false;
	}
}
</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style5 {font-size: 13px}
.style7 {font-size: 13px; font-weight: bold; }
-->
    </style>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 >Account Management</h1>
     </div>
    </div>
    <div id="body">
      <?php
	if($tp=='u')
	{
	include("usermenu.php");
	  }
	  else
	  {
	 include("adminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="adduseraction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 239px; top: 144px; width: 634px; height: 444px;layer-background-color: #CCCCCC; border: 1px none #000000;">
              <tr>
                <th height="24" colspan="3" scope="row" id="hd"><div align="center">
                  <span class="style1 style6">USER DETAILS </span>
                  </div>      </th>
      </tr>
              <tr>
                <th height="22" colspan="3" scope="row"><?php echo $ms;?></th>
      </tr>
              <tr>
                <th height="22" scope="row">ORGANIZATION</th>
                <th height="22" colspan="2" scope="row" align='left'><select name="comboorg" onchange="showdep(this.value)"><option value="select">-SELECT-</option>
            <?php
			$qry=execute("select * from ac_organization");
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
            <option value="<?php echo $row[vorgname]; ?>">  <?php echo $row[vorgname]; ?>	  </option>
            <?php }  ?>
            </select>&nbsp;</th>
              </tr>
              <tr>
                <th height="22" scope="row"><strong>DEPARTMENT</strong></th>
        <th height="22" colspan="2" scope="row"><div align="left" id="t11"><select name="cmbin">
          <option value="select">-SELECT-</option>
         
          </select>&nbsp;</div></th>
      </tr>
              <tr>
                <th height="22" scope="row">User Type </th>
        <th height="22" colspan="2" scope="row"><label><div align="left">
          <select name="utype">
            <option value="select">-SELECT-</option>
            <?php
		$qq=execute("select * from ac_usertype");
		while($ru=mysql_fetch_assoc($qq))
		{
		?>
            <option value="<?php echo $ru[iIdx_usertype];?>"><?php echo $ru[vusertype];?></option>
            <?php
		}
		?>
            </select></div>
        </label></th>
      </tr>
              
              <tr>
                <th width="164" height="22" class="style16" scope="row"> Name</th>
        <td colspan="2"><label>
          <input type="text" name="txtname" value="<?php echo $n;?>"/><font color="red"><?php echo $msg1;?></font>
          </label></td>
      </tr>
              <tr>
                <th height="23" scope="row"><span class="style22">DOB</span></th>
        <td colspan="2"><strong>
          <select name="combodate">
            <option value="date">-DATE-</option>
            <?php
		for($i=1;$i<32;$i++)
		{
		?>
            <option value="<?php echo $i; ?>" <?php if($d==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
            <?php
		}?>
            </select>
          
          <select name="combomonth">
            <option value="month">-MONTH-</option>
            <?php
		 for($i=0;$i<12;$i++)
		 {
		 
		?>
            <option value="<?php echo $array[$i];?>" <?php if($m==$array[$i]){?>selected="selected"<?php }?>><?php echo $array[$i];?></option>
            <?php
		}
		?>
            </select>
          
          <select name="comboyear">
            <option value="year">-YEAR-</option>
            <?php
		for($i=1900;$i<1993;$i++)
		{
		?>
            <option value="<?php echo $i; ?>" <?php if($y==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
            <?php
		}
		?>
            </select></strong><font color="red"><?php echo $msg2;?></font></td>
      </tr>
              <tr>
                <th height="83" scope="row"><span class="style22">Address</span></th>
        <td colspan="2"><label>
          <textarea name="txtaddress" rows="5"><?php echo $add;?></textarea><font color="red"><?php echo $msg5;?></font>
          </label></td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">Country</span></th>
        <td colspan="2"><label>
          <input type="text" name="txtcountry" value="<?php echo $c;?>"/><font color="red"><?php echo $msg6;?></font>
          </label></td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">Pincode</span></th>
        <td colspan="2"><label>
          <input type="text" name="txtpin" value="<?php echo $pin;?>"/><font color="red"><?php echo $msg7;?></font>
          </label></td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">User Name </span></th>
        <td colspan="2"><label>
          <input type="text" name="txtuname" /><font color="red"><?php echo $msg;?></font>
          </label></td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">Password</span></th>
        <td colspan="2"><input type="password" name="txtpass" /><font color="red"><?php echo $msg9;?></font>&nbsp;</td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">Confirm Password </span></th>
        <td colspan="2"><input type="password" name="txtcpass" /><font color="red"><?php echo $msg10;?></font>&nbsp;</td>
      </tr>
              <tr>
                <th height="22" scope="row"><span class="style22">Date</span></th>
        <td colspan="2"><input type="text" name="txtdate" value="<?php echo $date;?>" />&nbsp;<input type="hidden" name="d" value="<?php echo $org;?>" /></td>
      </tr>
              
              <tr>
                <th scope="row">&nbsp;</th>
        <td colspan="2"><input type="submit" value="Save" />&nbsp;<input type="reset" name="btnreset" value="Reset"/>
          <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewusers.php&quot;' value='View Users' /></td>
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
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
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
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p>
			  
                    
        </div>
      </div>
        
      <div class="clear"> </div>
        <div id="seas">
          
          <div class="clear"> </div>
        </div>
    </div><div id="copyright">
      <p>All rights reserved</p>
    </div>
  </div>
</body>
</html>
<?php
}
catch(Exception $ex)
{
echo $ex->getMessage();
}
?>
