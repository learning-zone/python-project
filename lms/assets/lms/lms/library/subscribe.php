<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");
if($_POST)
{
	
	$id=$_POST['id'];
	$act=$_POST['act'];
	$nid=$_POST['nid'];
	$idttl=$_POST['idttl'];
    $du_dd=$_POST['du_dd'];
	$du_mm=$_POST['du_mm'];
	$du_yy=$_POST['du_yy'];
	$su_dd=$_POST['su_dd'];
	$su_mm=$_POST['su_mm'];
	$su_yy=$_POST['su_yy'];
	$jmsub=$_POST['jmsub'];
	$title=$_POST['title'];
	$copies=$_POST['copies'];
	$source=$_POST['source'];
	$amount=$_POST['amount'];
	$library=$_POST['library'];
	$remarks=$_POST['remarks'];
	$bill_no=$_POST['bill_no'];
	$language=$_POST['language'];
	$a_sub_no=$_POST['a_sub_no'];
	$supplier=$_POST['supplier'];
	$register1=$_POST['register1'];
	$extraAmount=$_POST['extraAmount'];
	$amountMonth=$_POST['amountMonth'];
	$periodicity=$_POST['periodicity'];
	$amount_type=$_POST['amount_type'];
	$bank_details=$_POST['bank_details'];
		
}
if($_GET)
{

	$act=$_GET['act'];
	$msg=$_GET['msg'];
	$idttl=$_GET['idttl'];
	$jmsub=$_GET['jmsub'];
    $register1=$_GET['register1'];
}
if($msg!='')
{
	?>
    	<script language="JavaScript">
		    alert('<?=$msg?>');
		</script>
    <?
}
?>
<html>
<head>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e,flag)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT )
	{
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
		{
			return true
		}
		else
		{
			if(flag==1)
			{
				if((charCode !=190) && (charCode !=110))
				{
					alert("Please make sure entries are numbers only.")
					return false
				}
				else
				{
					return true
				}
			}
			else
			{
				alert("Please make sure entries are numbers only.")
				return false
			}
		}
	}
	return true
}
function check(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 65 || charCode > 91 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 
		{
		if((charCode >= 65456 && charCode <= 65465) )
		{
			return true
		}
		else
		{
			if((charCode == 37) || (charCode == 39)|| (charCode == 46) || (charCode==190) || (charCode==32))
			{
				return true
			}
			else
			{
				alert("Please make sure entries are alphapets only.")
				return false
			}
		}
	}
	return true
}
function addnew()
{	
	if(document.frm.title.value=='')
	{
		alert("Please Enter the Title");
		document.frm.title.focus();
	}
	else
	{
		document.frm.action="subscribe1.php?jmsub=$jmsub&actn=1";
		document.frm.submit();
	}
}
function modnew()
{
	document.frm.action="subscribe1.php?jmsub=$jmsub&actn=2";
	document.frm.submit();
}
function delnew()
{
	document.frm.action="subscribe1.php?jmsub=$jmsub&actn=3";
	document.frm.submit();
}
function frmsubmit()
{
	document.frm.submit();
}
function reload()
{
	document.frm.action="subscribe.php";
	document.frm.submit();
}
</script>
</head>
<body>
<?php
if($jmsub==1)
{
	$sel1="selected";$sel2="";$sel3="";
}
else if($jmsub==2)
{
	$sel1="";$sel2="selected";$sel3="";
}
else if($jmsub==3)
{
	$sel1="";$sel2="";$sel3="selected";
}
if($act==1)
{
	$sel4="selected";$sel5="";
}
else if($act==2)
{
	$sel4="";$sel5="selected";
}
?>
<form method="POST" name="frm" action="subscribe.php">
<table class='forumline' align='center' width="47%" border="1">
<tr>
   <td class='head' colspan='2' align='center'>Subscription Details</td>
</tr>
<tr>
   <td align="right">Subscription Type&nbsp;&nbsp;&nbsp;</td>
   <td><select name='jmsub' onchange='frmsubmit()'>
   <?php
     echo "<option value=0>--Select Subscrition Type--</option>";
     echo "<option value=1 $sel1>Journals Subscription</option>";
     echo "<option value=2 $sel2>Magazine Subscription</option>";
     echo "<option value=3 $sel3>News Paper Subscription</option>";
  ?>
</select></td>
</tr>
<tr>
   <td align="right">Select Action&nbsp;&nbsp;&nbsp;</td>
   <td><select name='act' onchange='frmsubmit()'>
   <?php
     echo "<option value=0>---- Select Action Type ----&nbsp;&nbsp;</option>";
     echo "<option value=1 $sel4>Add</option>";
     echo "<option value=2 $sel5>Modify/Inactive</option>";
  ?>
</select></td>
</tr>
</table>
<br>
<?php
if($act==1)
{
	if($jmsub==1)
	{
		$ttle='Add Journal Subscription Details';
	}
	elseif($jmsub==2)
	{
		$ttle='Add Magazine Subscription Details';
	}
	elseif($jmsub==3)
	{
		$ttle='Add NewsPaper Subscription Details';
	}
	$sql="select max(id) from lib_magazine_subscription where library='$library'";
	$rs=execute($sql);
	$newid = fetcharray($rs);
	$nid=$newid[0]+1;
?>
<table align="center" class="forumline" width="80%">
  <tr>
    <td class="head" colspan="4" align="center"><?php echo $ttle?></td>
  </tr>
  <tr>
    <td width="120" align="left" height="22">&nbsp;&nbsp;&nbsp;Library <font color="#FF0000">*</font></td>
	<td  height="22">
	<select size="1" name="library" onchange='reload()'>
	<option value=''>Select Library</option>
	<?php
	$sql1 = "SELECT * FROM library_name order by id";
	$rs1 = execute($sql1);
	$row1 = rowcount($rs1);
	for($i=0;$i<$row1;$i++)
	{
		$r1 = fetcharray($rs1);
		if($r1[id]==$library)
		{
			echo "<option value='$r1[id]' selected>$r1[name]</option>";
		}
		else
		{
			echo "<option value='$r1[id]' >$r1[name]</option>";
		}
	}
	?>
	</select></td>
	<td>Register <font color="#FF0000">*</font></td>
	<td>
 <?PHP
	$qry="select * from lib_register where library=$library";
	echo "<select name=register1>";
	echo "<option value=0>Select Register</option>";
	$librs=execute($qry);
	while($librow=fetcharray($librs))
	{
		if($librow[id]==$register1)
		{
			echo "<option value='$librow[id]' selected >$librow[register]</option>";
		}
		else
		{
			echo "<option value='$librow[id]'>$librow[register]</option>";
		}
	}                
	echo "</select></td></tr>";
?>
	<tr>
    
      <td width="18%">&nbsp;&nbsp;&nbsp;Sl.No</td>
	  <td width="21%" colspan="3"><?php echo $nid ?>
	  <input type="hidden" name="id" value="<?php echo $nid?>"></td>
    </tr>

	<tr>
	  <td width="14%">&nbsp;&nbsp;&nbsp;Title</td>
	  <td width="22%">
	  <input type="text" name="title" size="30"></td>
      
      <td width="22%">No of Copies</td>
	  <td width="31%" >
	  <input type="text" name="copies" size="8"></td>
	</tr>
	<tr>
	  <td width="14%">&nbsp;&nbsp;&nbsp;Language</td>
	  <td width="22%">
	  <input type="text" name="language" onKeyDown="return check(event)"></td>
	  <td width="22%">Source</td>
	  <td width="30%">
	  <input type="text" name="source"></td>
	</tr>

	<tr>
	  <td width="17%">&nbsp;&nbsp;&nbsp;Subscription Date</td>
	  <td width="22%">
	<?php
		if($du_dd=="")
			$du_dd=date("d");
	//Day
	echo "<select name='du_dd'>";
	for($i=1;$i<=31;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$du_dd)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	if($du_mm=="")
			$du_mm=date("m");
	echo "<select name='du_mm'>";
	for($i=1;$i<=12;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$du_mm)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	if($du_yy=="")
			$du_yy=date("Y");
	$maxYr =$du_yy+1;
	$st=$du_yy-4;
	echo "<select name='du_yy'>";
	for($i=$st;$i<=$maxYr;$i++)
	{
		if($i==$du_yy)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td>

	<td width="17%">Due Date</td>
	<td width="22%">
	<?php
	if($su_dd=="")
			$su_dd=date("d");
	//Day
	echo "<select name='su_dd'>";
	for($i=1;$i<=31;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$su_dd)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	if($su_mm=="")
			$su_mm=date("m");
	//Month
	echo "<select name='su_mm'>";
	for($i=1;$i<=12;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$su_mm)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	if($su_yy=="")
			$su_yy=date("Y");
	$maxYr =$su_yy+1;
	$st=$su_yy-4;
	echo "<select name='su_yy'>";
	for($i=$st;$i<=$maxYr;$i++)
	{
		if($i==$su_yy)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	  </td>
    </tr>

	<tr>
	  <td width="18%">&nbsp;&nbsp;&nbsp;Agent Sub. No</td>
	  <td width="31%">
	  <input type="text" name="a_sub_no"  size=8 ></td>
	  <td width="18%">Supplier</td>
	  <td width="31%">
	  <input type="text" name="supplier" size="30"></td>
	</tr>

	<tr>
	  <td width="19%">&nbsp;&nbsp;&nbsp;Periodicity</td>
	  <td width="21%"><select name="periodicity">
	<?php
	$sel1="";
	$sel2="";
	$sel3="";
	$sel4="";
	$sel5="";
	$sel6="";
	if($periodicity=="Daily")
		$sel1="selected";
	elseif($periodicity=="Weekly")
		$sel2="selected";
	elseif($periodicity=="Monthly")
		$sel3="selected";
	elseif($periodicity=="Fortnightly")
		$sel4="selected";
	elseif($periodicity=="Quarterly")
		$sel5="selected";
	else
		$sel6="selected";
	?>
	<option value="Daily" <?php echo $sel1?>>Daily</option>
	<option value="Weekly" <?php echo $sel2?>>Weekly</option>
	<option value="Monthly" <?php echo $sel3?>>Monthly</option>
	<option value="Fortnightly" <?php echo $sel4?>>Fortnightly</option>
	<option value="Quarterly" <?php echo $sel5?>>Quarterly</option>
	<option value="Yearly" <?php echo $sel6?>>Yearly</option>
    </select></td>
	<td width="13%">Amount Type</td>
	<td width="21%"><select name="amount_type">
	<?php
	$sel1="";
	$sel2="";
	$sel3="";
	if($amount_type=="cash")
		$sel1="selected";
	elseif($amount_type=="cheque")
		$sel2="selected";
	else
		$sel3="selected";
	?>
	<option value="cash" <?php echo $sel1?>>Cash</option>
	<option value="cheque" <?php echo $sel2?>>cheque</option>
	<option value="DD" <?php echo $sel3?>>D.D</option>
    </select></td>
	</tr>
	<tr>
	  <td width="21%">&nbsp;&nbsp;&nbsp;Amount</td>
	  <td width="31%">
	  <input type="text" name="amount"size="8" onKeydown="return checkIt(event,1)"></td>
	  <td width="21%">Bank Details</td>
	  <td width="31%">
	  <input type="text" name="bank_details"></td>
	</tr>
	<tr>
	  <td width="13%">&nbsp;&nbsp;&nbsp;Bill Details</td>
	  <td width="21%"><input type="text" name="bill_no" size="8"></td>
	  
      <td width="13%">Amount (per month)</td>
	  <td width="21%"><input type="text" name="amountMonth" size="8"></td>
	</tr>
	
	<tr>
	  <td width="13%">&nbsp;&nbsp;&nbsp;Extra amount</td>
	  <td width="21%"><input type="text" name="extraAmount" size="8"></td>
	  
      <td width="13%">Remarks</td>
	  <td width="21%"><textarea name="remarks" style="width: 150px; height: 20px;"></textarea></td>
	</tr>
</table>
<br>
<p align="center">
	  <input type="button" name="add" value="ADD" onClick="addnew()" class="bgbutton" style="width:60px; height:22px"></p>
<?php
}
if($act==2)
{
	if($jmsub==1)
	{
		$ttle='Modify/Inactive Journal Subscription Details';
	}
	elseif($jmsub==2)
	{
		$ttle='Modify/Inactive Magazine Subscription Details';
	}
	elseif($jmsub==3)
	{
		$ttle='Modify/Inactive NewsPaper Subscription Details';
	}
?>
	<table align=center class=forumline width="80%">
	  <tr>
	    <td class=head colspan=6 align=center><?php echo $ttle?></td>
     </tr>
	 <tr>
	   <td colspan=2 align="right">Select ID/Title&nbsp;&nbsp;&nbsp;</td>
	   <td><select name="idttl" onchange="frmsubmit()">
	   <option value=''>---Select--</option>    
		<?php

            $sql="select id,title from lib_magazine_subscription where ssp_type='$jmsub' and stts=1 order by id";
            $rs=execute($sql);
            while($rs1=fetcharray($rs))
            {
                $idttl1=$rs1[id]."--".$rs1[title];
                $newid=$rs1[id];
                if($idttl==$newid)
                {
                    echo "<option value=$newid selected>$idttl1</option>";
                }
                else
                {
                    echo "<option value=$newid>$idttl1</option>";
                }
            }
        ?>
        </select>
	    </td>
	  <td></td>
	</tr>
<?php
	if($idttl!='')
	{
		$sql1=execute("select * from lib_magazine_subscription where ssp_type='$jmsub' and id=$idttl");
		if(rowcount($sql1)>0)
		{
			$rs3=fetcharray($sql1);
	
?>
<?
$library=1;
$register1 =1;
?>
			<tr>
			  <td >&nbsp;&nbsp;&nbsp;ID</td>
			  <td  colspan="3"><?php echo $rs3[id]?>
			  <input type="hidden" name="nid" value="<?php echo $rs3[id]?>"></td>
			</tr>

			<tr>
			  <td >&nbsp;&nbsp;&nbsp;Title</td>
			  <td >
			  <input type="text" name="title" size="30" value="<?php echo $rs3[title]?>"></td>
             
              <td>No of Copies</td>
	  		  <td>
	          <input type="text" name="copies" size="8" value="<?php echo $rs3[copies]?>"></td>
     	 </tr>
		 <tr>
			  <td>&nbsp;&nbsp;&nbsp;Language</td>
			  <td>
			  <input type="text" name="language" value="<?php echo $rs3[language]?>" onKeyDown="return check(event)"></td>
			  <td>Source</td>
			  <td>
			  <input type="text" name="source" value="<?php echo $rs3[source]?>"></td>
			</tr>

			<tr>
			  <td>&nbsp;&nbsp;&nbsp;Subscription Date</td>
			  <td>
	<?php
	
			$c_date=explode("-",$rs3[subscription_date]);
	
			echo "<select name='du_dd'>";
			for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[2])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			//$MyMonth=$c_date[1];
			//Month
			echo "<select name='du_mm'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[1])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			//Year
			$maxYr =$c_date[0]+2;
			//$MyYear=$c_date[0];
			$st=$c_date[0]-4;
			echo "<select name='du_yy'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$c_date[0])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
	?>
			</td>

			<td width="17%">Due Date</td>
			<td width="22%">
	<?php
	
			$c_date=explode("-",$rs3[due_date]);
			//$MyDay=$c_date["mday"];
			//Day
			echo "<select name='su_dd'>";
			for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[2])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			//$MyMonth=$c_date["mon"];
			//Month
			echo "<select name='su_mm'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[1])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			//Year
			$maxYr =$c_date[0]+2;
			//$MyYear=$c_date["year"];
			$st=$c_date[0]-4;
			echo "<select name='su_yy'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$c_date[0])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
	?>
			</td>
	    </tr>

			<tr>
			  <td width="18%">&nbsp;&nbsp;&nbsp;Agent Sub. No</td>
			  <td width="31%">
			  <input type="text" name="a_sub_no"  size=8 value="<?php echo $rs3[a_sub_no]?>"></td>
			  <td width="18%">Supplier</td>
			  <td width="31%">
			  <input type="text" name="supplier" value="<?php echo $rs3[supplier]?>" size="30"></td>
			</tr>
			<tr>
			  <td width="19%">&nbsp;&nbsp;&nbsp;Periodicity</td>
			  <td width="21%"><select name="periodicity">
	<?php

			if($rs3[periodicity]=="Daily")
			{
				$sel1="selected";
				$sel2="";
				$sel3="";
				$sel4="";
				$sel5="";
				$sel6="";
			}
			elseif($rs3[periodicity]=="Weekly")
			{
				$sel1="";
				$sel2="selected";
				$sel3="";
				$sel4="";
				$sel5="";
				$sel6="";
			}
			elseif($rs3[periodicity]=="Monthly")
			{
				$sel1="";
				$sel2="";
				$sel3="selected";
				$sel4="";
				$sel5="";
				$sel6="";
			}
			elseif($rs3[periodicity]=="Fortnightly")
			{
				$sel1="";
				$sel2="";
				$sel3="";
				$sel4="selected";
				$sel5="";
				$sel6="";
			}
			elseif($rs3[periodicity]=="Quarterly")
			{
				$sel1="";
				$sel2="";
				$sel3="";
				$sel4="";
				$sel5="selected";
				$sel6="";
			}
			else
			{
				$sel1="";
				$sel2="";
				$sel3="";
				$sel4="";
				$sel5="";
				$sel6="selected";
			}
	?>
			<option value="Daily" <?php echo $sel1?>>Daily</option>
			<option value="Weekly" <?php echo $sel2?>>Weekly</option>
			<option value="Monthly" <?php echo $sel3?>>Monthly</option>
			<option value="Fortnightly" <?php echo $sel4?>>Fortnightly</option>
			<option value="Quarterly" <?php echo $sel5?>>Quarterly</option>
			<option value="Yearly" <?php echo $sel6?>>Yearly</option>
            </select></td>
			<td width="13%">Amount Type</td>
			<td width="21%"><select name="amount_type">
	<?php

			if($rs3[amount_type]=="cash")
			{
				$sel1="selected";
				$sel2="";
				$sel3="";
			}
			elseif($rs3[amount_type]=="cheque")
			{
				$sel1="";
				$sel2="selected";
				$sel3="";
			}
			else
			{
				$sel1="";
				$sel2="";
				$sel3="selected";
			}
	?>
			<option value="cash" <?php echo $sel1?>>Cash</option>
			<option value="cheque" <?php echo $sel2?>>Cheque</option>
			<option value="DD" <?php echo $sel3?>>DD</option>
            </select></td>
	   </tr>
	   <tr>
	     <td width="21%">&nbsp;&nbsp;&nbsp;Amount </td>
	     <td width="31%">
		 <input type="text" name="amount"size="8" value="<?php echo $rs3[amount]?>" onKeydown="return checkIt(event,1)"></td>
		 <td width="21%">Bank Details</td>
		 <td width="31%">
		  <input type="text" name="bank_details" value="<?php echo $rs3[bank_details]?>"></td>
	  </tr>
	   <tr>
	    <td width="13%">&nbsp;&nbsp;&nbsp;Bill Details</td>
		<td width="21%"><input type="text" name="bill_no" size="8" value="<?php echo $rs3[bill_no]?>" ></td>
        
        <td width="13%">Amount (per month)</td>
	    <td width="21%">
        <input type="text" name="amountMonth" size="8" value="<?php echo $rs3[amountMonth]?>" onKeydown="return checkIt(event,1)"></td>
	</tr>
	
	<tr>
	    <td width="13%">&nbsp;&nbsp;&nbsp;Extra amount</td>
	    <td width="21%">
        <input type="text" name="extraAmount" size="8" value="<?php echo $rs3[extraAmount]?>" onKeydown="return checkIt(event,1)"></td>
	  
        <td width="13%">Remarks</td>
	    <td width="21%"><textarea name="remarks" style="width: 150px; height: 20px;"><?php echo $rs3[remarks]?></textarea></td>
	</tr>
</table>
<br>
<p align="center">
	   <input type="button" name="mod" value="MODIFY" onClick="modnew()" class='bgbutton'>
	   &nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" name="del" value="INACTIVE" onClick="delnew()" class='bgbutton'></p>
	<?php
		}
	}
}
function MonthName($mon)
{
	if($mon == 1) return("Jan");
	if($mon == 2) return("Feb");
	if($mon == 3) return("Mar");
	if($mon == 4) return("Apr");
	if($mon == 5) return("May");
	if($mon == 6) return("Jun");
	if($mon == 7) return("Jul");
	if($mon == 8) return("Aug");
	if($mon == 9) return("Sep");
	if($mon == 10) return("Oct");
	if($mon == 11) return("Nov");
	if($mon == 12) return("Dec");
}
?>
</form>
</BODY>
</HTML>