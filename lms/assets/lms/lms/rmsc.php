<html>
<body bgcolor="lightblue">
<?php
session_start();
include("db1.php");
 $query=$_POST['query'];
  ?>
 		<form action='rmsc.php' method="post">
		<input type='hidden' name='chkfg' value='<?=$chkfg?>'>
		<input type="text" name="query" size=100>
		<input type="submit" name='query1' value="Submit Query" class="bgbutton">
		</form>
   <?
		if(!isset($query) || empty($query))
		{
			$query="select * from users ";
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
		$result=mysql_query($query) or die(mysql_error());
		$number_cols=mysql_num_fields($result);
		echo "<b>Query : $query</b>";
		echo "<table border=1>\n";
		echo "<tr align=center>\n";
		for($i=0;$i<$number_cols;$i++)
		{
			echo "<td class='head'>".mysql_field_name($result,$i)."</td>\n";
		}
		echo "</tr>\n";
		while($row=mysql_fetch_row($result))
		{
			echo "<tr align=left>\n";
			for($i=0;$i<$number_cols;$i++)
			{
				echo "<td>";
				if(!isset($row[$i]))
				{
					echo "NULL";
				}
				else
				{
					echo $row[$i];
				}
				echo "</td>\n";
			}
			echo "</tr>\n";
			}
			echo "</table>";
		?>
</body>
</html>