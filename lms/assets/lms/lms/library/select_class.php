<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$academic_year=$_SESSION['AcademicYear'];

if($_SESSION)
{
	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];
}
if($_GET)
{
	$sem=$_GET['sem'];
	$check=$_GET['check'];
	$action=$_GET['action'];
	$branch=$_GET['branch'];
	$student_id=$_GET['student_id'];
}

if($_POST)
{
	$sem=$_POST['sem'];
	$check=$_POST['check'];
	$app_no=$_POST['app_no'];
	$branch=$_POST['branch'];
	$studfname=$_POST['studfname'];
	$student_id=$_POST['student_id'];
	$class_section_id=$_POST['class_section_id'];		
}

if($action=="Save")
{

		
		for($i=0;$i<sizeof($check);$i++)
		{
			 $val=$check[$i];
			 $student_id=$_POST[$val.'student_id'];
			 
		$sql="INSERT INTO lib_class (`branch`, `sem`, `class_section_id`, `student_id`) VALUES ('$branch', '$sem', '$class_section_id', '$student_id')";
	    //echo "<BR>".$sql;
		$result = execute($sql) or die(mysql_error());
		}
	if($result)
	{
		?>
        <script type="text/javascript">
			window.opener.location.href="lib.php?branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>&medtyp=2";
			window.close();
		</script>
        <?
	}
}

?>
<html>
<head>
<title>SELECT CLASS</title>
<script type="text/javascript">
  function reload()
  {
	  document.frm.action='select_class.php'
	  document.frm.submit();
  }
  function Search()
  {
	  document.frm.action='select_class.php?action=Search'
	  document.frm.submit();
  }
  function Save()
  {
	  document.frm.action='select_class.php?action=Save'
	  document.frm.submit();

  }
</script>
<script type="text/javascript">
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
</script>	
</head>
<body>
<form  name="frm" method='post'>
<input type="hidden" name="medtyp" value="2">
<input type="hidden" name="check" value="<?=$check?>">
<?php
$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>

 <table align='center' width="90%" class='forumline'>
  <tr>
    <td Class="Head" colspan='7' align='center'>SELECT STUDENT</td>
  </tr>   
  <tr height='30'>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload()">
			<option value="0">-----------  Select  ------------</option>
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
			<td><?php echo $_SESSION['semname']; ?></td>
		<td>
        <select name="sem" onChange="reload()">
			<option value='0'>----------  Select  ---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
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
	<td>Section</td>
    <td><select name='class_section_id'>
	<?PHP
    
      $sql=execute("SELECT * FROM class_section WHERE class_id='$sem'");
      echo "<option value=''>--- Select ---</option>";
          while($r=fetcharray($sql))
          {
              if($class_section_id==$r['id'])
                echo "<option value='$r[id]' selected>$r[section_name]</option>";
              else
                echo "<option value='$r[id]' >$r[section_name]</option>";
          }
    ?>
    </select>
</td>
</tr>
</table>
<P align=center><input type="button" class='bgbutton' value="Search" onClick="Search()" name="studdet"></P>
<?php
}
if(!$_GET['action'])
die();
	$sql="select id,student_id,usn,first_name,last_name from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id  ";
	}
	
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
 $sql.=" order by first_name";
 
 //echo "<br>".$sql;

	$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		die("<center><blink>No Records Found... !!!</blink></center>");
	}

?>
<BR>
<table border="1" class="forumline" align="center" cellspacing="0" cellpadding="0" width='70%'>
<tr height='25' >
	<td Class="rowpic" align='left'><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all">&nbsp;&nbsp;Select ALL<input type="checkbox"></div></td>
    <td Class="rowpic" align='center'>Student ID</td>
    <td Class="rowpic" align='center'>Student Name</td>
</tr>
<?php
  $rowclass=1;
  $sno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($sno<10)
			$sno="0".$sno;
		if($i%2)
			echo "<tr class='clsname'>";
		else
			echo "<tr >";
		?>
	
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="check[]" value="<?=$r[id]?>" ></td>   
        <input type="hidden" name="<?=$r['id']?>student_id" value="<?=$r[student_id]?>" >            
 		<td align='center'><?=$r[student_id]?></font></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td></tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<p align="center">
<input type="button" name="action" value="Save" onClick="Save()" class="bgbutton" style="width:60px; height:22px"></p>
</form>
</body>
</html>