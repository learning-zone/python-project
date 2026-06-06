<html>
    <head>
        <script langauge="javascript">
			function confirmSubmit(e)
			{
				var disp='Do you want to apply';
				var agree=confirm(disp);
				if (agree)
					{
						document.frm.delete.value=e;
						document.frm.acti.value='delete';
						document.frm.action='test_mod_att.php';
						document.frm.submit();
						
					}

			}
            function calculate(stud_id,tot_cls)
            {
                tot_abs = parseInt(document.getElementsByName("total_absent" + tot_cls)[0].value);
                var a = document.getElementsByName("att"+stud_id+tot_cls)[0].checked;
                if(a==false)
                {
                    tot_abs = tot_abs + 1;
                    document.getElementsByName("total_absent" + tot_cls)[0].value = tot_abs;
                }
                if(a==true)
                {
                    tot_abs = tot_abs - 1;
                    document.getElementsByName("total_absent" + tot_cls)[0].value = tot_abs;                    
                } 
            }
        </script>
    </head>
    <body>
        <form name="frm" method="get" action='test_mod_att1.php' >
<?php
include("../db.php");
$elective=='N';
$section=$class_section_id;
$cid=$course;
$yrid=$FromYear;
$subject_id=$sub;
$mainTab = "main_att_".$cid."_".$yrid;
$marksTab = "marks_".$cid."_".$yrid;
if($acti=='delete')
{
	$acti=="";
	if($acti=='delete')
	{
		$tqury=execute("select id, cc, ca from $marksTab where secid='$section' and subid='$subject_id'");
		while($row1=fetcharray($tqury))
		{
			$temcc=$row1[cc]-1;
			$temca=$row1[ca]-1;
			execute("update $marksTab set cc='$temcc', ca=$temca where id='$row1[id]'");
		}
		$tqury1=execute("select id , abs_stu_id from $mainTab where id='$delete'");
		while($row2=fetcharray($tqury1))
		{
			$tempmaiat=$row2[id];
			$tempstudentda= explode(",",$row2[abs_stu_id]);
		}
		execute("update $mainTab set stat_s=0 where id='$delete'");
		for($et=0;$et<sizeof($tempstudentda);$et++)
		{
			$tqury3=execute("select id,ca from $marksTab where studid='$tempstudentda[$et]' and secid='$section' and subid='$subject_id'");
			while($row3=fetcharray($tqury3))
			{
				$canew=$row3[ca]+1;
				execute("update $marksTab set ca='$canew' where id='$row3[id]'");
			}
		}
		
	}
}
if($adate!="")
{
        $date2 = explode("/",$adate);
        $att_date = $date2[2]."-".$date2[1]."-".$date2[0];
}
if($course==0)
{
	$cr_row[0]='First Year';
}
else
{
	$cr_det = execute("select course_abbr from course_m where course_id='$course'");
	$cr_row = fetcharray($cr_det);
}
$yr_det = execute("select year_name from course_year where year_id='$FromYear'");
$yr_row = fetcharray($yr_det);
if($section!=0)
{
        $rs_section=execute("select section_name from class_section where id=$class_section_id");
        $r_section=fetcharray($rs_section);
        $section_name=$r_section[0]." - Section";
}
else
{
        $section_name='No Section';
}
if($elective=='Y')
{
    if($cid==0)
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
		$sqlstr.=" left join elective b on b.subject_id=$subject_id and b.student_id=a.id ";
		$sqlstr.=" where  a.class_section_id='$section' and a.course_yearsem='$yrid' and archive='N' ";
		$sqlstr.="  order by student_id";
	}
	else
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
		$sqlstr.=" left join elective b on b.subject_id=$subject_id and b.student_id=a.id ";
		$sqlstr.=" where a.course_admitted='$cid' and a.course_yearsem='$yrid' and archive='N' ";
		$sqlstr.=" and b.student_id is not null order by student_id";
	}
}
else
{
	if($cid==0)
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
		$sqlstr.=" where a.class_section_id='$section'  and a.course_yearsem='$yrid'and ";
		$sqlstr.=" archive='N' order by student_id";   
	}
	else
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
		$sqlstr.=" where a.class_section_id='$section' and a.course_yearsem='$yrid' and ";
		$sqlstr.=" a.course_yearsem='$yrid' and archive='N' order by student_id";   
	}
}
$stud_det = execute($sqlstr) or die(mysql_error());
$stud_num = rowcount($stud_det);
$tot_cls = execute("select id,tot_class,tot_abs,abs_stu_id from $mainTab where stat_s=1 and subject_id='$subject_id' and adate='$att_date' order by id");
$tot_class = rowcount($tot_cls);
if($tot_class==0)
{
        echo "<font color='blur' > <center>No Records Found</center></font>";
        ?>
        <br>
        <center><a href="ex_FetchsubjectDet1.php">Go Back</a></center>
        <?php
        die();
}
for($ii=1;$ii<=$tot_class;$ii++)
{
    $tot_cls1 = fetcharray($tot_cls);
    $cls_id[$ii] = $tot_cls1[id];
    $cls_num[$ii] = $tot_cls1[tot_class];
    $cls_abs[$ii] = $tot_cls1[tot_abs];
	
}

?>

        <input type="hidden" name="tot_class" value="<?php echo $tot_class ?>">
        <input type="hidden" name="cid" value="<?php echo $cid ?>">
        <input type="hidden" name="yrid" value="<?php echo $yrid ?>">
        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
        <input type="hidden" name="elective" value="<?php echo $elective ?>">
        <input type="hidden" name="att_date" value="<?php echo $att_date ?>">
        <input type='hidden' name="student_count" value="<?php echo $stud_num ?>">
        <input type='hidden' name="section" value="<?php echo $section ?>">   
        <input type="hidden" name="date1" value="<?php echo $adate ?>">
        <input type="hidden" name="subjectcode" value="<?php echo $subjectcode ?>">
        <input type="hidden" name="subjname" value="<?php echo $subjname ?>">

        <table border=0 align='center' width='85%' cellspacing='2' cellpadding='2' class='forumline'>
        <tr>
                <td ><B><font color='brown'>Date  : </font></b> <?php echo $adate ?></td>
                <td><b><font color='brown'>Program  :</font></b><?php echo $cr_row[0] ?></td>
                <td><b><font color='brown'>Term  : </font></b><?=$yr_row[0]?>/<?=$section_name?></td>
        </tr>
        <tr>
                <td><b><font color='brown'>Sub Code :  </font></b><?=$subjectcode?></td>
                <TD colspan='2'><b><font color='brown'>Subject : </font></b> <?=$subjname?></td>
        </tr>
        </table>
        <br>
		
            <table border='0' align='center' cellpadding='2' cellspacing='2' width='80%'>
            <?php
	            echo "<tr>";
                    echo "<td class='head' align='center'>SR Number</td>";
                    echo "<td class='head' align='center' >Name</td>";
                    for($tot=1;$tot<=$tot_class;$tot++)
                    {
                        echo "<td align='center' class='head'>Session-$cls_num[$tot]</td>";  
                    } 
					
                echo "</tr>";
                for($i=1;$i<=$stud_num;$i++)
                {
			
                    $stud_row = fetcharray($stud_det);
                    echo "<input type='hidden' name='sid[]' value='$stud_row[id]' checked>";
                    echo "<input type='hidden' name='stud_sec$stud_row[id]' value='$stud_row[class_section_id]' >";
                    echo "<tr>";
                    echo "<td align='center' nowrap>$stud_row[student_id]</td>";
                    echo "<td nowrap>&nbsp;&nbsp;$stud_row[first_name].$stud_row[last_name]</td>";

                    for($tot1=1;$tot1<=$tot_class;$tot1++)
                    {
                      
                        if($cls_abs[$tot1]>0)
                        {
				            $att_stat = execute("select abs_stu_id from $mainTab where id='$cls_id[$tot1]'");
							$tot_cls123 = fetchrow($att_stat);
							$tempst = $tot_cls123[0];
							$absstuid = explode(",",$tempst);
							for($m=0;$m<sizeof($absstuid);$m++)
							{
								if($stud_row[0]==$absstuid[$m])
								{
								$att_num_stat=1;
								$m=sizeof($absstuid);
								}
								else
								$att_num_stat=0;
							}
                        }
                        else
                        {
                            $att_num_stat=0;
                        }
						echo "<td align='center' nowrap>";
                        if($att_num_stat==0)
                        {
                            ?>
                            <input  type="hidden" name="att_ori<?php echo $stud_row[id] ?><?php echo $tot1 ?>" value="1"  checked>
                            <input type="checkbox" name="att<?php echo $stud_row[id] ?><?php echo $tot1 ?>" value="1" onClick="calculate('<?php echo $stud_row[id] ?>','<?php echo $tot1 ?>')"  checked>
                            <?php
                        }
                        else
                        {
                            ?>
                            <input type="hidden" name="att_ori<?php echo $stud_row[id] ?><?php echo $tot1 ?>" value=""   checked>
                            <input type="checkbox" name="att<?php echo $stud_row[id] ?><?php echo $tot1 ?>" value="1" onClick="calculate('<?php echo $stud_row[id] ?>','<?php echo $tot1 ?>')" >
                            <?php                          
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td>&nbsp;</td>";
                echo "<td colspan='1'>No of Students :<input type=text name='total_present' disabled size='5' value='$stud_num'></td>";
                for($t=1;$t<=$tot_class;$t++)
                {
                    echo "<td align='center'>Absent : <input type=text name='total_absent$t' readonly size='3' value='$cls_abs[$t]'> 
<br><a href='test_mod_att.php?acti=delete&delete=$cls_id[$t]&subjname=$subjname&subjectcode=$subjectcode&sub=$subject_id&course=$cid&FromYear=$yrid&class_section_id=$section&adate=$adate'>[ Delete ]</a></td>";
                
				   //echo "<div align='center'><A HREF='javascript:confirmSubmit($cls_id[$t])'>Apply</a></div>";
				  
				   
				} 
					//echo "<input type='text' name='delete' value=''>
				  // <input type='text' name='acti' value=''>";				
            ?>
            </table>
            <br>
           <center>
                <input type="submit" name="SaveMe" value="Update Attendance" class="bgbutton">
				
            </center>                
        </form>
        
    </body>
</html>