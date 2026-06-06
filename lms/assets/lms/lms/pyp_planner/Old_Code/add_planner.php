<?php
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
session_start();
require_once("../db.php");

$msg=$_REQUEST['msg'];
if($_POST['Nenq_sn']!='' and $_POST['Nenq_sub_sn']!='')
{
	$enq_sn=$_POST['Nenq_sn'];
	$enq_sub_sn=$_POST['Nenq_sub_sn'];
}
else
{
	$enq_sn=$_POST['enq_sn'];
	$enq_sub_sn=$_POST['enq_sub_sn'];
}
if($_POST)
{
	
   $id=$_POST['id'];
   $title=$_POST['title'];
   $grade=$_POST['grade'];
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
	  
	 $result=mysql_query($sql);  
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
<html>
<head>
<script language="javascript">
	function ReloadMe()
	{
		document.frm.action="add_planner.php";
		document.frm.submit();
	}
	function adds_onclick()
	{
		document.frm.action="add_planner_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="add_planner_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
	function det(del)
    {
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="add_planner.php?Types=Delete&val="+del;
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
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="Editor/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
<title>ADD PLANNER</title>
</head>
<body>

<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='50%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>ADD PLANNER</td>
			</tr>
            <tr>
				<td colspan="2" nowrap align="right"><?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td>
				<td><select name="school_division"  OnChange="ReloadMe();" >
				<option value='' >----  Select ----</option>
				<?
                	$sqlCourse=mysql_query("SELECT * FROM `course_m` WHERE status=1");
					while($r=mysql_fetch_array($sqlCourse))
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
      		<td><select name="grade" OnChange="ReloadMe();">
            <option value='' >----  Select ----</option>
			<?php
				$sqlCYear=mysql_query("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");
					while($r=mysql_fetch_array($sqlCYear))
					{
						if($grade==$r['year_id'])
							echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
						else
							echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
        
            ?> </select></td>
          </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Group Name&nbsp;&nbsp;</td>
				<td><select name="group_name">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlName=mysql_query("SELECT * FROM `pyp_group` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");
                        while($r=mysql_fetch_array($sqlName))
                        {
                            if($group_name==$r['id'])
                                echo "<option value='$r[id]' selected>$r[group_name]</option>";
                            else
                                echo "<option value='$r[id]'>$r[group_name]</option>";
                        }
            
                ?> </select></td>
            </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td><select name="title">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlTitle=mysql_query("SELECT * FROM `pyp_planner` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");
                        while($r=mysql_fetch_array($sqlTitle))
                        {
                            if($title==$r['id'])
                                echo "<option value='$r[id]' selected>$r[title]</option>";
                            else
                                echo "<option value='$r[id]'>$r[title]</option>";
                        }
            
                ?> </select></td>
            </tr>

            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><INPUT TYPE="text"  NAME="enq_sn" value="<?=$enq_sn?>" size="60"></td>
	        </tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Sub Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><INPUT TYPE="text"  NAME="enq_sub_sn" value="<?=$enq_sub_sn?>" size="60"></td>
	        </tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><select name="Nenq_sn">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlEnq=mysql_query("SELECT * FROM `pyp_add_planner` WHERE `status`=1 GROUP BY `enq_sn`");
                        while($r=mysql_fetch_array($sqlEnq))
                        {
                            if($Nenq_sn==$r['enq_sn'])
                                echo "<option value='$r[enq_sn]' selected>$r[enq_sn]</option>";
                            else
                                echo "<option value='$r[enq_sn]'>$r[enq_sn]</option>";
                        }
            
                ?> </select></td>
            </tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Sub Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><select name="Nenq_sub_sn">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlEnq=mysql_query("SELECT * FROM `pyp_add_planner` WHERE `status`=1 GROUP BY `enq_sub_sn`");
                        while($r=mysql_fetch_array($sqlEnq))
                        {
                            if($Nenq_sub_sn==$r['enq_sub_sn'])
                                echo "<option value='$r[enq_sub_sn]' selected>$r[enq_sub_sn]</option>";
                            else
                                echo "<option value='$r[enq_sub_sn]'>$r[enq_sub_sn]</option>";
                        }
            
                ?> </select></td>
            </tr>
	</table><br><br>
    	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>ADD PLANNER DETAIL</td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry&nbsp;&nbsp;</td>
				<td><textarea name="enquiry" cols="120" rows="4"><?=$enquiry?></textarea><br></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Sub - Enquiry&nbsp;&nbsp;</td>
				<td><textarea name="enq_sub" cols="120" rows="4"><?=$enq_sub?></textarea><br></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry Description&nbsp;&nbsp;</td>
				<td><textarea name="enq_des" cols="120" rows="4"><?=$enq_des?></textarea><br></td>
			</tr>

	</table>
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Save &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p><br>
	
<?php
		
	   $result=mysql_query("SELECT * FROM `pyp_add_planner` WHERE `status`=1 ORDER BY `id`");
		
	   if(mysql_num_rows($result)>0)
       {
	   ?>
	   
	  <table align='center' width='90%' border="1">
		<tr height='22' >
		    <td Class="head" align='center'>Sl no</td>
			<td Class="head" align='center'>School Division </td>
			<td Class="head" align='center'>Grade</td>
            <td Class="head" align='center'>Title</td>
            <td Class="head" align='center'>Enquiry Short Name</td>
            <td Class="head" align='center'>Sub Enquiry Short Name</td>
            <td Class="head" align='center'>Action</td>			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=mysql_fetch_array($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					if($i%2)
						echo "<tr class='clsname' >";
					else
						echo "<tr >";
						
	$SDivision=mysql_fetch_array(mysql_query("SELECT `coursename` FROM `course_m` WHERE `course_id`=$row[school_division] AND status=1"));
	$grade=mysql_fetch_array(mysql_query("SELECT `year_name` FROM `course_year` WHERE `year_id`=$row[grade] AND status=1"));
	$title=mysql_fetch_array(mysql_query("SELECT `title` FROM `pyp_planner` WHERE `id`=$row[title] AND status=1"));				
				
			 ?>
	         
            <td align="center"><?=$sno?></td>
            <td align='center' ><?=$SDivision[0]?></td>
            <td align='center' ><?=$grade[0]?></td>
            <td align='center' ><?=$title[0]?></td>
            <td align='center' ><?=$row['enq_sn']?></td>
            <td align='center' ><?=$row['enq_sub_sn']?></td>
            <td  align='center' >
            <input type="button"  value="&nbsp;&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;" onclick ="OpenWind2('add_planner_edt.php?id=<?=$row[id]?>&Type=group_edt', 'OpenWind2',1200,800)" class="bgbutton"/>
            
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
