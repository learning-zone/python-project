<?php

session_start();

include("../db.php");

$academic_year=$_SESSION['AcademicYear'];
$user=$_SESSION['user'];
$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));
$adate="1".date("/m/Y");
$bdate=date("d/m/Y");
?>



<html>

<head>

<title>Student details Modify form</title>

</head>



<body>

<script LANGUAGE="JavaScript">



function reload(str)

{

var url="../sessionbranchfile.php";

url=url+"?q="+str;

url=url+"&sid="+Math.random();



if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}
</script>
<script type="text/javascript">
function ReloadMe()
{
//	alert('1');
	document.frm.action="select_stud_modrep2.php";
	document.frm.submit();
}
function ReloadMe1()
{
	//alert('2');
	document.frm.action="select_stud_modrep2exl.php";
	document.frm.submit();
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>

<form method='post' action="" name="frm" >
<?php
if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || $staffrigtss[0]=='ADMIN')
{
	$rs=execute("select a.id,a.codename,a.section_name from class_section a,subject_m b where b.sub_type=2 and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1 group by a.id order by  b.course_year_id,a.section_name");
	while($r=fetcharray($rs))
	{
			$classid[]=$r[0];
			$classname[]=$r[1].' '.$r[2];
	}
}
else
{
	$sqlname=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
	
	while($sqlname1=fetcharray($sqlname))
	{
		$tmorets[]=$sqlname1[0];
	}
	
	$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
	
	while($sqnmars1=fetcharray($sqnmars))
	{
		$tmorets[]=$sqnmars1[0];
	}
	$tmorets1=array_unique($tmorets);
	
	while (list(, $value) = each($tmorets1)) 
	{
		$j=$value;
		$sql1="select id,codename,section_name from class_section where id='".$j."' and status=1 order by grade";
		$sqlname=fetchrow(execute($sql1));
		$classid[]=$j;
		$classname[]="$sqlname[1]-$sqlname[2]";
	}

}
?>

<table class='forumline' align='center' cellpadding="4" width="80%" border="1" >
<tr><td Class="Head" colspan="4" align='center'>  Detailed Student Attendance</td></tr>
<tr height="30">
    <td align=''>Date </td>
    <td align='' colspan="3" nowrap><input type="text" name="adate" value="<?=$adate?>" readonly>&nbsp;&nbsp;
	<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;To&nbsp;&nbsp;<input type="text" name="bdate" value="<?=$bdate?>" readonly>&nbsp;&nbsp;
	<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
</tr>
<tr >
	<td align='' valign="top">Class</td>
    <td align="" >
        <div style="overflow-y:auto;height:200px;">
        <table width="100%">
            <tr>
                <td width="100%">
                <?php
                for($i=0;$i<sizeof($classid);$i++)
                {
                        $val=$classid[$i];
                        $dname=$classname[$i];
                        echo "<input type='checkbox' name='section[]' value='$val'>&nbsp;&nbsp;&nbsp;&nbsp;$dname<br>";
                }
                ?>
                </td>
            </tr>
        </table>
        </div>
    </td>
	<td align='' valign="top">Code</td>
    <td align="" >
        <div style="overflow-y:auto;height:200px;">
        <table width="100%">
            <tr>
                <td width="100%">
                <?php
				$sql1=execute("select order_id, Description from attendance_points where Status=1");		while($r=fetcharray($sql1))
                {
                      echo "<input type='checkbox' name='code[]' value='$r[0]'>&nbsp;&nbsp;&nbsp;&nbsp;$r[1]<br>";
                }
                ?>
                </td>
            </tr>
        </table>
        </div>
    </td>
</tr>
<tr height="30">
    <td align='' colspan="" nowrap>Tolerances</td>
    <td align='' colspan="3" nowrap> Percent &nbsp; ( Less than or equal to )
      <input type="text" width="5"  name="per" value="" >      
        <br> Number of days  ( Greater than or equal to ) &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" width="5" name="days" value="">
        <br> Number of days  ( Less than or equal to ) &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" width="5" name="daysless" value=""></td>
</tr></table>
<br>
    <div align="center">
	    <input type="button" name="print" value="Generate Report" class="bgbutton"  onClick="ReloadMe()">&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" name="print" value="Export To Excel " onClick="ReloadMe1()" class="bgbutton" >
    </div>
<br>
</form>
</body>

</html>