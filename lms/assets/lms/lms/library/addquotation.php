<?php
include_once("../db.php");
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$title = $_POST['title'];
$copies = $_POST['copies'];
$add = $_POST['add'];
$submit1 = $_POST['submit1'];
$quot_id = $_POST['quot_id'];
$library = $_POST['library'];
$sel = $_POST['sel'];
$B1 = $_POST['B1'];
$vendor = $_POST['vendor'];
$quot = $_POST['quot'];
$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];
$library=1;
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
if($library=="")
{
	execute("delete from lib_temp_quotation_trans");
}
if(isset($add))
{
$rs_sql=execute("select * from lib_temp_quotation_trans where library='$library' and vendor='$vendor' and author='$author' and publisher='$publisher' and title='$title' and copies='$copies'");
//echo "select * from lib_temp_quotation_trans where library=$library and vendor=$vendor and author='$author' and publisher='$publisher' and title='$title' and copies=$copies";
if(rowcount($rs_sql)==0)
{
	$qry="insert into lib_temp_quotation_trans(author,publisher,title,copies,library,vendor) 		values('$author','$publisher','$title','$copies','$library','$vendor')";
	execute($qry);
}
}

if(isset($submit1) && sizeof($quot_id) !=0)
{

	$qry="insert into lib_quotation values(NULL,$library,'$yy-$mm-$dd',$vendor)";
	execute($qry);
	$row=fetcharray(execute("select max(id) from lib_quotation"));
	$quot = $row[0];
	while(list(,$value) = each($quot_id))
	{
		
		$author=$_POST["author".$value];
		$publisher=$_POST["publisher".$value];
		$title=$_POST["title".$value];
		$copies=$_POST["copies".$value];

		$qry="insert into quotation_trans (id,author,publisher,title,copies) values($quot,'$author','$publisher','$title',$copies)";
		execute($qry);
	}
	//header("Location:../library/view_quotation.php?vendor=$vendor&quot=$quot&dd=$dd&mm=$mm&yy=$yy");
	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=../library/view_quotation.php?vendor=$vendor&quot=$quot&dd=$dd&mm=$mm&yy=$yy'>";
}
echo "<center><form method=post>";
	echo "<table border=0 class=forumline align=center width='47%'>";
		echo "<tr><td class='head' align=center colspan=4>Generate Quotation Form </td></tr>";
		/*
		echo "<tr><td colspan='2'>Library</td>";
			echo "<td colspan='2'><select name=library>";
				echo "<option value=''>Select Library</option>";
				$qry="select * from library_name";
				$rs=execute($qry);
				if($rs)
					{
						while($row=fetcharray($rs))
							{
								$sel="";
								if($library==$row[id])
									$sel="selected";
								echo "<option value=$row[id] $sel>$row[name]</option>";
							}
					}
				echo "</select>";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
		*/
		$library=1;
			echo "<td colspan='2' align='right'>Quotation Date&nbsp;&nbsp;&nbsp;</td>";
			echo "<td colspan='2'>";
				if($dd=="")
				{
					$currdate=getdate();
					$dd=$currdate[mday];
					$mm=$currdate[mon];
					$yy=$currdate[year];
				}
				echo "<input type=text name=dd value='$dd' size=3 maxlength=2 onKeydown='return checkIt(event,0)'>";
				echo "<input type=text name=mm value='$mm' size=3 maxlength=2 onKeydown='return checkIt(event,0)'>";
				echo "<input type=text name=yy value='$yy' size=5 maxlength=4 onKeydown='return checkIt(event,0)'>";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan='2' align='right'>Vendor/Supplier Name&nbsp;&nbsp;&nbsp;</td>";
			echo "<td colspan='2'><select name=vendor>";
					echo "<option value=''>Select Vendor</option>";
					$qry="select * from lib_vendor_m order by Name";
					$rs=execute($qry);
					if($rs)
					{
						while($row=fetcharray($rs))
						{
							$sel="";
							if($vendor==$row[id])
								$sel="selected";
							echo "<option value=$row[id] $sel>$row[Name]</option>";
						}
					}
				echo "</select>";
			echo "</td>";
		echo "</tr>";
		echo "<tr height='20'>";
			echo "<td colspan=4 align='center'>Add Media Details</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th Class='head'>Author</th>";
			echo "<th Class='head'>Publisher</th>";
			echo "<th Class='head'>Title</th>";
			echo "<th Class='head'>No of Copies</th>";
		echo "</tr>";
		echo "<tr>";
			echo "<td><input type=text name=author size=20></td>";
			echo "<td><input type=text name=publisher size=20></td>";
			echo "<td><input type=text name=title size=20></td>";
			echo "<td><input type=text name=copies size=20 onKeydown='return checkIt(event,0)'></td>";
		echo "</tr>";
	echo "</table>";
	echo "<p align='center'><input type=submit name=add value='Add Details' class=bgbutton></p>";
	echo "<br><br>";
	if($library =="" || $vendor=="")
	{
		echo "</form>";
		die();
	}
	$qry="select * from lib_temp_quotation_trans where library=$library and vendor=$vendor ";
	$rs=execute($qry);

if(rowcount($rs)!=0)
{
	echo "<table border=0 align=center class=forumline colspan='5'>";
	echo "<tr>";
	echo "<td class=rowpic align='center'>Sl.No.</td>";
	echo "<td class=rowpic align='center'>Author</td>";
	echo "<td class=rowpic align='center'>Publisher</td>";
	echo "<td class=rowpic align='center'>Title</td>";
	echo "<td class=rowpic align='center'>No. Of Copies</td>";
	echo "</tr>";

	if($rs)
	{
		$ctr=1;
		$tot = 0;
		while($row=fetcharray($rs))
		{
			echo "<tr>";
				echo "<td align=right><input type='checkbox' name='quot_id[]' value='$row[id]' checked>$ctr</td>";
				echo "<td><input type='text' name='author$row[id]' value='$row[author]'></td>";
				echo "<td><input type='text' name='publisher$row[id]' value='$row[publisher]'></td>";
				echo "<td><input type='text' name='title$row[id]' value='$row[title]'></td>";
				echo "<td align=right><input type='text' name='copies$row[id]' size='5' value='$row[copies]' onKeydown='return checkIt(event,0)'></td>";
			echo "</tr>";
			$ctr++;
			$tot = $tot + $row[copies];
		}
    }
		echo "<tr>";
		echo "<td colspan=5 align=center><input type=submit name=submit1 value='Save Details' class=bgbutton></td>";
		echo "</tr>";
		echo "</table>";
	}
echo "</form>";
?>
</center>
</body>
</html>