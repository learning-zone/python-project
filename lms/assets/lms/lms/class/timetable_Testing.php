<?php
session_start();
include("../db.php");

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

if($_GET)
{
	
	$msg=$_GET['msg'];
	$prm=$_GET['prm'];
	$semid=$_GET['semid'];
	$secid=$_GET['secid'];
	$rowColumn=$_GET['rowColumn'];	
}
//echo $rowColumn;
if($_POST)
{
	$prm=$_POST['prm'];
	$bid=$_POST['bid'];
	$prd=$_POST['prd'];
	$day=$_POST['day'];
	$act=$_POST['act'];
	$rsid=$_POST['rsid'];
	$semid=$_POST['semid'];
	$secid=$_POST['secid'];
	$hallno=$_POST['hallno'];
	$subcode=$_POST['subcode'];
	$subname=$_POST['subname'];
	$head_id=$_POST['head_id'];

}

		
if($_POST['adddet'])
{
	if($sub!=0 && $fac!='-1')
	{
		$chk=rowcount(execute("SELECT id FROM timetable WHERE hallno='$hallno' AND pid='$prd' AND weekday='$day'"));
		if($chk<1)
		{
			$chk1=rowcount(execute("SELECT id FROM timetable WHERE staffid='$fac' AND pid='$prd' AND weekday='$day'"));
			if($chk1<1)
			{
				$cc=fetcharray(execute("SELECT sub_type FROM subject_m WHERE subject_id='$sub'"));
				
				if($cc[sub_type]==2)
					$chk2=rowcount(execute("SELECT id FROM timetable WHERE course_id='$prm' AND sem_id='$semid' AND sec_id='$secid' AND batchid='$bid' AND sub_id='$sub' AND pid='$prd' AND weekday='$day'"));

				else

					$chk2=rowcount(execute("SELECT id FROM timetable WHERE course_id='$prm' AND sem_id='$semid' AND sec_id='$secid' AND sub_id='$sub' AND pid='$prd' AND weekday='$day'"));

				if($chk2<1)
				{

					$sn=fetcharray(execute("SELECT f_name FROM staff_det a WHERE a.slno='$fac'"));

					execute("INSERT INTO timetable (subjectcode,subname,hallno,staffid,staffname,course_id,sem_id,sec_id,batchid,pid,sub_id,weekday) values ('$subcode','$subname','$hallno','$fac','$sn[0]','$prm','$semid','$secid','$bid','$prd','$sub','$day')") or die ("Failed to add data to temp table");

					echo "<p align='center'><blink>Records Added</b></font>";

				}
				else
					echo "<p align='center'><blink>Time Table already assigned for this selection ...!!!</b></font>";
			}
			else
				echo "<p align='center'><blink>Time Table already assigned to this day / Period / Faculty...!!!</b></font>";
		}

		else
			echo "<p align='center'><blink>Time Table already assigned to this day / Period / Hall..!!!</blink></p>";
	}

	else

		echo "<font color=''><b>Select Subject & Subject Teacher ..!!!</b></font>";

	$act=1;

}

if(isset($_POST['submit2']))
{
	$act=2;
	if(is_array($rsid))
	{
		while( list(,$Value) = each($rsid) )
		{
			$hall=$_POST['hall'.$Value];
					
			if($hall=='')
				echo "<div><font color='brown'><b>Hall Number cannot be empty ...</b></font></div><br>";
			else
				$qry=execute("UPDATE hallno SET hall_no='$hall' WHERE id=$Value");
		}
		echo "<div><font color='brown'><b>Class room details updated ...</b></font></div><br>";
	}
	else
		echo "<div><font color='brown'><b>Please select checkbox ...</b></font></div><br>";
}
?>
<html>
<head>
<script language="JavaScript">
function reloadMe(rowColumn)
{
	//alert(rowColumn);
	document.frm.action="timetable_Testing.php?Type=ADD&rowColumn="+rowColumn;
	document.frm.submit();
}
</script>
<title>TIME TABLE TESTING</title>
</head>
<body>
<form name='frm' method='post' action="applytimetable.php">
<table align='center' border='0' class='forumline' width="70%">
	<tr>
    	<td colspan='4' class='head' align='center'>Time Table</td>
	</tr>
	<tr height='30'>
    	<td>&nbsp;&nbsp; School Division</td>
        <td colspan='3'>
        <select name='prm' onchange='reloadMe()'>
        <option value=0>-- Select --</option>   
        <?php
        
            $sql=execute("SELECT course_id,coursename FROM course_m order by head_id");
        
            while($r=fetcharray($sql))
            {
        
                if($prm==$r[0])
                    echo "<option value=$r[0] selected>$r[1]</option>";
                else
                    echo "<option value=$r[0]>$r[1]</option>";
        
            }
        
            ?>
    
        </select></td>
    </tr>
	<tr height='30'>
    	<td>&nbsp;&nbsp;Class</td>
        <td><select name='semid' onchange='reloadMe()'>
            <option value=0>-- Select--</option>
            <?php
            $sql=execute("SELECT * FROM course_year  WHERE head_id='$prm'");
        
            while($r=fetcharray($sql))
            {
                if($semid==$r[0])
                    echo "<option value=$r[0] selected>$r[1]</option>";
                else
                    echo "<option value=$r[0]>$r[1]</option>";
        
            }        
          ?>
        </select></td>
	<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section</td>
    <td>
	<?php
    if($secid=='0')
		$sel="selected";

	?>
	<select name='secid' onchange='reloadMe()'>
	<option value=''>-- Select--</option>
	<?php

	$sql=execute("select * from class_section where class_id='$semid'");

	while($r=fetcharray($sql))
	{
		if($secid==$r[0])
			echo "<option value=$r[0] selected>$r[1] - Section</option>";
		else
			echo "<option value=$r[0]>$r[1] - Section</option>";
	}
	?>
	</select></td>
   </tr>
</table><BR><BR>
<?
  			$grade=rowcount(execute("SELECT `id` FROM `classtime` WHERE `grade`='$semid'"));
			if($grade==0)
			{
				die('<center><blink>Manage Period Timings !!!</blink></center>');
			}
?>
<?PHP
if($secid!='' and $secid!='0')
{
	?>
  <table align='center' border='1' class='forumline'  width="100%">
	<tr>
    	<td colspan='30' class='head' align='center'>Assign Time Table</td>
	</tr>
    <tr>
    	<td class="row3" nowrap>&nbsp;&nbsp;</td>
        <?  
		 	$tdCount=0;
			$sql=execute("SELECT * FROM classtime WHERE grade='$semid'");
			$rowcount=rowcount($sql);
			if($rowcount>0)
			{
				$r=fetcharray($sql);								
				for($i=1;$i<=$r[nopd];$i++)
				{

					$fmp="fmp".$i; $top="top".$i; $am="p".$i;

					$am=$r[$am];

					if($am==0)
						$am="AM";
					elseif($am==1)
						$am="PM";

					$p=$r[$fmp]." to ".$r[$top]." ".$am;
					
				?>    			    
                    <td class="row3" nowrap>&nbsp;&nbsp;<?=$p?></td>
                 <?
				 		$tdCount++;
				}
			
			}
	
			$no_of_columns=$tdCount;
			?>
	</tr>
    <tr>
    	<td class="row3" nowrap>Monday</td>
    <?PHP
			$day=1;
			for($i=1;$i<=$no_of_columns;++$i)
			{
						
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>              				   
              <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
				  <select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
              <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				?>
				</select>
			
         </td> 	
		<?	
				}else{
					
					$field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
				
				

		}
?>
</tr>
    <tr>
    	<td class="row3" nowrap>Tuesday</td>
    <?PHP
			$day=2;
			//echo $tdCount;
			for($i=1;$i<=$no_of_columns;++$i)
			{
				
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>
				              				   
                <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
					<select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
               <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				echo "</select>";
			?>
         </td> 	
		<?	
				}else{
					     $field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
			

		}
?>
</tr>
 <tr>
    	<td class="row3" nowrap>Wednesday</td>
    <?PHP
			$day=3;
			//echo $tdCount;
			for($i=1;$i<=$no_of_columns;++$i)
			{
				
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>             				   
                <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onchange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
					<select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
               <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				echo "</select>";
			?>
         </td> 	
		<?	
				}else{
					     $field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
				
		}
?>
</tr>
 <tr>
    	<td class="row3" nowrap>Thursday</td>
    <?PHP
			$day=4;
			//echo $tdCount;
			for($i=1;$i<=$no_of_columns;++$i)
			{
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>               				   
                <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onchange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
					<select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
               <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				echo "</select>";
			?>
         </td> 	
<?	
				}else{
					     $field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
			

		}
?>
</tr>
 <tr>
    	<td class="row3" nowrap>Friday</td>
    <?PHP
			$day=5;
			//echo $tdCount;
			for($i=1;$i<=$no_of_columns;++$i)
			{
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>
			             				   
                <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onchange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
					<select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
               <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				echo "</select>";
			?>
         </td> 	
		<?	
				}else{
					     $field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}

		}
?>
</tr>
 <tr>
    	<td class="row3" nowrap>Saturday</td>
    <?PHP
			$day=6;
			//echo $tdCount;
			for($i=1;$i<=$no_of_columns;++$i)
			{
				$field_name="type".$i;
				$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
				if($type[0]==1)
				{
					
				?>              				   
                <td  align="right" nowrap>
           <!------------------------------------------------------------------------------------------------------->
           <select name='sub<?=$i.$day?>' onchange="reloadMe(<?=$i?><?=$day?>)">
				<option value='0'>--- Subject ---</option>
                <?				
				    $newSub=$_POST['sub'.$i.$day];
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 order by subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($newSub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$newSub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$day=='0')
						$s="selected";
					else
						$s="";
				?>
					<select name="bid<?=$i.$day?>" onChange="reloadMe(<?=$i?><?=$day?>)">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?
						 $newBid=$_POST['bid'.$i.$day];
					$sql=execute("select * FROM batch_master");

					while($r=fetcharray($sql))
					{

						if($newBid==$r[0])
							echo "<option value=$r[0] selected>$r[1]</option>";
						else
							echo "<option value=$r[0]>$r[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$newBid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$newSub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
				<option value=''>--- Faculty ---</option>
			<?
					$sql=execute($qry);
					
					$newFac=$_POST['fac'.$i.$day];
				while($r=fetcharray($sql))
				{
					if($newFac==$r[0])
						echo "<option value='$r[0]' selected>$r[1] $r[2]</option>";
					else
						echo "<option value='$r[0]'>$r[1] $r[2]</option>";
				}
			?>
				</select>
			<BR>
               <select name='hallno<?=$i.$day?>' onChange="reloadMe(<?=$i?><?=$day?>)">
               <option value=''>--- Hall No ---</option>
             <?
				$sql=execute("SELECT * FROM hallno");	
				
					$newHallno=$_POST['hallno'.$i.$day];	
				while($r=fetcharray($sql))
				{
					if($newHallno==$r[0])
						echo "<option value='$r[0]' selected>$r[1]</option>";
					else
						echo "<option value='$r[0]'>$r[1]</option>";
				}
				?>
				</select>
			
         </td> 	
	    <?	
				}else{
					     $field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
		}
?>
    </tr>
</table>
<!--<BR>
<p align="center"><input type='button' name='Save' value='Save' onClick='Save()' class='bgbutton' style="width:60px; height:22px"></p>-->
 <?
}
?>
</form>
</body>
</html>
