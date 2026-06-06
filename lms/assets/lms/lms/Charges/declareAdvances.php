<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='declareAdvances.php';
	document.frm.submit();
	
}

function val(val1)
{
	var a = parseInt(val1);
	if(isNaN(a))
	{
		alert('Enter numeric values   ');
		document.getElementById("amount").value='';
	}
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");

if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$accyear=$_POST['accyear'];
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$accyear=$_SESSION['AcademicYear'];
}

$amount=$_POST['amount'];
$tablename="spl_advances";
$sysdate=date("Y-m-d");
if($_POST['open'])
{
		$sql5=execute(" select `id` from $tablename where `div`='$branch' and `class`='$sem' and `acc_year`='$accyear' ");
		if(rowcount($sql5)>0)
		{
			?>
			<SCRIPT LANGUAGE="JavaScript">
			alert("Duplicate entry not allowed ");
			</SCRIPT>
			<?php
		}
		else
		{
			$sql1="insert into $tablename(`div`, `class`, `acc_year`, `price`, `status`) values('$branch','$sem','$accyear','$amount',1)";			
			execute($sql1);	
			?>
			<SCRIPT LANGUAGE="JavaScript">
			alert("Successfully Updated");
			</SCRIPT>
			<?php
		}

}
	

?>		<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Declare  Advances</td>
    </tr>
      <tr>
    <td height="28" nowrap>&nbsp;&nbsp;Academic  year</td><td>&nbsp;<select name='accyear' id='accyear'  onChange="reload()">
  <?
	$accyear2=date("Y");
	$accyear2=$accyear2-2;
	
echo "<option value=''>--Select--</option>";
for($i=1;$i<5;$i++)
{
	$accyear1=$accyear2+1;
	if($accyear2==$accyear)
	{
		echo "<option value='$accyear2' selected>$accyear2-$accyear1</option>";
	}
	else
	{
		echo "<option value='$accyear2'>$accyear2-$accyear1</option>";
	}
$accyear2=$accyear2+$i;
}
?>
  </select>
  </td>
  </tr>
  <tr>
    <td nowrap>&nbsp;&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">----------------All---------------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>
		
  </tr>
  <tr>
   <td>&nbsp;&nbsp;Class </td>
		<td>&nbsp;<select name="sem" id='sem' onChange="reload()">
			<option value='0'>-----All----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
  </tr>
 <tr>
    <td height="28">&nbsp;&nbsp;Price</td><td>&nbsp;<input type="text" value="" id='amount' name="amount" onChange="val(this.value)">
    </td>
 </tr>
 </table>
<br>
<div align="center"><input type="submit" name="open" value="UPDATE" class="bgbutton"></div><br>
<br>
<?php
if($accyear=='')
die();
$sql2="select * from $tablename where `acc_year`='$accyear' order by `div`, `class`";
$sql3=execute($sql2);
if(rowcount($sql3)==0)
die();

?>
<table width="70%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" align="center" class="head">  Advances For 			
		<?php
        $temp=$accyear+1; 
        echo $accyear." - ".$temp; 
        ?> 
    </td>
	</tr>
    <tr>
    <td align="center" class="row3">Sl.No
    </td>
        <td align="center" class="row3"> School Division
    </td>
        </td>
        <td align="center" class="row3">Class
    </td>
        </td>
        <td align="center" class="row3">Price
    </td>
        </td>
        <td align="center" class="row3">Action
    </td>
    </tr>

    <?php
	$i=1;
		while($r=fetcharray($sql3))
	{
	?>   
    <tr>
    <td align="center" ><?php echo $i; ?></td> 
    </td>
        <td  >&nbsp;&nbsp; <?php 
		$sql=execute("select coursename from course_m where course_id='$r[1]'");
		$branchname=fetchrow($sql);
		echo $branchname[0];
		?>
    </td>
        </td>
        <td >&nbsp;&nbsp;
		<?php 
			$rs=execute("SELECT year_name FROM course_year where year_id='$r[2]'");
	$classname=fetchrow($rs);
	echo $classname[0]; 
	?>
    </td>
        </td>
        <td align="center" ><?php echo $r[4]; ?>
    </td>
        </td>
        <td align="center" ><a href="#">Edit</a>
    </td>
    </tr>
    <?php
	$i++;
	}
	?>   
</table>
 				
</form>	
</body>
</html>