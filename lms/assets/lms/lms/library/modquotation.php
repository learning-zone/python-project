<?php
include_once("../db.php");
$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];
$submit1 = $_POST['submit1'];
$quotation = $_POST['quotation'];
$quot = $_POST['quot'];
$mdd = $_POST['mdd'];
$mmm = $_POST['mmm'];
$myy = $_POST['myy'];
$library = $_POST['library'];
$sel = $_POST['sel'];
$vendor = $_POST['vendor'];
$modify = $_POST['modify'];
$delete = $_POST['delete'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$title = $_POST['title'];
$copies = $_POST['copies'];
$add = $_POST['add'];
$tid = $_POST['tid'];
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
</script>
</head>
<body>
<?
if(isset($add))
{
	$qry="insert into quotation_trans values($quot,'$author','$publisher','$title',$copies,NULL)";
	execute($qry);
}
if(isset($delete))
{
	for($i=0;$i<count($tid);$i++)
	{
		execute("delete from quotation_trans where tid=$tid[$i]");
	}
}
if(isset($modify))
{
	execute("update lib_quotation set vendor=$vendor,library=$library,quot_date='$myy-$mmm-$mdd' where id=$quot");
	for($i=0;$i<count($tid);$i++)
	{
		//$au="author$tid[$i]";
		$au=$_POST["author".$tid[$i]];
		
		//$pu="publisher$tid[$i]";
		$pu=$_POST["publisher".$tid[$i]];
		
		//$tit="title$tid[$i]";
		$tit=$_POST["title".$tid[$i]];
		
		//$copies="copies$tid[$i]";
		$copies=$_POST["copies".$tid[$i]];
		
		execute("update quotation_trans set author='$au',publisher='$pu',title='$tit',copies=$copies where tid=$tid[$i]");

	}
}
echo "<form method=post>";
echo "<table border=0 align='center' class=forumline width='65%'>";
echo "<tr><td colspan=3 class=head align='center'>Quotation Modification Form</td></tr>";
echo "<tr>";
		echo "<td>Enter Date :</td>";
		echo "<td title='DD/MM/YYYY'><input type=text name=dd value='$dd' size=3 maxlength=2 onKeydown='return checkIt(event,0)'>";
		echo "<input type=text name=mm value='$mm' size=3 maxlength=2 onKeydown='return checkIt(event,0)'>";
		echo "<input type=text name=yy value='$yy' size=5 maxlength=4 onKeydown='return checkIt(event,0)'>";
		echo "<input type=submit name=submit1 value='Search Quotations' class=bgbutton></td>";
		if(isset($submit1))
		{
			$qry="select id from lib_quotation where quot_date='$yy-$mm-$dd'";
			$rs=execute($qry);
			if($rs)
			{
				echo "<td>";
					echo "<select name=quotation onChange=\"javascript:document.forms[0].submit()\">";
						echo "<option value=''>Select Quotation</option>";
						while($row=fetcharray($rs))
						{
							echo "<option value='$row[id]'>$row[id]</option>";
						}
					echo "</select>";
				echo "</td>";
			}
		}
		echo "</tr>";
	echo "</table>";
if($quotation<>'')
{
$qry="select * from lib_quotation where id=$quotation";
$rs=execute($qry);
$row=fetcharray($rs);
echo "<br><br>";
echo "<table border=0 align='center' class=forumline width='65%'>";
echo "<tr>";
		echo "<td>Quotation No</td>";
		echo "<td align='center'><input type=hidden name=quot value='$quotation'><font color=red><u>$quotation</u></font></td>";
		echo "<td>Quotation Date</td>";
		echo "<td >";
		$currdate=explode("-",$row[quot_date]);
		echo "<input type=text name=mdd value='$currdate[2]' size=3 maxlength=2 onKeydown='return checkIt(event,0)'>";
		printf("<input type=text name=mmm value='%02d' size=2 maxlength=3 onKeydown='return checkIt(event,0)'>",$currdate[1]);
		echo "<input type=text name=myy value='$currdate[0]' size=5 maxlength=4 onKeydown='return checkIt(event,0)'></td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Library</td>";
	echo "<td><select name=library>";
	echo "<option value=''>Select Library</option>";
	$qry="select * from library_name";
	$rs1=execute($qry);
	if($rs1)
	{
		while($row1=fetcharray($rs1))
		{
		if($row1[id]==$row[library])
			$sel = "selected";
		else
			$sel = "";
		echo "<option value=$row1[id] $sel>$row1[name]</option>";
		}
	}
	echo "</select>";
	echo "</td>";
	echo "<td>";
	echo "<b>Vendor/Supplier Name</b>";
	echo "</td>";
	echo "<td colspan=3>";
	echo "<select name=vendor>";
	echo "<option value=''>Select Vendor</option>";
	$qry="select * from lib_vendor_m order by name";
	$rs1=execute($qry);
	if($rs1)
	{
		while($row1=fetcharray($rs1))
		{
		if($row1[id]==$row[vendor])
			$sel = "selected";
		else
			$sel = "";
		echo "<option value=$row1[id] $sel>$row1[Name]</option>";
		}
	}
	echo "</select>";
	echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br>";
echo "<table border=0 align='center' class=forumline width='65%'>";
echo "<tr height='20'><td colspan=5 class=head align='center'>Media Details</td></tr> ";
echo "<tr>";
	echo "<td class='rowpic' align='center'>Select</td >";
	echo "<td class='rowpic' align='center'>Author</td>";
	echo "<td class='rowpic' align='center'>Publisher</td>";
	echo "<td class='rowpic' align='center'>Title</td>";
	echo "<td class='rowpic' align='center'>No of Copies</td>";
echo "</tr>";
$qry="select * from quotation_trans where id = $quotation";
$trs=execute($qry);
if($trs)
{
	while($trow=fetcharray($trs))
	{
		echo "<tr>";
			echo "<td><input type=checkbox name=tid[] value='$trow[tid]'></td>";
			echo "<td><input type=text name=author$trow[tid] value='$trow[author]'></td>";
			echo "<td><input type=text name=publisher$trow[tid] value='$trow[publisher]'></td>";
			echo "<td><input type=text name=title$trow[tid] value='$trow[title]'></td>";
			echo "<td><input type=text name=copies$trow[tid] value='$trow[copies]' size=10 onKeydown='return checkIt(event,1)'></td>";
		echo "</tr>";
	}
}
echo "<tr>";
	echo "<td colspan=5 align='center'>";
	echo "<input type=submit name=modify value='Modify Items' class=bgbutton>";
	echo "<input type=submit name=delete value='Delete Items' class=bgbutton>";
	echo "</td>";
echo "</tr>";
echo "</table>";

echo "<hr>";
echo "<table border=0 align='center' class=forumline width='65%'>";
	echo "<tr height='20'><td colspan=4 class='head' align='center'>Add Media Details</td></tr>";
	echo "<tr>";
		echo "<td class='rowpic' align='center'>Author</td>";
		echo "<td class='rowpic' align='center'>Publisher</td>";
		echo "<td class='rowpic' align='center'>Title</td>";
		echo "<td class='rowpic' align='center'>No of Copies</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td><input type=text name=author size=22></td>";
		echo "<td><input type=text name=publisher size=22></td>";
		echo "<td><input type=text name=title size=22></td>";
		echo "<td><input type=text name=copies size=10 onKeydown='return checkIt(event,1)'></td>";
	echo "</tr>";
	echo "<tr>";
	    echo "<td colspan=4 align='center'><input type=submit name=add value='Add Items' class=bgbutton></td>";
	echo "</tr>";
echo "</table>";
echo "</form>";
}
?>
</center>
</body>
</html>