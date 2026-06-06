<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/

$msg=$_REQUEST['msg'];
if($_GET)
{
	$grade=$_REQUEST['grade'];
	$school_division=$_REQUEST['school_division'];
}
if($_POST)
{
   $id=$_POST['id'];
   $grade=$_POST['grade'];
   $group_id=$_POST['group_id'];
   $teacher_id=$_POST['teacher_id'];
   $school_division=$_POST['school_division'];
}

if($msg)
{
?>
    <script language="javascript">
	  alert("<?=$msg?>");
    </script>
<?php
}

if($_GET[Types] == "Delete")
{
    $val=$_GET['val'];  
    $sql="UPDATE `pyp_group` SET `status`='0' WHERE `id`= $val";
	  
	 $result=execute($sql);  
	  if($result) 
	  {
	  
		  ?>
			  <script type="text/javascript">
				  alert("Deleted Successfully");
			  </script>
		  <?
  
	  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script language="javascript">
	function ReloadMe()
	{
		document.frm.action="create_group.php";
		document.frm.submit();
	}
	function adds_onclick()
	{
		document.frm.action="create_group_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="create_group_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
	function det(del)
    {
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="create_group.php?Types=Delete&val="+del;
			document.frm.submit();
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
<script language="javascript" src="../js/cal_conf2.js"></script>
<script type="text/javascript" src="jscolor/jscolor.js"></script>
<title>CREATE GROUP</title>
</head>
<body>

<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='60%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>CREATE GROUP</td>
			</tr>
            <tr>
				<td colspan="2" nowrap align="right"><?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td>
				<td><select name="school_division"  OnChange="ReloadMe()">
				<option value='' >----  Select ----</option>
				<?
                	$sqlCourse=execute("SELECT * FROM `course_m` WHERE status=1");
					while($r=fetcharray($sqlCourse))
					{
						if($school_division==$r['course_id'])
							echo "<option value='$r[course_id]' selected>$r[1]</option>";
						else
							echo "<option value='$r[course_id]'>$r[1]</option>";
					}
            
                ?>
			</select></td>
          </tr>
          <tr>
          	<td colspan="2" nowrap align="right"><?php echo $_SESSION['semname']; ?>&nbsp;&nbsp;</td>
      		<td><select name="grade" OnChange="ReloadMe()">
            <option value='' >----  Select ----</option>
			<?php
				$sqlCYear=execute("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");
					while($r=fetcharray($sqlCYear))
					{
						if($grade==$r['year_id'])
							echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
						else
							echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
        
            ?> </select></td>
          </tr>
			<tr height="25">
				<td colspan="2" nowrap align="right">Teacher Name&nbsp;&nbsp;</td>
				<td><select name="teacher_id" OnChange="ReloadMe()">
              	<option value=''>----  Select ----</option>
              	<?php
           $sqlT=execute("SELECT a.username,b.f_name,b.slno FROM usermenu a,staff_det b WHERE a.module='Class' AND a.submodule='PYP Planner' AND a.username=b.email GROUP BY b.f_name");
                      while($rt=fetcharray($sqlT))
                      {
                          if($teacher_id==$rt['slno'])
                              echo "<option value='$rt[slno]' selected>$rt[f_name]</option>";
                          else
                              echo "<option value='$rt[slno]'>$rt[f_name]</option>";
                      }
          
                ?> </select></td>
			</tr>
            <tr>
              <td colspan="2" nowrap align="right">Group Name&nbsp;&nbsp;</td>
              <td><select name="group_id" OnChange="ReloadMe()" required>
              <option value=''>----  Select ----</option>
              <?php
                $sqlGroup=execute("SELECT `id`,`group_name` FROM `pyp_group_m` WHERE `status`=1 AND `grade`='$grade' ORDER BY `id`");
                      while($r=fetcharray($sqlGroup))
                      {
                          if($group_id==$r['id'])
                              echo "<option value='$r[id]' selected>$r[group_name]</option>";
                          else
                              echo "<option value='$r[id]'>$r[group_name]</option>";
                      }
          
              ?></select>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="javascript:void(0);" onClick ="OpenWind2('create_group_m.php?grade=<?=$grade?>', 'OpenWind2',400,300)" 
              title="Click to add new Group"><img src="../images/add.png" align="top" height="15" width="15"></a></td>
          </tr>
          <tr>
			 <td colspan="2" nowrap align="right">Choose Color&nbsp;&nbsp;</td>
       		 <td><input class="color"  name="color_code" value="66ff00"></td>
		</tr>
	</table>
        <br/>
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Save &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
	
<?php
		
	   $result=execute("SELECT * FROM `pyp_group` WHERE `status` = 1 AND `grade` = '$grade' ORDER BY `id`");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table align='center' width='90%' border="1">
		<tr height='22' >
		    <td Class="head" align='center' >Sl No</td>
			<td Class="head" align='center' >School Division </td>
			<td Class="head" align='center' >Grade</td>
            <td Class="head" align='center' >Group Name</td>
			<td Class="head" align='center' >Teacher Name</td>
            <td Class="head" align='center' >Text Color</td>
            <td Class="head" align='center' >Action</td>			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=fetcharray($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					if($i%2)
						echo "<tr class='clsname' >";
					else
						echo "<tr >";
						
$SDivision=fetcharray(execute("SELECT `coursename` FROM `course_m` WHERE `course_id`=$row[school_division] AND status=1"));
$grade=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE `year_id`=$row[grade] AND status=1"));
$group_name=fetcharray(execute("SELECT `group_name` FROM `pyp_group_m` WHERE `id`=$row[group_id]"));	
$teacher_name=fetcharray(execute("SELECT `f_name` FROM `staff_det` WHERE `slno`='$row[teacher_id]'"));	
				
		?>	         
            <td align="center" ><?=$sno?></td>
            <td align='center' >&nbsp;<?=$SDivision[0]?></td>
            <td align='center' >&nbsp;<?=$grade[0]?></td>
            <td align='center' >&nbsp;<?=$group_name[0]?></td>
            <td align='center' >&nbsp;<?=$teacher_name[0]?></td>
            <td align='center' >&nbsp;<input class="color" value="<?=$row[color_code]?>" readonly></td>
            <td  align='center'>
            <input type="button"  value="&nbsp;&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;" onclick ="OpenWind2('create_group_edt.php?id=<?=$row[id]?>&Type=group_edt', 'OpenWind2',600,400)" class="bgbutton"/>
            
            <input type="button" name="Delete" value="Delete" onclick ="det(<?=$row[id]?>)" class="bgbutton"/>
	
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	 

 ?>
 </table>
   <?
    }
?>
</form>

 </body>
 </html>
