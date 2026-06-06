<?php
session_start();
require_once("../db.php");
$msg=$_REQUEST['msg'];
if($_POST)
{	
   $name=$_POST['name'];
   $m_id=$_POST['m_id'];   
   $class=$_POST['class'];
   $subgroup=$_POST['subgroup'];
}
if($msg)
{
?>
    <script language="javascript">
	   alert("<?=$msg?>");
    </script>
<?php
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script language="javascript">
	function adds_onclick()
	{
		document.frm.action="miscfee_head_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="miscfee_head_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="miscfee_head_edt.php?Type=Del";
		    document.frm.submit();
		}
		
		return true;
	}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>MISCELLANEOUS FEE SUBGROUP</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<table align='center' class=forumline width='60%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>MISCELLANEOUS FEE SUBGROUP</td>
			</tr>
			<tr height="25">
				<td align="center" class="row3">Group Name</td>
                <!--<td align="center" class="row3">Class</td>-->
                <td align="center" class="row3">Sub-Gruop Name</td>
             </tr>
             <tr>
              
				<td align="center"><select name='m_id' required>
                <option value=''>-------  Select   -------</option>
				<?php
					$sqlF=execute("SELECT id, name FROM `fee_misc_m` WHERE status = 1  ORDER BY id");
						while($row=fetcharray($sqlF))
						{
							if($m_id==$row['id'])
								echo "<option value='$row[id]' selected>$row[name]</option>";
							else
								echo "<option value='$row[id]' >$row[name]</option>";
						}
					?>
				</select></td>	
				<!--<td align="center"><select name='class'>
                <option value=''>-------  Select   -------</option>
			    <?php
   				$sqlC=execute("SELECT  year_id, year_name  FROM `course_year`  WHERE status = 1 ORDER BY `year_id`");
						while($r=fetcharray($sqlC))
						{
							if($class==$r['year_id'])
								echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
							else
								echo "<option value='$r[year_id]' >$r[year_name]</option>";
						}
					?>
				</select></td>-->
                <td align="center"><input type="text" name="subgroup" value="<?=$subgroup?>" required> </td>
                
			</tr>
	</table>
        
    <p align="center">
    <input type="button"  value="ADD" LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton' style="width:60px; height:20px"></p>
	
<?php
		
	   $resultDisplay=execute("SELECT * FROM `fee_misc_head` WHERE status=1 ORDER BY id");
		
	   if(rowcount($resultDisplay)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='60%'>
		<tr height='22' >
		    <td Class="head" align='center'>Select</td>
			<td Class="head" align='center'>Group</td>
            <!--<td Class="head" align='center'>Class</td>-->
			<td Class="head" align='center'>Sub-Group Name</td>			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=fetcharray($resultDisplay))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					echo   "<tr>";
					
			 ?>
	         
            <td align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>"></td>
			<td align='center' ><select name='<?=$row[id]?>m_id'>
                <option value=''>-------  Select   -------</option>
				<?php
								$m_id=$row['m_id'];
				$sqlF=execute("SELECT  id, name FROM `fee_misc_m`  WHERE status = 1 ORDER BY id");
						while($r=fetcharray($sqlF))
						{
							if($m_id == $r['id'])
								echo "<option value='$r[id]' selected>$r[name]</option>";
							else
								echo "<option value='$r[id]' >$r[name]</option>";
						}
					?>
				</select></td>
                <?
					    $string=$row['subgroup'];
      					$subgroup = str_replace('_', ' ', $string); 
						$subgroupNew = preg_replace('/([1-9][0-9]*)/', ' ', $subgroup); // TO HIDE NUMBERS IN WORD
				?>
             <td align='center'><input type="text"  Name="<?=$row[id]?>subgroup" value="<?=$subgroupNew?>"></td>
            	
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	 

 ?>
 </table>
 	<p align="center">
		<Input type="submit" Name="Modify" value="MODIFY" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="DELETE" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'>--> </p>
   <?
    }
?>
</form>

 </body>
 </html>
