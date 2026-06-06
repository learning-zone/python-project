<?php
session_start();
include("../db.php");
$accyeardet=$_SESSION['AcademicYear'];
$user=$_SESSION['user'];

$class=$_REQUEST['class'];
$subject=$_REQUEST['subject'];
$amnt=$_REQUEST['amnt'];
$grade=$_POST['grade'];
$frmsub=$_POST['frmsub'];

?>
<html>
<head>
<script>
	function RefreshMe(val)
	{
		document.frm.action="viewamnt.php";
		document.frm.submit();
	}
</script>
</head>
<body>
<form method="post" name="frm">
<input type="hidden" name="amnt" value="<?=$amnt?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="class" value="<?=$class?>">
<input type="hidden" name="grade" value="<?=$grade?>">

<?
	if($_POST['submit'])
	{
		$subarr=$_POST['subarr'];
		for($i=0;$i<sizeof($subarr);$i++)
		{
			
			$stud_id=$subarr[$i];
			$cmnt=$_POST['cmnt'.$stud_id];
			$gradenew=$_POST['grade'.$stud_id];
			
			$namestaff=execute("select id from `lms_stud_grd` where subject='$subject' and amnt='$amnt' and stud_id='$stud_id' and status=1");
			if(rowcount($namestaff)>0)
			{
					
					$nameupt="update lms_stud_grd set `cmnt`='{$cmnt}',`grade`='$gradenew' where subject='$subject' and amnt='$amnt' and stud_id='$stud_id' and status=1";
				
			}
			else
			{
			
				$nameupt="INSERT INTO `lms_stud_grd` (`cmnt`,`grade`,`usernam`, `stud_id`, `acc_year`,`subject`,`amnt`,`status`) VALUES ('$cmnt', '$gradenew','$user', '$stud_id', '$accyeardet','$subject','$amnt','1')";
			}
			execute($nameupt);	
		}
	?>
		<SCRIPT LANGUAGE="JavaScript">
        alert("Grade Updated Successfully");
        </SCRIPT>
<?
	}

	$sql3=execute("select id, title_a, posi,titleimage,nameuser,date from  lms_stud where acc_year='$accyeardet' and amnt_id='$amnt'");
	if(rowcount($sql3)>=1)
	{	
	?>
<br>
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
	<?php
		$nk='1';
		while($r6=fetcharray($sql3))
		{
				//image
				$img=explode('/',$r6[3]);
				$name=$img[1].$img[2];
		//date
		$tfdate=explode('-',$r6[5]);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		
			$stname=execute("select first_name,last_name from student_m where username='$r6[4]'");
			while($srnmes=fetcharray($stname))
			{	

            echo"<table align='center' class='forumline' width='70%' cellspacing='0' cellpadding='3' border='1'>";
			echo "<tr>
    			<td align='center' class='head' nowrap>Sel</td>
    			<td align='left' class='head' nowrap>&nbsp;&nbsp;Student Name</td>
			<td align='center' class='head' nowrap>Topic</td>
			<td align='center' class='head' nowrap>Submitted Date</td>
			<td align='center' class='head' nowrap>File Name</td>
		</tr>
		";
	echo  	
			"<tr>
			<td align='center'  nowrap>$nk
			</td>
			<td align='left'  nowrap>&nbsp;&nbsp;$srnmes[0]&nbsp;$srnmes[1]
			</td>";
		echo"<td align='center'>$r6[1]
			</td>";
			
		$val1=fetchrow(execute("select cmnt, grade from `lms_stud_grd` where subject='$subject' and amnt='$amnt' and stud_id='$r6[4]' and status=1"));
			
			?>
            <td align='center' nowrap><?=$fdate?>
			</td>
			<td align='center' nowrap><a href="view.php?imge=<?=$r6[0]?>"><?=$name?></a>
			</td>
            </tr>
            </table>
            <table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
			<tr>
            <td align='center' width="40%" class="rowpic" nowrap>Comments</td>
            <td align='center' width="20%"  class="rowpic" nowrap>Grade</td>
            </tr>
            <tr>
            <input type='hidden' name='subarr[]' value='<?=$r6[4]?>'>
            <td align='center' width="40%" nowrap><textarea cols="70" rows="3" name="cmnt<?=$r6[4]?>" title="Comments"><?=$val1[0]?></textarea></td>
            <td align='center' width="20%" nowrap><input type="text" name="grade<?=$r6[4]?>" size="3" title="Grade 1-7" maxlength="2" value="<?=$val1[1]?>"></td>
            </tr>
            </table>
            <?
			$nk++;			
			}
		}
	}

?>	
<br>
<div align="center"><input type="submit" name="submit" class="bgbutton" onChange="RefreshMe()" value="Update" /></div>
</form>
</body>
</html>