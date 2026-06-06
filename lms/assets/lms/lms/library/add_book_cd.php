<?php
$flag = false;
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<pre>";*/

$copies=$_POST['copies'];
$acc_to=$_POST['acc_to'];
$media=$_REQUEST['media'];
$library=$_POST['library'];
$cd_type=$_POST['cd_type'];
$register=$_POST['register'];
$acc_from=$_POST['acc_from'];

?>
<HTML>
<HEAD>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function frm_add()
{
	var acc_from,acc_to;
	acc_from = document.book.acc_from.value;
	acc_to = document.book.acc_to.value;
	/*if(document.book.library.selectedIndex=="")
	{
		alert("please select Library");
		document.book.library.focus();
		return false;
	}*/
    if(document.book.register.selectedIndex=="")
	{
		alert("Please select Register ");
		document.book.register.focus();
		return false;
	}
	if (document.book.acc_from.value=="" || document.book.acc_to.value=="" )
	{
		alert("Enter Accession No From and To ");
		document.book.acc_from.focus();
		return false;
	}
    if (acc_from > acc_to)
	{
		alert("Accession No From can't be greater than accession no To  ");
		document.book.acc_from.focus();
		return false;
	}
    if (document.book.title.value=="")
	{
		alert("Enter media title");
		document.book.title.focus();
		return false;
	}
   
		document.book.action = "ins_book_cd.php";
		document.book.submit();
}
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) {
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
</script>
</HEAD>
<BODY onLoad=sam()>

<form method="POST" name="book" >
<input type="hidden" name="media" value="<?=$media?>">
<table border="0" width="90%" align='center' cellspacing="1" cellpadding="1"  class='forumline' >
	<tr height='30'>
		<td  colspan='4' align="center" class='head'>Add Book CD Details</td>
	</tr>
    
	<tr>
		<td class="topictitle" width="120" align="left" height="22" >&nbsp;&nbsp;&nbsp;Library*</td>
		<td><select size="1" name="library" onChange="javascript:document.book.submit()">
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
		</select></td>
		<td> Register*</td>
		<td><select name='register' onChange="javascript:document.book.submit()">
		<option value=''>Select Register</option>
		<?php
		if($library<>'')
			{
				$qry="select * from lib_register where library=$library";
				$librs=execute($qry);
				while($librow=fetcharray($librs))
					{
						$sel="";
						if($librow[id]==$register)
							{
								$sel="selected";
							}
						echo "<option value='$librow[id]' $sel >$librow[register]</option>";
					}
			}
		?>
		</select></td>
	</tr>
   
	<tr>
		<td width="12%">&nbsp;&nbsp;&nbsp;Accession No</td>
		<td width="51%">
		<?php
	if($library!='' and $register!='')
	{
		$var = "select acc_no from lib_cd_acc_det where library='$library' and `register`='$register' order by acc_no desc limit 1";
		
		$varrr=execute($var) ;
		$vae=fetcharray($varrr);
		
		if($vae[acc_no]=='')
		{
			$acno='1';
		}
		else
		{
			$acno=$vae[acc_no] + 1;// to get the next accession number
		}
		if($copies!='')
		{
			$a = $copies;
			$b = $acno + $a;

		}
	}
	if($library==1 and $register==1)  //PYP LIBRARY BOOK
	{
		$acno="P".$acno;
		if($b!=''){
			$b="P".$b;
		}
	}
	if($library==1 and $register==3)  //PYP TEXT BOOK
	{
		$acno="PT".$acno;
		if($b!=''){
			$b="PT".$b;
		}
	}
	if($library==2 and $register==2) //MYP LIBRARY BOOK
	{
		$acno="M".$acno;
		if($b!=''){
			$b="M".$b;
		}
	}
	if($library==2 and $register==4) //MYP TEXT BOOK
	{
		$acno="MT".$acno;
		if($b!=''){
			$b="MT".$b;
		}
	}
		/*if($library!=null)
			{
				$var = "select acc_no from lib_cd_acc_det where library='$library' order by acc_no desc limit 1";
				$varrr=execute($var);
				$vae=fetcharray($varrr);
				if($vae[acc_no]=='')
					{
						$acno='000001';
					}
				else
					{
						$acno=$vae[acc_no] + 1;// to get the next accession number
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
			}*/
		?>
		<table border="0" width="80%" >
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;From</td>
				<td nowrap="nowrap">No of Copies</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To</td>
			</tr>  
			<tr>
				<td><input type="text" name="acc_from" value="<?php echo $acno ?>" size="7" ></td>
				<td><input type="text" name="copies" value="<?php echo $copies?>" size="6" onchange='book.submit()'></td>
				<td ><input type="text" name="acc_to" value="<?php echo $b ?>" size="7" ></td>
			</tr>
		</table>
	  </td>
		<td width="14%">CD Type</td>
		<td width="23%">
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
		<select name='cd_type'>
		<option value='I' <?=$sel1?> >Issue</option>
		<option value='R' <?=$sel2?>>Reference</option>
		<option value='T' <?=$sel3?>>Temp</option>
		<option value='S' <?=$sel4?>>Weed out</option>
	  </select></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Title</td>
		<td><input type="text" name="title" value="<?=$title?>" size="42" onKeydown="first_caps(this.form.title)"></td>
		<td>Price</td>
		<td><input type="text" name="price" value="<?=$price?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Author</td>
		<td><input type="text" name="author" value="<?=$author?>"></td>
		<td>Rack</td>
		<td><input type="text" name="rack" value="<?=$rack?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Source</td>
		<td><input type="text" name="source" value="<?=$source?>" size="10"></td>
		<td>Source Acc No</td>
		<td><input type="text" name="source_acc_no" value="<?=$source_acc_no?>"></td>
	</tr>		
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Publication Date </td>
		<td>
		<?php
		$c_date=getdate();
		$MyDay=$c_date["mday"];
		echo "<select name='pub_dd'>";
		if ($pub_dd=='') 
			{
				$pub_dd=$MyDay;
			}
		for($i=1;$i<=31;$i++)
			{
				if($i == $pub_dd)
					{
						echo "<option value='$i' selected>$i</option>\n";
					}
				else
						echo "<option value='$i'>$i</option>\n";
			}
		echo "</select>";
		$MyMonth=$c_date["mon"];
		echo "<select name='pub_mm'>";
		if ($pub_mm=='')
			{
				$pub_mm=$MyMonth;
			}
		for($i=1;$i<=12;$i++)
			{
				if($i == $pub_mm)
					{
						echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
					}
				else
						echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
		echo "</select>";		
		$maxYr =$c_date["year"]+1;
		$MyYear=$c_date["year"];
		echo "<select name='pub_yy'>";
		if ($pub_yy=='') 
			{
				$pub_yy=$MyYear;
			}
		for($i=1970;$i<=$maxYr;$i++)
			{
				if($i == $pub_yy)	
					{
						echo "<option value='$i' selected>$i</option>\n";
					}
				else
						echo "<option value='$i' >$i</option>\n";
			}
		echo "</select>";
		?>
		</td>
		<td>
			Date of Acquiring
		</td>

		<td>
		<?php
		$c_date=getdate();
		$MyDay=$c_date["mday"];
		echo "<select name='acq_dd'>";
		if ($acq_dd=='') 
			{
				$acq_dd=$MyDay;
			}
		for($i=1;$i<=31;$i++)
			{
				if($i == $acq_dd)
					{
						echo "<option value='$i' selected>$i</option>\n";
					}
				else
						echo "<option value='$i'>$i</option>\n";
			}
		echo "</select>";
		$MyMonth=$c_date["mon"];
		echo "<select name='acq_mm'>";
		if ($acq_mm=='')
			{
				$acq_mm=$MyMonth;
			}
		for($i=1;$i<=12;$i++)
			{
				if($i == $acq_mm)
					{
						echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
					}
				else
						echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
		echo "</select>";		
		$maxYr =$c_date["year"]+1;
		$MyYear=$c_date["year"];
		echo "<select name='acq_yy'>";
		if ($acq_yy=='') 
			{
				$acq_yy=$MyYear;
			}
		for($i=1970;$i<=$maxYr;$i++)
			{
				if($i == $acq_yy)	
					{
						echo "<option value='$i' selected>$i</option>\n";
					}
				else
						echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
		?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Call No</td>
        <td>
		<table border="0" width="0" >
			<tr>
				<td><input type="text" name="call_no" value="<?=$call_no?>" size="19"></td>
			</tr>
		</table>
		</td>
		<td>Classification No</td>
		<td><input type='text' name='class_no' value=''></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Volume No</td>
		<td><input type="text" name="volume" value="<?=$volume?>"></td>
		<td>Issue No</td>
		<td><input type="text" name="issue" value="<?=$issue?>"></td>
	</tr>
	<tr height='25'>
		<td class="rowpic" colspan=5 align="center">Key Words</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Key Word1</td>
		<td><input type="text" name="key_word1" value="<?=$key_word1?>"></td>
		<td>Key Word2</td>
		<td><input type="text" name="key_word2" value="<?=$key_word2?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Key Word3</td>
		<td><input type="text" name="key_word3" value="<?=$key_word3?>"></td>
		<td>Key Word4</td>
		<td><input type="text" name="key_word4" value="<?=$key_word4?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Key Word5</td>
		<td><input type="text" name="key_word5" value="<?=$key_word5?>"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Remarks</td>
		<td colspan=3 align='left'><textarea name='remarks' rows=3 cols=40></textarea></td>
	</tr>
	<br>
	<tr>
		
	</tr>
</table>
<br>
<p align="center"><input type="button" value=" Add Media " name="add"   onClick="return frm_add()" class="bgbutton"></p>
<?php
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