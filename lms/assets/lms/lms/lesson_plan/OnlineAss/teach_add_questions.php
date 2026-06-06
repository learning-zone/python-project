<html>


<HEAD>


<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(URL, title,w,h)
{
 var left = (screen.width/2)-(w/2);
 var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function reload()


{


	document.frm.action='ex_FetchsubjectDet1.php';


	document.frm.submit();


	


}





</SCRIPT>





<script>


function goBack()


  {


  window.history.back()


  }


</script>





</HEAD>


<script>


function goBack()


  {


  window.history.back()


  }


</script>


<body>


<?php 


session_start();


require("../../db.php");





$subject=$_REQUEST['subject'];


$a_year=$_SESSION['AcademicYear'];








	$user=$_SESSION['user'];


	


	?>


    <br>


<br>   


    


        


        <table align='center' cellpadding="5" class='forumline' width='70%' border="1" >


    <tr height="10"><td colspan=2 align='center' class='head'>Add Quiz Questions</td></tr>


    <tr >


       


        <td align="center" class="rowpic" width="30%" nowrap>Exam</td>


        <td align="center" class="rowpic" width="20%" nowrap>Action</td>


    </tr>


    <?php


	$k=1;





		


		


		$course=$_REQUEST['course'];


		$sem=$_REQUEST['sem'];


		$class_section_id=$_REQUEST['class_section_id'];


		$unit=$_REQUEST['unit'];


		$title_id=$_REQUEST['title_id'];


		$subject=$_REQUEST['subject'];


		$type=$_REQUEST['type'];





		$date1=date("Y-m-d");


		


		$sql3=execute("SELECT exam_name,id ,exam_type FROM `online_exam_det` where class_id='$sem' and acc_year='$a_year' and section_id='$class_section_id' and subject_id='$subject' and status=1");


		if(rowcount($sql3)>0)


		{


			$subject_id_dis=mysql_fetch_row(execute("select subject_name from subject_m where subject_id='$subject'"));


			$subject_type_dis=mysql_fetch_row(execute("select subtype_name from subjecttype where subtype_id='$subject_type'"));


			$section_name=mysql_fetch_row(execute("select section_name from class_section where id='$class_section'"));


			$course_year=mysql_fetch_row(execute("select year_name from course_year where year_id='$sem'"));


			while($r1=fetcharray($sql3))


			{


			?>	


            <tr >


                <td align="left" nowrap>&nbsp;&nbsp;&nbsp;<?=$r1[0]?></td>


                <td align="center" width="30" nowrap>


                <?php


				if($r1['exam_type']==1)


				{


				?>


                <a href="javascript:void(0);" onClick ="OpenWind2('add_questions1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>', 'OpenWind2',1000,600)"><input type="button" name="update" value="View Quiz"  class='bgbutton'></a>


                <?php


				}


				else


				{


				?>


                <a href="javascript:void(0);" onClick ="OpenWind2('teac_add_questions2.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>', 'OpenWind2',1000,600)"><input type="button" name="update" value="View Quiz"  class='bgbutton'></a>


                <?php


				}


				?>


                </td>


            </tr>


		


		<?php


			}


		$k++;


		}


	?>


	</table>


</form>	


</body>


</html>


