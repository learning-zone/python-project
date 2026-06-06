<?php
session_start();
include("../connection.php");
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
 
$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
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
	function showemp(str)
{
var url="ajaxemp.php";
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
	var sss=xmlhttp.responseText.split(',');
    document.getElementById("txtHint1").innerHTML=sss[0];
	 document.getElementById("txtHint2").innerHTML=sss[1];
	  document.getElementById("txtHint3").innerHTML=sss[2];
	   document.getElementById("txtHint4").innerHTML=sss[3];
	    document.getElementById("txtHint5").innerHTML=sss[4];
		 document.getElementById("txtHint6").innerHTML=sss[5];
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showta(str)
{
var url="ajaxta.php";
var str1=document.form1.txtbpay.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint7").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showda(str)
{
var url="ajaxda.php";
var str1=document.form1.txtbpay.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint8").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showhra(str)
{
var url="ajaxhra.php";
var str1=document.form1.txtbpay.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showallw(str)
{
var url="ajaxallow.php";
var str1=document.form1.txtbpay.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;
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
          <form id="form1" name="form1" method="post" action="addsalaryaction.php">
            <table width="100%" border="0" cellspacing="0">
              <tr>
                <td height="24" colspan="5" id="th">SALARY PAYMENT </td>
              </tr>
              <tr>
                <td height="24" colspan="5" id="th1">EMPLOYEE DETAILS </td>
              </tr>
              <tr id="td1">
                <td width="17%" height="30"><div align="right"><strong>Employee ID </strong></div></td>
                <td width="23%"><label>
                  <select name="comboid" onchange="showemp(this.value)">
				  <option value="select">-SELECT ID-</option>
				  <?php
				  $q1=mysql_query("select * from emp_details");
				  while($row1=mysql_fetch_assoc($q1))
				  {
				  ?>
				  <option value="<?php echo $row1[ vemp_id]?>"><?php echo $row1[ vemp_id]?></option>
				  <?php
				  }?>
                  </select>
                </label></td>
                <td width="17%">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Employee Name </strong></div></td>
                <td><div id="txtHint1"><input type="text" name="txtename" readonly /></div></td>
                <td><div align="right"><strong>Job Type </strong></div></td>
                <td colspan="2"><div id="txtHint2"><input type="text" name="txtjtype" value="" readonly/></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Designation</strong></div></td>
                <td><div id="txtHint3"><input type="text" name="txtdesig" readonly /></div></td>
                <td><div align="right"><strong>Basic Pay </strong></div></td>
                <td><div id="txtHint4"><input type="text" name="txtbpay" readonly /></div></td>
                <td>&nbsp;</td>
              </tr>
			  
			  
              <tr id="th1">
                <td height="30" colspan="5">PAYMENT DETAILS </td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Payment Date: </strong></div></td>
                <td height="30"><b><input type="text" name="txtpdate" value=" <?php $date=date("d/m/Y");echo $date;?>" readonly="true"/>            
                </b></td>
                <td height="30">&nbsp;</td>
                <td height="30">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Month</strong></div></td>
                <td height="30"><label>
                  <select name="combomonth">
				  <option value="<?php echo date('M');?>"><?php echo date('M');?></option>
				  <?php
				  for($i=0;$i<12;$i++)
		 			{
		 
					?>
						<option value="<?php echo $array[$i];?>"><?php echo $array[$i];?></option>
					<?php
					}
					?>
                  </select>
                </label></td>
                <td height="30"><div align="right"><strong>Year</strong></div></td>
                <td width="17%" height="30"><select name="comboyr">
				<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
				<?php
		for($i=2005;$i<2038;$i++)
		{
		?>
		<option value="<?php echo $i; ?>" <?php if($y==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
		<?php
		}
		?>
                </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Working Days </strong></div></td>
                <td height="30"><input name="txtwdays" type="text" /></td>
                <td height="30"><div align="right"><strong>Absent</strong></div></td>
                <td height="30"><input name="txtabsent" type="text" /></td>
                <td height="30">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Amount/Hour</strong></div></td>
				<?php
				?>
                <td height="30"><div id="txtHint5"><input name="txtamth" type="text" readonly/></div></td>
                <td height="30"><div align="right"><strong>Total Hours </strong></div></td>
                <td height="30"><div id="txtHint6"><input name="txttoth" type="text" readonly/></div></td>
                <td height="30">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>TA</strong></div></td>
                <td height="30"><input name="txttap" type="text" onkeyup="showta(this.value)" />
                %</td>
                <td height="30"><div id="txtHint7"><input name="txtta" type="text" readonly="true" /></div></td>
                <td colspan="2" rowspan="5">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>DA</strong></div></td>
                <td height="30"><input name="txtdap" type="text" onkeyup="showda(this.value)" />
                  %</td>
                <td height="30"><div id="txtHint8"><input name="txtda" type="text" readonly="true" /></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>HRA</strong></div></td>
                <td height="30"><input name="txthrap" type="text" onkeyup="showhra(this.value)" />
                  %</td>
                <td height="30"><div id="txtHint9"><input name="txthra" type="text" readonly="true" /></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Other Allowances </strong></div></td>
                <td height="30"><input name="txtoalp" type="text" onkeyup="showallw(this.value)" />
                  %</td>
                <td height="30"><div id="txtHint10"><input name="txtoal" type="text" readonly="true" /></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="right"><strong>Total Deduction</strong></div></td>
                <td height="30"><input name="txttotded" type="text" /></td>
                <td height="30">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="15">&nbsp;</td>
                <td height="15">&nbsp;</td>
                <td height="15">&nbsp;</td>
                <td height="15">&nbsp;</td>
                <td height="15">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>Net Salary </strong></div></td>
                <td height="30"><input name="txtnet" type="text" /></td>
                <td height="30">&nbsp;</td>
                <td height="30"><label></label>
                  <label></label></td>
                <td height="30">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30">&nbsp;</td>
                <td height="30">&nbsp;</td>
                <td height="30"><input type="submit" name="Submit" value="Save" />
                <input type="reset" name="Submit2" value="Reset" /></td>
                <td height="30">&nbsp;</td>
                <td height="30">&nbsp;</td>
              </tr>
            </table>
          </form>
         
          
			
                    
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

