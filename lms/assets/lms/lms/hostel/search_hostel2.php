<?php

session_start();

require("../db.php");
$hname = $_GET['hname'];
$blkname = $_GET['blkname'];
$B1 = $_GET['B1'];
$id = $_GET['id'];
$stud_det = $_GET['stud_det'];
$row = $_GET['row'];

$sid = $_GET['sid'];
$rid = $_GET['rid'];
$bid = $_GET['bid'];
$hid = $_GET['hid'];
$college = $_GET['college'];

$cname = $_GET['cname'];
?>
<HTML>
<HEAD>
<TITLE>SEARCH FOR VIEW / MODIFY ROOM DETAILS</TITLE>



<SCRIPT LANGUAGE="JavaScript">

function frm_reload()
{
	document.frm.action="search_hostel2.php";
	document.frm.submit();
}

</script>
</HEAD>
<CENTER>
<FORM METHOD="GET" ACTION="search_hostel2.php" NAME="frm">
<TABLE CLASS='forumline' CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%">
<TBODY>
<TR><TD ALIGN="CENTER" COLSPAN="5"> VIEW / MODIFY ROOM DETAILS</TD></TR>
<TR>
	<TD WIDTH="15%">Hostel Name</TD>
	<TD WIDTH="25%">
		<SELECT SIZE="1" NAME="hname" onChange="frm_reload()">
			<OPTION VALUE="0">--- SELECT ---</OPTION>
			<?
			$sql = "SELECT * FROM hostel_m ORDER BY id ASC";

			$rs = execute($sql) or die("QUERY $sql " . error_description());
			while ($row = fetcharray($rs))
			{
				if ($hname == $row["id"])
					echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
				else
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
			}
			mysql_free_result($rs);
			?>
		</SELECT>
	</TD>
	<TD WIDTH="10%">Block</TD>
	<TD WIDTH="25%">
		<SELECT SIZE="1" NAME="blkname">
			<OPTION VLAUE="0">--- SELECT ---</OPTION>
			<?php
			if ($hname != 0)
			{
				$sql = "SELECT * FROM h_block WHERE hostel_no=$hname AND status=1 ORDER BY id ASC";

				$rs = execute($sql) or die("QUERY $sql " . error_description());
				if (rowcount($rs) != 0)
				{
					while ($row = fetcharray($rs))
					{
						if ($blkname == $row["id"])
							echo "<OPTION VALUE='$row[id]' SELECTED>$row[blockname]</OPTION>";
						else
							echo "<OPTION VALUE='$row[id]'>$row[blockname]</OPTION>";
					}
					mysql_free_result($rs);
				}
			}
			?>
		</SELECT>
	</TD>
    </TBODY>
</TABLE>
<br>
	<CENTER><INPUT TYPE="SUBMIT" VALUE="Search" NAME="B1" CLASS="bgbutton"></CENTER>

</form>
<?php
if ((isset($B1)) && ($hname != 0) && ($blkname != 0))
{
	echo "";
	//echo "<TABLE CLASS='forumline' CELLPADDING='0' CELLSPACING='0'  BORDER='1' WIDTH='100%' align=center>";
	//echo "<table border='1' cellpadding='0' cellspacing='0' width='100'>";
	echo "<tr>";
	//echo "<table border='1' cellpadding='0' cellspacing='0' width='100%'>";
	echo "</tr><tr>";
	echo "<td width='50%'></td><td width='50%'></td>";
	echo "</tr>";
    $query  = "SELECT * FROM h_room_m WHERE h_id=$hname AND bid=$blkname ORDER BY bid ASC";
    //echo $query;
	$rs = execute($query) or die("QUERY $query " . mysql_error());
	if (rowcount($rs) == 0)
	{
		echo "<TR>";
			echo "<TD COLSPAN='5' ALIGN='CENTER' WIDTH='100%'>";
			echo "Room Details Not entered !!</B></TD>";
		echo "</TR>";
	}
	else
	{
	   echo "<table width=90% border=2 class=forumline >";
       echo "<TR>";
       echo "<TD class=head colspan=2 align=center>";
       echo "Search Results..";
       echo "</TD></TR>";
	   $i=0;
	while ($row = fetcharray($rs))
	{
		$va = 0;		// FOR NUMBER OF VACANCIES.
		$va = $row["capacity"]-$row["occupant"];
		$query  = "SELECT * FROM h_block WHERE id=$row[bid]";
		//echo $query;
		$res = execute($query) or die("QUERY $query " . error_description());
		$rw = fetcharray($res);
		$query  = "SELECT hostel_name, id FROM hostel_m WHERE id=$row[h_id]";
		//echo $query;
		$result = execute($query) or die("QUERY $query " . error_description());
		$rw1 = fetcharray($result);
		//echo " room _no = ";
		//echo $row[id];
		$sql1 = "SELECT s_id,domain FROM h_stud_m WHERE room_no=$row[id]";
		 //echo $sql1;
		 $res12=execute($sql1) or die(error_description);
		 //$row12=fetcharray($res12);


 if($i%2==0 )
 {

        if($va!=0)
        	{
				echo "<TR><TD width='50%' valign='top' >";
		    }
		else
		{
		  		echo "<TR><TD width='50%' valign='top'>";
		}
				echo "<A HREF='view_roomdet.php?id=$row[id]'";
				echo "<B>Room Number:&nbsp;</B></a>$row[room_no]";
				echo "<br>Ext.Number:&nbsp;$row[ext_no]";
				echo "<br>Capacity:&nbsp;$row[capacity]";
				echo "<br>Vacancy:&nbsp;$va";
				$rid=$row[room_no];
if($va!=0)
{
			echo "<br><A HREF='doSearch.php?action=add_stud1.php' >AddNewStudent</a>";
}
else
{

}
     while($row13=fetcharray($res12))
  	  {		  
  	         if ($row13["domain"] == -1)
			 		{
			 			$table1 = "student_m";
			 			$table2 = "course_m";
			 			$table3 = "course_year";
			 			$field1 = "id";
			 		}
			 		elseif ($row13["domain"] == -2)
			 		{
			 			$table1 = "student_m";
			 			$table2 = "course_m";
			 			$table3 = "course_year";
			 			$field1 = "id";
			 		}
			 		elseif ($row13["domain"] == -3)
			 		{
			 			$table1 = "student_m";
			 			$table2 = "course_m";
			 			$table3 = "course_year";
			 			$field1 = "id";
			 		}
			 		elseif ($row13["domain"] > 0)	// FOR ADDITIONAL COLLEGES
			 		{
			 			$table1 = "additional_student";
			 			$table2 = "additional_course";
			 			$table3 = "additional_term";
			 			$field1 = "student_id";
		 			}
//echo $row13[s_id];
               $query  = "SELECT id, student_id, first_name, last_name, course_admitted, course_yearsem, ";
			   $query .= "per_state FROM student_m WHERE id='$row13[s_id]'";
				//echo $query;
			    $stud_det1=execute($query);
				$stud_det=fetcharray($stud_det1);
		if($va!=0)
		{
				echo "<p>Student ID:&nbsp;$stud_det[student_id]";
				echo "<br>Name:&nbsp;$stud_det[first_name]$stud_det[last_name]";
			?>
				<br><?php echo $_SESSION['branchname'] ?>&nbsp;<?=getcourse_name($stud_det[course_admitted],$database,$table2)?>
				<?
                echo "<br>Term / Year:&nbsp;$stud_det[course_yearsem]";
				echo "<br>State:&nbsp;$stud_det[per_state]";				
				echo "<br><A HREF='delstud.php?sid=$stud_det[id]&rid=$rid&hid=$hname&bid=$blkname&college=$college'>Delete Student</a>";
				}
				else
				{
	echo "<p>Student ID:&nbsp;$stud_det[student_id]";
				echo "<br>Name:&nbsp;$stud_det[first_name]$stud_det[last_name]";
			?>
				<br><?php echo $_SESSION['branchname'] ?>&nbsp;<?=getcourse_name($stud_det[course_admitted],$database,$table2)?>
				<?
                echo "<br>Term / Year:&nbsp;$stud_det[course_yearsem]";
				echo "<br>State:&nbsp;$stud_det[per_state]";
				echo "<br><A HREF='delstud.php?sid=$stud_det[id]&rid=$rid&hid=$hname&bid=$blkname&college=$college'>Delete Student</a>";
				}

       		}

				echo "</td>";
 }
 else
 {
      if($va!=0)
	     {
	  				echo "<TD valign='top'>";
					echo "<A HREF='view_roomdet.php?id=$row[id]'";
					echo "<b>Room Number:&nbsp;</a></b>$row[room_no]";
					echo "<br>Ext.Number:&nbsp;$row[ext_no]";
					echo "<br>Capacity:&nbsp;$row[capacity]";
					echo "<br>Vacancy:&nbsp;$va";
     				echo "<br><A HREF='doSearch.php?action=add_stud1.php'>AddNewStudent</a>";


	  	 }
	  	else
	  	{
	  		  		echo "<TD valign='top' >";
					echo "<A HREF='view_roomdet.php?id=$row[id]'";
					echo "<b>Room Number:&nbsp;</a></b>$row[room_no]";
					echo "<br>Ext.Number:&nbsp;$row[ext_no]";
					echo "<br>Capacity:&nbsp;$row[capacity]";
					echo "<br>Vacancy:&nbsp;$va";
		}

					
				    //echo "<B><br>Action:&nbsp;</B>Modify";
		   			while($row14=fetcharray($res12))
		   			{
						//echo "hello : ";
						//echo $row14["domain"];

				     	         if ($row14["domain"] == -1)
				   			 		{
				   			 			$table1 = "student_m";
				   			 			$table2 = "course_m";
				   			 			$table3 = "course_year";
				   			 			$field1 = "id";
				   			 		}
				   			 		elseif ($row14["domain"] == -2)
				   			 		{
				   			 			$table1 = "student_m";
				   			 			$table2 = "course_m";
				   			 			$table3 = "course_year";
				   			 			$field1 = "id";
				   			 		}
				   			 		elseif ($row14["domain"] == -3)
				   			 		{
				   			 			$table1 = "student_m";
				   			 			$table2 = "course_m";
				   			 			$table3 = "course_year";
				   			 			$field1 = "id";
				   			 		}

				   			 		elseif ($row14["domain"] > 0)	// FOR ADDITIONAL COLLEGES </
				   			 		{
				   			 			$table1 = "additional_student";
				   			 			$table2 = "additional_course";
				   			 			$table3 = "additional_term";
				   			 			$field1 = "id";
				   		 			}



				$rid=$row[room_no];
				//echo $row14[s_id];

               
			              $query  = "SELECT id, student_id, first_name, last_name, course_admitted, course_yearsem, ";
   			   			   $query .= "per_state FROM $database.$table1 WHERE $field1='$row14[s_id]'";
                         // echo $query;
                                           $stud_det2=execute($query) or die(mysql_error());
						   $stud_det3=fetcharray($stud_det2);

					if($va!=0)
					{
					
					echo "<p>Student ID:$stud_det3[student_id]";
					echo "<br>Name:$stud_det3[first_name]$stud_det3[last_name]";
			?>
	    			<br><?php echo $_SESSION['branchname'] ?><?=getcourse_name($stud_det3[course_admitted],$database,$table2)?>

					<?
                    echo "<br>Term / Year:$stud_det3[course_yearsem]";
	  	            echo "<br>State:$stud_det3[per_state]";
					echo "<br><A HREF='delstud.php?sid=$stud_det3[id]&rid=$rid&hid=$hname&bid=$blkname&college=$college'>Delete Student</a>";
	  	            }
					else
					{
					
					echo "<p>Student ID:$stud_det3[student_id]";
					echo "<br>Name:$stud_det3[first_name]$stud_det3[last_name]";
			?>
           
	    			<br><?php echo $_SESSION['branchname'] ?><?=getcourse_name($stud_det3[course_admitted],$database,$table2)?>

					<?
                    echo "<br>Term / Year:$stud_det3[course_yearsem]";
	  	            echo "<br>State:$stud_det3[per_state]";
					echo "<br><A HREF='delstud.php?sid=$stud_det3[id]&rid=$rid&hid=$hname&bid=$blkname&college=$college'>Delete Student</a>";
	  	           
					}

	  	}
	}
   $i=$i+1;
					echo "</td>";
  }

 }
					echo "</table>";

}
					echo "</TBODY>";
					echo "</TABLE>";
//}
					echo "</CENTER>";
            echo "</BODY>";
            echo "</HTML>";

function getcourse_name($cname,$database,$table)
{
   if($cname!="")
   {	   
     $dd=execute("select coursename from $database.$table where course_id=$cname")or die(mysql_error());
     $name=fetcharray($dd);
     echo $name[0];
    }
    else
    echo "";
    }

?>
