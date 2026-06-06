<?php
		$flag = false;
		REQUIRE("../db.php");
?>
<HTML>
<HEAD>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
	function frm_add()
		{
			if(document.book.library.selectedIndex=="")
				{
					alert("Please select Library");
					document.book.library.focus();
					return false;
				}

			if(document.book.register.selectedIndex=="")
				{
					alert("Select Register ");
					document.book.register.focus();
					return false;
				}
			if (document.book.acc_no.value=="" )
				{
					alert("Enter Accession No");
					document.book.acc_no.focus();
					return false;
				}
			if (document.book.title.value=="")
				{
					alert("Enter media title");
					document.book.title.focus();
					return false;
				}

					document.book.action = "ins_bound_media.php";
					document.book.submit();
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

function all_caps(theField)
	{
		var str;
		str=theField.value;
		theField.value=str.toUpperCase();
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
<form method="POST" name="book" action="add_bound_media.php">
<?php
 include("media_add.php");
?>
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="accNo" value="<?=$accNo?>">
<br>
<table class='forumline' width="90%" align=center border=0 cellpadding=1 cellspacing=1 >
<tr>
<td class="head" colspan=4 align="center">Add Bound Volume Details</td></tr>

<tr>
<td width="120" align="left" height="22" ><b><font color="#a65353">Library</font></b><font color="#FF0000">*</font></td>
<td  height="22">
<select size="1" name="library" onChange="javascript:document.book.submit()">
<option value=''>Select Library</option>
<?php
	$sql1 = "SELECT * FROM library_name";
	$rs1 = execute($sql1);
	$row1 = rowcount($rs1);
	
	for($i=0;$i<$row1;$i++)
		{
			$r1 = fetcharray($rs1,$i);
			if($r1[id]==$library)
				$sel="selected";
			else
				$sel="";
?>
	<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
	<?php
		}
	?>
</select>
</td>
<td nowrap>
<?php
//if($library<>'')
	{
		echo "<font color='#a65353'><b>Register</b></font> <font color=#FF0000>*</font>";
		echo "</td>";
		echo"<td>";
		echo "<select name=register onChange='javascript:document.book.submit()'>";
		$qry="select * from lib_register where library='$library'";
		$librs=execute($qry);
		echo "<option value=''>Select Register</option>";
		while($librow=fetcharray($librs))
			{
				$sel="";
				if($librow[id]==$register)
					{
						$sel="selected";
					}
		echo "<option value='$librow[id]' $sel >$librow[register]</option>";
	}
		echo "</select>";
?>
	</td>
	</tr>
	<tr>
	<td>
	<font color="#a65353"><b>Accession No</b></font>
	</td>
	
	<td>
<?php
	if($library!=null)
	{
		$var = "select mag_acc_no from lib_bound_acc_det where library='$library' order by mag_acc_no desc limit 1";
		//echo $var;
		$varrr=execute($var) or die(mysql_error());
		$vae=fetcharray($varrr);
		if($vae[acc_no]=='')
		{
			$acno='000001';
		}
		else
		{
			$acno=$vae[acc_no] + 1;
			if(strlen($acno)==1)
			{
			  $acno='00000'.$acno;
			}
			if(strlen($acno)==2)
			{
			  $acno='0000'.$acno;
			}
			if(strlen($acno)==3)
			{
			  $acno='000'.$acno;
			}
			if(strlen($acno)==4)
			{
			  $acno='00'.$acno;
			}
			if(strlen($acno)==5)
			{
			  $acno='0'.$acno;
			}
		}
		if($copies!=null)
		{
			$a = $copies - 1;
			$b = $acno + $a;
			if(strlen($b)==1)
			{
			  $b='00000'.$b;
			}
			if(strlen($b)==2)
			{
			  $b='0000'.$b;
			}
			if(strlen($b)==3)
			{
			  $b='000'.$b;
			}
			if(strlen($b)==4)
			{
			  $b='00'.$b;
			}
			if(strlen($b)==5)
			{
			  $b='0'.$b;
			}
		
		}
	}
?>
<table border="0" width="100%" >
  <tr>
    <td ><b>From</b> </td>
    <td ><b>No of<br>Copies</b> </td>
    <td ><b>To</b></td>
  </tr>
  
  <tr>
    <td ><input type="text" name="acc_from" value="<?php echo $acno?>" size="6" onKeydown="return checkIt(event)"></td>
    <td ><input type="text" name="copies" value="<?php echo $copies?>" size="6" onchange='book.submit()'></td>
	<td ><input type="text" name="acc_to" value="<?php echo $b ?>" size="6" ></td>
  </tr>
</table>
</td>
	
	<!-- <td>
	<font color="#a65353"><b></b></font>
	<?php
	$sel="";
	if($mode=='on')
	{
		$sel="checked";
	}
	?>
	<input type="checkbox" name="mode" <?=$sel?>>
	</td> -->
	<td colspan=1>
	<font color="#a65353"><b>Bound Type</b></font></td>
	<?php
		$sel1="";
		$sel2="";
		$sel3="";
		$sel4="";
		if($cd_type=="I")
			{
				$sel1="selected";
			}
		elseif($cd_type=="R")
			{
				$sel2="selected";
			}
		elseif($cd_type=="T")
			{
				$sel3="selected";
			}
		elseif($cd_type=="S")
			{
				$sel4="selected";
			}

	?>
		<td>
			<select name=bound_type>
				<option value='I' <?=$sel1?> >Issue</option>
				<option value='R' <?=$sel2?>>Reference</option>
				<option value='T' <?=$sel3?>>Temp</option>
				<option value='S' <?=$sel4?>>Weed out</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><font color="#a65353"><b>Title</b></font></td>
		<td colspan=0><input type="text" name="title" value="<?=$title?>" size="33" onKeydown="first_caps(this.form.title)"></td>
		<td><font color="#a65353"><b>Classification No</b></font></td>
		<td><input type="text" name="class_no" value=''></td>
	</tr>
	<tr>
		<td><font color="#a65353"><b>Month</b></font></td>
		<td><input type="text" name="month" value="<?=$month?>" size=3 maxlength='2' onKeydown="return checkIt(event)"></td>
		<td><font color="#a65353"><b>Year</b></font></td>
		<td><input type="text" name="year" value="<?=$year?>" size=5 maxlength='4' onKeydown="return checkIt(event)"></td>
	</tr>
	<tr>
	<td>
	<font color="#a65353"><b>Periodicity</b></font></td>
	<td>
	<?php
	$sel1="";
	$sel2="";
	$sel3="";
	$sel4="";
	$sel5="";
	$sel6="";
	if($periodicity=="D")
	{
		$sel1="selected";
	}
	elseif($periodicity=="W")
	{
		$sel2="selected";
	}
	elseif($periodicity=="M")
	{
		$sel3="selected";
	}
	elseif($periodicity=="F")
	{
		$sel4="selected";
	}
	elseif($periodicity=="Q")
	{
		$sel5="selected";
	}
	elseif($periodicity=="Y")
	{
		$sel6="selected";
	}
	?>
	<select name=periodicity>
	<option value='D' <?=$sel1?> >Daily</option>
	<option value='W' <?=$sel2?>>Weekly</option>
	<option value='M' <?=$sel3?>>Monthly</option>
	<option value='F' <?=$sel4?>>Fortnightly</option>
	<option value='Q' <?=$sel5?>>Quatarly</option>
	<option value='Y' <?=$sel6?>>Yearly</option>
	</select>
	</td>
	<td>
				<font color="#a65353"><b>Date of Acquiring</b></font>
			</td>
			<td>
			<?php

			if(@$acq_dd=="")
			{
				$acq_dd="$c_date[mday]";
			}
			if(@$acq_mm=="")
			{
				$acq_mm="$c_date[mon]";
			}
			if(@$acq_yy=="")
			{
				$acq_yy="$c_date[year]";
			}

				?>
				<input type="text" name="acq_dd" value="<?=$acq_dd?>" size=2 maxlength="2" onKeydown="return checkIt(event)">-
				<input type="text" name="acq_mm" value="<?=$acq_mm?>" size=3 maxlength="2" onKeydown="return checkIt(event)">-
				<input type="text" name="acq_yy" value="<?=$acq_yy?>" size=4 maxlength="4" onKeydown="return checkIt(event)">

			</td>
			</tr>


	<tr height=25>
	<td class="rowpic" colspan=4 align="center"><b>Key Words</b></td>
	</tr>
	<tr>
	<td>
	<b>Key Word1</b>
	</td>
	<td>
	<input type="text" name="key_word1" value="<?=$key_word1?>">
	</td>
	<td>
	<b>Key Word2</b>
	</td>
	<td>
	<input type="text" name="key_word2" value="<?=$key_word2?>">
	</td>
	</tr>
	<tr>
	<td>
	<b>Key Word3</b>
	</td>
	<td>
	<input type="text" name="key_word3" value="<?=$key_word3?>">
	</td>
	<td>
	<b>Key Word4</b>
	</td>
	<td>
	<input type="text" name="key_word4" value="<?=$key_word4?>">
	</td>
	</tr>
	<tr>
	<td>
	<b>Key Word5</b>
	</td>
	<td>
	<input type="text" name="key_word5" value="<?=$key_word5?>">
	</td><td colspan=2></td>
	</tr>
	<tr>
	<td >
	<b>Remarks</b>
	</td>
	<td colspan=3 align='left' >
	<textarea name='remarks' rows=3 cols=40><?=$remarks?></textarea>
	</td>
	</tr>
		</tr>

	<tr height=25>
	<td colspan=4 class='rowpic' align='center'><b>Select Magazine</b></div>
	</td>
	</tr>
	<tr>
	<td colspan=4 align='center'>
	<b>Select Title </b>&nbsp;
	<select name='mag_title' onChange='javascript:document.book.submit()'>
	<option value='0'>Select Title</option>
	<?
	$rs_sql=execute("select distinct(title) from lib_magazine where register='$register' and status=1 and bound='N'") or die(mysql_error());
	if(rowcount($rs_sql)==0)
	{
		die("<font color='red' size=4>There is no magazine/journal to bound in this register.</font>");
	}
	for($i=0;$i<rowcount($rs_sql);$i++)
	{
		$r_sql=fetcharray($rs_sql,$i);
		$sel="";
		if($mag_title==$r_sql[title])
			$sel="selected";

		echo "<option value='$r_sql[title]' $sel>$r_sql[title]</option>";

	}

	?>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan=4 align='center'>
	<table border=1 cellspacing=0>
	<tr>
	<td class='chead'>
		Select
	</td>
	<td class='chead'>
		Acc No
	</td>
	<td class='chead'>
		Date
	</td>

	<td class='chead'>
		Volume
	</td>
	<td class='chead'>
		Issue No
	</td>
	</tr>

	<?
	if($mag_title =='0')
	{
		die();

	}
	else
	{
		mysql_free_result($rs_sql);
	//echo "select id,magazine_no,volume,magazine_date,issue from lib_magazine where title='$mag_title' and status=1 and bound='N' and register=$register";
		$rs_sql=execute("select id,magazine_no,volume,magazine_date,issue from lib_magazine where title='$mag_title' and status=1 and bound='N' and register=$register") or die (mysql_error());

		for($i=0;$i<rowcount($rs_sql);$i++)
		{
			$r_sql=fetcharray($rs_sql,$i);
			echo "<tr>";
			echo "<td>";
				echo "<input type='checkbox' name=mag_id[] value='$r_sql[id]'>";
				echo "<input type='hidden' name='mag_acc_no$r_sql[id]' value='$r_sql[magazine_no]'>";
			echo "</td>";
			echo "<td>";
			echo "$r_sql[magazine_no]";
			echo "<input type='hidden' name='mag_acc_no$r_sql[id]' value='$r_sql[magazine_no]'>";
			echo "</td>";
			echo "<td>";
				echo date('d-m-Y',strtotime($r_sql[magazine_date]));
			echo "</td>";

			echo "<td>";
				echo "$r_sql[volume]";
				echo "<input type='hidden' name='volume$r_sql[id]' value='$r_sql[volume]'>";
			echo "</td>";
			echo "<td>";
				echo "$r_sql[issue]";
				echo "<input type='hidden' name='issue$r_sql[id]' value='$r_sql[issue]'>";
			echo "</td>";
			echo "</tr>";

		}
	}

	?>
	</table>
	<br>
	</td>
	</tr>
	 <tr>
	<td colspan=4 align="center">
	<input type="button" value=" Bound Volume " name="add" style="background-color: #800000; color: #FFFFFF;font-weight: bold" onClick="frm_add()">
	</td>
	</tr> 
	
<?
	}
?>

</table>
</form>
</BODY>
</HTML>

