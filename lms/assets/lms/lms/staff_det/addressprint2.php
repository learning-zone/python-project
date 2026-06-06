<HTML>
<HEAD>
<?php
session_start();
require("../db.php");
$count = 0;
$f_name=$_POST['f_name'];
$staff_status=$_POST['staff_status'];
$staff_id=$_POST['staff_id'];
$subj=$_POST['subj'];

?>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
}
</script>
</HEAD>
<body>
<?php

	if(empty($f_name)  && ($subj=="0") && ($staff_status=="0")  && empty($staff_id))
{
        die("<font color=red>Please select proper details!! <a href='addresssearch.php'>Back to Search Form</a>");
}
 else  
 $SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id ";
	$flag = 0;
	if($staff_id !="")
	{
		$SQL .= " and a.slno='$staff_id' ";
		$flag = 1;
	}
	if($f_name != "")
	{
		if($flag==0)
		{
			$SQL .= "and  a.f_name LIKE '%$f_name%'";
			$flag = 1;
		}
		else
		{
			$SQL .= " and a.f_name LIKE '%$f_name%'";
		}
	}


	 if($subj != 0)
	{
		if($flag == 0)
		{
			$SQL .= "and  a.subj =' $subj'" ;
			$flag = 1;
		}
		else
		{
			$SQL .= " AND a.subj = '$subj'";
		}
	}


        
	if($staff_status=="1" )
	{
		$SQL .= " and a.active='YES'  ";
	}
	elseif($staff_status=="2")
	{
		$SQL .= " and a.active='NO' ";
	}
	else
	{
	$SQL.="  ORDER BY a.f_name";
	}

        $rs = execute($SQL) or die($SQL);
	$num = rowcount($rs);

?>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<INPUT TYPE="HIDDEN" NAME="branch_id" VALUE="<?=$branch_id;?>">
<INPUT TYPE="HIDDEN" NAME="course" VALUE="<?=$course;?>">
<INPUT TYPE="HIDDEN" NAME="course_year" VALUE="<?=$course_year;?>">
<table border="1" cellpadding="10" cellspacing="10" width='90%' align='center' class='forumline'>
 <tr height="13">
  <td colspan="3" align='center' class='head'>Staff's Address</td>
 </tr>

<tr><td width="35%" valign="top">
<?php
$num = rowcount($rs);
if($num==0)
{
	die("The search did not retrieve any values.");
}
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	$rs_dept=execute("select * from dept_no where dpt_id=$r[subj] and col_id=$cname");
	if( rowcount($rs_dept)==0)	
	{
		//	die("<font color='red' size=4> Department Details Not Found.");
	}
	$r_dept=fetcharray($rs_dept);
	$dept_name=$r_dept[Dept];
	mysql_free_result($rs_dept);
	$rs_sql=execute("select * from staff_des where d_id=$r[type_id] and col_id=$cname");
	$designation="";
	if(rowcount($rs_sql)>0)	
	{
		$r_sql=fetcharray($rs_sql);
		$designation=$r_sql[d_name];
	}
	mysql_free_result($rs_sql);
	$address = " ";
	$name = $r["f_name"]. " " .  $r["s_name"];
	if($addr == 1)
	{
		$address .= $r["addr_perm"];
	}
else
	{
		$address .= $r["addr_pres"];
	}
	if($addr == 1)
	{
		$city = $r["ct_perm"] . " - " . $r["pin_perm"];
	}
else
	{
		$city = $r["ct_pres"]  . " - " . $r["pin_pres"];
	}
	if($addr == 1)
	{
		$state = $r["st_perm"];
	}
else
	{
		$state = $r["st_pres"];
	}
	if($addr == 1)
	{
		$phone = $r["ph_perm"];
	}
else
	{
		$phone = $r["ph_pres"];
	}
		$temp = str_replace(",","<br>",$address);
    	$temp1 = str_replace(",","\n",$address);
	if($old_dept_name <> $dept_name)	
	{
		echo $dept_name."<br><hr>";
		$line1=$dept_name."\n\n";
	}
	$old_dept_name=$dept_name;
	?>&nbsp;&nbsp;<b><?=$name?></b><br>
	&nbsp;&nbsp;<?=$temp?><br>
	&nbsp;&nbsp;<?=$city?><br>
	&nbsp;&nbsp;<?=$state?><br>
<?php
	if($phone != "" )
	{
?>
	&nbsp;&nbsp;Ph: <?=$phone?><br>
<?php
	}
?>	
	<?php
		if(++$count==3)
		{
		    echo "</td></tr><tr><td width='35%' valign='top'>";
			$count=0;
		}else{
		    echo "</td><td  width='35%'  valign='top'>";
		}
	}

if($count<3){
echo "&nbsp;</td>";
while(++$count<3){
	echo "<td>&nbsp;</td>";
}
echo "</tr>";
}

?>
</table>

<div id='prn' align='center'>
  <input class='bgbutton' type="button" value="PRINT THE REPORT" name="print" onClick="printReport()" >
</div>
</BODY>
</HTML>


