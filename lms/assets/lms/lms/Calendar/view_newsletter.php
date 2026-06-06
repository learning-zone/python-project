<?php

session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];
$sem=$_SESSION['sem'];

?>
<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<title>Newsletter
</title>
</head>
<?php

	$sem=$_SESSION['sem'];			// class / grade

?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="view_newsletter.php";
	document.frm.submit();
}

function addnew()
{
		
		//alert("Save");
		
		// var tval=document.getElementById("type").value;
		// if(tval==1)
		{
			var adate=document.getElementById("import_file").value;
			
			var caption=document.getElementById("caption").value;
			if(adate=='' || caption=='')
			{
				if(caption=='' && adate!='')
					var msg="Enter the Title ";
				if(caption!='' && adate=='')
					var msg="Upload the File ";
				if(adate=='' && caption=='')
					var msg="Upload the file and give a Caption";
				
				alert(msg);
			}
			else
			{
				document.frm.action="view_newsletter.php?save=save";
				document.frm.submit();
			}
			

		}
		
		
}

</SCRIPT>
<BODY>
<br>
    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Preview Newsletter</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic" nowrap="nowrap">No.</td>
    <!-- <td align="center" class="rowpic">Contents</td> -->
    <td align="center" class="rowpic">Download</td>
    <td align="center" class="rowpic">Description</td>
    <!-- <td align="center" class="rowpic">Division</td>
    <td align="center" class="rowpic">Grade</td>	-->
  </tr>
  <?
	$inc=1;
		$temsql3=execute("select * from newslatter_class_call where status=1 and grade='$sem'");
	//$temsql3=execute("select * from newslatter_class_call where status=1 and grade!='0'");
	while($r=fetcharray($temsql3))
	{
		echo "<tr height='25'>";
			//echo "<td align='center'>$inc</td>";
			echo "<td align='center' nowrap>$inc</a></td>";
			
			$temppath=$r['file_name'];
			// echo "<td><iframe src='http://docs.google.com/gview?url=http://demo.myschoolone.com/renew/Calendar/$temppath&embedded=true' style='width:480px; height:320px;' frameborder='0'></iframe></td>";
			
			echo "<td align='center' nowrap>";			
			
			$file_name=explode("/",$r[file_name]);
			if($temppath!="")
			echo "<a href='$r[file_name]' title='Click here to Download $file_name[1]'> <img src='../images/Download.png'></a>";
			else
			echo "File Not Found";
			
			//echo date("d-m-Y",strtotime($r['fromdate']));
			echo "</td>";
		echo "<td align='center' nowrap>$r[caption]</td>";
		
		/*
			
			echo "<td align='center' nowrap>$r[division]</td>";		// branch
			echo "<td align='center' nowrap>$r[grade]</td>";		// grade sem
		*/
				
		/*		echo "<td align='center'>";
				$rs=execute("SELECT * FROM course_m where course_id='$r[division]'");
				while($r1=fetcharray($rs))
				{
					echo " $r1[coursename] ";
				}
		*/

		/*
				echo "</td>";
				echo "<td align='center'>";
				$rs=execute("select * from course_year where year_id='$r[grade]'");
				//$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$r[grade]'");
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r2=fetcharray($rs);
				  echo " $r2[year_name] ";			
				}
				echo "</td>";
		*/	
			
			/*
			if($r[todate]=='0000-00-00')
			{
				echo date("d-m-Y",strtotime($r['fromdate']));
			}
			else
				echo date("d-m-Y",strtotime($r['todate']));
			*/
			
			echo "</tr>";
  $inc++;
	}

/*
ALTER TABLE `newslatter_class_call` ADD `file_name` VARCHAR( 255 ) NULL ,
ADD `caption` VARCHAR( 255 ) NULL 
*/
	
?>
	</table>
</BODY>
</HTML>