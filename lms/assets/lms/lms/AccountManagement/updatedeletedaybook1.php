<?php
session_start();
$name=$_SESSION['name'];
$or1=$_REQUEST['or1'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
$dep=$_REQUEST['dep'];
$ins1=$_REQUEST['ins1'];
$ivn=$_REQUEST['ivn'];
//echo $or1;
$vt=$_POST['combovtype'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$date=date("Y/m/d");
$y=date("Y");

$qry=execute("select * from ac_vouchermaster");
$qry1=execute("select * from ac_voucher");
$num=rowcount($qry1);
if($vt=="")
{
//$ins=$_REQUEST['ins'];
$vt=$_SESSION['vtp'];
}
$_SESSION['ins']=$ins;
$_SESSION['vtp']=$vt;
//echo $ins1.$vt;
$id=$_REQUEST['id'];
$vtp=$_REQUEST['vtype'];
$ins=$_REQUEST['ins'];
$qk1=execute("select * from ac_institution where iIdx_institution=\"$dep\"");
$qk=mysql_fetch_object($qk1);
if($id=="" and $ivn=="")
{
$id=$_SESSION['id2'];
$ivn=$_SESSION['ivn2'];
}
$q1=execute("select * from ac_voucher where vvoucherno=\"$id\" and iIdx_vouchermaster='$ivn'");
while($row1=mysql_fetch_assoc($q1))
	{
	    	
		$date=$row1[ddate];
		$dated=$row1[ddate];
		if($row1[vvoucherno]==$v1) {$to=$row1[acc];} else {$by=$row1[acc];}
		if($row1[vvoucherno]==$v1) {$idd2=$row1[iIdx_voucher];} else {$idd1=$row1[iIdx_voucher];}
		$cno=$row1[chequedd_no];
		$cdate=$row1[chequedd_date];
		if($row1[vvoucherno]==$v1) {if($row1[fcredit]!=0.00){$amt=$row1[fcredit];}else{ $amt=$row1[fdebit]; }}
		if($row1[vvoucherno]!=$v1){$nar=$row1[vnarration];}
		//$nar=$row1[vnarration];
		$a=explode("-",$date);
$day=$a[2];
$month=$a[1];
$year=$a[0];
$a1=explode("-",$cdate);
$day1=$a1[2];
$month1=$a1[1];
$year1=$a1[0];
	    $v1=$row1[vvoucherno];

	}

/*$num=$num/2;
$vno=$num+1;
$q3=execute("select iIdx_vouchermaster from ac_vouchermaster where vvouchertype=\"$vt\"");
$rr=fetchrow($q3);
$qry2=execute("select iIdx_institution from ac_institution where vinstitution='".$ins."'");
$d1=fetchrow($qry2);
$qry11=execute("select max(vvoucherno) from ac_voucher where iIdx_institution='".$d1[0]."'");
$r=fetchrow($qry11); 
//echo $r[0];
$qry3=execute("select * from ac_voucher where iIdx_institution='".$d1[0]."' and iIdx_vouchermaster='".$rr[0]."' and YEAR(ddate)='".$y."' order by ddate");*/
//echo  $id." ".$ivn;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script type="text/javascript">
function showbyto(str)
{
var url="ajaxbytoedit.php";
var str1=document.form1.oh1.value;
var str2=document.form1.h1.value;
var str3=document.form1.h3.value;
url=url+"?q="+str;
url=url+"&p="+str1;
url=url+"&r="+str2;
url=url+"&s="+str3;
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
	
    document.getElementById("txtHint11").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showBybal(str)
{
var url="ajaxcombo.php";
var str1=document.form1.ins3.value;
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showTobal(str)
{
var url="ajaxcombo1.php";
var str1=document.form1.ins3.value;
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
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showledgers(str)
{
var url="ajaxcombo3.php";
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
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function validate()
{
	
	if(isNaN(document.form1.txtamt.value))
	{
		window.alert("Enter a Valid Amount");
		document.form1.txtamt.focus();
		return false;
	}
	
	if(document.form1.combobc.value=="select")
	{
		window.alert("Select Bank/Cash");
		return false;
	}
	if(document.form1.txtamt.value=="")
	{
		window.alert("Enter Amount");
		document.form1.txtamt.focus();
		return false;
	}
	
	if(document.form1.comboacname.value=="select")
	{
		window.alert("Select Account Name");
		return false;
	}
	if(document.form1.combobc.value==document.form1.comboacname.value)
	{
		window.alert("Error!!");
		//document.form1.date.focus();
		return false;
	}
	if(document.form1.date.value=="")
	{
		window.alert("Enter Date");
		document.form1.date.focus();
		return false;
	}
	
	
	function viewcalendar()
	{
 		 kalendarik = window.open("calendar.php", "kalendarik" , "location=0, menubar=0, scrollbars=0, status=0, titlebar=0, toolbar=0, directories=0, resizable=1, width=200, height=240, top=50, left=250");
  		 kalendarik.resizeTo(200, 240);
  		 kalendarik.moveTo(535, 393);
	}
//=========================================================================================================================================
	
//==========================================================================================================================================
	function insertdate(d)
	{
 		 window.close();
 		 window.opener.document.getElementById('date').value = d;
	}
	jQuery(document).ready(function () 
	{
    $('input.calendar1').simpleDatepicker();
    $('input.calendar2').simpleDatepicker();
    });
}


</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
    
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
        <div class="inner" style="height:auto">
          <form id="form1" name="form1" method="post" action="editvoucheraction.php" onsubmit="return validate();" >
		  <table width="762" border="0">
              <tr><td width="756"> <div align="right"> <?php echo "<a href=\"viewdaybook.php\" id=new><strong>Back</strong></a>" ;?> </div>
                <?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;addledger.php&quot;' value='Add New' /><?php */?>
                </td></tr></table>
             <table width="965" border="1" style="position:absolute; width: 736px; height: 286px; left: 236px; top: 143px;" cellspacing="0" id="tb1" <?php echo "if($vv==1){bgcolor=#FFFF99 }if($vv==2){ bgcolor=#8bf7dc }if($vv==3){  bgcolor=#CCCCCC   }if($vv==6){bgcolor=#66CCFF }";?>>
              <tr id="th">
                <th height="26" colspan="4" scope="row">
                  <div align="center"><span class="style8">VOUCHER</span></div></th>
      </tr>
              
              <tr id="td1">
                <th width="75" height="33" scope="row"><div align="center"><span class="style19"><strong>DEPARTMENT</strong>:</span></div></th>
        <td width="218"><b><font color="#000000">
          <select name="comboin">
                  <option value=" <?php echo $qk->vinstitution;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $qk->vinstitution;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php
	  $qry2=execute("select * from ac_institution where iIdx_organization='$or1' and vinstitution <> '$qk->vinstitution'");
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
                  <option value="<?php echo $row[vinstitution]; ?>"><?php echo $row[vinstitution]; ?></option>
                  <?php } ?>
              </select></font></b>&nbsp;</td>
        <td>
          <div align="center"> 
            <span class="style4 style11 style22"><strong>Voucher Type</strong></span><span class="style22">:</span></div></td>
        <td width="168"><span class="style4 style11 style22"><b><font color="#000000">
		 <?php
		  $qvt=execute("select * from ac_vouchermaster where vvouchertype='$vtp'");
		  $qv=mysql_fetch_object($qvt);
		  ?>
		<select name="combovtype" onchange="showbyto(this.value)">
            <option value="<?php echo $qv->iIdx_vouchermaster;?>"><?php echo $vtp;?></option>
            <?php
	  $qry=execute("select * from ac_vouchermaster where iIdx_vouchermaster <> '$qv->iIdx_vouchermaster'");
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
            <option value="<?php echo $row[iIdx_vouchermaster]; ?>"> <?php echo $row[vvouchertype]; ?> </option>
            <?php }  ?>
            </select></font></b></span></td>
      </tr>
	 
	   <tr id="td1">
	     <td colspan="4" id="td1">
	   <div id="txtHint11">
     
	 
      <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;Voucher No:</strong>&nbsp;&nbsp;
      <input type="text" name="txtvno" size="35" value="<?php echo $id;?>" disabled="disabled" />
      <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</strong>
        <b>
          <?php
	  $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 $myCalendar->setDate($day, $month, $year);
	  $myCalendar->setPath("./");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?></b>
          </span><br /><br /><br />
		  
		  
		  
		  
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select name="combobc" readonly="readonly" onchange="showBybal(this.value)">
          <option value="<?php echo $by; ?>"> <?php echo $by; ?> </option>
         
          <?php
	  $qry1=execute("select * from ac_ledger where iIdx_organization='$or1' and vledger<>'$by'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
          <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
          <?php }  ?>
          </select><?php /*?><input type="text" name="combobc" value="<?php echo $by; ?>" /><?php */?>
          <label>          </label>
     
    
   
    <span class="style4 style11 style20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <select name="comboacname" onchange="showTobal(this.value)">
          <option value="<?php echo $to; ?>"> <?php echo $to; ?> </option>
         
          <?php
		 $qry1=execute("select * from ac_ledger where iIdx_organization='$or1' and vledger<>'$to'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
          <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
          <?php }  ?>
          </select><?php /*?><input type="text" name="comboacname" value="<?php echo $to; ?>" /><?php */?>
		  <br /><br /><br />		  	</td></div>
     	</tr>
              
             
               
       
	
              <tr id="td1">
                <th height="43" scope="row">&nbsp;</th>
	    
      <td colspan="3"><p><span class="style4">
        <?php
	  if($cno=="")
	  {
	  ?>
        <input name="rd" type="radio" value="1" onclick="txtcno.disabled=true" checked="checked"/>
        <strong>Cash</strong></span></p>
		  <p><span class="style4 style11 style20">
		    <input name="rd" type="radio" value="0" onclick="txtcno.disabled=false,date6.disabled=false"/>
		    <strong>Cheque/DD</strong></span><span class="style22"></span></p>
		  <?php 
		}
		else
		{
		?>
        <input name="rd" type="radio" value="1" onclick="txtcno.disabled=true"/>
        <strong>Cash</strong></span></p>
        <p><span class="style4 style11 style20">
          <input name="rd" type="radio" value="0"  checked="checked" onclick="txtcno.disabled=false,date6.disabled=false"/>
          <strong>Cheque/DD</strong></span><span class="style22"></span></p><?php } ?></p></td>
        </tr>
              
              
              <tr id="td1">
                <th height="43" scope="row"><div align="center"><span class="style4 style11 style20">Cheque/DD No: </span></div></th>
        <td><?php
	  if($cno=="")
	  {
	  ?><input type="text" name="txtcno" size="35"  disabled="disabled" value="<?php echo $cno;?>"/><?php } else { ?><input type="text" name="txtcno" size="35" value="<?php echo $cno;?>" readonly/><?php }?>
          <strong>
          <strong>      </strong></td>
        <td><div align="center"><span class="style21"><strong>Cheque/DD Date:
          
          </strong></span></div></td>
        <td><strong>
          <?php
	  $myCalendar = new tc_calendar("date6", true, false);
	 $myCalendar->setIcon("images/iconCalendar.gif");
	 if($cdate!='0000-00-00')
	 {
	  $myCalendar->setDate($day1, $month1, $year1);
	  }
	  $myCalendar->setPath("./");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
          </strong></td>
      </tr>
              <tr id="td1">
                <th height="34" scope="row"><div align="center"><span class="style19"><strong>Amount:</strong></span></div></th>
        <td colspan="3"><input type="text" name="txtamt" size="35" value="<?php echo number_format($amt,2);?>"/>
          
          <input type="hidden" name="ins3" >        &nbsp;</td>
        </tr>
              
              <tr id="td1">
                <th scope="row"><div align="center"><span class="style4 style11 style20">Narration:</span></div></th>
        <td colspan="3"><textarea name="txtnarr" rows="5" cols="32" readonly="readonly"><?php echo $nar;?></textarea></td>
        </tr>
              <tr id="td1">
                <th height="29" colspan="2" scope="row">&nbsp;</th>
        <td> <?php /*?><input name="b1" type="submit" value="Delete" align="middle"/>
          <input name="b1" type="submit"  value="Update"  align="middle"/><?php */?></td>
        <td><input type="hidden" name="h3" value="<?php echo $ivn;?>" />
          <input type="hidden" name="h1" value="<?php echo $id;?>" />
          <input type="hidden" name="h2" value="<?php $vt;?>" /><input type="hidden" name="oh1" value="<?php echo $or1;?>" />
		   
			 <input type="hidden" name="i1" value="<?php echo $idd1;?>" /> <input type="hidden" name="i2" value="<?php echo $idd2;?>" />
	            </td>
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
            <p>&nbsp;</p> <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p> <h2>&nbsp;</h2>
             <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            
           
			  
                    
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

