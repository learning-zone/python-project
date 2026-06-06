<?php
session_start();
include("../db.php");
echo "<pre>";
//print_r($_GET);
//print_r($_POST);
echo "</pre>";
	
	if(!$_REQUEST['store_stud'])
	{
		$store_stud=date("his");
	}
	else
	{
		$store_stud=$_REQUEST['store_stud'];
	}
	
$academic_year=$_SESSION['AcademicYear'];
if($_GET)
{
	$newtab=$_GET['newtab'];
	$tab=$_GET['tab'];
	$groupname=$_GET['groupname'];
}
if($_POST)
{		
	$sem=$_POST['sem'];
	$iflag=$_POST['iflag'];
	$subject=$_POST['subject'];
	$sub_det=$_POST['sub_det'];
	$sections=$_POST['sections'];
	$sections_det=$_POST['sections_det'];
	$groupname=$_POST['groupname'];
	$save=$_POST['save'];
	$teacher=$_POST['teacher'];
	$newtab=$_POST['newtab'];
	$staffs_det=$_POST['staffs_det'];
	
}

if($_GET['tab']!='')
	{
	   $p=$_GET['tab'];
	}
	elseif($_POST['tab']!='')
	{
	   $p=$_POST['tab'];
	}
	elseif($_POST['newtab'])
	{
	   $p=$_POST['newtab'];
	}
	else
	{
	    $p=1;
	}
?>

<?
///////////////////////////////////////////////////////////////////////////////////////////
//tem subject
//add
	if($_POST['subj_temp'])
	{
			$subject=$_POST['subject'];
		for($j=0;$j<sizeof($subject);$j++)
		{
			$subjes=$subject[$j];
			
			$totidss=explode(',',$subject[$j]);
			$subjeid=$totidss[0];
			$secid22=$totidss[1];
			
			$suts=execute("select id from subj_temp where sub_temp='$subjeid' and univat='$store_stud' and section='$secid'");
			if(rowcount($suts)>0)
			{
			}
			else
			{
				$rs_sub=execute("select sub_type,course_id,course_year_id from subject_m where subject_id='$subjeid'");
				while($r_sub44=fetcharray($rs_sub))
				{
				execute("INSERT INTO `subj_temp` (`sub_temp`,`subject_type`,`univat`,`section`,`head_id`,`sem`) VALUES ('$subjes','$r_sub44[0]','$store_stud','$secid22','$r_sub44[1]','$r_sub44[2]')");
				}
			}
		}
	}
//delete	
	if($_POST['removeallvat'])
	{
			$sub_det=$_POST['sub_det'];
		for($j=0;$j<sizeof($sub_det);$j++)
		{
			$subjes_det=$sub_det[$j];	
			execute("delete from subj_temp where id='$subjes_det'");
		}
	}
	//end
///////////////////////////////////////////////////////////////////////////////////////////////	
?>


<?
/////////////////////////////////////////////////////////////////////////////////////////
//tem staff
//add
	if($_POST['staff_temp'])
	{
			$teacher=$_POST['teacher'];
		for($j=0;$j<sizeof($teacher);$j++)
		{
			$tesch=$teacher[$j];
			$teache=execute("select id from staff_temp where staff_temp_id='$tesch' and univat='$store_stud'");
			if(rowcount($teache)>0)
			{
			}
			else
			{
			execute("INSERT INTO `staff_temp` (`staff_temp_id`,`univat`) VALUES ('$tesch','$store_stud')");
			}
		}
	}
//delete	
	if($_POST['removeallvat'])
	{
			$staffs_det=$_POST['staffs_det'];
		for($j=0;$j<sizeof($staffs_det);$j++)
		{
			$stafss_det=$staffs_det[$j];	
			execute("delete from staff_temp where staff_temp_id='$stafss_det'");
		}
	}
	//end
/////////////////////////////////////////////////////////////////////////////////////////////////////
?>


<?
//////////////////////////////////////////////////////////////////////////////////////////////////
//tem section,sem
//add
	if($_POST['sub_sec'])
	{
		$sem=$_POST['sem'];
		for($j=0;$j<sizeof($sem);$j++)
		{
			$brsnc=explode(',',$sem[$j]);
			$semid=$brsnc[0];
			$secid=$brsnc[1];
				
			$teache=execute("select id from sect_temp where sect_temp_id='$secid' and univat='$store_stud' and sem='$semid'");
			if(rowcount($teache)>0)
			{
			}
			else
			{
				
			execute("INSERT INTO `sect_temp` (`sect_temp_id`,`univat`,`sem`) VALUES ('$secid','$store_stud','$semid')");
				
			}
		}
	}
	//end
/////////////////////////////////////////////////////////////////////////////////////////
?>




<?php
///////////////////////////////////////All the Code for insert///////////////////////////////

if($_POST['save'])
{
	
		$subcheckss=execute("select id from subj_temp where univat='$store_stud'");
		$staffchecks=execute("select id from staff_temp where univat='$store_stud'");
		
		if(rowcount($subcheckss)>0 and rowcount($staffchecks)>0)
		{
		$groupinsrts="INSERT INTO `staff_groupnames` (`grupname`,`status`) VALUES ('$groupname','1')";
		$grouplastid=execute($groupinsrts);
		$groupsids=fetchInsertId($grouplastid);
		}
		else
		{
			?>
				<Script language="JavaScript">
                alert("Enter Proper Data");
                </Script>
            <?
		}
		$allvat=execute("select sub_temp,subject_type,section,head_id,sem from subj_temp where univat='$store_stud'");
		while($allvat1=fetcharray($allvat))
		{
			$staffidsss=execute("select staff_temp_id from staff_temp where univat='$store_stud'");
			while($staffidsss1=fetcharray($staffidsss))
			{
				$staff_auto_id=fetchrow(execute("select slno from staff_det where id='$staffidsss1[0]'"));
				
				
				$teache=execute("select id from staff_rights where staff_id='$staffidsss1[0]' and year_id='$allvat1[4]' and subject_id='$allvat1[0]' and class_section_id='$allvat1[2]'");
				if(rowcount($teache)>0)
				{
				}
				else
				{
					
			execute("insert into staff_rights(staff_id,subject_id,course_id,year_id,subject_type,class_section_id,StaffID,groupnames_id) VALUES ('$staffidsss1[0]','$allvat1[0]','$allvat1[3]','$allvat1[4]','$allvat1[1]','$allvat1[2]','$staff_auto_id[0]','$groupsids')");
				}
			
			}
		}
			execute("delete from `sect_temp`");
			execute("delete from `subj_temp`");
			execute("delete from `staff_temp`");
	if(rowcount($subcheckss)>0 and rowcount($staffchecks)>0)
		{
	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=stud_rprts_modi.php?groupname=$groupsids'>";
	?>
		<script type="text/javascript">
        alert("Inserted Successfully");
        </script>
    <?	
		}
			
}

////////////////////////////////////////////end/////////////////////////////////////////////
?>



<html>
<head>
<script type="text/javascript">
	function Reload(token)
	{
	document.frm.action="class_group.php?sem="+token;
	document.frm.submit();
	}
</script>

<script type="text/javascript">
	function reloadme()
	{
	document.frm.action="class_group.php";
	document.frm.submit();
	}
</script>
</head>
<body>

<form Name="frm" action="class_group.php" method="post">   
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="store_stud" value="<?=$store_stud?>"/>
<input type="hidden" name="groupname" value="<?=$groupname?>"/>

<? if($tab) {?>
<input type="hidden" name="newtab" value="<?=$tab?>"/>
<? } if($newtab) {?>
<input type="hidden" name="newtab" value="<?=$newtab?>"/>
<?
}
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<table  align='center' border="1" width="90%" cellpadding="0" cellspacing="0">
<tr>
<td Class="head" align='center' colspan="5">Create Group</td>
</tr>
<tr>
 <td valign="top" width="10%" nowrap align="center" rowspan="2">
  <div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
 <?
	if($p==1 || $p==2){
		?>
        <li class="currentBtn"><a href="class_group.php?tab=1" >ADD NEW</a></li>
        <?
	}else{
		?>
        <li><a href="class_group.php?tab=1" >ADD NEW</a></li>
        <?
	}
?>
      <li><a href="stud_rprts_modi.php" >Modify</a></li>
       </ul>
</div>
</div>
 <br>
 <input type="text" name="groupname"  value="<?=$groupname?>" STYLE="width:150px" placeholder="Group Name *"  required>
 <br>
<b>Grade</b><br>
    <select name="sem[]" STYLE="width:150px;height:290px" multiple>
   <?php
    $rs=execute("SELECT a.year_name,a.year_id,c.s_name,c.id FROM course_year a,course_m b,class_section c,section_temp d where a.head_id=b.head_id and c.id=d.section and a.year_id=d.class group by a.year_id,c.s_name order by a.year_id,c.id");
    while($r=fetcharray($rs))
    {
        if($sem==$r[year_id] && $r[3])
        {
            echo "<option value='$r[year_id],$r[3]' selected> $r[year_name] $r[s_name]</option>";
        }
            else
        {
            echo "<option value='$r[year_id],$r[3]'> $r[year_name] $r[s_name]</option>";
        }
    }
    ?>
    </select>
    </td>
    <td width="5%" align="center" rowspan="2">
   <input type='submit' name='sub_sec' value='>>' class='bgbutton'>
    </td>
     <td valign="top" width="10%" nowrap align="center" rowspan="2">
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==1){
		?>
        <li class="currentBtn"><a href="class_group.php?tab=1&store_stud=<?=$store_stud?>&groupname=<?=$groupname?>" >Subject</a></li>
        <?
	}else{
		?>
        <li><a href="class_group.php?tab=1&store_stud=<?=$store_stud?>&groupname=<?=$groupname?>" >Subject</a></li>
        <?
	}
?>
<?
	if($p==2 ){
		?>
        <li class="currentBtn"><a href="class_group.php?tab=2&store_stud=<?=$store_stud?>&groupname=<?=$groupname?>" >Staff</a></li>
        <?
	}else{
		?>
        <li><a href="class_group.php?tab=2&store_stud=<?=$store_stud?>&groupname=<?=$groupname?>" >Staff</a></li>
        <?
	}
?></ul>
</div>
</div>

 <br>
<?
if($p==1)
{

?> 
    <select name="subject[]" STYLE="width:250px;height:300px" multiple>
 <?
        	
        	$rs_sub=execute("select a.subject_id,c.id,a.subject_code,c.s_name from subject_m a,sect_temp b,class_section c where a.course_year_id=b.sem  and a.status=1 and b.univat='$store_stud' and c.id=b.sect_temp_id group by a.subject_id,b.sect_temp_id  order by b.sem,c.id");
		
        while($r_sub=fetcharray($rs_sub))
        {
			if($subject==$r_sub[subject_id] && $r_sub[1])
			echo "<option value='$r_sub[subject_id],$r_sub[1]' selected>$r_sub[subject_code]  $r_sub[s_name]</option>";
			else
			echo "<option value='$r_sub[subject_id],$r_sub[1]'>$r_sub[subject_code]  $r_sub[s_name]</option>";
		
		}
    ?>
    </select>
<?
}
if($p==2)
{
?>    
 <select name="teacher[]" STYLE="width:250px;height:300px" multiple>
	<?php
	
	$dd1=execute("select a.id, a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	$countBR1=rowcount($dd1);
	for($i1=0;$i1<$countBR1;$i1++)
	{
		$rBR1 = fetcharray($dd1);
		if($teacher==$rBR1[id])
		{
			echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
			else
		{
			echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
	}
	?>
	</select>
    <?
}
	?>   
    </td>
	<?
    	if($p==1)
    {
		
    ?>
   <td width="5%" align="center" rowspan="2">
   <input type='submit' name='subj_temp' value='>>' class='bgbutton'>
   <br>
   <br>
    <?
	}
	?>
    <?
    	if($p==2)
    {
		
		
?> 
   <td width="5%" align="center" rowspan="2">
   <input type='submit' name='staff_temp' value='>>' class='bgbutton'>
   <br>
   <br>
    <?
	}
	?>
     <input type='submit' name='removeallvat' value='<<' class='bgbutton'>
    </td>
    <td valign="top" width="15%"  nowrap align="center">
    <b>Applied Subject</b>
    <br>
    <select name="sub_det[]"  STYLE="width:250px;height:170px"  multiple >
		<?
    	 $sect12.="select a.id,b.subject_code,c.s_name from subj_temp a,subject_m b,class_section c where b.subject_id=a.sub_temp and a.univat='$store_stud' and c.id=a.section group by b.subject_id,a.section order by b.course_year_id,c.id"; 
		$rs_section=execute($sect12);
        for($i=0;$i<rowcount($rs_section);$i++)
        {
            $r_section=fetcharray($rs_section,$i);
            if($sub_det==$r_section[0])
            echo "<option value='$r_section[0]' selected>$r_section[1]  $r_section[2]</option>";
            else
            echo "<option value='$r_section[0]'>$r_section[1]  $r_section[2]</option>";
        }
        ?>
</select>
</td>
</tr>
<tr>
 <td valign="top" width="15%"  nowrap align="center">
 <b>Applied Staff</b>
 <br>
    <select name="staffs_det[]"  STYLE="width:250px;height:170px"  multiple >
		<?
    	 $sect123.="select a.staff_temp_id,b.f_name,b.s_name from staff_temp a,staff_det b where b.id=a.staff_temp_id and a.univat='$store_stud' group by a.staff_temp_id order by  b.f_name"; 
		$rs_section3=execute($sect123);
        for($i=0;$i<rowcount($rs_section3);$i++)
        {
            $r_section=fetcharray($rs_section3,$i);
            if($staffs_det==$r_section[0])
            echo "<option value='$r_section[0]' selected>$r_section[1] $r_section[2]</option>";
            else
            echo "<option value='$r_section[0]'>$r_section[1] $r_section[2]</option>";
        }
        ?>
</select>
</td>
</tr>
</table>
<br>
<div align='center'><input type='submit' name='save' value='Save' class='bgbutton'></div>

</form>
</BODY>
</HTML>
