<?php
session_start();
include("../connection.php");
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
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
<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../calendar.js"></script>
<script language="javascript" src="../calendar1.js"></script>
	<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="../scripts/jquery.min.js"></script> 
<script type="text/javascript" src="../scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	<script language="javascript">
	function showid(str)
	{
	var url="ajaxid.php";
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
    document.getElementById("t1").innerHTML=xmlhttp.responseText;
	
		 
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
	}
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
	 //document.getElementById("txtHint2").innerHTML=sss[1];
	  document.getElementById("txtHint3").innerHTML=sss[2];
	   document.getElementById("txtHint4").innerHTML=sss[3];
	   // document.getElementById("txtHint5").innerHTML=sss[4];
		 document.getElementById("t8").innerHTML=sss[5];
		  document.getElementById("t9").innerHTML=sss[6];
		   document.getElementById("t10").innerHTML=sss[7];
		    document.getElementById("t11").innerHTML=sss[8];
			 document.getElementById("t12").innerHTML=sss[9];
			  document.getElementById("t13").innerHTML=sss[10];
			   document.getElementById("t14").innerHTML=sss[11];
			    document.getElementById("t15").innerHTML=sss[12];
				document.getElementById("t16").innerHTML=sss[13];
				document.getElementById("33").innerHTML=sss[14];
				document.getElementById("34").innerHTML=sss[15];
				document.getElementById("35").innerHTML=sss[16];
					document.getElementById("36").innerHTML=sss[17];
				document.getElementById("37").innerHTML=sss[18];
				document.getElementById("38").innerHTML=sss[19];
				document.getElementById("39").innerHTML=sss[20];
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}



function showgrosssal()
{

}

function showtotsal()
{
var url="ajaxtotsal.php";
var bpay=document.form1.txtbpay.value;
var da=document.form1.txtda.value;
var oall=document.form1.txtoal.value;
var pf=document.form1.txtpf.value;
var esi=document.form1.txtesi.value;
var wdays=document.form1.txtwdays.value;
var absent=document.form1.txtabsent.value;
//var str1=document.form1.txtbpay.value;
url=url+"?p="+pf;
url=url+"&q="+esi;
url=url+"&r="+bpay;
url=url+"&s="+da;
url=url+"&t="+oall;
url=url+"&u="+wdays;
url=url+"&v="+absent;
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
	document.getElementById("txtHint12").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showpsal()
{
var url="ajaxpsal.php";
var bpay=document.form1.txtbpay.value;
var da=document.form1.txtda.value;
var oall=document.form1.txtoal.value;
var pf=document.form1.txtpf.value;
var esi=document.form1.txtesi.value;
var wdays=document.form1.txtwdays.value;
var absent=document.form1.txtabsent.value;
//var str1=document.form1.txtbpay.value;
url=url+"?p="+pf;
url=url+"&q="+esi;
url=url+"&r="+bpay;
url=url+"&s="+da;
url=url+"&t="+oall;
url=url+"&u="+wdays;
url=url+"&v="+absent;
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
	document.getElementById("txtHint13").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showpdays(str)
{
var url="ajaxpdays.php";
var id=document.form1.comboid.value;

//var str1=document.form1.txtbpay.value;
url=url+"?p="+str;
url=url+"&q="+id;

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
	document.getElementById("tt1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showgross(str)
{
var bpay=document.form1.txtbpay.value;
var da=document.form1.txtda.value;
var hra=document.form1.txthra.value;
var cca=document.form1.txtcca.value;
var oth1=str;
if(oth1=="")
{
oth1=0;
document.form1.txtoth1.value=0.00;
}
//window.alert("hai.........");
document.form1.txtgsalary.value=parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1);
var a1=parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1);
if(a1<9999)
{
document.form1.txtpt.value=0.00;
}
if(a1>10000 && a1<14999)
{
document.form1.txtpt.value=150;
}
if(a1>=15000)
{
document.form1.txtpt.value=200;
}
//window.alert(parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1));
}

	function validate()
	{
	if(document.form1.comboid.value=="select")
	{
	window.alert("Select Employee ID");
	return false;
	}
	if(document.form1.txtwdays.value=="")
	{
	window.alert("Enter Total Working Days");
	document.form1.txtwdays.focus();
	return false;
	}
	if(isNaN(document.form1.txtdap.value))
	{
		window.alert("Enter a valid Number");
		document.form1.txtdap.focus();
		return false;
	}
	if(isNaN(document.form1.txtoalp.value))
	{
		window.alert("Enter a valid Number");
		document.form1.txtoalp.focus();
		return false;
	}
	if(isNaN(document.form1.txttap.value))
	{
		window.alert("Enter a valid Number");
		document.form1.txttap.focus();
		return false;
	}
	if(isNaN(document.form1.txthrap.value))
	{
		window.alert("Enter a valid Number");
		document.form1.txthrap.focus();
		return false;
	}
	}
	function showlop(str)
{
var bpay=document.form1.txtbpay.value;
var pdays=document.form1.txtpdays.value;
var wdays=str;
var onday=parseFloat(bpay)/parseFloat(wdays);
var sal=parseFloat(onday)*parseFloat(pdays);
//window.alert(parseFloat(onday));
var lop=parseFloat(bpay)-parseFloat(sal);
//var lop1=Math.round(lop*Math.pow(2,dec))
var lop=round(lop,2);
document.form1.txtlop.value=parseFloat(lop);

//window.alert(parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1));
}
function showtotded()
{
	var lop=document.form1.txtlop.value;
	var pf=document.form1.txtpf.value;
	var pt=document.form1.txtpt.value;
	var loans=document.form1.txtmi.value;
	var oth2=document.form1.txtoth2.value;
	if(isNaN(lop))
	lop=0;
	if(isNaN(pf))
	pf=0;
	if(isNaN(pt))
	pt=0;
	if(isNaN(loans))
	loans=0;
	if(isNaN(oth2))
	oth2=0;

	
	
	if(oth2=="")
	{
		oth2=0;
		document.form1.txtoth2.value="0.00";
	}
	var totded=parseFloat(lop)+parseFloat(pf)+parseFloat(pt)+parseFloat(loans)+parseFloat(oth2);
	//window.alert(parseFloat(onday));
	//var totded1=round(totded,2);
	//var totded1=Math.round(totded*Math.pow(2,dec))
	var totded=round(totded,2);
	document.form1.txttotal.value=parseFloat(totded);
	
	//window.alert(parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1));
}
function shownetsal(str)
{
	var gsalary=document.form1.txtgsalary.value;
	var tsalary=document.form1.txttotal.value;
	var sall=parseFloat(gsalary)-parseFloat(tsalary);
	var sall=round(sall,2);
	
	document.form1.txtnetsal.value=parseFloat(sall);

//window.alert(parseFloat(bpay)+parseFloat(da)+parseFloat(hra)+parseFloat(cca)+parseFloat(oth1));
}
function round(number,X) 
{
// rounds number to X decimal places, defaults to 2
    X = (!X ? 2 : X);
    return Math.round(number*Math.pow(10,X))/Math.pow(10,X);
}
function enab(str)
{
if(str=="sb")
{
document.form1.txtaccount.Enabled=true;
}
}
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL, title, 'toolbar=no,addressbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no,width='+w+', height='+h+', top='+top+', left='+left);
} 
function popup()
{
document.form1.txtlamount.disabled=false;
document.form1.txtmi.disabled=false;
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
          <form id="form1" name="form1" method="post" action="addsalaryaction.php" onsubmit="return validate();">
            <table width="801" border="0" id="tbl">
              <tr>
                <td height="24" colspan="5" id="th">SALARY PAYMENT </td>
              </tr>
              <tr>
                <td height="15" colspan="5" id="th1">EMPLOYEE DETAILS </td>
              </tr>
             
              <tr id="td1">
                <td width="17%"><div align="right"><strong>Organization:</strong></div></td>  <td>
                  <p>
                  <?php 
	  if($type=='a')
	  {
	  ?>
                  <select name="comboin" onchange="showid(this.value)">
                    <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    <?php
		$qry2=mysql_query("select * from ac_organization");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
                    <option value="<?php echo $row[iIdx_organization]; ?>"><?php echo $row[vorgname]; ?></option>
                    <?php } ?>
                    </select>      
                  &nbsp;</p>
                  <p>
                    
                    <?php
	  }
	  else
	  {
	  ?>
                  </p>
                  <label>
      <input type="txt" name="txtins" value="<?php echo $re[0];?>" readonly="true" />
</label>
	  <?php
	  }
	  ?></td>
                <td><div align="right"><strong>Employee ID </strong></div></td>
                <td colspan="3">
				<?php
				if($type=='a')
				{
				?>
				<div id="t1"><select name="comboid" onchange="showemp(this.value)">
                  <option value="select">-SELECT ID-</option>
                
                </select></div>
				<?php 
				}
				else
				{
				?>
				<select name="comboid" onchange="showemp(this.value)">
                  <option value="select">-SELECT ID-</option>
                  <?php
				  $org=$_SESSION['ior'];
				  $q1=mysql_query("select * from emp_details1 where iIdx_institution='$org'");
				  while($row1=mysql_fetch_assoc($q1))
				  {
				  ?>
                  <option value="<?php echo $row1[ vemp_id]?>"><?php echo $row1[ vemp_id]?></option>
                  <?php
				  }?>
                </select>
				<?php
				}
				?>				</td>
              </tr>
              
              <tr id="td1">
                <td height="30"><div align="right"><strong>Employee Name </strong></div></td>
                <td width="22%"><div id="txtHint1"><input type="text" name="txtename" readonly /></div></td>
                <td width="15%"><div align="right"><strong>Designation</strong></div></td>
                <td colspan="2"><div id="txtHint3">
                  <input type="text" name="txtdesig" readonly="readonly" />
                </div></td>
              </tr>
              <tr id="td1">
                <td height="30">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="3">&nbsp;</td>
              </tr>
			  
			  
              <tr id="th1">
                <td height="29" colspan="5">PAYMENT DETAILS </td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>Status: </strong></div></td>
                <td height="30"><b><font color="#FF0000" size="2"><div id="33" align="left"><input type="text" readonly /></div></font></b>&nbsp;</td>
                <td height="30" colspan="3"><label></label></td>
              </tr>
              
              <tr id="td1">
                <td height="30"><div align="center"><strong>Payment:</strong></div></td>
                <td height="30"><div id="35"><input type="text" name="combobank"  disabled="disabled"/></div></td>
                <td height="30"><div align="center"><strong>A/c No: </strong></div></td>
                <td height="30"><label><div id="34">
                  <input type="text" name="txtaccount" disabled="disabled"/>
               </div> </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>Payment Date: </strong></div></td>
                <td height="30"><b>
                  <input type="text" name="txtpdate" value=" <?php $date=date("d/m/Y");echo $date;?>" readonly="true"/>
                </b></td>
                <td height="30"><div align="center"><strong>Month</strong></div></td>
                <td width="19%" height="30"><select name="combomonth" onchange="showpdays(this.value)">
                 <option value="select">-SELECT-</option>
                  <?php
				  for($i=0;$i<12;$i++)
		 			{
		 
					?>
                  <option value="<?php echo $i+1;?>"><?php echo $array[$i];?></option>
                  <?php
					}
					?>
                </select></td>
                <td width="27%"><div align="left"><strong>Year</strong>:
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
                </div></td>
              </tr>
              
              <tr id="td1">
                <td height="30"><div align="center"><strong>Working Days </strong></div></td>
                <td height="30"><input name="txtwdays" type="text" /></td>
                <td height="30"><div align="center"><strong>Present Days: </strong></div></td>
                <td height="30"><!--<div id="tt1">--><div ><input name="txtpdays" value="" type="text"/></div></td>
                <td height="30">&nbsp;</td>
              </tr>
              <tr id="td1">
                <td height="30" colspan="2"><div align="center"><strong>EARNING</strong></div></td>
                <td height="30" colspan="3"><div align="center"><strong>DEDUCTION</strong></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>Basic Salary </strong></div></td>
                <td height="30"><div id="txtHint4">
                  <input type="text" name="txtbpay" readonly="readonly" />
                </div></td>
                <td height="30"><div align="center"><strong>LOP</strong></div></td>
                <td colspan="2"><input name="txtlop" type="text" onfocus="showlop(txtwdays.value)"/></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>DA</strong></div></td>
                <td height="30"><div id="t8">
                  <input name="txtda" type="text" readonly="true" />
                </div></td>
                <td height="30"><div align="center"><strong>PF</strong></div></td>
                <td colspan="2"><div id="t12">
                  <input name="txtpf" type="text" readonly="true"/>
                </div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>HRA </strong></div></td>
                <td height="30"><div id="t9">
                  <input name="txthra" type="text" readonly="true"/>
                </div></td>
                <td height="30"><div align="center"><strong>PT</strong></div></td>
                <td colspan="2"><div id="t16"><input name="txtpt" type="text"/></div></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>CCA</strong></div></td>
                <td height="30"><div id="t10">
                  <input name="txtcca" type="text" readonly="true"/>
                </div></td>
                <td height="30"><div align="center"><strong>Loans</strong></div></td>
                <td><div id="t13" style="width:50px"><input name="txtloans" type="text" disabled="disabled" onchange="showtotded()" />
                  </div></td>
                <td><div align="center" style="width:50px"><a href="javascript:popup();" ><b>Edit</b></a></div></td>
              </tr>
			    <tr id="td1">
                <td><label></label></td>
                <td>&nbsp;</td>
                <td><div align="center"><strong>Loan Amount </strong></div></td>
                <td colspan="2"><b><div id="36"><input name="txtlamount" type="text" disabled="disabled" /></div></b></td>
              </tr>
              
              <tr id="td1">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="30"><div align="center"><strong>Monthly Installment </strong></div></td>
                <td colspan="2"><b><div id="37"><input name="txtmi" type="text" disabled="disabled" /></div></b></td>
              </tr>
              <tr id="td1">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="30"><div align="center"><strong>From</strong></div></td>
                <td colspan="2"><span class="style3"><b><div>
                  <?php
	  $myCalendar = new tc_calendar("datefrom", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");?><div id="38"></div><?php
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
              </div>  </b></span></td>
              </tr>
              <tr id="td1">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="30"><div align="center"><strong>To</strong></div></td>
                <td colspan="2"><span class="style3"><b><div >
                  <?php
	  $myCalendar = new tc_calendar("dateto", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");
	?><div id="39">
	 </div><?php
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
              </div>  </b></span></td>
              </tr>
              <tr id="td1">
                <td height="30"><div align="center"><strong>Others</strong></div></td>
                <td height="30"><div id="t11"><input name="txtoth1" type="text"  onchange="showgross(this.value)" /></div></td>
                <td height="30"><div align="center"><strong>Others</strong></div></td>
                <td colspan="2"><div id="t14" ><input name="txtoth2" type="text"  onchange="showtotded()" /></div></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>Total Gross Salary: </strong></div></td>
                <td height="29"><div id="t15"><label>
                  <input type="text" name="txtgsalary" readonly="true"/>
                </label></div></td>
                <td height="29"><div align="center"><strong>Total:</strong></div></td>
                <td colspan="2"><label>
                  <input type="text" name="txttotal" onfocus="showtotded()" />
                  <a href="javascript:void(0);" onclick="PopupCenter('popup.php', 'myPop1',500,300);"></a></label></td>
              </tr>
              <tr id="td1">
                <td height="27"><div align="center"><strong>Net Salary: </strong></div></td>
                <td height="27"><label>
                  <input type="text" name="txtnetsal" onfocus="shownetsal()" />
                </label></td>
                <td height="27"><div align="center"><strong>Comments:</strong></div></td>
                <td colspan="2"><label>
                  <textarea name="txtnarration"></textarea>
                </label></td>
              </tr>
              
              
              <tr id="td1">
                <td height="30">&nbsp;</td>
                <td height="30">&nbsp;</td>
                <td height="30"><a href="javascript:void(0);" onclick="PopupCenter('popup.php', 'myPop1',500,300);"></a></td>
                <td height="30" colspan="2"><input type="submit" name="Submit" value="Save & Export" />
                <input type="reset" name="Submit2" value="Reset" />
                <label></label></td>
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
   
  </div>
</body>
</html>
