<HTML>
<HEAD>
<?php
	$flag = false;
	require("../db.php");
	if($_REQUEST)
{
	$Type=$_REQUEST['Type'];
	$media=$_REQUEST['media'];
	$acc_no=$_REQUEST['acc_no'];
	$action=$_REQUEST['action'];
}
if($_POST)
{
$acc_no=$_POST['acc_no'];
$id=$_POST['id'];
$library=$_POST['library'];
$register=$_POST['register'];
$author=$_POST['author'];
$rack=$_POST['rack'];
$title=$_POST['title'];
$source_acc_no=$_POST['source_acc_no'];
$acq_dd=$_POST['acq_dd'];
$acq_mm=$_POST['acq_mm'];
$acq_yy=$_POST['acq_yy'];
$key_word1=$_POST['key_word1'];
$key_word2=$_POST['key_word2'];
$key_word3=$_POST['key_word3'];
$key_word4=$_POST['key_word4'];
$key_word5=$_POST['key_word5'];
$sel=$_POST['sel'];
$sel1=$_POST['sel1'];
$sel2=$_POST['sel2'];
$cd_type=$_POST['cd_type'];
$mode=$_POST['mode'];
$remarks=$_POST['remarks'];
$accNo=$_POST['accNo'];
$modDet=$_POST['modDet'];
}
	$sql="select a.*,b.library,b.register from lib_cd_det a,lib_cd_acc_det b where a.id=b.master_id and b.acc_no='$acc_no' and b.cd_status=1 limit 0,1";
	$rs = execute($sql);
	$row= rowcount($rs);
	if($row==0)
		{
			if($row==0)
				{
					echo "<font color=red><b>Enter valid Accession no.</b></font>";
					die();
				}
		}
?>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;

function frm_modify()
	{
		document.modDet.action = "modify_other_cd.php?Type=modify";
		document.modDet.submit();
	}
function checkIt(e)
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
						alert("Please make sure entries are numbers only.")
						return false
					}
			}
		return true
	}
function first_caps(theField)
	{
		var str,str_len;
		str=theField.value;
		str_len=str.length;
		if(str_len==1)
			{
				theField.value=str.toUpperCase();
			}
	}
</script>
</HEAD>

<BODY>
<form method="POST" name="modDet" action="modify_other_cd_det.php">
<table border="0" width="70%" align='center' class='forumline'>
	<input type="hidden" name="acc_no" value="<?=$acc_no?>">
	<tr height='25'>
		<td class="head" colspan=4 align="center">Modify Other CD Details</td>
	</tr>
	<?php
	$r=fetcharray($rs,0);
	?>
	<tr>
		<td><font color="#a65353">Library</font><font color="#FF0000">*</font></td>
	    <td><select size="1" name="library" >
		<?php
		$sql1 = "SELECT * FROM library_name";
		$rs1 = execute($sql1);
		$row1 = rowcount($rs1);
		for($i=0;$i<$row1;$i++)
			{
				$r1 = fetcharray($rs1,$i);
				if($r1[id]==$r[library])
				$sel="selected";
				else
				$sel="";
				?>
				<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
				<?php
			}
		?>
		</select></td>
		<td>
		<?php
		if($r[library]<>'')
			{
				echo "<font color='#a65353'><b>Register</b></font> <font color=#FF0000>*</font>";
				echo "</td>";
				echo"<td>";
				echo "<select name=register>";
				$qry="select * from lib_register where library=$r[library]";
				$librs=execute($qry);
				echo "<option value=''>Select Register</option>";
				while($librow=fetcharray($librs))
					{
						$sel="";
						if($librow[id]==$r[register])
							{
								$sel="selected";
							}
						echo "<option value='$librow[id]' $sel >$librow[register]</option>";
					}
			?>
			</select></td>
		</tr>
		<tr>
			<td><font color="#a65353"><b>Title</b></font></td>
			<td colspan=3><input type="text" name="title" value="<?=$r[title]?>" onKeydown="first_caps(this.form.title)"></td>
		</tr>
		<tr>
			<td><font color="#a65353"><b>Source</b></font></td>
			<td><input type="text" name="source" value="<?=$r[source]?>"></td>
			<td><font color="#a65353"><b>Price</b></font></td>
			<td><input type="text" name="price" value="<?=$r[price]?>" size="10"></td>
		</tr>
		<tr>
			<td><font color="#a65353"><b>Rack</b></font></td>
			<td><input type="text" name="rack" value="<?=$r[rack]?>"></td>
			<td><font color="#a65353"><b>Month-Year</b></font></td>
			<td><input type="text" name="month" value="<?=$r[month]?>" size=2 maxlength="2" onKeydown="return checkIt(event)">-
			<input type="text" name="year" value="<?=$r[year]?>" size=4 maxlength="4" onKeydown="return checkIt(event)"></td>
		</tr>
		<tr>
			<td><font color="#a65353"><b>Publication Date </b></font></td>
			<?php
			$date1=explode("-",$r[publication_date]);
			$pub_dd=$date1[2];
			$pub_mm=$date1[1];
			$pub_yy=$date1[0];
			?>
			<td><select name="pub_dd">
			<?php
		    for($i=1;$i<=31;$i++)
				{
					$sel='';
					if($i == $pub_dd)
					$sel='selected';
					echo "<option value='$i' $sel>$i</option>";
	            }
			?>
			</select>
			<select name="pub_mm">
			<?php
			for($i=1;$i<=12;$i++)
				{
					$sel='';
					if($i==$pub_mm)
					$sel='selected';
                    echo "<option value='$i' $sel>$i</option>";
				}
			?>
			</select>
			<select name="pub_yy">
			<?php
			$j=date('Y');
			$d=$j-30;
			for($i=$d;$i<=$j+1;$i++)
                {
					$sel='';
	                if($i==$pub_yy)
				    $sel='selected';
	                echo "<option value=$i $sel>$i</option>";
                 }
			?>
			</select></td>
			<td><font color="#a65353"><b>Date of Acquiring</b></font></td>
			<?php
			$date=explode("-",$r[date_of_acquiring]);
			$acq_dd=$date[2];
			$acq_mm=$date[1];
			$acq_yy=$date[0];
			?>
			<td><select name="acq_dd">
			<?php
		     for($i=1;$i<=31;$i++)
				{
					$sel='';
					if($i == $acq_dd)
					$sel='selected';
					echo "<option value='$i' $sel>$i</option>";
	            }
			?>
			</select>
			<select name="acq_mm">
			<?php
			for($i=1;$i<=12;$i++)
				{
					$sel='';
					if($i==$acq_mm)
					$sel='selected';
                    echo "<option value='$i' $sel>$i</option>";
				}
			?>
			</select>
			<select name="acq_yy">
			<?php
			$j=date('Y');
			$d=$j-30;
			for($i=$d;$i<=$j+1;$i++)
                {
					$sel='';
	                if($i==$acq_yy)
				    $sel='selected';
	                echo "<option value=$i $sel>$i</option>";
                 }
				?>
			</select></td>
			</tr>
			<tr>
				<td><font color="#a65353"><b>Volume No</b></font></td>
				<td><input type="text" name="volume" value="<?=$r[volume]?>"></td>
				<td><font color="#a65353"><b>Issue No</b></font></td>
				<td><input type="text" name="issue" value="<?=$r[issue]?>"></td>
			</tr>
			<tr>
				<td class="CHead" colspan=4 align="center"><font color='red'>Key Words</font></td>
			</tr>
			<tr>
				<td><b>Key Word1</b></td>
				<td><input type="text" name="key_word1" value="<?=$r[key_word1]?>"></td>
				<td><b>Key Word2</b></td>
				<td><input type="text" name="key_word2" value="<?=$r[key_word2]?>"></td>
			</tr>
			<tr>
				<td><b>Key Word3</b></td>
				<td><input type="text" name="key_word3" value="<?=$r[key_word3]?>"></td>
				<td><b>Key Word4</b></td>
				<td><input type="text" name="key_word4" value="<?=$r[key_word4]?>"></td>
			</tr>
			<tr>
				<td><b>Key Word5</b></td>
				<td><input type="text" name="key_word5" value="<?=$r[key_word5]?>"></td>
			</tr>
			<tr>
				<td colspan='4'><input type="hidden" name="id" value="<?=$r[id]?>">
				<table align="center" width='100%'>
					<tr>
						<td class="row3"><font face='Lucida Sans' size='1.8'>Acc No</font></td>
						<td class="row3"><font face='Lucida Sans' size='1.8'>Call No</font></td>
						<td class="row3"><font face='Lucida Sans' size='1.8'>Mode</font></td>
						<td class="row3"><font face='Lucida Sans' size='1.8'>Floppy Type</font></td> 
					</tr>
					<?
					$remarks=$r[remarks];
					$sql1="select distinct(a.acc_no) from lib_cd_acc_det a where a.master_id=$r[id] and cd_status=1";
					$rs1=execute($sql1);
					while($r2=fetcharray($rs1))
						{
							$sql2="select * from lib_cd_acc_det a where a.acc_no=$r2[acc_no]";
							$rs2=execute($sql2);
							$r3=fetcharray($rs2,0);
							?>
							<tr><input type="hidden" name="sel[]" value="<?=$r3[id]?>">
							<td><font face='Lucida Sans'><input type="text" name="sel1[]" value="<?=$r3[acc_no]?>"></font></td>
							<td><font face='Lucida Sans'><input type="text" name="sel2[]" value="<?=$r3[call_no]?>"></font></td>
							<td>
							<?php
							$sel1="";
							$sel2="";
							$sel3="";
							if($r3[mode]==A)
								{
									$sel1="selected";
								}
							elseif($r3[mode]==D)
								{
									$sel2="selected";
								}
							elseif($r3[mode]==M)
								{
									$sel3="selected";
								}
							?>
							<select name=mode<?=$r3[id]?>>
							<option value='A' <?=$sel1?> >Active</option>
							<option value='D' <?=$sel2?>>Dummy</option>
							<option value='M' <?=$sel3?>>Missing</option>
							</select></td>
							<td>
							<?php
							$sel1="";
							$sel2="";
							$sel3="";
							$sel4="";
							if($r3[cd_type]==I)
								{
									$sel1="selected";
								}
							elseif($r3[cd_type]==R)
								{
									$sel2="selected";
								}
							elseif($r3[cd_type]==T)
								{
									$sel3="selected";
								}
							elseif($r3[cd_type]==S)
								{
									$sel4="selected";
								}
							?>
							<select name=cd_type<?=$r3[id]?>>
							<option value='I' <?=$sel1?> >Issue</option>
							<option value='R' <?=$sel2?>>Reference</option>
							<option value='T' <?=$sel3?>>Temp</option>
							<option value='S' <?=$sel3?>>Weed out</option>
							</select></td>
						</tr>
						<?
					}
				}
			?>
			<input type="hidden" name="acc_no" value="<?=$acc_no?>">
			<tr>
				<td><b>Remarks</b></td>
				<td colspan=3 align='left'><textarea name='remarks' rows=3 cols=40><?=$remarks?></textarea></td>
			</tr>
			<tr>
				<td colspan=3 align="center"><input type="button" name="modify" value="Modify" onClick="frm_modify()"></td>
			</tr>
		</table>
	</td>
</tr>
</table>
</form>
</BODY>
</HTML>