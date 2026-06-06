<?php
session_start();
include("../db.php");


$col = "subj_".$subject_id;
$mainTab = "main_att_".$cid."_".$yrid;
$marksTab = "marks_".$cid."_".$yrid;
$absTab = "abs_att_".$cid."_".$yrid;

//first fetch total class condected and increment it ny 1 for next process below

$max_class = execute("select max(tot_class) from $mainTab where subject_id='$subject_id' and section='$section'") or die();

$max_class_row = fetcharray($max_class);

$cls_num = $max_class_row[0] + 1;


// loop through the classes condected on selected date 
for($t=1;$t<=$tot_class;$t++)
{
    //fetch total no of absent student from prev page and store them in following table
    $abs = "total_absent".$t;
    $abs_num = $$abs;    
	$insert_main = execute("insert into $mainTab(adate,subject_id,section,tot_class,tot_abs,no_of_stu,staff_id) values ('$att_date','$subject_id','$section','$cls_num','$abs_num','$totolstudent','$user')");

    $insertId = mysql_insert_id();
    $cnt = 0;
	
    //loop through each student 
    foreach($sid as $studid)
    {
		$att = "att".$studid.$t;
	    $att1 = $$att;
		
		if($att1=="")
		{
			if($tempstuid=='')
			$tempstuid=$studid;
			else
			$tempstuid=$tempstuid.",".$studid;	
			$sql1=execute("select id, cc , ca from $marksTab where studid='$studid' and subid='$subject_id'");
			if((rowcount($sql1))>0)
			{
				while($row1=fetcharray($sql1))
				{
					$cc1=$row1[cc]+1;
					$ca1=$row1[ca];
					execute("update $marksTab set cc='$cc1' , ca='$ca1' where id='$row1[id]'");
					
				}
			}
			else
			{
				execute("insert into $marksTab(studid ,subid , cc , ca , secid) values('$studid','$subject_id', 1 ,0 , '$section' )");	
			}
		}	
       else
	   {
			$sql1=execute("select id, cc , ca from $marksTab where studid='$studid' and subid='$subject_id'");
			
			if((rowcount($sql1))>0)
			{
				while($row1=fetcharray($sql1))
				{
					$cc1=$row1[cc]+1;
					$ca1=$row1[ca]+1;
					execute("update $marksTab set cc='$cc1' , ca='$ca1' where id='$row1[id]'");
					
				}
			}
			else
			{
			execute("insert into $marksTab(studid ,subid , cc , ca , secid) values('$studid','$subject_id', 1 ,1 , '$section' )");
			
			}
	   }
	   
	}
	$insert_abs = execute("update $mainTab set abs_stu_id='$tempstuid' where id='$insertId'");	
	$tempstuid="";
	
   $cls_num++;
}
?>
        <br> <br><center><font color='blue'>Updated Successfully </font></center><br> 