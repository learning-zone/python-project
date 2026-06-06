<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db.php");

$msg=$_REQUEST['msg'];
if($_POST)
{
	
   $id=$_POST['id'];
   $school_division=$_POST['school_division'];
   $grade=$_POST['grade'];
   $ins_phone=$_POST['ins_phone'];
   $ins_fax=$_POST['ins_fax'];

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
				<td><select name="school_division"  OnChange="ReloadMe();">
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
      		<td><select name="grade">
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
				<td colspan="2" nowrap align="right">Teacher Name&nbsp;&nbsp;</td>
				<td><INPUT TYPE="text"  NAME="group_name" value="<?=$group_name?>" size="50"></td>
			</tr>
	</table>
        <br/>
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Save &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
	
<?php
		
	   $result=mysql_query("SELECT * FROM `pyp_group` WHERE `status`=1 ORDER BY `id`");
		
	   if(mysql_num_rows($result)>0)
       {
	   ?>
	   
	  <table align='center' width='90%' border="1">
		<tr height='22' >
		    <td Class="head" align='center' >Sl no</td>
			<td Class="head" align='center' >School Division </td>
			<td Class="head" align='center' >Grade</td>
			<td Class="head" align='center' >Teacher Name</td>
            <td Class="head" align='center' >Action</td>			
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
				
			 ?>
	         
            <td align="center" ><?=$sno?></td>
            <td align='center' >&nbsp;<?=$SDivision[0]?></td>
            <td align='center' >&nbsp;<?=$grade[0]?></td>
            <td align='center' >&nbsp;<?=$row[group_name]?></td>
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
