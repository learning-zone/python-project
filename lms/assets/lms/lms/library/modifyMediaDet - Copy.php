<?php
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
 session_start();
 require_once("../db.php"); 
 if($_POST)
 {		
    $media=$_POST['media'];  
	$Type=$_POST['Type'];
    $id=$_POST['id'];
    $library=$_POST['library'];
    $accNo=$_POST['accNo'];	 
	$media_type=$_POST['media_type'];
    $register=$_POST['register'];
    $title=$_POST['title'];
    $class_no=$_POST['class_no'];
    $book_no=$_POST['book_no'];
    $author=$_POST['author'];
	$author_details=$_POST['author_details'];
    $publisher=$_POST['publisher'];
    $edition=$_POST['edition'];
    $year=$_POST['year'];
    $rack=$_POST['rack'];
	$purchase_type=$_POST['purchase_type'];
	$supplier=$_POST['supplier'];
    $no_of_pages=$_POST['no_of_pages'];
	$pyment_type=$_POST['pyment_type'];
	$payment_details=$_POST['payment_details'];
    $bill_no=$_POST['bill_no'];
    $bill_dd=$_POST['bill_dd'];
    $bill_mm=$_POST['bill_mm'];
    $bill_yy=$_POST['bill_yy'];
    $acq_dd=$_POST['acq_dd'];
    $acq_mm=$_POST['acq_mm']; 
	$acq_yy=$_POST['acq_yy'];
	$price_type=$_POST['price_type'];
    $price=$_POST['price'];
    $isbn=$_POST['isbn'];
    $subject=$_POST['subject'];
    $key_word1=$_POST['key_word1'];
    $key_word2=$_POST['key_word2'];
	$key_word3=$_POST['key_word3'];
	$key_word4=$_POST['key_word4'];
	$key_word5=$_POST['key_word5'];
    $sel=$_POST['sel'];
    $sel1=$_POST['sel1'];
    $sel2=$_POST['sel2'];
    $mode=$_POST['mode'];
    $book_type=$_POST['book_type'];
    $acc_no=$_POST['acc_no'];
    $remarks=$_POST['remarks'];
    $SeekPos=$_POST['SeekPos'];
    $PAGES=$_POST['PAGES'];
    $modDet=$_POST['modDet'];
    $LAST=$_POST['LAST'];
    $media_type=$_POST['media_type'];
}
if($_REQUEST)
{
	$action=$_REQUEST['action'];
    $Type=$_REQUEST['Type'];
    $accNo=$_REQUEST['accNo'];	
    $media_type=$_REQUEST['media_type'];
    $library=$_REQUEST['library'];
	
}
$library=1;
$_NUMREC_ = 15;

if(empty($SeekPos))
{
        $SeekPos = 0;
}

if($accNo=='' || $media_type=='')
{
	echo "Please Select Media type or Enter The Accession Number";

	//die();
}

if($accNo!='' && $media_type!='')
{
	if($media_type==2)
	{
		header("Location:modify_book_cd_det.php?acc_no=$accNo&media=$media_type");
	}
	elseif($media_type==3)
	{
		header("Location:modify_book_floppy.php?acc_no=$accNo&media=$media_type");
	}
	elseif($media_type==4)
	{
		header("Location:modify_other_cd_det.php?acc_no=$accNo&media=$media_type");
	}
	elseif($media_type==5)
	{
		header("Location:modify_proj_det.php?acc_no=$accNo&media=$media_type");
	}
	else
	{     

		$sql="select a.* from lib_book_details a,lib_acc_details b where a.id=b.master_id and b.acc_no='$accNo' and b.book_status=1 and b.library='$library' and b.media_type='$media_type' limit 0,1";

		//echo $sql;
        $rs = execute($sql) or die(mysql_error());
        $row= rowcount($rs);
	}
}
  
if($row==0)
{ 
	echo "No data found";
	die();
}
else
{
?>

<html><head>
	<Script language="JavaScript">

	var KEY_LEFT=268762961;

	var KEY_RIGHT=268762963;

	function fun_go_to()
    {
    	if((document.modDet.go_to.value==0)||(document.modDet.go_to.value=="")||(parseInt(document.modDet.go_to.value) > parseInt(document.modDet.PAGES.value) ))
    	{
     		alert("Page not found");
     	}
    	else
		{

			document.modDet.SeekPos.value = (parseInt(document.modDet.go_to.value)-1)* 15;
            document.modDet.submit();

		}

	}

	function frm_modify()
    {
    	if(document.modDet.title.value=="")
     	{
     		alert("Please Enter the Title");
      		document.modDet.title.focus();
        	return false;
		}
        else
        {
        	document.modDet.action = "modifyMedia.php?Type=modify";
        	document.modDet.submit();
        }
	}

	function checkIt(e)
    {

		var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
     	status = charCode // see ASCII character value!

		if((charCode>=48 && charCode<=57)||(charCode>=96 && charCode<=105)||(charCode==8)||(charCode==9)||(charCode==45)||(charCode==46)||(charCode>=35 && charCode<=40))
    	{
        	  return true;

		}
        else
		{

			alert("Please make sure entries are numbers only.");

			return false

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

	function checkChar(e)

	{

		var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode

		status = charCode // see ASCII character value

		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 65 && charCode <= 91) || (charCode>=97 && charCode<=123) || (charCode == 32) || (charCode == 190)||(charCode ==9)||(charCode ==8))

		{

			return true

		}

		else

		{

			alert("Please make sure entries are Alphanumeric only.")

			return false

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

			document.book.title.value=str.toUpperCase();

		}

	}

	</script>

	</head>

	<BODY>

	<form method="POST" name="modDet" action="modifyMedia.php?Type=modify">

	<input type="hidden" name="library" value="<?php echo $library?>">

	<input type="hidden" name="LAST" value="<?php echo $LAST?>">

	<table class=forumline width=60% align=center>

	<input type="hidden" name="accNo" value="<?php echo $accNo?>">

		<tr>

			<td align="center" Class="head" colspan='4'>Modify Media Details </td>

		</tr>

		<tr height='20'>

			<td class="rowpic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attribute</td>

			<td class="rowpic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Value</td>

		</tr>

        

		<tr>

		<?php

		while($r=fetcharray($rs))

		{

			?>

		

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Register</td>

			<td>

			<?php

			$qry1="select register from lib_acc_details where acc_no='$accNo' and library='$library' and media_type='$media_type'";

			$librs=execute($qry1);

			$q1=fetcharray($librs);

			$ragreg=$q1[0];	

			$qry11=execute("select * from lib_register");

			echo "<select name=register>";

			while($librow=fetcharray($qry11))

			{

				$sel="";

				if($librow[id]==$q1[register])

				{

					echo "<option value='$librow[id]' selected >$librow[register]</option>";

				}

				else

				{

					echo "<option value='$librow[id]'>$librow[register]</option>";

				}

			}

			echo "</select>";

			?>

			</td>


		</tr>

        

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title</td>

			<td><input type="text" name="title" value="<?php echo $r[title]?>" size='60' onKeydown="first_caps(this.form.title)"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class No</td>

			<td><input type="text" name="class_no" value="<?php echo $r[class_no]?>" onBlur="all_caps(this.form.class_no)"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Media type</td>

			<td><select name="book_no">

			<?php

			if($r[book_no]=='')

				{

					$rt1="selected";

					$rt2="";

					$rt3="";

				}

			elseif($r[book_no]=='National Edition')

				{

					$rt1="";

					$rt2="selected";

					$rt3="";

				}	

			elseif($r[book_no]=='International Edition')

				{

					$rt1="";

					$rt2="";

					$rt3="selected";	

				} 

			?>

			<option value="Select" <?php echo $rt1?>>Select</option>

			<option value="National Edition" <?php echo $rt2?>>National Edition</option>

			<option value="International Edition" <?php echo $rt3?>>International Edition</option></select></td>

		</tr>

	

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Author</td>

			<td><input type="text" name="author" value="<?php echo $r[author]?>" size='60'></td>

		</tr>

		

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Publisher</td>

			<td><input type="text" name="publisher" value="<?php echo $r[publisher]?>" size='60'></td>

		</tr>



		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edition</td>

			<td><input type="text" name="edition" value="<?php echo $r[edition]?>"></td>

		</tr>



		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year</td>

			<td><input type="text" name="year" value="<?php echo $r[year]?>" onKeyDown="return checkIt(event)"></td>

		</tr>



		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rack</td>

			<td><input type="text" name="rack" value="<?php echo $r[rack]?>"></td>

		</tr>

		

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier</td>

			<td><input type="text" name="supplier" value="<?php echo $r[supplier]?>"></td>

		</tr>

		

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No of pages</td>

			<td><input type="text" name="no_of_pages" value="<?php echo $r[no_of_pages]?>" onKeyDown="return checkIt(event)"></td>

		</tr>

		

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bill No</td>

			<td><input type="text" name="bill_no" value="<?php echo $r[bill_no]?>"></td>

		</tr>



		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bill Date</td>

			<td>

			<?php

			$c_date=getdate();

			$b_dt=explode("-",$r[bill_date]);

			$MyDay=$c_date["mday"];

		

			echo "<select name='bill_dd'>";

			for($i=1;$i<=31;$i++)

		{

			if($b_dt[2]!="" || $b_dt[2]!='00')

			{

				$bill_dd=$b_dt[2];			

			}

			else

			{

				$bill_dd="$c_date[mday]";

			}

			if($i<='9')

			{

				$i='0'.$i;

			}

			if($i==$bill_dd)

				echo "<option value='$i' selected>$i</option>\n";

			else

				echo "<option value='$i'>$i</option>\n";

		}

		echo "</select>";

		$MyMonth=$c_date["mon"];

		//Month

		echo "<select name='bill_mm'>";

		for($i=1;$i<=12;$i++)

		{

			if($b_dt[1]!="" || $b_dt[1]!='00')

			{

				$bill_mm=$b_dt[1];

			}

			else

			{

				$bill_mm="$c_date[mon]";

			}

			if($i<='9')

			{

				$i='0'.$i;

			}

			if($i==$bill_mm)

				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

			else

				echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		}

		echo "</select>";

		//Year

		$maxYr =$c_date["year"]+1;

		$MyYear=$c_date["year"];

		$st=$c_date["year"]-4;

		echo "<select name='bill_yy'>";

		for($i=$st;$i<=$maxYr;$i++)

		{

			if(@$b_dt[0]!="" || $b_dt[0]!='0000')

			{

				$bill_yy=$b_dt[0];

			}

			else

			{

				$bill_yy="$c_date[year]";

			}

			if($i==$bill_yy)

				echo "<option value='$i' selected>$i</option>\n";

			else

				echo "<option value='$i' >$i</option>\n";

		}

		echo "</select>";

		?>

		</td></tr>



		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Acquiring</td>

		<td>

		<?php

		$a_dt=explode("-",$r['date_of_acquiring']);

		$MyDay=$c_date["mday"];

		//Day

		echo "<select name='acq_dd'>";

		for($i=1;$i<=31;$i++)

		{

			if($a_dt[2]!="" || $a_dt[2]!='00')

			{

				$acq_dd=$a_dt[2];			

			}

			else

			{

				$acq_dd="$c_date[mday]";

			}

			if($i<='9')

			{

				$i='0'.$i;

			}

			if($i==$acq_dd)

				echo "<option value='$i' selected>$i</option>\n";

			else

				echo "<option value='$i'>$i</option>\n";

		}

		echo "</select>";

		$MyMonth=$c_date["mon"];

		//Month

		echo "<select name='acq_mm'>";

		for($i=1;$i<=12;$i++)

		{

			if($a_dt[1]!="" || $a_dt[1]!='00')

			{

				$acq_mm=$a_dt[1];

			}

			else

			{

				$acq_mm="$c_date[mon]";

			}

			if($i<='9')

			{

				$i='0'.$i;

			}

			if($i==$acq_mm)

				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

			else

				echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		}

		echo "</select>";

		//Year

		$maxYr =$c_date["year"]+1;

		$MyYear=$c_date["year"];

		$st=$c_date["year"]-4;

		echo "<select name='acq_yy'>";

		for($i=$st;$i<=$maxYr;$i++)

		{

			if(@$a_dt[0]!="" || $a_dt[0]!='0000')

			{

				$acq_yy=$a_dt[0];

			}

			else

			{

				$acq_yy="$c_date[year]";

			}

			if($i==$acq_yy)

				echo "<option value='$i' selected>$i</option>\n";

			else

				echo "<option value='$i' >$i</option>\n";

		}

		echo "</select>";

		?>

		</td></tr>



		<!-- <tr><td>Price Type</td>

		<td>

		<input type="text" name="price_type" value="<?php echo $r[price_type]?>"></td></tr> -->

		

		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</td>

		<td>

		<input type="text" name="price" value="<?php echo $r[price]?>" onKeyDown="return checkIt(event)"></td></tr>

		

		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISBN</td>

		<td><input type="text" name="isbn" value="<?php echo $r[isbn]?>"></td></tr>



		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject</td>

		<?php

		echo "<td>";

		$qry="select distinct(subject) as subject from lib_book_details where subject!='' order by subject asc";



		$rs=execute($qry);

		echo "<select name=subject >";

		echo "<option value='0'>--- Select Subject ---</option>";

	

		while($row=fetcharray($rs))

		{	

		//	if($flag==0)

			{

			if(trim($row[subject]) == trim($r[subject]))

				$sel = selected;

			else

				$sel = "";

			}

			echo "<option value='$row[subject]' $sel>$row[subject]</option>";

		}

		echo "</select>";

		echo "</td>";

		?>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Word1</td>

			<td>

			<input type="text" name="key_word1" value="<?php echo $r[key_word1]?>" size="60"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Word2</td>

			<td>

				<input type="text" name="key_word2" value="<?php echo $r[key_word2]?>" size="60"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Word3</td>

			<td>

				<input type="text" name="key_word3" value="<?php echo $r[key_word3]?>" size="60"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Word4</td>

			<td>

				<input type="text" name="key_word4" value="<?php echo $r[key_word4]?>" size="60"></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Word5</td>

			<td>

				<input type="text" name="key_word5" value="<?php echo $r[key_word5]?>" size="60"></td>

		</tr>



		</table>

		<input type="hidden" name="id" value="<?php echo $r[id]?>">

		<?php

		$remarks=$r[remarks];

		$sql1="select distinct(a.acc_no) from lib_acc_details a where a.master_id='$r[id]' and register='$ragreg' and book_status=1 ";

		$rs1=execute($sql1) or die(mysql_error());



		$n=$m;

		$m=$m+5;

		?>

		<table align="center" class=forumline width=60%>

		<tr>

			<td class="rowpic">&nbsp;&nbsp;Acc No</td>

			<td class="rowpic">Call No</td>

			<td class="rowpic">Mode</td>

			<td class="rowpic">Book Type</td>

		</tr>

		<?php

		$countRS = rowcount($rs1);

	

		mysql_data_seek($rs1,$SeekPos); //Move the data pointer to the next position.

		if( ($SeekPos + $_NUMREC_) > $countRS)

		{

			$MAX = $countRS;

		}

		else

		{

			$MAX = $SeekPos + $_NUMREC_ ;

		}

		if( ($SeekPos + $_NUMREC_) >= $countRS)

		{

			$NEXT = $SeekPos;

		}

		else

		{

			$NEXT  = $SeekPos + $_NUMREC_ ;

		}

		if( ($SeekPos - $_NUMREC_)  > 0)

		{

			$PREV = $SeekPos - $_NUMREC_;

		}

		else

		{

			$PREV = 0;

		}

		$PAGES = $countRS / $_NUMREC_;

		if($countRS % $_NUMREC_)

		{

			$PAGES++;

		}

		$LAST = ((int) $PAGES - 1) * $_NUMREC_;

		$slno=$SeekPos+1;

		for($i=$SeekPos;$i<$MAX;$i++)

		{

			$r2 = fetcharray($rs1);

			$sql2="select * from lib_acc_details  where acc_no=$r2[acc_no] and library='$library' and media_type='$media_type' order by acc_no";

			//echo $sql2;

			$rs2=execute($sql2) or die(mysql_error());

			$r3=fetcharray($rs2);

			$ac_nuM = strlen($r3[acc_no]);

			if($ac_nuM==1)

			{

				$Accession_Number='00000'.$r3[acc_no];

			}

			else if($ac_nuM==2) 

			{

				$Accession_Number='0000'.$r3[acc_no];

			}

			else if($ac_nuM==3) 

			{

				$Accession_Number='000'.$r3[acc_no];

			}

			else if($ac_nuM==4) 

			{

				$Accession_Number='00'.$r3[acc_no];

			}

			else if($ac_nuM==5) 

			{

				$Accession_Number='0'.$r3[acc_no];

			}

			else if($ac_nuM==6) 

			{

				$Accession_Number=$r3[acc_no];

			}

			?>

			<tr><input type="hidden" name="sel[]" value="<?php echo $r3[id]?>">

			<!--<td><input type="text" name="sel1[]" value="<?php echo $Accession_Number?>"></td>-->
            
            <td>&nbsp;&nbsp;<?php echo $Accession_Number?></td>

			<td><input type="text" name="sel2[]" value="<?php echo $r3[call_no]?>"></td>

			<td><select name=mode<?php echo $r3[id]?>>

			<?php

			if($r3[mode]=="A")

			{

				echo "<option value='A' selected >Active</option>";

				echo "<option value='D' >Damaged</option>";

				echo "<option value='M' >Misssing</option>";

				echo "<option value='W' >WriteOff</option>";



			}

			if($r3[mode]=="D")

			{

					echo "<option value='A'  >Active</option>";

					echo "<option value='D' selected>Damaged</option>";

					echo "<option value='M' >Misssing</option>";

					echo "<option value='W' >WriteOff</option>";

			}

			if($r3[mode]=="M")

			{

				echo "<option value='A'  >Active</option>";

				echo "<option value='D' >Damaged</option>";

				echo "<option value='M' selected>Misssing</option>";

				echo "<option value='W' >WriteOff</option>";

			}

			if($r3[mode]=="W")

			{

				echo "<option value='A'>Active</option>";

				echo "<option value='D' >Damaged</option>";

				echo "<option value='M' >Misssing</option>";

				echo "<option value='W' selected>WriteOff</option>";

			}

			?>

			</td>

			<td>

			<?php

			$sel1="";

			$sel2="";

			

			if($r3[book_type]==I)

			{

				$sel1="selected";

			}

			elseif($r3[book_type]==R)

			{

				$sel2="selected";

			}

			

			?>

			<select name=book_type<?php echo $r3[id]?>>

			<option value='I' <?php echo $sel1?> >Issue</option>

			<option value='R' <?php echo $sel2?>>Reference</option>

			</select></td></tr>

			<?php

		}

	}

	?>

	<input type="hidden" name="acc_no" value="<?php echo $accNo?>">

	<tr><td>Remarks</td>

	<td colspan=3>

	<textarea name='remarks' rows=3 cols=25><?php echo $remarks?></textarea></td></tr>



	<tr></tr>
	</table>

    <br>

    <div align="center">

	<input type="button" name="modify" value="Modify" onClick="frm_modify()" class='bgbutton'></div>

	<script language="JavaScript">

	function first()
	{

		var i;

		i = 0;

		document.modDet.SeekPos.value = i;

		document.modDet.submit();

	}

	function prev()
	{

		var i;

		i = "<?php echo $PREV?>";

		document.modDet.SeekPos.value = i;

		document.modDet.submit();
	}

	function next()
	{

		var i;

		i = "<?php echo $NEXT?>";

		document.modDet.SeekPos.value = i;

		document.modDet.submit();

	}

	function last()
	{

		var i;

		i = "<?php echo $LAST?>";

		document.modDet.SeekPos.value = i;

		document.modDet.submit();

	}

	</script>

	<input type="hidden" name="SeekPos" value="<?php echo $SeekPos?>">
	<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">

           <!--
			<table align="center">

				<tr>

					<td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>

					<td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>

					<td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next"></a></td>

					<td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last"></a></td>

				</tr>

			</table>
			-->
	<?php
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