<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1" />
<style type="text/css">
div.page
{
page-break-after: always;
page-break-inside: avoid;
}
      p.vertical
     {
           writing-mode:tb-lr;
           -webkit-transform:rotate(270deg);
           -moz-transform:rotate(270deg);
           -o-transform: rotate(270deg);
           white-space:nowrap;
           display:block;
           bottom:0;
           //width:90px;
           //height:120px; 
           position:relative;
           //left:110px;
           top:0px;
    }
</style>
<style type="text/css">
<!--
body {  
    background-image:url('Logo2.jpg');
    background-position:top;  
    background-repeat:repeat-y;
    background-size: 1000px;
    font-size: 12px;
    margin-top: 10px;
    border-bottom-left-radius:0px;
    border-bottom-right-radius:0px;
    border-top-left-radius:0px;
    border-top-right-radius:0px;
    font-family:"Times New Roman","serif";
}

table.forumline { 
    /*font-family: Arial, Helvetica, sans-serif;*/
    
    font-size: 6px;
    
    
    /*border-spacing: 4px;
    margin-top: 2px;
    padding-top:20px;
    padding-bottom:20px;
    padding-right:20px;
    padding-left:20px;*/
}
forumline.td{
  text-align:justify;
}
td{
    //text-align:justify;
    font-size:14px;
}
td.row3 { 
    
    background-color:#91D04E;
    text-align: justify;
    font-family:"Times New Roman","serif";

}

td.row4 { 
    
    background-color:#91D04E;
    text-align: center;
    font-family:"Times New Roman","serif";

}

div.hardcode{
    font-size: 1px;
}
</style>

<?php
session_start();
include("../db1.php");

$name=execute("SELECT *  FROM college");
     while($rc=fetcharray($name))
    {
        $_SESSION['SchoolName']=$rc['col_name'];
        $_SESSION['SchoolCode']=$rc['col_code'];
        $_SESSION['SchoolAddress']=$rc['col_addr']." ".$rc['col_city']." ".$rc['col_state']." Pin : ".$rc['col_pin'];
    }
    $date1=date("Y-m-d");
    $sql_id=fetchrow(execute("select acc_year from academic_year where  status=1 and ( '$date1' Between from_date and to_date )"));
    
    
    $a_year=$sql_id[0];


//$a_year=$_SESSION['AcademicYear'];
$accname=$a_year+1;
$accname1=$a_year."-".$accname;
//sname="comments_".$a_year;
if($_POST['branch']!='')
{
    $stuid=$_POST['stuid'];
    $stuname=$_POST['stuname'];
    $branch=$_POST['branch'];
    $sem=$_POST['sem'];
    $examid=$_POST['examid'];
    $studentid=$_POST['studentid'];
    $class_section_id=$_POST['class_section_id'];
    $stundetname=$_POST['stundetname'];
    $admissionid=$_POST['admissionid'];
    $student_id=$_POST['student_id'];
    $check=$_POST['check'];
}
else
{
    $stuid=base64_decode($_REQUEST['stuid']);
    $stuname=base64_decode($_REQUEST['stuname']);
    $branch=base64_decode($_REQUEST['branch']);
    $sem=base64_decode($_REQUEST['z']);
    $examid=base64_decode($_REQUEST['e']);
    $studentid=base64_decode($_REQUEST['studentid']);
    $class_section_id=base64_decode($_REQUEST['c']);
    $stundetname=base64_decode($_REQUEST['stundetname']);
    $admissionid=base64_decode($_REQUEST['admissionid']);
    $student_id=base64_decode($_REQUEST['x']);
    $masteexamn=base64_decode($_REQUEST['m']);
    $unit=base64_decode($_REQUEST['u']);

}
    $classsections=base64_decode($_REQUEST['c']);


?>
<script LANGUAGE="JavaScript">
function setPageBreak()
{
    document.getElementById("footer").style.pageBreakAfter="always";
}
function prn()
{
    pr1.style.display = "none";
    window.print();
}
</script>
<title>MySchoolOne</title>
</head>
<body>
<style>
body
{ 
  background: url(Logo2.jpg) no-repeat center center ; 
  /*-webkit-background-size: cover;
  -moz-background-size: cover;*/
  -o-background-size: cover;
  background-size: cover;
}
</style>
<?php
$sqlt=execute("select * from college");
while($r=fetcharray($sqlt))
{
    
    $col_name=$r['col_name'];
    $col_code=$r['col_code'];
    $col_addr=$r['col_addr'];
    $col_pin=$r['col_pin'];
    $col_phone=$r['col_phone'];
    $col_fax=$r['col_fax'];
    $email=$r['email'];
}
    $rs_ec=execute("select sub_id, descr, f_date, t_date from exam_m where id='$examid'");
    while($r1=fetcharray($rs_ec))
    {
        $subid=explode(',',$r1['sub_id']);
        $examnamed1=$r1['descr'];
        $exam_des=$r1['exam_des'];
        $f_date=$r1['f_date'];
        $t_date=$r1['t_date'];
    }
    $att_table='att_'.$sem;


?>
<br>
 <?php
        $examnsme=fetcharray(execute("select * from dp_exam_sub_m where id='$examid'"));
       ?>
       <!--<title><?=$examnsme[exam_name]?></title>-->
<table cellpadding="5" cellspacing="0" border="0" width="90%" align="center">
<tr>
<td align="center" ><div align="center"><img src="oberoilogo.png" width="150" title=""></div><br></td>
    <?php
    $studenname=execute("select first_name,last_name,dob from student_m where id='$student_id'");
    $stundetname1=fetcharray($studenname);
    $homeroomid=fetchrow(execute("select sub from class_section where id='$classsections'"));
    $course_year=fetchrow(execute("select year_name from course_year where year_id='$sem'"));
    $course_m=fetchrow(execute("select course_id from course_m where course_id='$branch'"));
    ?>
    <tr>
        <td colspan="5" align="center"  style="font-size:23px">
        
        <b><!--<?=$examnsme[exam_name]?>-->Academic year 2013-2014</b>        
    </td>
    </tr>
        <tr>
       <td colspan="5" align="center"><strong>Date: 06/05/2014&nbsp;&nbsp;&nbsp;Semester: II</strong><!--<?=$dt=date('d/m/Y',strtotime($examnsme[to]));?>--></td>
        </tr>
        </table>
        
            <table cellpadding="5" cellspacing="0" border="0" width="90%" align="center">

        <tr>
       <td colspan="5" align="left"><b>Student name : <?=$stundetname1[0]?>&nbsp;<?=$stundetname1[1]?></b></td>
        </tr>
        <?
        
        $stucourse=execute("SELECT sub_sec FROM `student_course` WHERE stu_id='$student_id' and acc_year='$a_year' and class='$sem'");
    $stucourse2=fetcharray($stucourse);
    
    $staffcourse=execute("SELECT home_teac FROM `all_teachers` WHERE  section='$classsections'");
    $staffcourse2=fetcharray($staffcourse);
    
    $vicepvt=execute("SELECT `f_name`,`s_name`,`gender` FROM `staff_det` WHERE `id`='$staffcourse2[0]' and active='YES'");
    $viceplas=fetcharray($vicepvt);
    if($viceplas[2]=='FEMALE')
    $salutaion='';
    else
    $salutaion='';

$homeroomteacher="$viceplas[0] $viceplas[1]";

?>
    <tr>
        <td width="40%" nowrap><b>Grade : <?php
        $sql5=execute("SELECT year_name FROM course_year where year_id='$sem'");
        $grade_name=fetchrow($sql5);
        echo $grade_name[0];
        ?></b></td>
    </tr>
    <tr>
        <td width="40%" nowrap><b>Homeroom Teacher : <!--<?=$salutaion?>-->
        <?=$viceplas[0]?>&nbsp;<?=$viceplas[1]?>
        </b></td>
    </tr>
  <!--<tr>
        <td width="40%" nowrap><b>Date of Birth : 
        <?=$dt=date('d/m/Y',strtotime($stundetname1[dob]));?>
        </b></td>
    </tr>-->
 </table><br>
 <table class="data" cellpadding='0' cellspacing="0" border="1" width="90%" align="center">
    <tr>
        <td align="center">
 <table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
    <tr>
        <td colspan="2" align="center"><strong>Progress Indicator</strong>
      </td>
    </tr>   
    <tr>
        <td width="40%" >&nbsp;<strong><u>Achievement :</u></strong>
        </td>
        <td align="justify">&nbsp;
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong>I - Independent:</strong>
        </td>
        <td align="justify">Consistently demonstrates knowledge, skills and or
understanding of concepts. Applies and /or makes connections
in a variety of situations independently.
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong>D - Developing:</strong>
        </td>
        <td align="justify">Demonstrates knowledge, skills and or understanding of
concepts with occasional support. Applies and /or makes
connections. Requires occasional support.
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong>E - Emerging:</strong>
        </td>
        <td align="justify">Beginning to demonstrate knowledge, skills and or
understanding of concepts. Beginning to apply and /or makes
connections. Requires support.
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong>L - Limited progress:</strong>
        </td>
        <td align="justify">Demonstrates limited knowledge, skills and or understanding of
concepts. Experiences difficulty applying and /or making
connections. Requires individual support.
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong>N/A</strong>
        </td>
        <td align="justify">Not covered in this semester
        </td>
    </tr>   
    <tr>
        <td >&nbsp;<strong><u>Effort:</u></strong>
        </td>
        <td align="justify">&nbsp;<strong>Additional Services</strong>
        </td>
    </tr>   
    <tr>
        <td >1 - Rarely demonstrates best effort<br>
2 - Occasionally demonstrates best effort<br>
3 - Usually demonstrates best effort<br>
4 - Consistently demonstrates best effort
        </td>
  <?php
  
  $sqlSub=execute("SELECT c.subject_name FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id AND b.status=1 AND c.subject_id=b.sub");
  
  while($rsub=fetcharray($sqlSub)){
      
      if($rsub[subject_name]=='SSP'){
          $SSPsubject='&#10004;';    
      }
      if($rsub[subject_name]=='EAL'){
          $EALsubject='&#10004;';         
      }
  }   
     
  ?>
        <td align="justify">EAL services [ <?=$EALsubject?> ]<br>
        SSP (Student Success Program) services [ <?=$SSPsubject?> ]
        </td>
    </tr>   
 </table> 
</td></tr></table>
<?php
$remarkds=='';
$sql7=execute("SELECT id FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$a_year'");
while($r7=fetcharray($sql7))
{
    $sql8=execute("SELECT id FROM `dp_exam_sub_m` where `class`='$sem' and status=1 and acc_year='$a_year' and exam_id='$r7[id]'");
    while($r8=fetcharray($sql8))
    {
        $examid=$r8[id];
        $unitnamesnew=execute("select unit,id from msp_unit where status=1  and exam_id='$r8[id]' order by posi");
        while($unitnames=fetcharray($unitnamesnew))
         {
            $unit=$unitnames[id];   
            $sqtestrem=execute("select remarks from obe_skill_mark where student_id='$student_id' and  sem_id='$examid'  and unit='$unit'");
            while($sqtestrem2=fetcharray($sqtestrem))
            {
                $remarkds.=$sqtestrem2[0];
            }
         }
    }
}
if($remarkds)
{
    ?>
    <div class='page'></div>
     <table cellpadding="5" cellspacing="0" border="0" width="90%" align="center">
     <tr>
        <td width="40%" nowrap>Dear Parents,<br></td>
    </tr>
    <tr>
        <td colspan='4'>Please find below your child's school end of unit report. The transdisciplinary skills and learner profiles have been discussed in your child's general comment for the Unit of Inquiry (UOI).
        </td>
    </tr>
</table>
     <?php
    $flag1=1;
    // select unit,id from msp_unit where status=1  and exam_id='$examid' order by posi
$sql7=execute("SELECT id,exam_name FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$a_year'");
//echo "SELECT id,exam_name FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$a_year'<br>";
while($r7=fetcharray($sql7))
{
    $sql8=execute("SELECT id,exam_name FROM `dp_exam_sub_m` where `class`='$sem' and status=1 and acc_year='$a_year' and exam_id='$r7[id]'");
    
    while($r8=fetcharray($sql8))
    {
        $examid=$r8[id];
        $unitnamesnew=execute("select unit,id from msp_unit where status=1  and exam_id='$r8[id]' order by posi");
		$i=1;
        
        while($unitnames=fetcharray($unitnamesnew))
         {
             
               $unit=$unitnames[id];
               $remarkds='';
            
               $sqtestrem=execute("select remarks from obe_skill_mark where student_id='$student_id' and  sem_id='$examid'  and unit='$unit'");
               
              
                while($sqtestrem2=fetcharray($sqtestrem))
                {
                    $remarkds=$sqtestrem2[0];
                }
            if($remarkds)                  
            {
                $flag1=0;
                   ?>
                
            <table cellpadding="5" cellspacing="0" border="1" width="90%" align="center">
            <tr>
            <td ><b><?=$unitnames[unit]?></b>
            </td>
            </tr>
            <?php
            
            $sql3=execute("select id, idea, theme,keyconc from ideas where acc_year='$a_year' and class='$sem' and exam_id='$examid' and unit='$unit'");
            while($r6=fetcharray($sql3))
            {
                $idaers=$r6[1];
                $themess=$r6[2];
                $keyscc=$r6[3];
            }
            ?>
            <tr>
            <td><b>Transdisciplinary Theme:</b>&nbsp;&nbsp;<?=$themess?></td>
            </tr>
            <tr>
            <td><b>Central Idea:</b>&nbsp;&nbsp;<?=$idaers?></td>
            </tr>
             <tr>
            <td><b>Key Concepts:</b>&nbsp;&nbsp;<?=$keyscc?></td>
            </tr>
             <tr>
            <td><b>Lines of Inquiry:</b>
            <br>
            <?php
            //and exam_id='$examid' 
            //$remarkds='';
            $sqtest=execute("select sub_skill from  pyp_subskills where acc_year='$a_year' and class='$sem' and unit='$unit' and examid='$examid' order by posi");
        while($sqtest1=fetcharray($sqtest))
            {
            ?>
            &nbsp;&nbsp;&#8226;&nbsp;<?=$sqtest1[0]?><br>
            <?
            }
                 $comments=str_replace('...', '.', $remarkds);
                 //echo "<br>".$comments;
            
            ?>
            </td>
            </tr>
           <tr>
             <td><small><?=htmlspecialchars($comments)?>&nbsp;</small></td>
            </tr>
         </table>
         <br><br>
         <?php
         
        
            }
			 if($i>1 && $i%2==0)
         {
         ?>
         <div class='page'></div>
         
         <?
         }
            $i++;
         }
    }
}
}
if($flag1)
echo " <div class='page'></div><br>";
     $k=0;
     
     
     // type 0,1,2,3 code starts
        
     $sql_type=execute("SELECT c.subject_id, a.sub_sec,c.sub_pre,b.id FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND c.sub_type!=2 AND c.sub_type!=3 AND b.grade!=0 and c.subject_name not like '%Unit of Inquiry%' and c.subject_name not like '%EAL%' and c.subject_name not like '%Homeroom%' group by a.sub_sec order by c.sub_pre");
     
    
    
     
     $table_count=0;
     while($rrr=fetcharray($sql_type))
     {
         
    
                $subjectid=$rrr[subject_id];
            
                $teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$rrr[sub_sec]' AND acc_year='$a_year'")); 
                $className=fetcharray(execute("SELECT subject_name, subject_id FROM subject_m WHERE subject_id='$rrr[subject_id]' AND status=1"));
                
                if($teacherID['sub_teac'])
                {
                    $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
                }
                else
                {
                    $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
                }
                if($teacherName[2]=='FEMALE')
                $salutaion='';
                else
                $salutaion='';
                
                
                
                
                $type=execute( "select * from master_skills where sub='$className[1]' and status='1' and (mark='1' or mark='2' or mark='3') order by mark");
                
                
                
                
                if(rowcount($type)!='')
                {
                    
    //--------------------------(type3 & type0) or type1 starts------------------------------------//
                    $type3=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='3' order by mark");
                     if(rowcount($type3)!=NULL)
                     {
                         $lang=fetcharray(execute("SELECT  subject_code  FROM subject_m WHERE subject_id='$className[subject_id]' AND status='1' and subject_code like '%Lan%'"));
                            
                        ?>  <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                            <?php
                             if($lang)
                             {
                                 ?>
                                 <tr>
                    <td    class="row3" nowrap><strong>
                      Literacy</strong></td>
                      <td class="row4"><b>Semester 2</b></td>
                                 </tr>
                                 <?php
                             }
                            else
                            {
                            ?>
                  <tr>
                    <td class="row3"  nowrap><strong>
                      <?=$className['subject_name']?></strong>
                    </td>
                    <td class="row4"><b>Semester 2</b></td>
                    
                  </tr>
                  <?php
                            }
                  ?>
                  <tr>
                    <td width="20%"  align='center'>&nbsp;</td>
                    <td width="20%" align='center'><b>Achievement</b></td>
                  </tr>
                  <?php
                  $sql1=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='3' order by mark");
                  
                 //echo "select * from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark";
                  while($r1=fetcharray($sql1))
                            {
                                //echo "<tr> <td width='60%'>$r1[skill]</td>";
                                
                                
                                $sub_skill=execute("select sub_skill, id from sub_skills where master_skill='$r1[id]' and status=1 ORDER BY master_skill");
                                
                                //echo "select sub_skill, id from sub_skills where master_skill='$r1[id]' and status=1 ORDER BY master_skill";
                                
                    while($rs=fetcharray($sub_skill))
                    {
                        $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r1[id]' and sub_skil='$rs[id]' and status=1"));
                        echo "<tr> <td width='60%' align='justify'>$rs[sub_skill]</td>";
                        $eff=fetcharray(execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'"));
                        echo "<td align='center'>$eff[0]&nbsp;</td></tr>";
                        
                    }
                    
                        $cmt=fetchrow(execute("select sem2 from grade_skill_comments_1 where sub='$rrr[sub_sec]' and student='$student_id' and status='1'"));
                
                    if($cmt[0]!=NULL)
                    {
                        echo "<tr><td colspan='2' align='justify'><small>$cmt[0]&nbsp;</small></td></tr>";
                    }
                    
                                    //$upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r1[id]' and status=1"));
                    
                    
                    
                    
                                
                                
                            }
                            
                            echo "</table><br><br><br>";
                            $table_count++;
                            if($table_count%2==0 && $table_count<7)
                            {
                                ?>
                                <div class='page'></div>
                            <?
                            }
                            
                     }
//-----------------------(type0 & type 3) or only type 3 ends--------------------------------//             
            
    //--------------------------(type1 & type0) or type1 starts------------------------------------//
                    $type1=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark");
                     if(rowcount($type1)!=NULL)
                     {
                         
                        
                         $phys=fetcharray(execute("SELECT  subject_code  FROM subject_m WHERE subject_id='$className[subject_id]' AND status=1 and subject_code like '%PE'"));
                        
                          $ict=fetcharray(execute("SELECT  subject_code  FROM subject_m WHERE subject_id='$className[subject_id]' AND status=1 and subject_code like '%ICT'"));
                          
                          
                          
if($phys[0]!=NULL)
{
    ?>
    
    <table align="center" width="90%" border="0" cellpadding="5">
    <tr><td>
    
    <small>Specialized program at OIS are designed to encourage students to explore the relationship between effort and outcomes, try new activities, accept challenges, and arrive at a personal definition of success.</small>
   
    </td></tr>
    </table><br>
    <?php
}
            $sub_com=fetcharray(execute("select * from master_subject_comments where subject='$className[1]' and status=1"));
                            
        //echo "<br>select * from master_subject_comments where subject='$className[1]' and status=1";
                /*          
                if($sub_com[description_1]!=NULL || $sub_com[description_2]!=NULL || $sub_com[description_3]!=NULL || $sub_com[description_4]!=NULL)
                {*/
                    ?>
                            
                            
                  
            
                  <?php
                   $sql1=fetcharray(execute( "select count(*) from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark"));
                   
                   
                    $sql0=fetcharray(execute( "select count(*) from master_skills where sub='$className[1]' and status='1' and mark='0' order by mark"));
                    
                    
                    if($sql1[0]>$sql0[0])
                    {
                        $max=$sql1[0];
                    }
                    if($sql1[0]<$sql0[0])
                    {
                        $max=$sql0[0];
                    }
                    
                    $sql1=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark");
                    
                    $c=0;
                   while($r1=fetcharray($sql1))
                            {
                                $skill1[$c]=$r1[skill];
                                
                                $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r1[id]' and status=1"));
                                $eff=fetcharray(execute("SELECT effort FROM `grade_points` where effort='$upin[1]'"));
                                 $effort[$c]=$eff[0];
                    
                                $c++;
                                
                            }
                            
                            $sql2=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='0' order by mark");
                            $i=0;
                  while($r2=fetcharray($sql2))
                            {
                                $skill2[$i]=$r2[skill];
                                
                                $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[id]' and status=1"));
                                $ach=fetcharray(execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'"));
                                $achive[$i]=$ach[0];
                                $i++;
                                
                                
                            }
                            //echo "</table><br><br>";
                    // }
                    ?>
                    <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                    <tr>
                    <td class="row3" rowspan="2" ><strong>
                    <?php
                    if($ict[0]!=NULL)
                    {
                        echo "Integrated Technology ";
                    }
                    else
                    {
                        echo $className['subject_name'];
                    }
                    
                    ?>
                     </strong><br><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></td>
                    <!--<td class="row3" rowspan="2"><strong>
                      <?=$className['subject_name']?><br><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></strong>
                    
                    
                    <?php if($sub_com[description_1]!=NULL)
                    {
                        echo $sub_com[description_1];
                        
                    }
                    else
                    {
                        echo "Subject Description not Entered";
                    }?></td>-->
                <td width="20%"   class="row4" colspan="3" nowrap><b>Semester 2</b></td>
                    
                  </tr>
                  <tr>
                  
                  <td class="row3" colspan="3"><small>&nbsp;<?=$sub_com[description_4]?></small></td>
                  </tr>
                  <tr>
                 
                    <td class='row3' style="border-bottom:0px">&nbsp;</td>
                    <td class='row4' ><b>Achievement</b></td>
                     <td  class='row3'>&nbsp;</td>
                    <td  class='row4'><b>Effort</b></td>
                   
                  </tr>
                    <?php
                    for($k=0;$k<$max;$k++)
                    {
                        echo "<tr>
                         <td width='30%' align='justify' style='border-bottom:hidden' >$skill2[$k]&nbsp;</td>
                         <td width='10%' align='center'>$achive[$k]&nbsp;</td>
                         <td width='40%' align='justify'>$skill1[$k]&nbsp;</td>
                        <td width='10%'  align='center'>$effort[$k]&nbsp;</td>
                        
                        
                        </tr>";
                        /*<td width='10%' align='justify'>$achive[$k]&nbsp;</td>
                        <td width='30%' align='justify'>$skill2[$k]&nbsp;</td>*/
                    }
                                        $cmt=fetchrow(execute("select sem2 from grade_skill_comments_1 where sub='$rrr[sub_sec]' and student='$student_id' and status='1'"));
                
                    if($cmt[0]!=NULL)
                    {
                        echo "<tr><td colspan='4' align='justify'><small>$cmt[0]&nbsp;</small></td></tr>";
                    }
                    ?>
</table><br>


<?
$table_count++;

                            if($table_count%2==0 && $table_count<7)
                            {
                                 
                                ?>
                               
                                <div class='page'></div>
                            <?
                            }


?>



<?php
                
                //}
                
                /*else {
                
                            
                            //echo "select * from master_subject_comments where subject='$className[1]' and status=1";
                            ?>
                            <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                            
                  <tr>
                    <td width="20%"   class="row3"  colspan="2" nowrap><strong>
                      <?=$className['subject_name']?><br><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?><br>Semester 2
                    </strong></td>
                    
                  </tr>
                  <tr>
                    <td width="20%"  align='center'></td>
                    <td width="20%" align='center'><b>Effort</b></td>
                  </tr>
                  <?php
                  $sql1=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark");
                  while($r1=fetcharray($sql1))
                            {
                                echo "<tr>
                                <td width='60%'>$r1[skill]</td>";
                                
                                
                                    
                                    $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r1[id]' and status=1"));
                    
                    $eff=fetcharray(execute("SELECT effort FROM `grade_points` where effort='$upin[1]'"));
                    echo "<td>$eff[0]&nbsp;</td></tr>";
                    
                                
                                
                            }
                            ?>
                            <tr>
                            <td width="20%"  align='center'>&nbsp;</td>
                    <td align='center' ><b>Achievement</b></td>
                    
                  </tr>
                  
                  
                   <?php
                  $sql2=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='0' order by mark");
                  while($r2=fetcharray($sql2))
                            {
                                echo "<tr>
                                <td width='60%'>$r2[skill]</td>";
                                
                                
                                    
                                    $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[id]' and status=1"));
                    
                    $ach=fetcharray(execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'"));
                    echo "<td>$ach[0]&nbsp;</td></tr>";
                                
                                
                            }
*/                          
                //}
                     }
//-----------------------(type0 & type 1) or only type 1 ends--------------------------------//             
                            
                
//--------------------------(type2 & type0) or type2 starts------------------------------------//
                    //echo  "select * from master_skills where sub='$className[1]' and status='1' and mark='2' order by mark";
                    $type2=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='2' order by mark");
                    
                     if(rowcount($type2)!=NULL)
                     {
                            
        //---------------------------------//
        ?>
                            
                            <table border="1" align="center" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                            <tr >
                            <td class="row3" width="20%" rowspan="2"  ><b><?=$className['subject_name']?>&nbsp;</b><br><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></td>
                            <td class="row4" colspan="2" ><b>Semester 2</b>
                    
                    
                  </tr>
                  <tr>
                  
                  <td class="row4" align='center' colspan="2" ><b>Achievement</b></td>
                  </tr>
                  
                  
                   <?php
                  $sql2=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='0' order by mark");
                  while($r2=fetcharray($sql2))
                            {
                                echo "<tr>
                                <td width='60%' align='justify'>$r2[skill]</td>";
                                
                                
                                    
                                    $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[id]' and status=1"));
                    
                    $ach=fetcharray(execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'"));
                    echo "<td align='center'>$ach[0]&nbsp;</td></tr>";
                                
                                
                            }
         


        
    
    //---------------------------------//
    
      ?>
      </table><br></div>
      <?php
      /*$table_count++;

                            if($table_count%2==0 && $table_count<7)
                            {
                                 
                                ?>
                               
                                <div class='page'></div>
                            <?
                            }*/
        
            ?>              
                <?php           
                            
                            
                        $sub_com=fetcharray(execute("select * from master_subject_comments where subject='$className[1]' and status=1"));
                     
                     //echo "<br/>select * from master_subject_comments where subject='$className[1]' and status=1";
                            
                            
                            ?>
                            <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                            
                  <tr>
                 <!-- <td   class="row3" align='justify' rowspan="2" ><b><?=$sub_com[description_1]?></b></td>-->
                  <td class="row3" rowspan="2" ><?php if($sub_com[description_1]!=NULL)
                    {
                        echo "<b>".$sub_com[description_1]."</b>";
                        
                    }
                    else
                    {
                        echo "Subject Description ";
                    }?></td>
                    <!--<td   class="row3" align='center' colspan="4" nowrap><strong><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?>-->
                    <td class="row4" colspan="4"  nowrap><b>Semester 2</b> </td>
                   </tr>
                  <tr>
                  <td   class="row3" colspan="4"><?=$sub_com[description_4]?></td>
                   </tr>
                 
                  <?php
                  
//---------------------------------------------------------------------------------------------------//
                  
                  
                  $sql1=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='2' order by mark");
                  $c=0;
                  $i=0;
                  while($r1=fetcharray($sql1))
                            {
                                
                            $sub_count=fetcharray(execute("select count(*) from sub_skills where master_skill='$r1[id]' and status=1 ORDER BY master_skill"));
                            $count[$c]=$sub_count[0];
                            
                            //echo $count[0]."&nbsp;".$count[1]."<br>";
                            if($count[0]!=0 && $count[1]!=0)
                            {
                                if($count[0]>$count[1])
                                {
                                     $max=$count[0];
                                    $rp=$max+1;
                                }
                                if($count[1]>$count[2])
                                {
                                     $max=$count[1];
                                     $rp=$max+1;
                                    
                                }
                                
                                
                                
                                
                            }
                            
                            $skill[$c]=$r1[skill];
                            $skill_id[$c]=$r1[id];
                            if($skill[0]!=NULL && $skill[1]!=NULL)
                            {
                            echo "<tr>";
                            echo "<td width='20%' rowspan='$rp' align='justify'><b>$sub_com[description_2]</b></td>";
                    echo "<td width='30%' align='justify'><b>$skill[0]&nbsp;</b></td>";
                    echo "<td width='10%' align='center'><b>Effort</b></td>";
                    echo "<td width='30%' align='justify'><b>$skill[1]&nbsp;</b></td>";
                    echo "<td width='10%' align='center'><b>Effort</b></td>";
                    echo "</tr>";
                    
                            }
                            
                            $sub_skill123=execute("select sub_skill, id from sub_skills where master_skill='$skill_id[$c]' and status=1 ORDER BY master_skill");
                            
                            while($rs123=fetcharray($sub_skill123))
                    {
                        
                        
                        $upin123=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$skill_id[$c]' and  sub_skil='$rs123[id]' and status=1"));
                        $eff123=fetcharray(execute("SELECT effort FROM `grade_points` where effort='$upin123[1]'"));
                        
                        
                    
                        
                        $subskill[$i]=$rs123[sub_skill];
                        $effort[$i]=$eff123[0];
                        $i++;
                    }
                    
                    $b=0;
                    $a=0;
                    for($j=0;$j<$i;$j++)
                    {
                        
                        if($j<$count[0])
                        {
                        $a=$j;
                        $sk1[$a]=$subskill[$j];
                        $ef1[$a]=$effort[$j];
                        $a++;
                        }
                        if($j>=$count[0])
                        {
                        
                        $sk2[$b]=$subskill[$j];
                        $ef2[$b]=$effort[$j];
                        $b++;
                        }
                    }
                    
                    
                    for($k=0;$k<$max;$k++)
                    {
                        
                        echo "<tr>";
                        echo "<td align='justify'> $sk1[$k]&nbsp;</td>";
                        echo "<td align='center'>$ef1[$k]&nbsp;</td>";
                        echo "<td align='justify'>$sk2[$k]&nbsp;</td>";
                        echo "<td align='center'>$ef2[$k]&nbsp;</td>";
                        echo "</tr>";
                    }
                    
                    
                            
                            $c++;
                    
                }
                
                    $cmt=fetchrow(execute("select sem2 from grade_skill_comments_1 where sub='$rrr[sub_sec]' and student='$student_id' and status='1'"));
                
                    if($cmt[0]!=NULL)
                    {
                        echo "<tr><td colspan='5' align='justify'><small>$cmt[0]&nbsp;</small></td></tr>";
                    }
                ?>
                
                </table><br><br><br>
                <?php
                $table_count++;

                            if($table_count%2==0 && $table_count<7)
                            {
                                 
                                ?>
                               
                                <div class='page'></div>
                            <?
                            }
                            
                
//-----------------------(type0 & type 2) or only type 2 ends--------------------------------//
                            ?>
                            
                           <!-- <div class='page'></div>-->
      
  
      <?php
            
            
         }  
        
    }
        
        else
     {
         $k++;
    if($k==3 or $k==6 or $k==9 or $k==12)
    //echo "<div class='page'></div><br>";
    

    
    

    ?>
  <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
            
  <tr>
    <td width="20%" rowspan='2'  class="row3" nowrap><strong>
    <?php
    $lang=fetcharray(execute("SELECT  subject_code  FROM subject_m WHERE subject_id='$className[subject_id]' AND status='1' and subject_code like '%Lan%'"));
    if($lang[0])
{
    echo "Literacy";
}
else
{
    echo $className['subject_name'];
    
}
    ?>
      </strong>
    </td>
    <td colspan='2'  class="row4"><strong>Semester 2</strong></td>
    
  </tr>
  <tr>
    <td width="20%"  class="row4"><b>Achievement</b> </td>
    <td width="20%" class="row4"><b>Effort</b></td>
  </tr>
  <!--code starts -->
  <?php
//echo "select id,skill from master_skills where sub='$subjectid' and mark=0  and status='1' order by posi";
  $flag=1;
$sql2=execute("select id,skill from master_skills where sub='$subjectid' and mark=0  and status='1' order by posi");
while($r2=fetcharray($sql2))
{
    $flag=0;
    
    $namev="_".$student_id."_$r2[0]";

    echo " <tr>
    <td>&nbsp;$r2[1]</td><td align='center' nowrap>&nbsp;";

    $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[0]' and status=1"));
    
    $sql3=execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[1]'");
    
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td> </tr>";
  
}

if($flag)
{
    $subject_type=fetchrow(execute("select sub_type from subject_m where subject_id='$subjectid'"));
    $namev="_".$student_id."_0";
    if($subject_type[0]!=2)
    {
    echo " <tr>
    <td>&nbsp;$r2[1]</td><td align='center' nowrap>&nbsp;";
    $upin=fetchrow(execute(" select `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and status=1"));
    
    $sql3=execute("SELECT achievement FROM `grade_points`  where achievement='$upin[0]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[1]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td></tr>";
    }
    
    
}

    $cmt=fetchrow(execute("select sem2 from grade_skill_comments_1 where sub='$rrr[sub_sec]' and student='$student_id' and status='1'"));
                
                    if($cmt[0]!=NULL)
                    {
                        echo "<tr><td colspan='3' align='justify'><small>$cmt[0]&nbsp;</small></td></tr>";
                    }

//$cmt=fetchrow(execute("select sem1, sem2 from grade_skill_comments_1 where `sub`='$r[id]' and `student`='$student_id' and status=1"));
 ?> <!--<tr>
    <td>&nbsp;&nbsp;Comments</td>
    <td colspan="3" align="justify">&nbsp;<?=$cmt[0]?></td>
     <td colspan="2" align="justify">&nbsp;<?=$cmt[1]?></td>
    </tr>-->
    </table><br><br><br>
    <?php
    $table_count++;

                            if($table_count%2==0 && $table_count<6)
                            {
                                 
                                ?>
                               
                                <div class='page'></div>
                            <?
                            }
                            ?>
    <!--<div class='page'></div>-->
 <!-- code ends -->
 <!-- </table><br>-->
  
    <?
    
    
$lang=fetcharray(execute("SELECT  subject_code  FROM subject_m WHERE subject_id='$className[subject_id]' AND status=1 and subject_code like '%Lan%'"));
if($lang[0]!=NULL)
{
    ?>
    <br>
    <div class='page'></div>
    <table align="center" width="90%" border="0"><tr><td><small>Class participation is considered a key element in the  authentic learning process. At OIS, we strive to engage our students through  meaningful and challenging classroom projects and activities in order to  facilitate the development of informed, confident, and self-aware  learners.</small></td></tr></table>
    
<table class="forumline" align="center" width="90%" border="1" cellspacing="0" cellpadding="5" >
  <tr valign="top">
    <td width="10%"  ><small>
      <strong>Demonstration of effort in Literacy</strong></small></td>
    <td  ><small><strong>4-Consistently demonstrates best effort </strong><em>(almost always)</em><strong> </strong></small></td>
    <td  ><small><strong>3-Usually demonstrates best effort </strong><em>(most often)</em><strong> </strong></small></td>
    <td  ><small><strong>2-Occasionally demonstrates best effort </strong><em>(sometimes)</em><strong> </strong></small></td>
    <td  ><small><strong>1- Rarely demonstrates best effort </strong><em>(hardly ever to never)</em><strong> </strong></small></td>
  </tr>
  
  <tr valign="top">
    <td  ><small><strong>Active Listening</strong></small></td>
    <td  ><small>
      Consistently    looks at speaker<br>
      sits    quietly without being asked, </br>
    may    ask questions that are thoughtful and thought provoking, </br>
      has    a relevant answer to questions asked.
    </small></td>
    <td  ><small>
    Usually    looks at speaker, <br>
      will    sit quietly when asked,<bR>
      often    has a thoughtful response when called upon,<br>
      usually    asks relevantprobing questions.
    </small></td>
    <td  ><small>
     Occasionally    looks at speaker, <br>
     sometimes    sits quietly when asked,<br>
     doesn't    always answer when asked questions about the topic presented or may have a    response that is off topic,<br>
     may    ask follow up questions when probed to do so.<br>
    </small></td>
    <td  ><small>
     Rarely    looks at speaker,<br>
     distracts    others despite reminders and prompts to sit quietly<br>
     when    teacher follows up with student, often cannot verify student was paying    attention to what was said in class,<br>
     does    not ask questions when probed to do so.<br>
    </small></td>
  </tr>
 
 
 
  <tr valign="top">
    <td  ><small><strong>Active Speaking </strong><br>
      <strong>Participation</strong></small></td>
    <td  ><small>
      Raises hand/volunteers at least once <br>
      Waits for turn <br>
      Contributes thoughts and opinions <br>
      Works on tasks <br>
      Stays on topic and/or appropriately advances discussion topics.<br>
    </small></td>
    <td  ><small>
      Usually during class discussions student raises hand/volunteers at least once<br>
      Waits for turn when reminded <br>
      Contributes thoughts and opinions when probed<br>
      Works on tasks, may need reminders<br>
      Stays on topic though may need to be reminded of topic and/or sometimes advances    discussion topics.<br>
    </small></td>
    <td  ><small>
      Student is more likely to respond when called on than volunteer or raise hand<br>
      Sometimes waits for turn when reminded <br>
      Contributes thoughts and opinions when probed though sometimes off topic<br>
      Works on tasks with many reminders<br>
      Does not stay on topic easily, rarely advances the discussion topic<br>
    </small></td>
    <td  ><small>
      Student may respond when called upon but does not raise hand or volunteer<br>
      Does not wait for turn, despite reminders<br>
      May contribute thoughts and opinions when probed, though often off topic<br>
      Often receiving reminders to work on task, often does not despite reminders<br>
      Does not contribute to discussions<br>
   </small></td>
  </tr>
  </table><br>
  <div class='page'></div>
  <table class="forumline" align="center" width="90%" border="1" cellspacing="0" cellpadding="5" >
  <tr valign="top">
    <td  ><small><strong>Reading:</strong><br>
      <strong>Persistence Cooperation</strong></small></td>
    <td  ><small>
     Consistently focuses attention to reading task <br>
     ignores distractions from others<br>
     persists with reading until complete or permission to stop<br>
     participates in small and large group<br>
     asks questions as a follow up to having read something of interest (wanting to talk about what read).
    </small></td>
    <td  ><small>
      Usually focuses attention to reading task<br>
      Does not always ignore distractions from others <br>
      Frequently persists with reading until complete or permission to stop<br>
      Willingly participates in small and large group with little or no encouragement needed <br>
      Occasionally asks questions to show interest in topic read<br>
    </small></td>
    <td  ><small>
      Occasionally focuses attention to reading task<br>
      Is often distracted by others<br>
      Sometimes stops reading before complete or permission to stop<br>
      participates in small and large group with a    lot of encouragement</br>
      sometimes asks questions about what reading</br>
    </small></td>
    <td  ><small>
      Rarely focuses attention to reading task ,br>
      Very easily distracted by others <br>
     Often stops reading before time (or doesn't start)<br>
      May refuse to do activity frequently<br>
     Does not ask questions about what reading, or engage in discussions about text<br>
    </small></td>
  </tr>
  <tr valign="top">
   <td><small><strong>Writing:Persistence Cooperation</strong></small></td>
    <td  ><small>
      Consistently focuses attention to writing task<br>
     Ignores distractions from others <br>
      Persists with writing until complete or permission to stop <br>
      Participates in small and large group <br>
   </small></td>
    <td  ><small>
      Usually focuses attention to writing task</br>
      Does not always distractions from others</br>
      Frequently persists with writing until complete or permission to stop <br>
      Willingly participates in small and large group with little or no encouragement to do    so <br>
    </small></td>
    <td  ><small>
      Occasionally focuses attention to writing task <br>
      Is often distracted by others <br>
      Sometimes stops writing until complete or permission to stop<br>
      Participates in small and large group with a lot of encouragement <br>
    </small></td>
    <td  ><small>
      Rarely S   focuses attention to writing task<br>
      Very    easily distracted by others <br>
      Often    stops writing before time (or doesn't start) <br>
      May    refuse to do activity frequently <br>
    </small></td>
  </tr>
  <tr valign="top">
    <td  ><small><p><strong>Media Literacy: Preparation Organization</strong></p></small></td>
    <td  ><small>
      Consistently    collects materials accordingly <br>
      strategizes    project <br>
      works    on project from beginning to end with clear vision and outcome <br>
      creates    a meaningful product<br>
      asks    questions accordingly.<br>
    </small></td>
    <td  ><small>
      Usually    collects materials accordingly <br>
      strategizes    project with some assistance <br>
      works    on project from beginning to end with clear vision and outcome with guidance <br>
      creates a meaningful product, sometimes needed a deadline extension, meets    most requirements <br>
    </small></td>
    <td  ><small>
      Occasionally    collects materials accordingly <br>
      Cannot    strategizes project without assistance<br>
      works on project from beginning to end with clear vision and outcome with    guidance and frequent check ins, may change project but able to finish it<br>
      creates    a finished project that usually meets most requirements <br>
    </small></td>
    <td  ><small>
      Rarely    collects materials accordingly<br>
      Does    not strategizes project though provided assistance<br>
      May    quite project work or frequently changes project so often that may not be    able to complete project<br>
      Final    product may be unfinished or not meet requirements<br>
    </small></td>
  </tr>
</table><br>
<div class='page'></div>


    
    <?php
}
        

     }
     
     }
     // type 0,1,2,3 code ends
     
     
//normal codes for all the subjects ... for only type 0 


//$sql_3=execute("select id,skill,mark from master_skills where sub='$r[4]' and status='1'  and mark='3' order by mark"); 
 /*     $sql=execute("SELECT c.subject_id, a.sub_sec,c.sub_pre,b.id FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND c.sub_type!=2 AND c.sub_type!=3 AND b.grade!=0 and c.subject_name not like '%Unit of Inquiry%' and c.subject_name not like '%EAL%' and c.subject_name not like '%Homeroom%' group by a.sub_sec order by c.sub_pre");
    
    //old code starts
 while($r=fetcharray($sql))
 {
    
    $subjectid=$r[subject_id];
    
    $teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$r[sub_sec]' AND acc_year='$a_year'"));   
    $className=fetcharray(execute("SELECT subject_name, subject_id FROM subject_m WHERE subject_id='$r[subject_id]' AND status=1"));
    
    if($teacherID['sub_teac']){
        $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
    }
    else
    {
        $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
    }
    if($teacherName[2]=='FEMALE')
    $salutaion='';
    else
    $salutaion='';
    $k++;
    if($k==3 or $k==6 or $k==9 or $k==12)
    echo "<div class='page'></div><br><br><br>";
    
    //$mark=execute( "select id,skill,mark from master_skills where sub='$className[1]' and status='1'  and mark='1' and mark='0' order by mark");
    //echo "select id,skill,mark from master_skills where sub='$className[1]' and status='1'  and mark='1' and mark='0' order by mark";
    
    
    ?>
  <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
            
  <tr>
    <td width="20%" rowspan='2'  class="row3" align='center' nowrap><strong>
      <?=$className['subject_name']?><br><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?>
    </strong></td>
    <td colspan='2'  class="row3" align='center'><strong>semester 1</strong></td>
    <td colspan='2'  class="row3" align='center'><strong>semester 2</strong></td>
  </tr>
  <tr>
    <td width="20%"  class="row3" align='center'>Achievement</td>
    <td width="20%"  class="row3" align='center'>Effort</td>
    <td width="20%"  class="row3" align='center'>Achievement</td>
    <td width="20%" class="row3" align='center'>Effort</td>
  </tr>
  <!--code starts -->
  
<?php 

$flag=1;
$sql2=execute("select id,skill from master_skills where sub='$subjectid' and mark=0  and status='1' order by posi");
while($r2=fetcharray($sql2))
{
    $flag=0;
    
    $namev="_".$student_id."_$r2[0]";

    echo " <tr>
    <td>&nbsp;$r2[1]</td><td align='center' nowrap>&nbsp;";

    $upin=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[0]' and status=1"));
    
    $sql3=execute("SELECT achievement FROM `grade_points` where achievement='$upin[0]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[1]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    
    $sql3=execute("SELECT achievement FROM `grade_points`  where achievement='$upin[2]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[3]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td></tr>";
  
}
if($flag)
{
    $subject_type=fetchrow(execute("select sub_type from subject_m where subject_id='$subjectid'"));
    $namev="_".$student_id."_0";
    if($subject_type[0]!=2)
    {
    echo " <tr>
    <td>&nbsp;$r2[1]</td><td align='center' nowrap>&nbsp;";
    $upin=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and status=1"));
    
    $sql3=execute("SELECT achievement FROM `grade_points`  where achievement='$upin[0]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[1]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    
    $sql3=execute("SELECT achievement FROM `grade_points`  where achievement='$upin[2]'");
    while($r3=fetcharray($sql3))
    {
          echo "$r3[0]";
    }
    echo "</td><td align='center' nowrap>&nbsp;";
    $sql3=execute("SELECT effort FROM `grade_points`  where effort='$upin[3]'");
    while($r3=fetcharray($sql3))
    {
        echo "$r3[0]";
    }
    echo "</td></tr>";
    }



}
    $cmt=fetchrow(execute("select sem1, sem2 from grade_skill_comments_1 where `sub`='$r[id]' and `student`='$student_id' and status=1"));
 ?> <tr>
    <!--<td>&nbsp;&nbsp;Comments</td>-->
    <td colspan="5" align="justify">&nbsp;<?=$cmt[0]?><!--</td>
     <td colspan="2" align="justify">&nbsp;<?=$cmt[1]?>--></td>
    </tr>
    </table>
 <!-- code ends -->
  </table><br>
    <?
        
 }*/
 
//normal code ends..... for only type 0 by default
 
//EAL code start 
  ?>
<?php


    $sql=execute("SELECT c.subject_id, a.sub_sec,c.sub_pre, b.id FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND c.sub_type!=2 AND c.sub_type!=3 AND b.grade!=0 and c.subject_name like '%EAL%' group by a.sub_sec order by c.sub_pre");
 while($r=fetcharray($sql))
 {
    
    $subjectid=$r[subject_id];
    
    $teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$r[sub_sec]' AND acc_year='$a_year'"));   
    $className=fetcharray(execute("SELECT subject_name FROM subject_m WHERE subject_id='$r[subject_id]' AND status=1"));
    
    if($teacherID['sub_teac']){
        $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
    }
    else
    {
        $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
    }
    if($teacherName[2]=='FEMALE')
    $salutaion='';
    else
    $salutaion='';

    
?>    <div class='page'></div><br>
    
    <table width='90%' align="center" border='0' cellspacing='0' cellpadding='5'>
      <tr>
            <td align="center" style="font-size:18px"><br><strong>EAL Progress Report</strong><br><br>&nbsp;
            </td>
      </tr>
      <tr>
        <td align="justify" ><strong>Teacher  Name: </strong><!--<?=$salutaion?>--><?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></td></tr>
        <tr><td align="justify">
          <strong>Overall  EAL proficiency level </strong> : <strong>End of Year:</strong> &nbsp;&nbsp;
          <?
          $upin=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
     
        //semister 1
        
        $sql3=execute("SELECT id, achievement FROM `grade_points_eal`");
        while($r3=fetcharray($sql3))
        {
            if($upin[1]==$r3[0])
            echo "<u>$r3[1]</u>";
        }
        ?>
          </td></tr><tr><td align="justify"><?php
  $upin=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
            
            $sql3=execute("SELECT achievement FROM `grade_points_eal` where id='$upin[0]'");
            while($r3=fetcharray($sql3))
            {
                echo "$r3[0]";
            }        
          
?><strong>Performance Level</strong> : 
        <?php
        //echo "SELECT id,achievement FROM `grade_points_eal` ";
       // $sql3=execute("SELECT id,achievement FROM `grade_points_eal` ");
        $sql3=execute("SELECT id,achievement,effort FROM `grade_points_eal` order by effort ");
        while($r3=fetcharray($sql3))
        {
            echo "$r3[2]-$r3[1], ";
        } 
        ?></td>
      </tr>
     </table><br><br>
     <table width='90%' align="center" border='1' cellspacing='0' cellpadding='5' >
      <tr>
        <td align="center" colspan="3" style="font-size:18px"><strong>Language Indicators</strong></td>
      </tr>
      <tr>
        <td colspan="3" align="justify" ><strong>ASSESSMENT KEY:</strong><br>
        <?php
        $sql3=execute("select * from grade_points_eal_ASSESSMENT_KEY");
        while($r3=fetcharray($sql3))
        {
            echo "<strong>$r3[1] $r3[2] : </strong>$r3[3]<br>";
        }
        
        ?>
        </td>
      </tr>
      <tr>
      
        <td width="40%" class="row3" nowrap><strong>
      <?=$className['subject_name']?><br>
    </strong></td>
        <td width="30%" class="row4" ><strong>Semester 1</strong></td>
        <td  width="30%" class="row4" ><strong>Semester 2</strong></td>
      </tr>
      <!--<tr>
     <td><b>EAL proficiency level&nbsp;</b></td>
      <?php
      $upin1=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
        //semister 1`sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"
        
        $sql31=execute("SELECT id, achievement FROM `grade_points_eal`");
        echo "<td align='center' >";
        while($r31=fetcharray($sql31))
        {
            if($upin1[0]==$r31[0])
            echo $r31[1];
        }
         echo "&nbsp;</td>";
      ?>
      <?php
      $upin=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
     
        //semister 1
        
        $sql3=execute("SELECT id, achievement FROM `grade_points_eal`");
        echo "<td align='center' >";
        while($r3=fetcharray($sql3))
        {
            if($upin[1]==$r3[0])
            echo $r3[1];
        }
         echo "&nbsp;</td>";
      ?></tr>
      -->
      <?php
            $namev="_"."$student_id"."_0_0";

      ?>
      <!--<tr  height="30">
      <td colspan="3" ><strong>
      <?php
        $sql3=execute("SELECT effort,achievement FROM `grade_points_eal`");
        while($r3=fetcharray($sql3))
        {
            echo "$r3[0] . $r3[1], ";
        }
      ?></strong>
      </td>
      </tr>
      <tr  height="30">
      <td colspan="3" >
      <?php
        $sql3=execute("SELECT * FROM `grade_points_eal_ASSESSMENT_KEY`");
        while($r3=fetcharray($sql3))
        {
            echo "<strong>$r3[1] $r3[2] : </strong> $r3[3]<br> ";
        }
      ?>
      </td>
      </tr>-->
      
      
      <!--<tr  height="30">
      <td><strong>Overall EAL proficiency level </strong></td>
      <td align='center'><b>&nbsp;<?php
      $upin1=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
      $sql1=execute("SELECT id, achievement FROM `grade_points_eal`");
      
      while($r1=fetcharray($sql1))
        {
            if($upin1[0]==$r1[0])
            echo $r1[1];
        }
      ?></b></td>
      <td align='center'>&nbsp;<?php
      $upin2=fetchrow(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='0' and sub_skil='0' and status=1"));
      
      $sql2=execute("SELECT id, achievement FROM `grade_points_eal`");
      while($r2=fetcharray($sql2))
        {
            if($upin2[0]==$r2[0])
            echo $r2[1];
        }
      ?></td>
      </tr>-->
      
      <?php
        $k=0;
        $sql2=execute("select id,skill from master_skills where sub='$subjectid' and status='1' order by posi");
    while($r2=fetcharray($sql2))
    {
        
        $k++;
        if($k>3)
        {
            ?></table>
             <!--<div class='page'></div>--><br>
            <table width='90%' align="center" border='1' cellspacing='0' cellpadding='5' >
      
      <tr>
      
        <td width="40%" class="row3"  nowrap><strong>
      <?=$className['subject_name']?><br>
    </strong></td>
        <td width="30%" class="row4"  ><strong>Semester 1</strong></td>
        <td  width="30%" class="row4" ><strong>Semester 2</strong></td>
      </tr>
     
            <?php
        }
        $flag=0;
        echo "  <tr height='20'>
            <td ><strong>&nbsp;&nbsp;$r2[1]</strong></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>";
        $subskilsql=execute(" select id , sub_skill  from sub_skills where status=1 and master_skill='$r2[0]' order by posi");
        while($r233=fetcharray($subskilsql))
        {
            $cmtcol=1;
            $namev="_"."$student_id_"."$r2[0]_$r233[0]";
        
            echo " <tr height='20'>
            <td nowrap>&nbsp;&nbsp;&nbsp;$r233[1]</td>";
        //echo " select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[0]' and sub_skil='$r233[0]' and status=1";
            $upin=fetcharray(execute(" select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[0]' and sub_skil='$r233[0]' and status=1"));
            
            
            $upin1=fetchrow(execute("select `sem1_ach`, `sem1_eff`, `sem2_ach`, `sem2_eff` from grade_skill_ponts where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r2[0]' and sub_skil='$r233[0]' and status=1"));
        
echo "<td align='center' nowrap>";
        $sql31=execute("SELECT id, fname FROM `grade_points_eal_ASSESSMENT_KEY`");
        while($r31=fetcharray($sql31))
        {
            if($upin1[0]==$r31[0])
            echo $r31[1];
        }
        echo "</td>";
            //echo "SELECT fname FROM `grade_points_eal_ASSESSMENT_KEY` where id='$upin[0]'";
            
            echo "<td align='center' nowrap>";
            $sql3=execute("SELECT fname FROM `grade_points_eal_ASSESSMENT_KEY` where id='$upin[1]'");
            while($r3=fetcharray($sql3))
            {
                //if($upin1[1]==$r31[0])
                echo "$r3[0]";
            }
            echo "</td>";
            
            echo "</tr>";
        }
    }
    $cmt1=fetchrow(execute("select sem1, sem2 from grade_skill_comments where `sub`='$r[id]' and `student`='$student_id' and status=1"));
    $cmt2=fetchrow(execute("select sem1, sem2 from grade_skill_comments_1 where `sub`='$r[id]' and `student`='$student_id' and status=1"));
 ?> <tr>
     <td colspan="3"  align="justify"><b>Semester I Comment</b><br><small>&nbsp;<?=$cmt1[0]?></small></td>
     </tr>
     <tr>
     <td colspan="3" align="justify"><b>Semester II Comment</b><br><small>&nbsp;<?=$cmt2[1]?></small></td>
    </tr>
     </table>    <div class='page'></div><br><br>

     <br><div align="center" style="font-size:23px"><strong>EAL Proficiency Definitions based on WIDA, <br>
World Class Instructional Design and Assessment,<br>
Consortium of 30 states
</strong></div>

<table border="1"  width="90%" cellspacing="0" cellpadding='5' align="center" style="font-size:14px" >
<small>
  <tr valign="top">
    <td width="18%" align="justify" ><p><strong>1 - Entering</strong></p>
      
        1. Pictorial    or graphic representation of the language of the content areas
        <br>2. Words,    phrases or chunks of language when presented with one-step
        <br>3. Commands,    directions, WH-, choice or yes/no questions, or statements with
        <br>4. Sensory,    graphic or interactive support
        <br>5. Oral    language with phonological, syntactic, or semantic errors that often impede
        <br>6. Meaning    when presented with basic oral commands, direct questions, or simple
        <br>7. Statements with sensory,    graphic or interactive support 
      </td>
    <td width="16%%" align="justify"  ><p><strong>2 - Beginning</strong></p>
      
        1. General    language related to the content areas
        <br>2. Phrases    or short sentences
        <br>3. Oral    or written language with phonological, syntactic, or semantic errors that often    impede the meaning of the communication when presented with one- to multiple-step    commands, directions, questions, or a series of statements with sensory,    graphic or interactive support 
      </td>
    <td width="16%%" align="justify"  ><p><strong>3 - Developing </strong></p>
      
        1. General    and some specific language of the content areas
        <br>2. Expanded    sentences in oral interaction or written paragraphs
        <br>3. Oral    or written language with phonological, syntactic or semantic errors that may    impede the communication, but retain much of its meaning, when presented with    oral or written, narrative or expository descriptions with sensory, graphic    or interactive support 
      </td>
    <td width="16%" align="justify"  ><p><strong>4 - Expanding</strong></p>
      
        1. Specific    and some technical language of the content area.
        <br>2. A    variety of sentence lengths of varying linguistic complexity in oral    discourse or multiple, related sentences or paragraphs
        <br>3. Oral    or written language with minimal phonological, syntactic or semantic errors    that do not impede the overall meaning of the communication when presented    with oral or written connected discourse with sensory, graphic or interactive    support 
      </td>
    <td width="16%%" align="justify"  ><p><strong>5- Bridging</strong></p>
      
        1. Specialized or technical language    of the content areas
        <br>2. A variety of sentence lengths of    varying linguistic complexity in extended oral or written discourse,    including stories, essays or reports
        <br>3. Oral or written language approaching    comparability to that of English-proficient peers when presented with    grade-level material
      
      </td>
      <td width="16%" align="justify"  ><p><strong>6 - Reaching</strong></p>
      
       1.    Specialized or technical language reflective of the content area at grade level<br>
2.   A variety of sentence lengths of varying linguistic complexity in extended oral or written discourse as required by the specified grade level<br>
3.   Oral or written communication in English comparable to proficient English peers
      
      </td>
  </tr>
  </small>
</table>
    <?php
    //end eal
    
    //starting homerooom
}

//home room code starts

?>      <!--<div class='page'></div><br><br><br>

<table width='90%' align="center" border='1' cellspacing='0' cellpadding='5'>
      <tr>
        <td  class="" bgcolor="#91D04E" align='' nowrap>&nbsp;&nbsp;<strong>General Comment<br>&nbsp;&nbsp;<?=$homeroomteacher?>
    </strong></td></tr>
<?php

    $cmt=fetchrow(execute("select sem1, sem2 from grade_skill_comments_1 where `sub`='$classsections' and `student`='$student_id' and status=1"));
 ?> <tr>
    <td align="justify">&nbsp;&nbsp;<?=$cmt[0]?></td>
     <td colspan="" align="justify"><?=$cmt[1]?></td>
    </tr></table>
  -->
  
  <?php
  
   $sql_type_hr=execute( "SELECT c.subject_id, a.sub_sec,c.sub_pre,b.id FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND c.sub_type=2 AND c.sub_type!=3 AND b.grade!=0 and c.subject_name not like '%Unit of Inquiry%' and c.subject_name not like '%EAL%' and c.subject_name like '%Homeroom%' group by a.sub_sec order by c.sub_pre");
    while($r_hr=fetcharray($sql_type_hr))
     {
        $subjectid=$r_hr[subject_id];
            
                $teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$r_hr[sub_sec]' AND acc_year='$a_year'"));    
                $className=fetcharray(execute("SELECT subject_name, subject_id FROM subject_m WHERE subject_id='$r_hr[subject_id]' AND status=1"));
                
                if($teacherID['sub_teac'])
                {
                    $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
                }
                else
                {
                    $teacherName=fetcharray(execute("SELECT `f_name`,`s_name`,`gender` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
                }
                if($teacherName[2]=='FEMALE')
                $salutaion='';
                else
                $salutaion='';
                
                
                
                
                $type=execute( "select * from master_skills where sub='$className[1]' and status='1' and (mark='1' or mark='2' or mark='3') order by mark");
            if(rowcount($type)!='')
                {
                    $shr=execute( "select * from master_skills where sub='$className[1]' and status='1' and mark='1' order by mark");
                    
                    if(rowcount($shr)!=NULL)
                    {
                        
                    ?>
                    <br>
                    <table align="center" class="" border="1" width="90%" cellpadding='5' cellspacing="0" bordercolor="#000000">
                    <tr>
                    <td class="row3" rowspan="2" width="60%" >
                    <b><?=$className[subject_name]?></b><br>
                    <?=$teacherName[0]?>&nbsp;<?=$teacherName[1]?>
                
                    </td>
                    <td class="row4" width="40%"><b>Semester 2</b></td>
                    </tr>
                    <tr >
                   
                    <td class="row4"><b>Effort</b></td>
                    </tr>
                    
                   
                    
                    <?php
                        
                        
                        while($r_shr=fetcharray($shr))
                        {
                            echo "<tr><td  align='justify'>$r_shr[skill]&nbsp;</td>";
                            
                            $upin=fetchrow(execute(" select `sem2_eff` from grade_skill_ponts_1 where `sub`='$subjectid' and `student`='$student_id' and `skill`='$r_shr[id]' and sub_skil='0' and status=1"));
                            echo "<td align='center'>$upin[0]&nbsp;</td>";
                            echo "</tr>";
                            
        
                        }
                        
                        $cmt=fetcharray(execute("select  sem2 from grade_skill_comments_1 where `sub`='$classsections' and `student`='$student_id' and status=1"));
                        
                        if($cmt[0])
                        {
                            //$cmt_hr=fetcharray($cmt);
                            echo "<tr>";
                            echo "<td align='justify' colspan='2'><small>$cmt[0]&nbsp;</small></td>";
                            echo "</tr>";
                        }
                        
                        ?>
                         </table><br><br>
                        <?php
                        
                        
                    }
                }
                
     }
   ?>
    <?php
 //Home room code ends
$imgpath=fetchrow(execute("select reportcard  from fee_logo where class_id='$sem'"));
//$hr_sign=fetchrow(execute("select image_path from homeroom_signature where seection='$class_section_id'"));
$hr_sign=execute("select image_path, id from homeroom_signature where seection='$class_section_id'");


//echo "selct image_path from homeroom_signature where seection='$class_section_id'";
?>
<br><br><br>
<table align="center" width="70%" border="0" cellpadding="0" cellspacing="0">
<tr>
<?php
if($imgpath[1]==45)
{
	$img_size=70;
}
else
{
	$img_size=100;
}

?>
  <td align="right"><img height="80" src="<?=$imgpath[0]?>"></td>
  <td >&nbsp;</td>
  <?php
  $sign=1;
  while($hr_sign1=mysql_fetch_array($hr_sign))
  {
  ?>
  
  <td align="left"><img height="$img_size" src="<?=$hr_sign1[0]?>"></td>
    <?php
	$sign++;
  }
	?>
    
</tr>
<tr>
    <td align="right">-------------------------------</td>
    <td >&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</td>
    <?php
	for($r=1;$r<$sign;$r++)
	{
	?>
    
    <td align="left">--------------------------------</td>
    <?php
	}
	?>
    
</tr>
<tr>
    <td align="right"><strong>Head of Primary&nbsp;&nbsp; &nbsp;&nbsp;</strong></td>
     <td >&nbsp;</td>
    <?php
	for($p=1;$p<$sign;$p++)
	{
	?>
   
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Homeroom Teacher</strong></td>
    
    <?php
	}
	?>
</tr>
</table>
</body>
</html>
