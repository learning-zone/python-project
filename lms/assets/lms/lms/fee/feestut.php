<HTML>
<head>
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<?php
$ctime=date("dmyhis");
$uid=md5($ctime);
session_start();
include("../db.php");
if(!$_POST)
{
	$course=$_SESSION['branch'];
	$FromYear=$_SESSION['sem'];	
}
else
{
	$academicYear=$_POST['academicYear'];
	$a_year=$_POST['a_year'];
	$course=$_POST['course'];
	$FromYear=$_POST['FromYear'];
	$fee_type=$_POST['fee_type'];
	$intl=$_POST['intl'];
	$currency=$_POST['currency'];
	$slab=$_POST['slab'];
}

	$fee12=execute("select uid from  fee_m_descrption where class='$FromYear' and accyear='$slab' and adm_cat='$fee_type' and academicYear='$academicYear' ");
	$uid1=fetchrow($fee12);
	if($uid1[0])
	$uid=$uid1[0];
	
	if($uid1[0] and !$intl)
	{
		$r1=fetcharray(execute("select no_of_instal,currency from  fee_m_descrption where uid='$uid'"));
		$intl=$r1[0];
		$currency=$r1[1];
	}

if($_POST['save'])
{
	if($uid1[0])
	{	
		$sql="update fee_m_descrption set no_of_instal='$intl' ,currency='$currency' where uid='$uid' ";
	}
	else
	{
		$sql="INSERT INTO  fee_m_descrption (`uid`, `class`, `accyear`,`academicYear`, `adm_cat`, `no_of_instal`,  `no_of_student`,`status`,`currency`) VALUES ('$uid', '$FromYear','$slab','$academicYear', '$fee_type', '$intl', '0', '1','$currency')";
	}
	//echo $sql;
	execute($sql);


//code for instalment amount
	$sql44= execute("SELECT fee_id FROM fee_type WHERE status=1 ORDER BY fee_id");
	while($r=fetcharray($sql44))
	{
		//individuval total update
		for($i=1;$i<=$intl;$i++)
		{
			$amount=$_POST["fee_".$r[0]."_".$i];
			$newtot[$i]=$newtot[$i]+$amount;
			$fee1=execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$i' ");
			if(rowcount($fee1)>0)
			{
				$sql1="update `fee_m_descrption_val` set amount='$amount' where uid='$uid' and fee_head='$r[0]' and inst_id='$i' ";
			}
			else
			{
				$sql1="INSERT INTO `fee_m_descrption_val` (`uid`, `fee_head`, `inst_id`, `amount`, `sts`) VALUES ('$uid','$r[0]', '$i', '$amount', '1')";
			
			}			
			execute($sql1);				
		}
	
	//head total update
			$headtotal=$_POST['total'.$r[0]];
			$fee1=execute("select id from  fee_m_descrption_head_total where head_id='$r[0]' and uid='$uid' ");
			if(rowcount($fee1)>0)
			{
				$sql="update `fee_m_descrption_head_total` set `amount`='$headtotal' where uid='$uid' and head_id='$r[0]'";
			}
			else
			{
				$sql="INSERT INTO `fee_m_descrption_head_total` (`uid`, `head_id`, `amount`, `sts`) VALUES ('$uid', '$r[0]', '$headtotal', '1')";
			}
			execute($sql);

	}

// instalment amount code ends
//total amount and date insrtion code
$fd=3;
	for($i=1;$i<=$intl;$i++)
	{
		$fromdate=$_POST["date".$fd];
		$fromdate1=explode('/',$fromdate);
		$fromdate="$fromdate1[2]-$fromdate1[1]-$fromdate1[0]";
		$fd++;
		
		$todate=$_POST["date".$fd];
		$todate1=explode('/',$todate);
		$todate="$todate1[2]-$todate1[1]-$todate1[0]";
		$fd++;
		if($newtot[$i])
		{
			$fee1=execute("select id from  fee_m_descrption_inst_total where inst_id='$i' and uid='$uid' ");
			if(rowcount($fee1)>0)
			{
				$sql="update `fee_m_descrption_inst_total` set `amount`='$newtot[$i]', `f_due_date`='$fromdate', `t_due_date`='$todate' where uid='$uid' and inst_id='$i'";
			}
			else
			{
				$sql="INSERT INTO `fee_m_descrption_inst_total` (`uid`, `inst_id`, `amount`, `f_due_date`, `t_due_date`, `sts`) VALUES ('$uid', '$i', '$newtot[$i]', '$fromdate', '$todate', '1')";
			}
			execute($sql);
		}
	}
//total code ends

	?>
    <script language="javascript">
	alert("Updated successfully ");
    </script>
    <?php	
}
?>
    
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="feestut.php";
	document.frm.submit();
}
function calcal(i,k1)
{
	var installment=parseInt(document.getElementById("installment").value);
	var k=1;
	var total=0;
	var tot1=0;
	var newval=0;
	var newva2=0;	
	for(k=1;k<=installment;k++)
	{
		tot1=parseInt(document.getElementById("fee_"+i+"_"+k).value);
		newval=parseInt(document.getElementById("feetotal"+k).value);
		if(isNaN(tot1))
		{
			tot1=0;
			document.getElementById("fee_"+i+"_"+k).value=0;
		}
		newva2=newval+tot1;
		total=total+tot1;

		newva2=0;
		tot1=0;
	}
	//feetotal
	document.getElementById("total"+i).value=total;

	var levar=document.frm.elements['feeid[]'].length;
	var myControls = document.frm.elements['feeid[]'];
	var gtotal=0;
	var ggtotal=0;

	for(var m=0;m<levar;m++)
	{
		var newval1=myControls[m].value
		tot1=parseInt(document.getElementById("fee_"+newval1+"_"+k1).value);
		gtotal=gtotal+tot1;
		tot1=parseInt(document.getElementById("total"+newval1).value);
		ggtotal=ggtotal+tot1;
	}
	document.getElementById("feetotal"+k1).value=gtotal;
	document.getElementById("totalm").value=ggtotal;
}
function OpenWind2(k2)
	{
	
		var finalVar ;
	
		finalVar=k2 ;
	
		window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
	
	}
</SCRIPT>
<BODY>
	<FORM NAME='frm' METHOD='POST' ><br>
	<table class='forumline' align='center' width="90%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare Fee Master </td>
	</tr>
<!--   <tr height="25">
<td nowrap>&nbsp;&nbsp;Admitted Year</td>
            <td  align="left">&nbsp;&nbsp;<select name="a_year" id="a_year" OnChange=go()>
                <option value='0'>Select Year</option>
                <?php
				   $MyYear=date('Y')-10;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select></td>
              </tr>
-->	<tr>
    <tr height="25">
<td nowrap>&nbsp;&nbsp;Slab</td>
 <td>&nbsp;&nbsp;<select name="slab" onChange="go()">

	<option value="0">Select  </option>

<?php

	$sql3=execute("SELECT id, name FROM `fee_discount_slab` where status=1");

	for($j=0;$j<rowcount($sql3);$j++)
	{

		$r3=fetcharray($sql3,$j);

		if($r3[0]==$slab)
		{

			echo "<option value=$r3[0] selected>$r3[1]</option>";

		}
		else
		{

			echo "<option value=$r3[0]>$r3[1]</option>";

		}

	}

?>

</select>&nbsp;&nbsp;

<a href= "javascript:OpenWind2('slab.php?subject')"><input type="button" align="center" class="bgbutton" value="Add"></a> 		

</td> 

</tr>
	<tr>
	<td width="30%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td  align="left">&nbsp;
	<select name="course" size="1" OnChange=go()>
	<option value='' >-- Select --</option>
	<?
	$tempstr="SELECT course_id ,coursename FROM  course_m ";
	$rs_course=execute($tempstr);
	while($r1=fetcharray($rs_course))
	{
	if($course==$r1[0])
		{
			echo "<option value='$r1[0]' selected>$r1[1]</option>";
		}
		else
		{
			echo "<option value='$r1[0]'>$r1[1]</option>";
		}
	}
	?>
	</select></td></tr>
	
	  <tr>
	<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td colspan="2">&nbsp;
	<select name="FromYear" OnChange=go()>
	<?php
	$sql2 = "SELECT * FROM course_year where status=1 and head_id='$course' ";
	$rs2 = execute($sql2);
	$num = rowcount($rs2);
	echo "<option value=''>-- Select --</option>";
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($rs2,$i);
		if($FromYear==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
	}
	?> </select> </td></tr>
   
    		<tr>
		 <td nowrap>&nbsp;&nbsp;Admission Category</td>
            <td align="left">&nbsp;&nbsp;<select name="fee_type" OnChange=go()>
			<?php
            $qq="select id,name from admission";
            $qqq=execute($qq);
            for($i=0;$i<rowcount($qqq);$i++)
            {
				$myq=fetcharray($qqq);
				if($fee_type==$myq[id])
				{
					?>
					<option value="<?=$myq[id]?>" selected><?php echo $myq[name] ?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?php echo $myq[id] ?>"> 
					<?=$myq[name]?>
					</option>
					<?php
				}
            }
            ?>
            </select> </td>
	</tr>
<?php
$feestBlock=fetchrow(execute("select no_of_student from `fee_m_descrption` where uid='$uid'"));
if($feestBlock[0])
{
	$selectval='disabled';
	echo "<input type='hidden' name='currency' value='$currency'>
	<input type='hidden' name='intl' value='$intl'>";
}
else
$selectval='';

?>

    		<tr>
		 <td nowrap>&nbsp;&nbsp;Currency Type</td>
            <td align="left">&nbsp;&nbsp;<select name="currency" OnChange='go()' <?=$selectval?>>
			<?php
            $qqq=execute("select id, description  from fee_m_currency_code where status=1");
            for($i=0;$i<rowcount($qqq);$i++)
            {
				$myq=fetcharray($qqq);
				if($currency==$myq[id])
				{
					?>
					<option value="<?=$myq[id]?>" selected><?=$myq[description]?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?=$myq[id]?>"><?=$myq[description]?></option>
					<?php
				}
            }
            ?>
            </select> </td>
	</tr>
 		<tr>
		<td nowrap>&nbsp;&nbsp;No Of Installment </td>
		<td align="left">&nbsp;&nbsp;<select name='intl' OnChange='go()' <?=$selectval?>>
        		<option value=''>-- Select --</option>
				<?php
                for($k=1;$k<=12;$k++)
				{
				if($k==$intl)
                echo"<option value='$k' selected>$k</option>";
				else
				echo"<option value='$k'>$k</option>";
				}
                ?>  
		</select>
        </td>
		</tr>
</table>
<?php
if(!$intl or !$currency)
die();

$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
            
?>
    
		<table class='forumline' align='center' width="90%" border="1" cellspacing="0" cellpadding="0">
      <tr><td align='center' class="head" nowrap>Fee Head</td>
      <td align='center' colspan="<?=$intl?>"  class="head" nowrap>Instalment Amount
      </td>
	 <td align='center' class="head" nowrap>Total</td></tr>
     <input type="hidden" id="installment" value="<?=$intl?>">
		<?php
		$fd=3;
			echo "<tr>
				<td width='15%' nowrap>&nbsp;&nbsp;Date&nbsp;&nbsp;</td>";
				for($i=1;$i<=$intl;$i++)
				{
					$feedate=fetcharray(execute("select DATE_FORMAT(f_due_date,'%d/%m/%Y'),DATE_FORMAT(t_due_date,'%d/%m/%Y') from  fee_m_descrption_inst_total where uid='$uid' and inst_id='$i' and uid='$uid' "));
					
					$fromdate="date".$fd;
					$fcalender="Calendar".$fd;
					$fd++;
					$todate="date".$fd;
					$tcalender="Calendar".$fd;
					$fd++;
					?>
                    <td align='center' nowrap>
						F <input type='text' name='<?=$fromdate?>' value='<?=$feedate[0]?>' size="10"  readonly >
                        <a href="javascript:showCal('<?=$fcalender?>')"><img src='../images/calendar.jpg' align='absmiddle' ></a>
					<br>
					T <input type='text' name='<?=$todate?>' value='<?=$feedate[1]?>' size="10"  readonly >
                    <a href="javascript:showCal('<?=$tcalender?>')"><img src='../images/calendar.jpg' align='absmiddle' ></a>
					</td>
                    <?php
				}
				echo "<td align='center'>
					
					</td></tr>";
					
					
			$sql44= execute("SELECT fee_id,fee_name FROM fee_type WHERE status=1 ORDER BY fee_id");
			while($sql45=fetcharray($sql44))
			{
				
				
				echo "<input type='hidden' name='feeid[]' value='$sql45[0]'>";
				echo "<tr>
				<td width='15%' nowrap>&nbsp;&nbsp;$sql45[1]&nbsp;&nbsp;</td>";
				$sumval=0;
				for($i=1;$i<=$intl;$i++)
				{
					
					$feestBlockInst=fetchrow(execute("select no_of_student from `fee_m_descrption_inst_total` where uid='$uid' and inst_id='$i'"));
					if($feestBlockInst[0])
					$readonly='';
					else
					$readonly='';
					
					$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$sql45[0]' and inst_id='$i'"));
					if($feeval[0])
					$val=$feeval[0];
					else
					$val=0;
					
					$sumval=$sumval+$val;
					echo "<td align='center'><b>$i</b><br>$readonly 
						<input type='text' name='fee_".$sql45[0]."_".$i."'  id='fee_".$sql45[0]."_".$i."' onChange='calcal($sql45[0],$i)'  value='$val' size='10' title='$readonly' $readonly> $currencydes[0]
					</td>";
				}
				
					
				echo "<td align='center'>
						<input type='text' name='total".$sql45[0]."'  id='total".$sql45[0]."' onChange='calnew(this.name)'  value='$sumval' size='10' readonly > $currencydes[0]
					</td></tr>";
				?>
				<?php
			}
			$totalm=0;
			echo "<tr>
			<td width='15%' nowrap>&nbsp;&nbsp;TOTAL&nbsp;&nbsp;</td>";
			for($i=1;$i<=$intl;$i++)
			{
				
				$feetot=fetchrow(execute("select amount from  fee_m_descrption_inst_total where uid='$uid' and inst_id='$i' "));
				echo "<td align='center'>=<br>
				<input type='text' name='feetotal".$i."'  id='feetotal".$i."' value='$feetot[0]' size='10' readonly > $currencydes[0]
				</td>";
				$totalm=$totalm+$feetot[0];
			}
			echo "<td align='center'>=<br>
			<input type='text' name='totalm'  id='totalm' value='$totalm' size='10' readonly > $currencydes[0]
			</td></tr>";
			
 		?>
			
       </table>
	  <br>
	  <div align="center">
		<input type="submit" name="save" value="UPDATE" class="bgbutton">
	  </div>
	
</FORM>
</BODY>
</HTML>