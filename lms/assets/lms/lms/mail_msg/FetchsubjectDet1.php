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
	document.frm.action='FetchsubjectDet1.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='Marks_card1.php';
	document.frm.submit();
}
function reload2()
{
	document.frm.action='sendmsgstudent.php';
	document.frm.submit();
}
function reload3()
{
	document.frm.action='sendmsgstaff.php';
	document.frm.submit();
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
$academic_year=$_SESSION['AcademicYear'];
if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
elseif(!$_POST and $_REQUEST)
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
}
else
{

$branch=$_POST['branch'];
$sem=$_POST['sem'];
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];
}
$subj=$_POST['subj'];
$type=$_POST['type'];
echo '<form name="frm" action="" method="post" >';	


?>		<table width="90%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">SEND MSG</td>
    </tr>
    <td width="30%" nowrap>&nbsp;&nbsp;Type</td>
    <?php
	if($type==1)
	{
		$seltype1='selected';
		$hreflink='reload2()';
	}
	if($type==2)
	{
		$seltype2='selected';
		$hreflink='reload1()';
	}
	if($type==3)
	{
		$seltype3='selected';
		$hreflink='reload3()';
	}
	?>
		<td>&nbsp;<select name="type" onChange="reload()">
			<option value="">------Select-----</option>
            <option value="3" <?=$seltype3?>>Staff</option>
            </select>
			</td>
  </tr>
<?php
if($type=='')
die();
if($type==3)
{
?>
 <tr>
    <td>&nbsp;&nbsp;Department</td>
    
    <td >&nbsp;<select  name="subj" size="1" onChange="reload()">
    <option  value="0"> --All-- </option>
    <?php
    $temp = "SELECT * FROM dept_no";
    
    $rs = execute($temp);
    
    $num = rowcount($rs);
    
    for($i=0;$i<$num;$i++)
    {
		$r = fetcharray($rs,$i);
		if($subj==$r[1])
		echo("<option value='" . $r[1] . "' selected>" . $r[0] . "</option>");
		else
		echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");
    }
    ?>
    </select></td>
</tr>
<?php	
}
else
{
?>     
      <tr>
        <td nowrap>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
            <td>&nbsp;<select name="branch" onChange="reload()">
                <option value="0">------Select-----</option>
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
       <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
            <td>&nbsp;<select name="sem" onChange="reload()">
                <option value='0'>-----Select----</option>
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
      <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
    <?
    $rs_section=execute("select * from class_section");
    echo "<option value=''>--Select--</option>";
    for($i=0;$i<rowcount($rs_section);$i++)
    {
        $r_section=fetcharray($rs_section,$i);
        if($class_section_id==$r_section[id])
        echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
        else
        echo "<option value='$r_section[id]'>$r_section[section_name]</option>";
    
    }
    ?>
    </select>
    </td>
      </tr>
    <?php
}
?>
   <tr>
   <td colspan="2" align="center" class="head">ENTER MSG</td>
  </tr>
  <tr>
   <td valign="middle" >&nbsp;&nbsp;<select name="senderid">
   <option value="Announcement">Announcement</option>
   <option value="Emergency Alert">Emergency Alert</option>
   </select></td>  <td valign="middle" >&nbsp;<textarea name='remks'  cols='44' rows='4'></textarea></td>
  </tr>
</table>
<br>
<div align="center"><input type="button" name="open" value="Send MSG"  class="bgbutton" onClick="<?=$hreflink?>"></div><br>
  <?php
if($type==3)
{
 
    $SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.Active='YES'  ";
	$flag = 0;
	if($subj != 0)
	{
		if($flag == 0)
		{
			$SQL .= "and  a.subj = $subj" ;
			$flag = 1;
		}
		else
		{
			$SQL .= " AND a.subj = $subj";
		}
	}
    $SQL.=" order by a.f_name";
    $rs = execute($SQL) or die("<p align=center>No Record Found !</p>");
	$num = rowcount($rs);

	if($num == 0)
	{
		die("No records found");
	}
	?>
	<table border='1'  align="center" width="90%">
	
	<td class="row3" >Name
	</td>
	<td class="row3" align='center'>Staff ID
	</td>
	<td class="row3" align='center'>
	Department</td>
	<td  class="row3" align='center'>
	Designation</td>
	<td width="7%" align="center" class="row3" nowrap><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all Students">Select ALL<input type="checkbox"></div></td>

	<?php
	
	for($i=0;$i<$num;$i++)
	{
		if($i%2)
		echo "        <tr class='clsname' > ";
		else
		echo "        <tr > ";
		$r = fetcharray($rs,$i);
		$ar2 = getdate($r["j_date"]);
		$ar3 = getdate(time());
		$d=explode(" ",$r["j_date"]);
		
		?>
		
		<td  class="CBody" align="LEFT">
		&nbsp;<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</td>
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $r["slno"]?></td>
		<?php 
		$rs_sql=execute("select * from staff_des where d_id=$r[type_id]");
		$designation="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$designation=$r_sql[d_name];
		}
		mysql_free_result($rs_sql);
		$rs_sql=execute("select * from dept_no where dpt_id=$r[subj]");
		$department="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$department=$r_sql[Dept];
		}
		mysql_free_result($rs_sql);
		?>
		<td class="CBody" align="CENTER"><?php echo $department?> </td>
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $designation?> </td>
		<!--	<td class="CBody" align="left"><font face='Lucida Sans' ><?php //echo $ex?> Years</font></td>-->
		<td  class="CBody" align="CENTER">
        <input type="checkbox" name="check[]" value="<?=$r[id]?>" >
		</td></tr>
		<?php
	}
	?>
	</table>
<?php
	
	
}
else
{  
		if($branch=='0')
		die();
		if($sem=='0')
		die();
		
	   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and  academic_year='$academic_year'";
		if($branch!=0)
		{
		$sql123.=" and course_admitted=$branch";
		}
		if($sem!=0)
		{
		$sql123.=" and course_yearsem=$sem";
		}
		if($class_section_id!='')
		{
		$sql123.=" and class_section_id=$class_section_id  ";
		}
		
		$sql123.=" order by first_name";
		
		$rs=execute($sql123) or die(mysql_error());
	  ?><br>  <table width="90%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
	  <tr>
		<td width="10%" class="head" nowrap>Sl No.</td>
		<td width="40%" align="center"  class="head" nowrap>Name</td>
		<td width="20%" align="center"  class="head" nowrap>Student Id</td>
		<!--<td width="23%" align="center">Action</td>-->
		<td width="7%"  class="head"  align="center"><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';
	this.style.cursor='hand';this.style.color='white'"
	onMouseOut="this.style.backgroundColor='#E9D0B6';this.style.cursor='default';this.style.color='black'"
	onClick="selectMe()" Title="Click to Select all Students"><b>X</b></div></td>
	  </tr>
	  <?php
	  $i=1;
	  while($r1=fetcharray($rs))
	  { 
	  echo "<tr>
		<td nowrap>&nbsp;$i</td>
		<td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
		<td nowrap align='center'>&nbsp;$r1[student_id]</td>
		";
		?>
	  <td align="center">
		<input type="checkbox" name="check[]" value="<?=$r1[id]?>" >
		
		</td>
	  </tr><?php
	$i++;  }
	  ?>
	  
	</table>
	<?php
}
?>				
</form>	
</body>
</html>