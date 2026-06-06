<?php
session_start();
include("../connection.php");
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['ior'];
$qy=mysql_query("select vorgname from ac_organization where iIdx_organization='$org'");
$re=mysql_fetch_row($qy);
 $iid=$_REQUEST['id1'];
 $df=$_REQUEST['dp1'];
 /*$q3=mysql_query("select iIdx_department from emp_details1 where vemp_id='$iid'");
$r5=mysql_fetch_row($q3);
echo $r5[0];*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8" />
	<script language="javascript">
	function showjobs(str)
{
var url="ajaxjob.php";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showdept(str)
{
var url="ajaxdept.php";
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
	if(document.form1.txtid.value=="")
	{
	window.alert("Enter ID");
	document.form1.txtid.focus();
	return false;
	}
	if(document.form1.txtename.value=="")
	{
	window.alert("Enter Name");
	document.form1.txtename.focus();
	return false;
	}
	if(document.form1.txtadd.value=="")
	{
	window.alert("Enter Address");
	document.form1.txtadd.focus();
	return false;
	}
	if(document.form1.txtcno.value=="")
	{
	window.alert("Enter Phone or Email");
	document.form1.txtcno.focus();
	return false;
	}
	if(document.form1.txtage.value=="")
	{
	window.alert("Enter Age");
	document.form1.txtage.focus();
	return false;
	}
	if(document.form1.txtrel.value=="")
	{
	window.alert("Enter Religion");
	document.form1.txtrel.focus();
	return false;
	}
	if(document.form1.txtcast.value=="")
	{
	window.alert("Enter Cast");
	document.form1.txtcast.focus();
	return false;
	}
	if(document.form1.jtype.value=="select")
	{
	window.alert("Select Designation");
	return false;
	}
	if(document.form1.txtjob.value=="select")
	{
	window.alert("Select Job Position");
	document.form1.txtjob.focus();
	return false;
	}
	if(document.form1.txtbp.value=="")
	{
	window.alert("Enter Basic Pay");
	document.form1.txtbp.focus();
	return false;
	}
	if(document.form1.txtta.value=="")
	{
	window.alert("Enter TA");
	document.form1.txtta.focus();
	return false;
	}
	if(document.form1.txtda.value=="")
	{
	window.alert("Enter DA");
	document.form1.txtda.focus();
	return false;
	}
	if(document.form1.txthra.value=="")
	{
	window.alert("Enter HRA");
	document.form1.txthra.focus();
	return false;
	}
	}
	function calculate()
	{
	 var da=parseFloat(document.form1.txtbp.value)*parseFloat(document.form1.txtdap.value)/100;
	var ab=parseFloat(document.form1.txtbp.value)+parseFloat(da);
	var pf=parseFloat(ab)*12/100;
	if(pf>=780)
	{
	document.form1.txtpfp.value=780.00;
	}
	else
	{
	document.form1.txtpfp.value=pf;
	}
	}
	
	</script>
	<script language="javascript" src="../calendar.js"></script>
<script language="javascript" src="../calendar1.js"></script>
<script type="text/javascript" src="../scripts/jquery.min.js"></script> 
<script type="text/javascript" src="../scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style3 {font-weight: bold}
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
          <h2>&nbsp;</h2>
          <form id="form1" name="form1" method="post" action="editempaction.php" onsubmit="return validate();">
		  <?php
		   $q1=mysql_query("select * from emp_details1 where iId_emp='$iid'");
			$r1=mysql_fetch_object($q1);
			
		  ?>
            <table width="98%" height="592" border="0" id="tbl">
              <tr id="th">
                <td height="21" colspan="4"><div align="center"><strong>ADD EMPLOYEE </strong></div></td>
              </tr>
              
              <tr id="td1">
                <td height="17"><div align="center"><strong>Organization<input type="hidden" name="idd" value="<?php echo $iid;?>" /></strong></div></td>
                <td height="17"><?php 
	 
	  $q2=mysql_query("select vorgname from ac_organization where iIdx_organization='$r1->iIdx_institution'");
	  $ob1=mysql_fetch_row($q2);
	  ?>
                  <select name="comboin" onchange="showdept(this.value)">
                    <option value="<?php echo $r1->iIdx_institution;?>"><?php echo $ob1[0];?></option>
                    <?php
		$qry2=mysql_query("select * from ac_organization where iIdx_organization<>'$r1->iIdx_institution'");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
                    <option value="<?php echo $row[iIdx_organization]; ?>"><?php echo $row[vorgname]; ?></option>
                    <?php } ?>
                  </select>              </td>
                <td height="17"><div align="center"><strong>Department</strong></div></td>
			
                <td height="17"><div id="2"><label>
                  <select name="combodep" onchange="showdept(this.value)">
				   <?php
				     $qryy1=mysql_query("select * from ac_institution where iIdx_institution='$df'");
					 $rr2=mysql_fetch_object($qryy1);?>
					   <option value="<?php echo $rr2->iIdx_institution;?>"><?php echo $rr2->vinstitution;?></option>;
					 <?php
					  $qryy2=mysql_query("select * from ac_institution where iIdx_organization='$r1->iIdx_institution' and iIdx_institution<>'$df'");
					 while($rr3=mysql_fetch_assoc($qryy2))
					 {
					 ?>
					   <option value="<?php echo $rr3[iIdx_institution];?>"><?php echo $rr3[vinstitution];?></option>;
					<?php } ?>
                  </select>
                </label></div></td>
              </tr>
			    <tr id="th1">
                <td height="17" colspan="4">Employee Details </td>
              </tr>
              <tr id="td1">
                <td height="28"><div align="center"><strong>Name</strong></div></td>
                <td height="28"><input type="text" name="txtename" value="<?php echo $r1->vemp_name;?>"  /><input type="hidden" name="n1" value="<?php echo $r1->vemp_name;?>" /></td>
                <td height="28"><div align="center"><strong>Qualification</strong></div></td>
                <td height="28"><label>
                  <input name="txtqualification" type="text" value="<?php echo $r1->vemp_qualification;?>"  />
                </label></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>Date Of Birth </strong></div></td>
                <td height="29"> <b><?php 	$dt11=$r1->demp_dob;
				$y=substr($dt11,0,strpos($dt11,'-'));
				$m=substr($dt11,5,2);
				$d=substr($dt11,8,2);?>
                </b><b>
                  <?php
	  $myCalendar = new tc_calendar("datedob", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");
	  $myCalendar->setDate($d,$m,$y);
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
                </b></td>
                <td height="29"><div align="center"><strong>Gender</strong></div></td>
                <td height="29"><span class="style3">
                  <label>
				  <?php
				  if($r1->vemp_gender==0)
				  {
				  ?>
                  <input name="rdgen" type="radio" value="0" checked="checked" /><?php } else { ?> <input name="rdgen" type="radio" value="0"/><?php } ?>
Male</label>
                </span> <span class="style3">
                <label>
				 <?php
				  if($r1->vemp_gender==1)
				  {
				  ?>
                <input name="rdgen" type="radio" value="1" checked="checked" /><?php } else { ?>   <input name="rdgen" type="radio" value="1" /> <?php } ?>
Female</label>
                </span> </td>
              </tr>
              <tr id="td1">
                <td height="25"><div align="center"><strong>Address</strong></div></td>
                <td height="25"><label></label>
                <label>
                <textarea name="textarea"><?php echo $r1->vemp_address;?></textarea>
                </label></td>
                <td height="25"><div align="center"><strong>Contact No: </strong></div></td>
                <td height="25"><input type="text" name="txtcno" value="<?php echo $r1->iemp_cno;?>" /></td>
              </tr>
              <tr id="td1">
                <td height="25"><div align="center"><strong>Email</strong></div></td>
                <td height="25"><input type="text" name="txtmail"  value="<?php echo $r1->vemp_email;?>"/></td>
                <td height="25"><div align="center"><strong>A/c No: </strong></div></td>
                <td height="25"><label>
                  <input type="text" name="txtaccount" value="<?php echo $r1->vaccount;?>" />
                </label></td>
              </tr>
              <tr id="td1">
                <td height="25"><div align="center"><strong>Comments</strong></div></td>
                <td height="25"><textarea name="textarea2"> <?php echo $r1->vemp_comments;?></textarea></td>
                <td height="25">&nbsp;</td>
                <td height="25">&nbsp;</td>
              </tr>
              <tr id="th1">
                <td height="17" colspan="4">Office Use </td>
              </tr>
             
              <tr id="td1">
                <td width="135" height="29"><div align="center"><strong>Employee ID </strong></div></td>
                <td height="29"><input type="text" name="txtid" value="<?php echo $r1->vemp_id;?>" readonly="true"/></td>
                <td width="117"><div align="center"><strong>Date Joined </strong></div></td>
                <td width="228"><b><?php 	$dt22=$r1->demp_jdate;
				$y=substr($dt22,0,strpos($dt22,'-'));
				$m=substr($dt22,5,2);
				$d=substr($dt22,8,2);?>
                  <?php
	  $myCalendar = new tc_calendar("datejoin", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");
	  $myCalendar->setDate($d,$m,$y);
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
                </b></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>Designation</strong></div></td>
                <td height="29">
				
				<select name="txtjob">
                
				  <?php
				  $org=$_SESSION['ior'];
				   $rty1=mysql_query("select * from emp_job where iId_job='$r1->iemp_designation'");
				$row1=mysql_fetch_object($rty1);
				?>
				
				   <option value="<?php echo $row1->iId_job; ?>"><?php echo $row1->vjob; ?></option>
			<?php
				  $rty=mysql_query("select * from emp_job where iIdx_institution='$r1->iIdx_institution' and iId_job<>'$r1->iemp_designation'");
				  while($row=mysql_fetch_assoc($rty))
				  {
				  ?>
				   <option value="<?php echo $row[iId_job]; ?>"><?php echo $row[vjob]; ?></option>
				   <?php 
				   }
				  ?>
                </select>				</td>
                <td height="29"><div align="center"><strong>Salary Payment :</strong></div></td>
                <td height="29"><select name="combobank" onchange="enab(this.value)">
				
                  <?php
				if($r1->ptype=='sb')
				{
				$ac="SB A/C";
				}
				if($r1->ptype=='cash')
				{
					$ac="Cash";
				}
				if($r1->ptype=='cheque')
				{
				$ac="Cheque";
				}
				  ?>
				   <option value="sb"><?php echo $ac;?></option>
                  <option value="sb">SB A/C</option>
                  <option value="cheque">Cheque</option>
                  <option value="cash">Cash</option>
                  <?php
				
				  ?>
                </select></td>
              </tr>
               
               <tr id="td1">
                <td height="29" colspan="2"><div align="center"><strong>EARNING</strong></div></td>
                <td colspan="2"><div align="center"><strong>DEDUCTION</strong></div></td>
              </tr>
               <tr id="td1">
                 <td height="29"><div align="center"><strong>Basic Salary </strong></div></td>
                 <td height="29"><input type="text" name="txtbp"  value="<?php echo $r1->femp_bpay; ?>" /></td>
                 <td height="29"><div align="center"><strong>LOP</strong></div></td>
                 <td height="29"><label>
                   <input type="text" name="textfield" disabled="disabled" />
                 </label></td>
               </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>DA</strong></div></td>
                <td height="29"><input name="txtdap" type="text"  value="<?php echo $r1->pda; ?>"/>
                %</td>
                <td height="29"><div align="center"><strong>PF</strong></div></td>
                <td height="29"><input name="txtpfp" type="text" onfocus="calculate()"  value="<?php echo $r1->pf; ?>" readonly="true"/></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>HRA</strong></div></td>
                <td height="29"><label>
                  <input name="txthra" type="text"  value="<?php echo $r1->phra; ?>" />
                %</label></td>
                <td height="29"><div align="center"><strong>PT</strong></div></td>
                <td height="29"><label>
                  <input name="txtpt" type="text" disabled="disabled"/>
                </label></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>CCA</strong></div></td>
                <td height="29"><label>
                  <input name="txtcca" type="text"  value="<?php echo $r1->pcca; ?>" />
                %</label></td>
                <td height="29"><div align="center"><strong>Loans</strong></div></td>
                <td height="29"><input name="txtloans" type="text"  value="<?php echo $r1->loans;?>" disabled="disabled"  /></td>
              </tr>
              <tr id="td1">
                <td height="29"><div align="center"><strong>Others</strong></div></td>
                <td height="29"><label>
                  <input name="txtoth1" type="text" value="<?php echo $r1->potherear; ?>"/>
                </label></td>
                <td height="29"><div align="center"><strong>Others</strong></div></td>
                <td height="29"><label>
                  <input name="txtoth2" type="text" value="<?php echo $r1->otherded; ?>" />
                </label></td>
              </tr>
            
              <tr id="td1">
                <td height="87" colspan="4"><label></label>                  <b><label></label>
                  </b>                  <label></label>                  <label></label>&nbsp;                  <p>
                  <label></label>
                  <span class="style3">
                  <label></label>
                  </span></p>                  
                  <p align="center"><span class="style3">                  </span>
                    <input name="b1" type="submit" value="UPDATE" />
                    <input type="submit" name="b1" value="DELETE" />
                    <label>
                 <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewemp.php&quot;' value='BACK '/>
                    </label>
                    <br />
                      </p>
                  <label></label>                  <label></label>                  <label></label>
                  <label></label>
                <label>                  </label>                  <label></label>                  <label></label>                  <label></label></td>
              </tr>
            </table>
          </form>
         
          
        <br/>
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
