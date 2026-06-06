<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if(!$_POST)
{

	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];	
}
elseif($_POST)
{
	$sem=$_POST['sem'];
	$m_id = $_POST['m_id'];
	$branch=$_POST['branch'];
	$student_id=$_POST['student_id'];
	$studdet=$_POST['studdet'];
	$studfname=$_POST['studfname'];	
	$appl_no = $_POST['appl_no'];
	$class_section_id=$_POST['class_section_id'];

}
else
{
	
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];

}

//echo "Sem :".$sem;

?>
<html>
<head>
<title> MISCELLANEOUS CANCEL RECEIPT </title>
<script language="javascript">
function OpenWind2(URL,title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank,titlebar=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script type="text/javascript">
  function reloadMe()
  {
	  document.frm.action="miscfee_cancel.php";
	  document.frm.submit();
  }
</script>
<script LANGUAGE="JavaScript">
function reload(str)
{

var url="../sessionbranchfile.php";
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
</head>
<body>
<form method='post' action="miscfee_cancel.php" name="frm" >
 <table class='forumline' align='center' width="90%" >
   <tr>
    	<td Class="Head" colspan='7' align='center'>CANCEL MISCELLANEOUS RECEIPT</td>
    </tr>
    <tr>
    	<td Class="row3" colspan='7' align='center'>Search Student Details</td>
    </tr>
	<tr height='30'>
        <td align='left'>&nbsp;&nbsp;Fee Title</td>
        <td >
        <select name='m_id' onChange="reloadMe()">
        <option value='0'>-----  Select  ------</option>
        <?php
          $sqlF=execute("SELECT  id, name FROM `fee_misc_m` WHERE `status` = 1 ORDER BY id");                    
				    while($row=fetcharray($sqlF))
                    {
                        if($m_id==$row['id'])
                            echo "<option value='$row[id]' selected>$row[name]</option>";
                        else
                            echo "<option value='$row[id]' >$row[name]</option>";
							
                    }
                ?>
            </select></td>
            
		<td> <?php echo $_SESSION['semname']; ?></td>
		<td><select name="sem" disabled>
			<option value='0'>---- Apply for all ----</option>
			<?php
		$class=fetcharray(execute("SELECT `class` FROM `fee_misc_m_desc` WHERE m_id ='$m_id' LIMIT 1"));
		        $sem=$class[0];

				$rs=execute("SELECT  year_name, year_id FROM course_year");

				while($r=fetcharray($rs))
				{

					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
			?>
			</select>
		</td>
	</tr>
	<tr height='30'>
		<td>&nbsp;&nbsp;Student Name</td>
		<td><input type='text' name='studfname' value=""></td>
        
        <td>Admission ID</td>

		<td colspan="3"><input type='text' name='student_id' value=""></td>
   </tr>
 </table>
	<p align=center><input type="submit" class='bgbutton' value="Search" name="studdet"></p>
</form>
<?

if($_POST['studdet']!='')
{
	
	$c_id=fetcharray(execute("SELECT `id` FROM `fee_misc_m_desc` WHERE m_id = '$m_id' AND `status` = 1"));
	
$sql="SELECT a.id, a.student_id, a.first_name, a.last_name, a.course_yearsem, a.academic_year, b.c_id, b.m_id FROM student_m a, fee_misc_collect_m b WHERE a.id is not null AND a.archive='N' and a.academic_year = '$academic_year' and a.id = b.student_id";

	if($student_id!='')
	{
	 	$sql.=" and a.student_id='$student_id'";
	}
	
	if($branch!=0)
	{
		$sql.=" and a.course_admitted='$branch'";
	}

	if($sem!=0)
	{
		$sql.=" and a.course_yearsem='$sem'";
	}

	if($class_section_id!='')
	{
		$sql.=" and a.class_section_id='$class_section_id'  ";
	}	

	if($studfname!='')
	{
		 $sql.=" and a.first_name like '$studfname%'";
	}
    
	if($c_id[0]!='')
	{
		 $sql.=" and b.c_id = '$c_id[0]'";
	}

 $sql.=" ORDER BY a.first_name";

   //echo "<br>".$sql;

		$result=execute($sql) or die(mysql_error());
}

if(rowcount($result)>0)
{
	
 ?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr>
	<td align='center' class='head' colspan='6'>STUDENT DETAILS</td>
</tr>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Admission ID</td>
    <td Class="rowpic" align='center'>Student Name</td>
    <td Class="rowpic" align='center'>Grade</td>
    <td Class="rowpic" align='center'>Fee Title</td>
</tr>

<?php
  $sno=1;
  $rowclass=1;

	for($i=0;$i<rowcount($result);$i++)
	{
		
		$r=fetcharray($result);

		if($sno<10)

			$sno="0".$sno;

		if($i%2)
			echo "<tr class='clsname' > ";
		else
			echo "<tr >";
			
		?>
		<td align='center' ><?=$sno?></td> 
        
        <td align='center' title="Click to cancel receipt" >
 <a href="javascript:void(0);" onClick ="OpenWind2('miscfee_receipt_cancel.php?student_mID=<?=$r[id]?>&academic_year=<?=$r[academic_year]?>&m_id=<?=$r[m_id]?>&c_id=<?=$r[c_id]?>', 'OpenWind2',1000,800)"><?=$r[id]?></a>
        </td>

		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
        
        <td align="center">&nbsp;&nbsp;<?php

		$course_yearsem=fetchrow(execute("SELECT year_name FROM course_year WHERE year_id = '$r[course_yearsem]'"));

		echo $course_yearsem[0]; ?></td>
    <?
		$feeTitle=fetcharray(execute("SELECT `name` FROM `fee_misc_m` WHERE id = '$r[m_id]'"));
	?>
        
        <td align='center'><?=$feeTitle[0]?></td>
    </tr>

		<?php

		$sno++;
		$rowclass = 1 - $rowclass;

	}

?>
</table>
<?
}
?>
</body>
</html>