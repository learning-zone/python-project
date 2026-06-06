<?php
include("../db.php");
$col = "subj_".$subject_id;
$mainTab = "main_att_".$cid."_".$yrid;
$conTab = "cons_att_".$cid;
$tot_cls = execute("select id,tot_class,tot_abs from $mainTab where subject_id='$subject_id' and adate='$att_date' and section='$section' and stat_s='1'");
$tot_class = rowcount($tot_cls);
for($i=1;$i<=$tot_class;$i++)
{
    $tot_cls1 = fetcharray($tot_cls);
    $cls_id[$i] = $tot_cls1[id];
    $cls_num[$i] = $tot_cls1[tot_class];
    $cls_abs[$i] = $tot_cls1[tot_abs];
}
for($ii=1;$ii<=$tot_class;$ii++)
{
	$marksTab = "marks_".$cid."_".$yrid;
    $abs = "total_absent".$ii;
    $abs_num = $$abs;
	$tempstrstu=fetchrow(execute("select abs_stu_id from $mainTab where id='$cls_id[$ii]'"));
	$absstuidetails= explode(",",$tempstrstu[0]);
	for($k=0;$k<sizeof($absstuidetails);$k++)
	{
		$tempstuatt=fetchrow(execute("select ca from $marksTab where studid='$absstuidetails[$k]' and secid='$section' and subid='$subject_id'"));
		$tempnewatt=$tempstuatt[0]+1;
		execute("update $marksTab set ca='$tempnewatt' where studid='$absstuidetails[$k]' and secid='$section' and subid='$subject_id'");
	}
	$upd_mainTab = execute("update $mainTab set staff_id='$user' , tot_abs='$abs_num' where id='$cls_id[$ii]' and subject_id='$subject_id' and section='$section'");      
    $tempiddet=$cls_id[$ii];      
	foreach($sid as $studid)
    {
        $att = "att".$studid.$ii;
        $att1 = $$att;
        $att_ori = "att_ori".$studid.$ii;
        $att_old = $$att_ori;
            if($att1!=1)
            {
               if($tempstuid=='')
				$tempstuid=$studid;
				else
				$tempstuid=$tempstuid.",".$studid;	
            }
			if($att1=='')
			{
				$sql1=execute("select id, ca from $marksTab where studid='$studid' and subid='$subject_id'");
				if((rowcount($sql1))>0)
				{
					while($row1=fetcharray($sql1))
					{
						$ca1=$row1[ca]-1;
						execute("update $marksTab set ca='$ca1' where id='$row1[id]'");
						
					}
				}
			}
            $new_stat = $tot_class."/".$tot_present;
            execute("update $conTab set $col='$new_stat' where stud_reg_no='$studid'");
        
    }
	$insert_abs = execute("update $mainTab set abs_stu_id='$tempstuid' where id='$tempiddet'");	
	$tempstuid="";
}
if($date1!="")
{
    $date2 = explode("/",$date1);
    $att_date = $date2[2]."-".$date2[1]."-".$date2[0];
}

$cr_det = execute("select course_abbr from course_m where course_id='$cid'");
$cr_row = fetcharray($cr_det);

$yr_det = execute("select year_name from course_year where year_id='$yrid'");
$yr_row = fetcharray($yr_det);

if($section !=0)
{
    $rs_section=execute("select section_name from class_section where id=$section");
    $r_section=fetcharray($rs_section);
    $section_name=$r_section[0]." - Section";
}
else
{
    $section_name='No Section';
}
?>
 <br> <center><font color='blue'>Updated Successfully </font></center><br> 
        <center><a href="ex_FetchsubjectDet1.php">Go Back</a></center>