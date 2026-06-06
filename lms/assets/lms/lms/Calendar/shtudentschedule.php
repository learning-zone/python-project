
<?php
include("../db.php");

session_start();
$per00=$_SESSION['per00'];
$parent=$_SESSION['parent'];
$user=$_SESSION['user'];


$newdate=date("d-m-Y",strtotime("+30 days"));
$daydet=date("D");
$datedet=array(date("Y-m-d",strtotime("-3 days")), date("Y-m-d",strtotime("-2 days")), date("Y-m-d",strtotime("-1 days")), date("Y-m-d"), date("Y-m-d",strtotime("+1 days")), date("Y-m-d",strtotime("+2 days")), date("Y-m-d",strtotime("+3 days")));

$datedet1=array(date("d-m-Y",strtotime("-3 days")), date("d-m-Y",strtotime("-2 days")), date("d-m-Y",strtotime("-1 days")), date("d-m-Y"), date("d-m-Y",strtotime("+1 days")), date("d-m-Y",strtotime("+2 days")), date("d-m-Y",strtotime("+3 days")));

$daydet=array(date("l",strtotime("-3 days")), date("l",strtotime("-2 days")), date("l",strtotime("-1 days")), date("l"), date("l",strtotime("+1 days")), date("l",strtotime("+2 days")), date("l",strtotime("+3 days")));

?>
<script src="SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
function chdate(k)
{
	alert(k);
}
</script>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
  <?php
  for($i=0;$i<sizeof($daydet);$i++)
  {
	  if($daydet[$i]==date("l"))
	  $tabeindex=1;
	  else
	  $tabeindex=0;
	  
  ?>
    <li class="TabbedPanelsTab" onclick="chdate(<?php echo $daydet[$i]; ?>)" value="<?php echo $tabeindex; ?>"
    tabindex="0" title="<?php echo $datedet1[$i]; ?>">
	<?php echo $daydet[$i]; ?>
    </li>
  <?php
  }
  ?>

   </ul>
  <div class="TabbedPanelsContentGroup">
  	<?php
  	for($i=0;$i<sizeof($datedet);$i++)
  	{
  		?>
    	<div class="TabbedPanelsContent">
            <table height="400" width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr height="20">
    <td class="head" width="50%">HOME WORK for(<?php echo $datedet1[$i]; ?>)</td>
  </tr>
  <tr>
    <td valign="top">
        <table width="100%" height="380" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
                           
            <tr height="20">
                
                <td align="center" class="row3" width="25%">Subject</td>
                <td align="center" class="row3" width="50%">Details</td>
                <td align="center" class="row3" width="25%">Resourses</td>
            </tr>
            <?php
				$fieldname='username';
				$rdate=$datedet[$i];
				//echo "select course_admitted, course_yearsem, class_section_id from student_m where $fieldname='$user' and archive='N'";
				$sql1=execute("select course_admitted, course_yearsem, class_section_id from student_m where $fieldname='$user' and archive='N'");
				while($r1=fetcharray($sql1))
				{	
					$branch=$r1[0];
					$sem=$r1[1];
					$class_section_id=$r1[2];
				}
					$sql3=execute("select subject_id, subject_name from subject_m where  course_year_id='$sem' and status='1' order by sub_pre");
					while($r3=fetcharray($sql3))
					{		
						$sql24=execute("select topic , home_work from teacher_lesson_plan where subj='$r3[0]' and  r_date='$rdate' and sec='$class_section_id'");
						while($r4=fetcharray($sql24))
						{
							echo "<tr height='20'>
									<td nowrap>$r3[1]</td>
									<td align='justify'  >$r4[1]</td>";
									$reso=fetchrow(execute("select reso from master_lesson_plan where id='$r4[0]'"));

									echo "<td nowrap>";
									if($reso[0]!='')
									{
										echo "<a href='$reso[0]'>
									Download</a>";
									}
									echo "</td>
									</tr>";
						}	
							
					}
				
			
			?> 
             <tr >
                <td align="center" class=""></td>
                <td align="center" class=""></td>
                <td align="center" class=""></td>
            </tr>
         </table>
	</td>
  </tr>
 </table>
</div>
		<?php
  	}
  		?>
    </div>

</div>
 
  <script type="text/javascript">

var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
