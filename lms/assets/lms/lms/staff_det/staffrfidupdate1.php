<?php

  session_start();

require("../db.php");

$subj = $_POST['subj'];

if($_POST['open'])

{

	$sturfid=$_POST['sturfid'];

	$studentid=$_POST['studentid'];

	for($i=0;$i<sizeof($studentid);$i++)

	{

		

		$sturfid1=$sturfid[$i];

		$studentid1=$studentid[$i];

		$sql5=execute("select id from rfid_enrolment_user where user='$studentid1' and status=1 and user_type=2");

		if(mysql_num_rows($sql5)>0)

		{

			$sql1="update rfid_enrolment_user set rfid='$sturfid1' where user='$studentid1' and status=1 and user_type=2";

		}

		else

		{

				$sql1="insert into rfid_enrolment_user (`user`, `rfid`, `status`,`user_type`,`active`,`rfidAccess`) values('$studentid1', '$sturfid1', '1', '2','Y','Y')";

		}

		//$sql1."<br>";		

		execute($sql1);	

	}

	?>

	<SCRIPT LANGUAGE="JavaScript">

		alert(" RFID Updated Successfully");

	</SCRIPT>



	<?php



}





?>



<html>

<head>

<Script language="JavaScript">

function check_data()

{

  document.frm.submit();

}

</script>

</head>

<body >

    <form method="POST"  action="" name="frm">

     <table border=0 width="90%" align="center">

<tr>

<td Class="head" colspan=2 align=center >View/Modify Staff RFID Details</td>

</tr>

 <tr>

  <td align='center'>Department</td>

  <td ><select  name="subj" size="1" onChange="check_data()">

  <option  value="0">---- Select ----</option>

<?php

$temp = "SELECT * FROM dept_no";

$rs = execute($temp);

$num = rowcount($rs);

for($i=0;$i<$num;$i++)

{

	$r = fetcharray($rs,$i);

	if($subj==$r[1])

	echo("<option value='" . $r[1] . "' selected>" . $r[0] . "</option>");

	else

		echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");

}

?>

</select></td></tr>

 </table>

<br>

 <?php  

 

 if(!$subj)

 die();     

	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.active='YES'  ";

	$flag = 0;

	 if($subj != 0)

	{

		if($flag == 0)

		{

			$SQL .= "and  a.subj = $subj" ;

			$flag = 1;
			echo "hello";
		}

		else

		{

			$SQL .= " AND a.subj = $subj";
			echo "hello1";
		}

	}

     	$SQL.=" order by a.f_name";

     	$rs = execute($SQL);

		$num = rowcount($rs);

	if($num == 0)

	{

		die("No records found");

	}

	?>

	<table border='1'  align="center" width="90%"> 

	<td class="row3" align='LEFT' nowrap>SL.No</td>

	<td class="row3" align='LEFT'>Name</td>

	<td class="row3" align='LEFT'>Staff Id</td>

	<td class="row3" align='LEFT'>RFID</td>

	<td class="row3" align='LEFT'>Department</td>

	<td  class="row3" align='LEFT'>Designation</td>

 	<?php

	for($i=0;$i<$num;$i++)

	{

		if($i%2)

	   echo "<tr class='clsname' > ";

	   else

	   echo "<tr > ";

		$r = fetcharray($rs,$i);

		$ar2 = getdate($r["j_date"]);

		$ar3 = getdate(time());

		$d=explode(" ",$r["j_date"]);

		

	$checkiddet=mysql_fetch_row(execute("select rfid from rfid_enrolment_user where user='$r[id]' and user_type=2 and status=1"));



		?>

		<td  class="CBody" align="LEFT">

        <?=$i+1?>

		</td>		

		<td  class="CBody" align="LEFT">

			&nbsp;<?php echo $r["f_name"] . " " . $r["s_name"] ?>

		</td>

		<td  class="CBody" align="LEFT">&nbsp;<?php echo $r["slno"]?></td>

        <td><input type="text" width="50" size="50" name="sturfid[]" value="<?=$checkiddet[0]?>" ></td>    	<input type="hidden" name="studentid[]" value="<?=$r[id]?>" >

		<?php 

		$rs_sql=execute("select * from staff_des where d_id=$r[type_id]");

		$designation="";

		if(rowcount($rs_sql)>0)

		{

			$r_sql=fetcharray($rs_sql);

			$designation=$r_sql[d_name];

		}

		mysql_free_result($rs_sql);

		$rs_sql=execute("select * from dept_no where dpt_id=$r[subj]");

		$department="";

		if(rowcount($rs_sql)>0)

		{

			$r_sql=fetcharray($rs_sql);

			$department=$r_sql[Dept];

		}

		mysql_free_result($rs_sql);

		?>

		<td class="CBody" align="CENTER"><?php echo $department?> </td>

		<td  class="CBody" align="LEFT">&nbsp;<?php echo $designation?> </td>

	</tr>

		<?php

	}



	 ?></table>

     <br>



<div align="center"><input class="bgbutton" type="submit" name="open" value="UPDATE" ></div>



    </form>

    

 </body>

</html>



