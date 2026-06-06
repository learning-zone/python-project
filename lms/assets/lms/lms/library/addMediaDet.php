<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<pre>";*/

if($_GET)
{
	$ISBN_ID=$_GET['ISBN_ID'];
}
if($_POST)
{
	
	$acq_dd = $_POST['acq_dd'];
	$acq_mm = $_POST['acq_mm'];
	$acq_yy = $_POST['acq_yy'];
	
	$bill_mm = $_POST['bill_mm'];
	$bill_yy = $_POST['bill_yy'];
	$bill_dd = $_POST['bill_dd'];
	
	$key_word1 = $_POST['key_word1'];
	$key_word2 = $_POST['key_word2'];
	$key_word3 = $_POST['key_word3'];
	$key_word4 = $_POST['key_word4'];
	$key_word5 = $_POST['key_word5'];
	
	
	$isbn = $_POST['isbn'];
	$year = $_POST['year'];
	$rack = $_POST['rack'];
	$price = $_POST['price'];
	$title = $_POST['title'];
	$media = $_POST['media'];
	$accNo = $_POST['accNo'];
	$author = $_POST['author'];
	$copies = $_POST['copies'];
	$acc_to = $_POST['acc_to'];
	$bill_no = $_POST['bill_no'];
	$subject = $_POST['subject'];
	$edition = $_POST['edition'];
	$book_no = $_POST['book_no'];
	$library = $_POST['library'];
	$supplier = $_POST['supplier'];
	$register = $_POST['register'];
	$acc_from = $_POST['acc_from'];
	$class_no = $_POST['class_no'];
	$publisher = $_POST['publisher'];
	$book_type = $_POST['book_type'];
	$price_type = $_POST['price_type'];
	$no_of_pages = $_POST['no_of_pages'];
	$pyment_type = $_POST['pyment_type'];
	$classific_num = $_POST['classific_num'];
	$purchase_type = $_POST['purchase_type'];
	$author_details = $_POST['author_details'];
	$payment_details = $_POST['payment_details'];
}

$flag = false;


/*xxxxxxxxxxxxxxxxxxxxxxxx TO GET ISBN BOOK DETAILS IN XML FORMTAE xxxxxxxxxxxxxxxxxxxxxxxx*/

if($_GET[ISBN_ID])
{
	
  $source = "http://isbndb.com/api/v2/xml/S5AEHY53/books?q=$ISBN_ID";
  

 // load as string
 $xmlstr = file_get_contents($source);
 $xmlcont = new SimpleXMLElement($xmlstr);
 foreach($xmlcont as $url) 
 {
    if($url->id){
		
		$id=$url->id;
	}
	if($url->name){
		$name=$url->name;
	}
	if($url->book_id){
		$book_id=$url->book_id;
	}
	if($url->edition_info){
		$edition=$url->edition_info;
	}
	if($url->isbn10){
		
		$isbn10=$url->isbn10;
	}
	if($url->isbn13){
		$isbn13=$url->isbn13;
	}
	if($url->physical_description_text){
		$no_of_pages=$url->physical_description_text;
	}
	if($url->publisher_id){
		$publisher_id=$url->publisher_id;
	}
	if($url->publisher_name){
		$publisher=$url->publisher_name;
	}
	if($url->publisher_text){
		$publication_place=$url->publisher_text;
	}
	if($url->summary){
		$remarks=$url->summary;
	}
	if($url->title){
		$title=$url->title;
	}
	/*if($url->title_latin){
		$title_latin=$url->title_latin;
	}*/
	if($url->title_long){
		$subtitle=$url->title_long;
	}
	
	
	//echo "{$url->id} - {$url->name} - {$url->book_id} - {$url->edition_info}\r\n";
 }
}



/************************************************************************************************/

?>
<?php
if($media==2) // Books CD
{	
	echo "<META http-equiv='refresh' content='0;URL=add_book_cd.php?media=$media'>";
}
elseif($media==4)  //Othere CD
{
	echo "<META http-equiv='refresh' content='0;URL=add_other_cd.php?media=$media'>";
}
elseif($media==5)  //Projects Reports
{
	echo "<META http-equiv='refresh' content='0;URL=add_project_report.php?media=$media'>";
}
elseif($media==6)  //Bound Volume
{
	echo "<META http-equiv='refresh' content='0;URL=add_bound_media.php?media=$media'>";
}
elseif($media==3)  //Book Floppy
{
	echo "<META http-equiv='refresh' content='0;URL=add_book_floppy.php?media=$media'>";
}
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function frm_add()
{
	var acc_from,acc_to,copies;
	acc_from = document.book.acc_from.value;
	acc_to = document.book.acc_to.value;
	copies = document.book.copies.value;

	if(document.book.register.selectedIndex=="")
	{
		alert("Select Register ");
		document.book.register.focus();
		return false;
	}
	if (document.book.acc_from.value=="" || document.book.acc_to.value=="" )
	{
		alert("Enter Accession No From and To ");
		document.book.acc_from.focus();
		return false;
	}
/*    if (acc_from.length < 5 || acc_to.length < 5 )
	{
		alert("Enter Valid Accession  ");
		document.book.acc_from.focus();
		return false;
	}*/
	if (copies.length < 0 && copies.length > 100)
	{
	    alert("Enter Valid no of copies  ");
		document.book.copies.focus();
		return false;
	}
	   
/*    if (acc_from > acc_to)
	{
		alert("Accession No From can't be greater than accession no To  ");
		document.book.acc_from.focus();
		return false;
	}*/
    if (document.book.title.value=="")
	{
		alert("Enter media title");
		document.book.title.focus();
		return false;
	}
    document.book.action = "addMedia.php";
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
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script LANGUAGE="JavaScript">
function reloadAjax(str)
{
var url="booktitle.php";
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
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
   }
 }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
</script>
<script>
function CallISBN(token)
{		
	location.href="?ISBN_ID="+token;
}
</script>
</HEAD>
<BODY>
<form method="POST" name="book" >
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="accNo" value="<?=$accNo?>">
<br>
<table class=forumline align=center width='90%'>
<tr width=30>
    <td align="center" class="head" colspan=4>Add Book Details</td>
</tr>
<tr>
<td width="120" align="left" height="22" title="Mandatory Field" >&nbsp;&nbsp;&nbsp;Library <font color=#FF0000>*</font></td>
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
    <td nowrap title="Mandatory Field">Register <font color=#FF0000>*</font></td>
    <td>
        <select name="register" onChange="javascript:document.book.submit()">
        <option value=''>Select Register</option>
        <?
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
        </select>
    </td>
</tr>
<tr>
	<td nowrap>&nbsp;&nbsp;&nbsp;Accession No</td>
<td>
<table border="0" width="100%" >
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;From </td>
    <td>No.Of Copies </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;To</td>
  </tr>
<?php
	
	if($library!='' and $register!='')
	{
		$var = "select acc_no from lib_acc_details where library='$library' and `register`='$register' order by acc_no desc limit 1";
		
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
			if($copies==0){
				$a = $copies;
			}else{
				$a = $copies - 1;
			}
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
?>
<tr>
    <td><input type="text" name="acc_from" value="<?=$acno?>" size="7" ></td>
    <td><input type="text" name="copies" value="<?=$copies?>" size="5"  onchange='book.submit()'></td>
    <td><input type="text" name="acc_to" value="<?=$b?>"  size="7" ></td>
</tr>
</table>
	</td>
	<td>Book Type</td>
<td>
<?php
$sel1="";
$sel2="";
if($book_type=="I")
{
	$sel1="selected";
}
elseif($book_type=="R")
{
	$sel2="selected";
}
?>
<select name=book_type>
<option value='I' <?=$sel1?>>Issue</option>
<option value='R' <?=$sel2?>>Reference</option>
</select>
</td>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Title</td>
	<td><input type="text" name="title" value="<?=$title?>" size="40" onKeydown="first_caps(this.form.title)"></td>
    <td>Sub Title</td>
	<td><input type="text" name="subtitle" value="<?=$subtitle?>" size="30"></td>
   </tr>
   <tr>
   
	<td nowrap >&nbsp;&nbsp;&nbsp;Media type</td>
    <td><select name="book_no">
		<?php
           if($book_no=='')
           {
              $rt1="selected";
              $rt2="";
              $rt3="";
           }
           elseif($book_no=='National Edition')
           {
              $rt1="";
              $rt2="selected";
              $rt3="";
           }	
           elseif($book_no=='International Edition')
           {
              $rt1="";
              $rt2="";
              $rt3="selected";	
           } 
		?>
				<option value="Select" <?=$rt1?>>Select</option>
				<option value="National Edition" <?=$rt2?>>National Edition</option>
				<option value="International Edition" <?=$rt3?>>International Edition</option>
				</select></td>
		
			<td>Call No</td>
			<td><input type="text" name="class_no" value="<?=$class_no?>" size="10" ></td>
       </tr>
	   <tr>
			<td nowrap>&nbsp;&nbsp;&nbsp;Classification No. &nbsp;&nbsp;</td>
			<td><input type='text' name='classific_num' value=''></td>
		
            <td>Author</td>
            <td><input type="text" name="author" value="<?=$author?>"></td>
		</tr>
		<tr>
            <td nowrap>&nbsp;&nbsp;&nbsp;Author Details</td>
            <td><input type="text" name="author_details" value="<?=$author_details?>"></td>
            <td>Publisher</td>
            <td><input type="text" name="publisher" value="<?=$publisher?>"></td>
        </tr>
		<tr>
        <td nowrap>&nbsp;&nbsp;&nbsp;Place of Publication &nbsp;&nbsp;
		</td>
		<td><input type="text" name="publication_place" value="<?=$publication_place?>">
		</td>
      
       
		<td>Edition</td>
        <td><input type="text" name="edition" value="<?=$edition?>" size="5"></td>
     </tr>
     <tr>
		<td>&nbsp;&nbsp;&nbsp;Year</td>
		<td><input type="text" name="year" value="<?=$year?>" size="5" onKeydown="return checkIt(event)"></td>
      
		<td>Rack</td>
		<td><input type="text" name="rack" value="<?=$rack?>"></td>
     </tr>
	 <tr>
		<td>&nbsp;&nbsp;&nbsp;Purchase type</td>
		<td><input type="text" name="purchase_type" value="<?=$purchase_type?>"></td>
        
		<td>Supplier</td>
		<td><input type="text" name="supplier" value="<?=$supplier?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;No of pages</td>
		<td><input type="text" name="no_of_pages" value="<?=$no_of_pages?>" size="5" onKeydown="return checkIt(event)"></td>
       
		<td>Payment Type</td>
		<td>
		<?
			  if($pyment_type=="")
			  {
				  $pyment_type="Cheque";
			  }
		?>
			<input type="text" name="pyment_type" value="<?=$pyment_type?>">
		</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Payment details</td>
		<td><input type="text" name="payment_details" value="<?=$payment_details?>"></td>
       
		<td>Bill No</td>
		<td><input type="text" name="bill_no" value="<?=$bill_no?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Bill Date</td>
		<td>
		   <?php
			$c_date=getdate();
			$MyDay=$c_date["mday"];
			echo "<select name='bill_dd'>";
			if ($bill_dd=='') 
			{
				$bill_dd=$MyDay;
			}
			for($i=1;$i<=31;$i++)
			{
				if($i == $bill_dd)
				{
					echo "<option value='$i' selected>$i</option>\n";
				}
				else
						echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";

			$MyMonth=$c_date["mon"];
			echo "<select name='bill_mm'>";
			if ($bill_mm=='')
			{
				$bill_mm=$MyMonth;
			}
			for($i=1;$i<=12;$i++)
			{
				if($i == $bill_mm)
				{
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				}
				else
						echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			
			$maxYr =$c_date["year"]+1;
			$MyYear=$c_date["year"];
			echo "<select name='bill_yy'>";
			if ($bill_yy=='') 
			{
				$bill_yy=$MyYear;
			}
			for($i=1970;$i<=$maxYr;$i++)
			{
				if($i == $bill_yy)	
				{
					echo "<option value='$i' selected>$i</option>\n";
				}
				else
						echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
			?>
		</td>
       
		
		<td nowrap>Date of Acquiring</td>
		<td nowrap>
		<?php
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
		
		<td>&nbsp;&nbsp;&nbsp;Price Type</td>
		<td>
		<?
			if($price_type=="")
			{
				$price_type="Rs.";
			}
		?>
			<input type="text" name="price_type" value="<?=$price_type?>">
		</td>
        <td>Price</td>
		<td><input type="text" name="price" value="<?=$price?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;ISBN</td>
         <?
		if($register==3 || $register==4){
		?><td nowrap><? }else{ ?><td colspan="4" nowrap ><? } ?>
        <input type="text" name="isbn" value="<?=$isbn?>" onChange="CallISBN(this.value)">&nbsp;<img src="../images/search.png" height="20" align="absmiddle"></td>
     <?
		if($register==3 || $register==4){
		?>
      
			<td>Title</td>
			<td><select name='subject' onChange="reloadAjax(this.value)">
             <option value="">---  Select Title ---</option>
				<?php
                $sql1=execute("SELECT * FROM `lib_book_title` WHERE status=1 ORDER BY id");
                    while($r=fetcharray($sql1))
                    {
                        if($subject==$r[id])
                        	echo "<option value='$r[id]' selected>$r[title]</option>";
                        else
                        	echo "<option value='$r[id]' >$r[title]</option>";
                    }
                ?>
				</select>
                <a href="javascript:void(0);" onClick ="OpenWind2('addSubject.php', 'OpenWind2',800,600)"><img src="../images/add.png" height="15" width="15" ></a></td>
	
		  </tr>
		<tr>
		<td>&nbsp;&nbsp;&nbsp;Subtitle</td>
        
		<td colspan="4"><div id="txtHint9" class="inline">
        <select name='subsubject'>
        <option value="">---  Select Subtitle ---</option>
		<?php
          $sql1=execute("SELECT * FROM `lib_book_subtitle` WHERE status=1 AND `lib_book_title_id`='$subject' ORDER BY id");
              while($r=fetcharray($sql1))
              {
                  if($subsubject==$r[id])
                      echo "<option value='$r[id]' selected>$r[subtitle]</option>";
                  else
                      echo "<option value='$r[id]' >$r[subtitle]</option>";
              }
          ?>
          </select></div></td>
	<?
	}
	?>
  </tr>
<tr height=25>
<td class="rowpic" colspan=4 align="center">Key Words</td>
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
		<td colspan=4></td>
		</tr>
		<tr>
            <td height="62" >&nbsp;&nbsp;&nbsp;Remarks</td>
            <td colspan=3 align='left' ><textarea name='remarks' rows="3" cols="40"><?=$remarks?></textarea></td>
		</tr></table>
    <p align="center"> <input type="button" value=" Add Media " name="add"  onClick="return frm_add()" class="bgbutton"></p>
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