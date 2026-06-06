<?php
require_once("../db.php");
$register=$_POST['register'];
$SeekPos=$_POST['SeekPos'];
$media_type=$_POST['media_type'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];

if(!checkdate($FMon,$FDay,$FYear))
{
	echo "Invalid From Date. ";
	die("</td></tr></table>");
}
$from_date = "$FYear-$FMon-$FDay";

if(!checkdate($TMon,$TDay,$TYear))
{
	echo "Invalid To Date.";
	die("</td></tr></table>");
}
$to_date = "$TYear-$TMon-$TDay";

?>
<html>
<head>
<script language="JavaScript">
function frm_submit()
{
	document.form1.SeekPos.value=0;
}
function printReport()
{
	prn.style.display = "none";
	prn1.style.display = "none";
	window.print();
	prn.style.display = "";
	prn1.style.display = "";
}
</script>
</head>
<body>
<?
echo "<div id='main_header'>";
if($register !="")
{
	$qry="select * from lib_register where id=$register";
	$ls=execute($qry) or die(error_description());
	$rls=fetcharray($ls);
}
echo "<table  width='90%' class=forumline align='center'>";
echo "<tr><td colspan=2 class=head align=center>";
if($media_type=='N')
{
	echo "Statistics of News Paper";
}
else if($media_type=='M')
{
	echo "Statistics of Magazine";
}
else if($media_type=='J')
{
  echo "Statistics of Journals";
}
echo "</td></tr>";
echo "<tr>";

/*
echo "Register:";
if($register!=-1)
{
$rs_sql=execute("select * from lib_register where id=$register");
$r_sql=fetcharray($rs_sql);
echo "$r_sql[register]";
}else
{
echo "ALL";
}
echo "</td>";
*/
$Register=1;
echo "<td align='left'>";
$c_date=date('d-m-Y');
echo "As On $c_date ";
echo "</td></tr>";
echo "<tr><td colspan=2 align='center'>";
echo "From : ";
print date('d-m-Y',strtotime($from_date));
echo "  To : ";
print date('d-m-Y',strtotime($to_date));
echo "</td></tr>";
echo "</table>";
$ctr=0;
echo "<center><table border=1 cellpadding=0 cellspacing=0 class='forumline' width='90%'>";
echo "<tr height='20'>";
echo "<td class='head' align='center'>Sl.No.</td>";
echo "<td class='head' align='center'>Title</td>";
if($media_type=='N')
{
echo "<td class='head' align='center'>newspaper No</td>";
}

if($media_type=='J')
{
echo "<td class='head' align='center'>Journal No</td>";
}

if($media_type=='M')
{
echo "<td class='head' align='center'>Magazine No</td>";
}

echo "<td class='head' align='center'>No. of Copies</td>";

echo "<td class='head' align='center'>Amount per Unit</td>";

echo "<td class='head' align='center'>Total Amount</td>";
echo "</tr>";

if($register!=-1)
{    
	if($media_type=='N')
		{   
		
		    $register=3;
			$qry="select distinct(title) from lib_newspaper_det where register=$register and newspaper_date between '$from_date' and"; 
			$qry .=" '$to_date' order by title ";
		}
	else if($media_type=='J')
		{
		    $register=4;
			$qry="select distinct(title) from lib_magazine where register=$register and magazine_date between '$from_date' and";
			$qry .="'$to_date' and magazine_no like 'J%' order by title ";
		}
	else if($media_type=='M')
		{   
		    $register=5;
			$qry="select distinct(title) from lib_magazine where register=$register and magazine_date between '$from_date' and";
			$qry .="'$to_date' and magazine_no like 'M%' order by title ";
		}
}
else
{
	if($media_type=='N')
		{   
		    
			$qry="select distinct(title) from lib_newspaper_det where newspaper_date between '$from_date' and '$to_date' order by title";
		}
	else if($media_type=='J')
		{
			$qry="select distinct(title) from lib_magazine where magazine_date between '$from_date' and '$to_date' and";
			$qry .=" magazine_no like 'J%' order by title ";
		}
	else if($media_type=='M')
		{
			$qry="select distinct(title) from lib_magazine where magazine_date between '$from_date' and '$to_date' and";
			$qry .=" magazine_no like 'M%' order by title ";
		}
}
$t4=execute($qry);
$countRS = rowcount($t4);

if($countRS==0)
{
	die("Record Not Found.");
}
$total_copies=0;
$total=0;
$sum=0;
for($i=0;$i<$countRS;$i++)
{
	$row = fetcharray($t4,$i);
	if($media_type=='N')
	{
		$sql2="select * from lib_newspaper_det where title='$row[title]'";
	}
	else if($media_type=='M')
	{
		$sql2="select * from lib_magazine where title='$row[title]' and magazine_no like 'M%'";
	}
	else if($media_type=='J')
	{
	 	$sql2="select * from lib_magazine where title='$row[title]' and magazine_no like 'J%'";
	}
	$rs22=execute($sql2);
	$r22=fetcharray($rs22);
	if($media_type=='N')
	{
		$sql="select count(id) as no_count ,sum(amount) as total_amount from lib_newspaper_det where title='$row[title]' and newspaper_date between '$from_date' and '$to_date'";
		//echo $sql;
		//echo "<br>";
	}
	else if($media_type=='J')
	{
		$sql="select count(id) as no_count ,sum(amount) as total_amount from lib_magazine where title='$row[title]' and magazine_no like 'J%' and magazine_date between '$from_date' and '$to_date' ";
	}
	else if($media_type=='M')
	{
		$sql="select count(id) as no_count ,sum(amount) as total_amount from lib_magazine where title='$row[title]' and magazine_no like 'M%' and magazine_date between '$from_date' and '$to_date' ";
	}
	$rs=execute($sql);

	if(rowcount($rs)>0)
	{
		$r=fetcharray($rs,0);
		$count=$r[0];
		$total_amount=$r[1];
	}
	else
	{
		$count=0;
		$total_amount=0;
	}
	if(is_null($total_amount) )
	{
		$total_amount="0.00";
	}
	$temp_i=strval($i)+1;
	$title=$r22[title];
	echo "<tr>";
	echo "<td align='center'>$temp_i</td>";		
	echo "<td align='center'>$title</td>";
	if($media_type=='N')
	{
	echo "<td align='center'>$r22[newspaper_no]</td>";
	}
	else
	{
	echo "<td align='center'>$r22[magazine_sub_no]</td>";
	}
	//echo "<td align='right'>$count</td>";
	//echo "<td align='right'>$total_amount</td>";
	echo "<td align='right'>$r22[nofcp]</td>";
    echo "<td align='right'>$r22[amount]</td>";
	$total_amount=$r22['amount'] * $r22['nofcp'];
	?>
	   <td align='right'><?=round($total_amount,2)?></td>
    <?
	echo "</tr>";
	$sno+=1;
	$total=$total+$total_amount;
	$total_copies= $total_copies+ $count;
	
   $no_copies=fetcharray(execute("SELECT SUM(nofcp) FROM `lib_newspaper_det`"));	
}
$total=number_format($total, 2, '.', '');
echo "<td colspan=3 align=right>Total</td>";

echo "<td align=right>$no_copies[0]</td>";
echo "<td align=right></td>";



echo "<td align=right>$total</td>";
echo "</table></center>";
?>
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"
	  onClick="printReport()" class='bgbutton'>
</div>
<div id='prn1'><a href="statistics_of_newspaper.php">Go Back </a></div>
</body>
</html>