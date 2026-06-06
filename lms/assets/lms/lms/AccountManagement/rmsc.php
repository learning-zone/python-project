<html>
<body bgcolor="lightblue">
<?php
if($chkfg=="")
{
	?>
	<br><br>
	<form action='<?echo $PHP_SELF?>' method="post">
	<font color='blue' size='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter the Password :&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="password" name="chkfg" size=5>
	</form>
	<?php
}
else
{
	if($chkfg=="r@dh@")
	{
		//include("db.php");
		mysql_connect("localhost","acdbmaster","@cdbm@ster");
		mysql_select_db("accountingdb");
		//die();
		if(!isset($query) || empty($query))
		{
			$query="select * from ac_organization";
			//echo $query;
		}
		$query=stripslashes($query);
		$sta=explode(" ",$query);
		$siz=sizeof($sta);
		//echo $sta[0];
		for($j=0;$j<$siz;$j++)
		{
			if($sta[$j]=='drop' || $sta[$j]=='DROP' || $sta[$j]=='Drop')
			{
				//die("<font color=blue>Premission Denied</font>");
				//exit();
			}
		}
		//die();
		$result=execute($query) or die(mysql_error());
		$number_cols=mysql_num_fields($result);
		echo "<b>Query : $query</b>";
		echo "<table border=1>\n";
		echo "<tr align=center>\n";
		for($i=0;$i<$number_cols;$i++)
		{
			echo "<th><font color=blue>".mysql_field_name($result,$i)."</font></th>\n";
		}
		echo "</tr>\n";
		while($row=fetchrow($result))
		{
			echo "<tr align=left>\n";
			for($i=0;$i<$number_cols;$i++)
			{
				echo "<td><font color=brown>";
				if(!isset($row[$i]))
				{
					echo "NULL";
				}
				else
				{
					echo $row[$i];
				}
				echo "</font></td>\n";
			}
			echo "</tr>\n";
			}
			echo "</table>";
		?>
		<form action='<?echo $PHP_SELF?>' method="post">
		<input type='hidden' name='chkfg' value='<?=$chkfg?>'>
		<font color=blue><input type="text" name="query" size=100></font>
		<input type="submit" value="Submit Query">
		</form>
		<?php
	}
	else
	{
		echo "<font color='red' size='4'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invalid Password..<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='rmsc.php'>Try Again ??</a></b></font>";
	}
}
?>
</body>
</html>