<?php
session_start();
require_once("../db.php");


/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET['tmid'])
{	
	$tmid = $_GET['tmid'];
	$flag = $_GET['flag'];
	$type = $_GET['type'];
	$media = $_GET['media'];
	$memtp = $_GET['memtp'];
	$medtyp =$_GET['medtyp'];
}
if($_GET and !$_GET['tmid'])
{
	$tmid = $_REQUEST['tmid'];
	$media = $_GET['media'];
	$flag = $_REQUEST['flag'];
	$medtyp =$_REQUEST['medtyp'];
	$barcode= $_REQUEST['barcode'];
	$library = $_REQUEST['library'];
}
if($_POST)
{
	$sel = $_POST['sel'];
	$mno = $_POST['mno'];
	$tmid=$_POST['tmid'];
	$media=$_POST['media'];
	$flag = $_POST['flag'];
	$idate=$_POST['idate'];
	$accno=$_POST['accno'];
	$medtyp=$_POST['medtyp'];
	$issued=$_POST['issued'];
	$library=$_POST['library'];
	$barcode= $_POST['barcode'];
	$eligible=$_POST['eligible'];
	$n_due_date=$_POST['n_due_date'];
}


///////////////////////////////////////////////////////////////////////////////////////
if($accno){
$array=preg_split("/(\d+)/", "$accno", -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //PHP split string into string AND integer

if($array[0]=='P' and $media==1)
{
	//echo 'PYP LIBRARY BOOK';

}elseif($array[0]=='M' and $media==1)
{
	//echo 'MYP LIBRARY BOOK';

}elseif($array[0]=='PT' and $media==6)
{
	//echo 'PYP TEXT BOOK';

}elseif($array[0]=='MT' and $media==6)
{
	//echo 'MYP TEXT BOOK';

}else{
	?>
    <script type="text/javascript">
		alert("Please enter the valid Accession Number...");
	</script>    
    <?
}
}

///////////////////////////////////////////////////////////////////////////////////////
?>
<html><head>
<style>
  .text {text-align:center;}
</style>
<script language='javascript'>
function selectMe()
{
	i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}
function focus()
{
	if(document.frm.tmid.value!='')
		document.frm.accno.focus();
	else
		document.frm.tmid.focus();
}
function reload()
{
	document.frm.action='lib.php'
	document.frm.submit();
}
function issueMe()
{
	document.frm.action='lib_issue.php';
	//document.frm.action='lib.php';
	document.frm.submit();
}
function retrunMe()
{
	document.frm.action='returnMedia.php';
	document.frm.submit();
}
function renewMe()
{
	document.frm.action='renewMedia.php';
	document.frm.submit();
}
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, 'toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
</head> 
<body onload='focus()'>
<form name='frm' method='post'>
<table border='0' align='center' class='forumline' width="47%" ><br/>
<tr><td class='head' align='center' colspan="0">Transact Media</td></tr>
<tr><td><table border='0' align='center' class='forumline' width='100%'>

<?php
$s1="";
$s2="";
$s3="";
if($medtyp==1)
{
	$s1="selected";
	$medname="Student Id";
}
elseif($medtyp==2)
{
	$s2="selected";
	$medname="Accession Number";
}
elseif($medtyp==3)
{
	$s3="selected";
	$medname="Staff Id";
}
?>

<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;Transact media By</td>
<td><select name='medtyp' onChange="reload()">
<option value=''>--- Select Type ---</option>
<option value='1' <?=$s1?>>&nbsp;&nbsp;Student ID</option>
<option value='3' <?=$s3?>>&nbsp;&nbsp;Staff ID</option>
<!--<option value='2' <?=$s2?>>&nbsp;&nbsp;&nbsp;Accession Number</option>-->
</select></td></tr>
<?php
if($medtyp!='')
{	
	?>
	<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<?=$medname?>&nbsp;&nbsp;</td>
    <td><input type='text' name='tmid' value='<?php echo $tmid?>' onChange="reload()" size=20>
    <?
		if($medtyp==1)
		{
		?>
    		<input type="button"  value="Search" onclick ="OpenWind2('search_student_det.php', 'OpenWind2',800,800)" class="bgbutton"/>
    	<?
		}
		if($medtyp==3)
		{
		?>
            <input type="button"  value="Search" onclick ="OpenWind2('search_staff_det.php', 'OpenWind2',800,800)" class="bgbutton"/>
    	<?
		}
	?>
    </td>
</tr>
	</table></td></tr></table>
	<tr><p align='center'><input type='button' name='bb' value='Submit' class='bgbutton'></p></tr>

	<?php
}
if($tmid!="" && $medtyp!='')
{
	$d=getdate();
	$MyDay=$d["mday"];
	$MyMonth=$d["mon"];
	$MyYear=$d["year"];

	if($MyMonth < 10)
	{
		$IMon="0".$MyMonth;
	}
	else
	{
		$IMon=$MyMonth;
	}
	if($MyDay < 10)
	{
		$IDay="0".$MyDay;
	}
	else
	{
		$IDay=$MyDay;
	}
	$IYear=$MyYear;
	$ndate = $IDay."-".$IMon."-".$IYear;
	$ndate1 = $IYear."-".$IMon."-".$IDay;
	if($medtyp==1 || $medtyp==3)
	{
		//echo "<br>SELECT s_id,type,m_no FROM lib_membership_m WHERE status=1 AND m_no='$tmid'";
		$mm=execute("SELECT s_id,type,m_no FROM lib_membership_m WHERE status=1 AND m_no='$tmid'");
		if(rowcount($mm)>0)
		{
			$mm1=fetcharray($mm);
			$memtp=$mm1[type];
			$tmid=$mm1[m_no];
			if($memtp==1)
			{
				$mem="Student ID";
				$mem1="Student Name";
				$mem2="&nbsp;&nbsp;&nbsp;Program";
				$mem3="Semester & Section";
				$ss=execute("SELECT first_name,last_name,course_admitted,course_yearsem,class_section_id,img_source,student_id,usn FROM student_m WHERE id='$mm1[s_id]'");
				if(rowcount($ss)>0)
				{
					$ss1=fetcharray($ss);
					$ccc1=$ss1[course_admitted];
					$image=$ss1[img_source];
					$stud1 = fetcharray(execute("SELECT course_abbr FROM course_m WHERE course_id='$ss1[course_admitted]'"));
					$stud2 = fetcharray(execute("SELECT year_name FROM course_year WHERE year_id='$ss1[course_yearsem]'"));
					$n=$ss1[first_name]." ".$ss1[last_name];
					$nn=$stud1[0];
					if($ss1[usn]!="")
						$stid=$ss1[usn];
					else
						$stid=$ss1[student_id];
					if($ss1[class_section_id]==0)
						$section='No Section';
					else
					{
						$stud3 = fetcharray(execute("SELECT section_name FROM class_section WHERE id='$ss1[class_section_id]'"));
						$section=$stud3[section_name]." Section";
					}
					$nnn=$stud2[0]." - ".$section;
				}
			}
	
			elseif($memtp==2)
			{
				$mem="Staff Id";
				$mem1="Staff Name";
				$mem2="Designation";
				$mem3="Department";
				
				//echo "<br>SELECT f_name,s_name,slno,subj,img_col,type_id FROM staff_det WHERE id='$mm1[s_id]'";
				$ss=execute("SELECT f_name,s_name,slno,subj,img_col,type_id FROM staff_det WHERE id='$mm1[s_id]'");
				if(rowcount($ss)>0)
				{
					
					$ss1=fetcharray($ss);
					$ccc1=$ss1[subj];
					$stid=$ss1[slno];
					$image=$ss1[img_col];
					$stud1 = fetcharray(execute("SELECT Dept FROM dept_no WHERE dpt_id='$ss1[subj]'"));
					$stud2 = fetcharray(execute("SELECT d_name FROM staff_des WHERE d_id='$ss1[type_id]'"));
					$n=$ss1[f_name]." ".$ss1[s_name];
					$nn=$stud2[0];
					$nnn=$stud1[0];
				}
			}
			elseif($memtp==3)
			{
				$mem="Department Id";
				$mem1="Department Name";
				
				$ss=execute("SELECT dpt_id,Dept,dept_code FROM dept_no WHERE dpt_id='$mm1[s_id]'");
				if(rowcount($ss)>0)
				{
					$ss1=fetcharray($ss);
					$ccc1=$ss1[Dept];
					$stid=$ss1[dept_code];
					$n=$ss1[Dept];
				}
			}
			else
			{
				$fgk=99;
				echo "<div><font color='red'>Wrong Member ID !!</font></div><br/>";
			}
		}
		else
		{
			$fgk=99;
			echo "<div><font color='red'>Wrong Member ID !!!</font></div><br/>";
		}
	}
	else
	{
		
		$mn=execute("SELECT cno FROM lib_circulation_m WHERE acc_id like '$tmid' AND status=0 order by id desc limit 1");
		if(rowcount($mn)>0)
		{
			$mn1=fetcharray($mn);
			$tmid=$mn1[0];
			$mm=execute("SELECT s_id,type FROM lib_membership_m WHERE m_no='$tmid'");
			if(rowcount($mm)>0)
			{
				$mm1=fetcharray($mm);
				$memtp=$mm1[type];
				if($memtp==1)
				{
					$mem="Student ID";
					$mem1="Student Name";
					$mem2="Program";
					$mem3="Semester & Section";
					$ss=execute("SELECT first_name,last_name,course_admitted,course_yearsem,class_section_id,img_source,student_id,usn FROM student_m WHERE id='$mm1[s_id]'");
					if(rowcount($ss)>0)
					{
						$ss1=fetcharray($ss);
						$ccc1=$ss1[course_admitted];
						$image=$ss1[img_source];
						$stud1 = fetcharray(execute("SELECT course_abbr FROM course_m WHERE course_id='$ss1[course_admitted]'"));
						$stud2 = fetcharray(execute("SELECT year_name FROM course_year WHERE year_id='$ss1[course_yearsem]'"));
						$n=$ss1[first_name]." ".$ss1[last_name];
						$nn=$stud1[0];
						if($ss1[usn]!="")
							$stid=$ss1[usn];
						else
							$stid=$ss1[student_id];
						if($ss1[class_section_id]==0)
							$section='No Section';
						else
						{
							$stud3 = fetcharray(execute("SELECT section_name FROM class_section WHERE id='$ss1[class_section_id]'"));
							$section=$stud3[section_name]." Section";
						}
						$nnn=$stud2[0]." - ".$section;
					}
				}
				elseif($memtp==2)
				{
					$mem="Staff Id";
					$mem1="Staff Name";
					$mem2="Designation";
					$mem3="Department";
					
					echo "SELECT f_name,s_name,slno,subj,img_col,type_id FROM staff_det WHERE id='$mm1[s_id]'";
					$ss=execute("SELECT f_name,s_name,slno,subj,img_col,type_id FROM staff_det WHERE id='$mm1[s_id]'");
					if(rowcount($ss)>0)
					{
						$ss1=fetcharray($ss);
						$ccc1=$ss1[subj];
						$stid=$ss1[slno];
						$image=$ss1[img_col];
						$stud1 = fetcharray(execute("SELECT Dept FROM dept_no WHERE dpt_id='$ss1[subj]'"));
						$stud2 = fetcharray(execute("SELECT d_name FROM staff_des WHERE d_id='$ss1[type_id]'"));
						$n=$ss1[f_name]." ".$ss1[s_name];
						$nn=$stud2[0];
						$nnn=$stud1[0];
					}
				}
				elseif($memtp==3)
				{
					$mem="Department Id";
					$mem1="Department Name";
					$ss=execute("SELECT dpt_id,Dept,dept_code FROM dept_no WHERE dpt_id='$mm1[s_id]'");
					if(rowcount($ss)>0)
					{
						$ss1=fetcharray($ss);
						$ccc1=$ss1[Dept];
						$stid=$ss1[dept_code];
						$n=$ss1[Dept];
					}
				}
				else
				{
					$fgk=99;
					echo "<div><font color='red'>Wrong Member ID ...!!</font></div><br/>";
				}
			}
			else
			{
				$fgk=99;
				echo "<div><font color='red'>Wrong Member ID ...!!!</font></div><br/>";
			}
		}
		else
		{
			echo "<div><font color='red'>Wrong Accession Number or Media not issued ...!!</font></div><br>";
			$fgk=99;
		}
	}
	if($fgk!=99)
	{
		?>
		<tr><td><table border='0' align='center' class='forumline' width='90%'>
		<tr><td class='head' align='center' colspan='4'>Member Details</td>
		<?php
		if($memtp!=3)
		{
			?>
			<td rowspan='4' align='center' width='20%'><img src="<?php echo $image?>" width='125' height='110'></img></td>
		</tr>
			<?php
		}
		?>
		<tr><td width="27%">&nbsp;&nbsp;&nbsp;Member ID</td>
		<td width="23%"><?=$tmid?></td>
		<td width="18%">&nbsp;&nbsp;&nbsp;<?=$mem?></td>
		<td width="14%" align="left"><?=$stid?></td>
		</tr>
		<tr><td>&nbsp;&nbsp;&nbsp;<?=$mem1?></td><td colspan="3" align="left"><?=$n?></td></tr>
		<?php
		if($memtp!=3)
		{
			?>
			<tr><td><?=$mem2?></td><td nowrap><?=$nn?></td>
			<td><?=$mem3?></td><td><?=$nnn?></td></tr>
			<?php
		}
		?>
		</table></td></tr>
		<?php
		if($library=="")
			$library=1;
		if($media=="")
			$media=1;
		?>
		<tr><td><table border='0' align='center' class='forumline' width='90%'>
		<tr><td class='head' align='center' colspan='8'>Issued Media Details</td></tr>
        <?php
	
		$query = execute("SELECT * FROM lib_mediatype");
		?>
		  <td colspan="3">&nbsp;&nbsp;&nbsp;Media Type&nbsp;</td>
		    <td align='center'><select name="media" onchange='reload()'>
		<?php
		while($qrow=fetcharray($query))
		{
			if($qrow[id]==$media)
				echo "<option value='$qrow[id]' selected>$qrow[name]</option>";
			else
				echo "<option value='$qrow[id]' >$qrow[name]</option>";
		}
		if($memtp==1)
		{
			$q2=execute("SELECT issues FROM cir_parameter WHERE member='$memtp' AND course='$ccc1' AND media='$media'");
			if(rowcount($q2)==0)
				$q2=execute("SELECT issues FROM cir_parameter WHERE member='$memtp' AND course='0' AND media='$media'");
			$qq=fetcharray($q2);
		}
		else
		{
			$q2=execute("SELECT issues FROM cir_parameter WHERE member='$memtp' AND department='$ccc1' AND media='$media'");
			if(rowcount($q2)==0)
				$q2=execute("SELECT issues FROM cir_parameter WHERE member='$memtp' AND department='0' AND media='$media'");
			$qq=fetcharray($q2);
		}

		?>
		</select></td>
      <?

		$ww=execute("SELECT * FROM lib_circulation_m WHERE media_type='$media' AND cno='$tmid' AND status=0 ORDER BY due_date");

		$cntww=rowcount($ww);
	?>

        <td align='center'>&nbsp;&nbsp;Eligibility&nbsp;&nbsp;</td><td align='center'><input type='text' class='text' name='eligible' value='<?php echo $qq[0] ?>' size='2' readonly></td>
		<td align='center'>&nbsp;&nbsp;Issued&nbsp;&nbsp;</td><td align='center'><input type='text' class='text' name='issued' value='<?php echo $cntww ?>' size='2' readonly></td></tr>
		<?php
		if($cntww>0)
		{
		?>
		<tr><td align='center' class='row3'><div id="checkAll" 
		onClick="selectMe()" Title="Click to Select all">All</div></td>
		<td class='row3' align='center'>Acc No</td>
		<td class='row3' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title</td>
		<td class='row3' align='center'>&nbsp;&nbsp;Author</td>
		<td class='row3' align='center'>Publisher</td>
		<td class='row3' align='center'>Issue Date</td>
		<td class='row3' align='center'>Due Date</td>
		<td class='row3' align='center'>Fine</td></tr>
		<?php
		$msg2 = rowcount($ww);	
		for($i=0;$i<$msg2;$i++)
		{
			
			$msg3=fetcharray($ww);
			if($msg3[media_type]==1)
			{
				$sel = "SELECT a.title,a.author,a.publisher,a.year,a.edition,b.call_no,b.acc_no,b.library,b.register ";
				$sel.=" FROM lib_book_details a,lib_acc_details b WHERE b.acc_no='$msg3[acc_id]' AND a.id=b.master_id AND b.mode='A'";				
				$sel.=" AND b.library='$msg3[library]' AND b.register='$msg3[register]'";	
				
			}
			
			if($msg3[media_type]==2 || $msg3[media_type]==4 )
			{
				$sel.=" b.acc_no='$msg3[acc_id]' AND a.id=b.master_id AND b.mode='A' AND b.media_type=$msg3[media_type]";
				$sel = "SELECT a.title,a.author,a.publisher,a.year,b.call_no,b.acc_no FROM lib_cd_det a,lib_cd_acc_det b WHERE ";
				$sel.=" b.acc_no='$msg3[acc_id]' AND a.id=b.master_id AND b.mode='A' AND b.media_type=$msg3[media_type]";
			}
			if($msg3[media_type]==5)
			{
				$sel = "SELECT a.title,a.author,a.publisher,a.year,a.edition,b.call_no,b.acc_no FROM lib_project_report_det a,lib_proj_acc_det";
				$sel.=" b WHERE b.acc_no='$msg3[acc_id]' AND a.id=b.master_id AND b.mode='A'";
			}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($msg3[media_type]==6)
			{
				$sel ="SELECT a.title,a.author,a.publisher,a.year,a.edition,b.call_no,b.acc_no ";
				$sel.=" FROM lib_book_details a,lib_acc_details b WHERE b.acc_no='$msg3[acc_id]'";
				$sel.=" AND a.id=b.master_id AND b.mode='A' AND b.library='$msg3[library]' AND b.register='$msg3[register]'";				
				
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($msg3[library]==1 and $msg3[register]==1)  //PYP LIBRARY BOOK
			{
				$acnoLabel="P";
			}
			if($msg3[library]==1 and $msg3[register]==3)  //PYP TEXT BOOK
			{
				$acnoLabel="PT";
			}
			if($msg3[library]==2 and $msg3[register]==2) //MYP LIBRARY BOOK
			{
				$acnoLabel="M";
			}
			if($msg3[library]==2 and $msg3[register]==4) //MYP TEXT BOOK
			{
				$acnoLabel="MT";
			}
			
			$sel1 = execute($sel);
			$sel2= fetcharray($sel1);
			?>					
		<tr>
            <td align='center'><input type='checkbox' name='sel[]' value='<?php echo $msg3[id] ?>' id="issued" onClick="enable('<?php echo $msg3[id] ?>','<?php echo $ndate1 ?>');" ></td>
			<td align='center'><?php echo $acnoLabel.$sel2[acc_no] ?></td>
			<td>&nbsp;&nbsp;<?php echo $sel2[title] ?></td>
			<td>&nbsp;&nbsp;<?php echo $sel2[author] ?></td>
			<td>&nbsp;&nbsp;<?php echo $sel2[publisher] ?></td>
			<?php
			$idate=explode("-",$msg3[issue_date]);
			$day=$idate[2];
			$mon=$idate[1];
			$yr=$idate[0];
			$idate1=$day."/".$mon."/".$yr;
			?>
			<td align='center'><?php echo $idate1 ?></td>
			<?php
			$ddate=explode("-",$msg3[due_date]);
			$dday=$ddate[2];
			$dmon=$ddate[1];
			$dyr=$ddate[0];									
			$ddate1=$dday."/".$dmon."/".$dyr;
			?>
			<td align='center'><input type="hidden" name="n_due_date<?php echo $msg3[id] ?>" value='<?php echo $ddate1 ?>'><?php echo $ddate1 ?></td>
			<?php
			$fine_amt=0;
			$cdte=date("Y-m-d");
			$nsql=execute("SELECT to_days('".$cdte."')-to_days('".$msg3[due_date]."')") or die(error_description());
			$nrs=fetcharray($nsql);
			$ndays=$nrs[0];
			//echo $ndays;
			$frs=fetcharray(execute("SELECT * FROM lib_finedtls"));
			if($ndays>0)
			{
				if($ndays>$frs[daysfrom])
				{
					$fine_amt=$frs[fine1]*$frs[daysfrom];
					$ndays-=$frs[daysfrom];
					$nextd=$frs[daysto]-$frs[daysfrom];
					if($ndays>$nextd)
					{
						$fine_amt=$fine_amt+($frs[fine2]*$nextd);
						$ndays-=$nextd;
						$fine_amt=$fine_amt+($ndays*$frs[fine3]);
					}
					elseif($ndays==$nextd)
						$fine_amt=$fine_amt+($frs[fine2]*$nextd);
					else
						$fine_amt=$fine_amt+($ndays*$frs[fine2]);
				}
				elseif($ndays==$frs[daysfrom])
					$fine_amt=($frs[fine1]*$frs[daysfrom]);
				else
					$fine_amt=($ndays*$frs[fine1]);
			}
			else
				$fine_amt=0;
			$fine_amt1 = number_format($fine_amt,2);
			echo "<td align='center'><input type='text' name='fine".$msg3[id]."' value='$fine_amt1' size='6'></td></tr>";
		}
		?>
		<tr height='30'><td colspan='8' align='right'><input class='bgbutton' type='button' name='return' value='Return' id='return' onclick='retrunMe()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input class='bgbutton' type='button' name='renew' value='Renew' id='renew' onclick='renewMe()'>&nbsp;&nbsp;</td></tr></table>
		<?php
		}
		else
		{
			echo "<tr height='30'><td colspan='8'>&nbsp;&nbsp;&nbsp;No Issues ...</td></tr></table></td></tr>";
		}
		?>
		<input type='hidden' name='mno' value='<?=$tmid?>'>
		<tr>
        	<td>
            	<table border='0' align='center' class='forumline' width='90%'>
					<tr>
                    	<td class='head' align='center' colspan='8'>Current Issue</td>
                     </tr>
					<tr height="30">
                    	<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;RFID/BARCODE</td>
                        <td colspan="4"><input type='text' name='accno' value='<?php echo $accno?>' onmouseover="this.focus();" size=70></td>
                    </tr>
					<tr>
                    	<td nowrap >&nbsp;&nbsp;&nbsp;&nbsp;Issue Date (DD-MM-YYYY)</td>
                        <td><input type='text' name='idate' value='<?php echo $ndate?>' size=12></td>
						<td nowrap>&nbsp;&nbsp;*Accession No</td>
        				<td><input type='text' name='accno' value='' onchange='addMe()'></td>
						<td>&nbsp;&nbsp;<input type='button' name='bb' value='Issue' class='bgbutton' onclick='issueMe()'></td>
                    </tr>
				</table>
              </td>
            </tr>
         </table>
		<?php
	}
}
   
if($flag==1)
{
	?>
		<script language='javascript'>
		alert("Accession Number Does Not Exist");
		</script>
	<?php			
}
if($flag==2)
{
	?>
		<script language='javascript'>
		alert("Accession Number Already Issued");
		</script>
	<?php	
}
if($flag==3)
{
	?>
		<script language='javascript'>
		alert("Media removed from stock");
		</script>
	<?php	
}
if($flag==4)
{
	?>
		<script language='javascript'>
		alert("Cannot issue as Media is Missing");
		</script>
	<?php	
}
if($flag==5)
{
	?>
		<script language='javascript'>
		alert("Cannot issue as Media is Damaged.");
		</script>
	<?php	
}
if($flag==6)
{
	?>
		<script language='javascript'>
		alert("Media Issued. ");
		</script>
	<?php	
}
if($flag==7)
{
	?>
		<script language='javascript'>
		alert("Cannot issue as max no of issues exceeded. ");
		</script>
	<?php	
}
if($flag==8)
{
	?>
		<script language='javascript'>
		alert("Media returned. ");
		</script>
	<?php	
}
if($flag==9)
{
	?>
		<!--<script language='javascript'>
		alert("Max no of renewals exceeded. ");
		</script>-->
	<?php	
}
if($flag==10)
{
	?>
		<!--<script language='javascript'>
		alert("Media renewed. ");
		</script>-->
	<?php	
}
if($flag==11)
{
	?>
		<script language='javascript'>
		alert("Cannot issue as Media is reserved by other member. ");
		</script>
	<?php	
}

if($tmid!='' and $medtyp!='' and $type!=''){    
?>
<input type="hidden" name="tmid" value="<?=$tmid?>">
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="medtyp" value="<?=$medtyp?>">
<? } ?>
</form>
</body>
</html>