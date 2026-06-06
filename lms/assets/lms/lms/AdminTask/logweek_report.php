<?
session_start();
include("../db.php");
$username = $_POST['username'];
$submit = $_POST['submit'];
if(isset($submit))
{
$username=$_POST['username'];
	$qry="select * from users where username='$username' ";
	$rs = execute($qry);
	//echo $qry;
	if($rs)
	{
		if(rowcount($rs)==0)
		{
			echo "User Not Found";
			echo "<a href='logweek.php'> Click Here To Go Back</a>";
		}
		else
		{
			$serial = 1;
$curr_date = date("Y-m-d");
//echo $curr_date;
$qry = "SELECT date_sub('$curr_date', interval '7' day) AS A";
//echo $qry;
$rs = execute($qry) or die("QUERY $qry : " .error_description());
$row = fetcharray($rs);
$prev_date = $row["A"];
mysql_free_result($rs);

$sql="select col_name from college";
$rs=execute($sql);
if(rowcount($rs)>=1)
{
	$row=fetcharray($rs);
	$colname=$row[col_name];
}
$query5  = "SELECT username FROM users WHERE Activated='On' and username='$username' ORDER BY username ASC";
//echo $query5;
$rs5 = execute($query5) or die("QUERY $query : " . error_description());
$usr = fetcharray($rs5);
?>
<HTML>
<HEAD>
<TITLE>Welcome to <?=$colname?></TITLE>
</HEAD>
<BODY class='bodyline'>
<TABLE align='center' cellpadding=1 cellspacing=0 border=1 width=50%>
<TBODY>
<TR>
	<TD COLSPAN="3" ALIGN="CENTER" class='head'>
	<?=strtoupper($usr[username])?> LOGIN REPORT FROM <?=date("d-m-Y", strtotime($prev_date));?> TO <?=date("d-m-Y", strtotime($curr_date));?></TD>
</TR>
<TR>
<!--
	<TD ALIGN="CENTER" class='row3'>Modules</TD>
-->
	<TD ALIGN="CENTER" class='row3'>Link Name</td>
	<TD ALIGN="CENTER" class='row3'>Hits/Week</TD>
</TR>
<?
$query  = "SELECT username FROM users WHERE Activated='On' and username='$username' ORDER BY username ASC";
//echo $query ;
echo "<br>";
$rs = execute($query) or die("QUERY $query : " . error_description());
while ($row = fetcharray($rs))
{
	$query  = "SELECT DISTINCT trans_date FROM log WHERE trans_date between '$prev_date' ";
	$query .= "and '$curr_date' AND username='$row[username]'";
	//echo $query."<br>"; 
	$result = execute($query) or die("QUERY $query : " .error_description());
	$query1  = "SELECT module FROM log WHERE username='$row[username]' and module is not null ";
	$query1 .= "GROUP BY module ORDER BY module ASC";
	
	//echo $query1;
	$res = execute($query1) or die("QUERY $query : " . error_description());
//$num=rowcount($res);
$num=rowcount($result);
	//$modules = "";
	echo "<TR>";
if($num==0)
{
echo "<TD ALIGN=CENTER class='row2' colspan=3 >&nbsp;&nbsp; This user hasn't logged in </TD></tr>";
}
else
{
	//for($rr=0;$rr<rowcount($res);$rr++)
	//for($rr=0;$rr<rowcount($result);$rr++)
	{
		$row1 = fetcharray($res);

			if($rr==0)
					{
					//echo "<TD ALIGN=LEFT > $row1[module] </TD>";
					}
					else
					{
					//echo "<TD ALIGN=LEFT>&nbsp;&nbsp;$row1[module]</TD>";
					}
			//$query1  = "SELECT  distinct(linkname) FROM log WHERE username='$row[username]' and module='$row1[module]' ";
			//$query1 .= "ORDER BY linkname ASC";
			$query1  = "SELECT distinct(linkname) FROM log WHERE username='$row[username]' ";
			$query1 .= "ORDER BY linkname ASC";
			//echo "<br>".$query1; 
			$res1 = execute($query1) or die("QUERY $query1 : " . error_description());
			//echo "<tr>";
				for($r=0;$r<rowcount($res1);$r++)
				{
					if($r%2)
					echo "<tr class='clsname'> ";
					else
					echo "<tr> ";
					$row2 = fetcharray($res1);
					//here
					$query1  = "SELECT count(*) FROM log WHERE username='$row[username]' and linkname='$row2[linkname]' and trans_date between '$prev_date' and '$curr_date'";
					//echo "<br>".$query1;
					$cntRS=execute($query1);
					$hitcnt=fetcharray($cntRS);
					//if($hitcnt[0] > 3)
					{
						
					if($r==0)
					{
						//echo "<tr class='clsname'> ";
					echo "<TD ALIGN=LEFT >&nbsp;&nbsp;$row2[linkname]</td>";
					}
					else
					{
						
						echo "<TD ALIGN=LEFT>&nbsp;&nbsp;$row2[linkname]</td>";
					}
					/*
					//$query1  = "SELECT count(*) FROM log WHERE username='$row[username]' and module='$row1[module]' and linkname='$row2[linkname]' and trans_date between '$prev_date' and '$curr_date'";
					$query1  = "SELECT count(*) FROM log WHERE username='$row[username]' and linkname='$row2[linkname]' and trans_date between '$prev_date' and '$curr_date'";
					//echo "<br>".$query1;
					$cntRS=execute($query1);
					$hitcnt=fetcharray($cntRS);
					//if($hitcnt[0] > 0)
					echo "<TD>&nbsp;&nbsp;$hitcnt[0]</TD>";
					*/
					echo "<TD>&nbsp;&nbsp;$hitcnt[0]</TD>";
					}
					
				}
			echo "</TR>";
			mysql_free_result($res1);
		
}		
}
$serial++;
}
mysql_free_result($rs);
?>
</TBODY>
</TABLE>
</BODY>
</HTML>
<?
}
}
}
?>
