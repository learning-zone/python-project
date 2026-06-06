<?php
include("../db.php");

if($date1!="")
{
        $date2 = explode("/",$date1);
        $att_date = $date2[2]."-".$date2[1]."-".$date2[0];
}

$cr_det = execute("select course_abbr from course_m where course_id='$cid'");
$cr_row = fetcharray($cr_det);

$yr_det = execute("select year_name from course_year where year_id='$yrid'");
$yr_row = fetcharray($yr_det);

$table =  "main_att_".$cid."_".$yrid;
$tot_class_det = execute("select max(tot_class) from $table where subject_id='$subject_id' and section='$section'");
$tot_class_row = fetcharray($tot_class_det);


$max_cls_det = execute("select cont_hours from subject_m where subject_id='$subject_id'");
$max_cls_row = fetcharray($max_cls_det);

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

if($elective=='Y')
{
    if($cid==0)
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
        $sqlstr.=" left join elective b on b.subject_id=$subject_id and b.student_id=a.id ";
        $sqlstr.=" where a.class_section_id='$section' and a.course_yearsem='$yrid' and archive='N' ";
        $sqlstr.=" order by student_id";
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
        $sqlstr.=" where a.class_section_id='$section' and ";
        $sqlstr.=" a.course_yearsem='$yrid' and archive='N' order by student_id";
	}
	else
	{
		$sqlstr="select a.id,a.student_id,a.first_name,a.last_name,a.class_section_id from student_m a ";
        $sqlstr.=" where a.class_section_id='$section' and a.course_admitted='$cid' and ";
        $sqlstr.=" a.course_yearsem='$yrid' and archive='N' order by student_id";
	}
	
}

$stud_det = execute($sqlstr) or die(mysql_error());
$stud_num = rowcount($stud_det);
?>
<html>
    <head>
        <script language="javascript">
            function reload()
            {
                document.frm.action="test_att.php";
                document.frm.submit();
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
        <form name="frm" method="post" action="test_att1.php">          
        <input type="hidden" name="tot_class" value="<?php echo $tot_class ?>">
        <input type="hidden" name="cid" value="<?php echo $cid ?>">
        <input type="hidden" name="yrid" value="<?php echo $yrid ?>">
        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
        <input type="hidden" name="elective" value="<?php echo $elective ?>">
        <input type="hidden" name="att_date" value="<?php echo $date1 ?>">
        <input type="hidden" name="student_count" value="<?php echo $stud_num ?>">
        <input type="hidden" name="section" value="<?php echo $section ?>">
        <input type="hidden" name="date1" value="<?php echo $date1 ?>">
        <input type="hidden" name="subjectcode" value="<?php echo $subjectcode ?>">
        <input type="hidden" name="subjname" value="<?php echo $subjname ?>">
        
        
        <table border=0 align='center' width='85%' cellspacing='2' cellpadding='2' class='forumline'>
        <tr>
                <td ><B><font color='brown'>Date  : </font></b> <?php echo $date1 ?></td>
                <td><b><font color='brown'>Program  :</font></b><?php echo $cr_row[0] ?></td>
                <td><b><font color='brown'>Class : </font></b><?=$yr_row[0]?>/<?=$section_name?></td>
        </tr>
        <tr>
                <td><b><font color='brown'>Sub Code :  </font></b><?=$subjectcode?></td>
                <TD colspan='2'><b><font color='brown'>Subject : </font></b> <?=$subjname?></td>
        </tr>
		<?php
		$temptablename="main_att_".$cid."_".$yrid;
		$sql2=execute("SELECT count(id) FROM $temptablename WHERE subject_id='$subject_id' and adate='$date1' and section='$section'");
		$tempvalue=fetchrow($sql2);
		?>
        <tr>
                <td><b><font color='brown'>No of Classes conducted today:  </font></b><?=$tempvalue[0]?></td>
                <TD colspan='2'><b><font color='brown'>No of Classes conducted : </font></b> <?=$tot_class_row[0]?></td>
        </tr>        
        </table>
        <br>
        <table border='0' align='center' cellpadding='2' cellspacing='2' width='55%'>
            <tr>
                
      <td class="head">Today`s Total Number Of Classes : </td>
                <td class="head">
                <input type='text' name="tot_class" size="5" value="<?php echo $tot_class ?>" >
                <input type="button" name="accept" value="ENTER" class="bgbutton" onClick="reload()">
                </td>
            </tr>
        </table>
        <?php
        
        ?>
        <table border='0' align='center' cellpadding='2' cellspacing='2' width='80%'>
            <?php
                echo "<tr>";
                    echo "<td class='head' align='center'>SR Number</td>";
                    echo "<td class='head' align='center'>Name</td>";
                    for($tot1=1;$tot1<=$tot_class;$tot1++)
                    {
                        echo "<td align='center' class='head'>Session$tot1</td>";  
                    }                  
                echo "</tr>";
               if($tot_class>0)
               {
			   echo "<input type='hidden' name='totolstudent' value='$stud_num'>";
                    for($i=1;$i<=$stud_num;$i++)
                    {
                        $stud_row = fetcharray($stud_det);
                        echo "<input type='hidden' name='sid[]' value='$stud_row[id]' checked>";
                        echo "<input type='hidden' name='stud_sec$stud_row[id]' value='$stud_row[class_section_id]' >";
                        echo "<tr>";
                        echo "<td align='center'>$stud_row[student_id]</td>";
                        echo "<td>&nbsp;&nbsp;$stud_row[first_name].$stud_row[last_name]</td>";
                        for($tot=1;$tot<=$tot_class;$tot++)
                        {
                            echo "<td align='center'>";
                            ?>
                            <input type="checkbox" name="att<?php echo $stud_row[id] ?><?php echo $tot ?>" value="1" onClick="calculate('<?php echo $stud_row[id] ?>','<?php echo $tot ?>')"  checked>
                            <?php
                            echo "</td>";
                        }
                        echo "</tr>";   
                   }
                   echo "<tr>";
                   echo "<td>&nbsp;</td>";
                   echo "<td colspan='1'>No of Students :<input type=text name='total_present' disabled size='5' value='$stud_num'></td>";
                   for($t=1;$t<=$tot_class;$t++)
                   {
                        echo "<td align='center'>Absent : <input type=text name='total_absent$t' readonly size='3' value='0'> </td>";
                   }
                   
               }
            ?>
            </table>
            <br>
            <center>
                <input type="submit" name="SaveMe" value="Save Attendance" class="bgbutton">
            </center>
            </form>
    </body>
</html>