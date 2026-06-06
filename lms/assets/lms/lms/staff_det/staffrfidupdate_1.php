<?php

  session_start();

require("../db.php");
//print_r($_POST);
if($_GET) 
{ 
$subj = $_GET['subj'];
}

if($_POST)
{
$subj = $_POST['subj'];	 
}

if(($_GET["page"])) //$_page
{ 
	$page  = $_GET["page"]; 
} 
else 
{ 
	$page=1; 
};

if(($_POST["search"])) //$_page
{ 
	$page=1; 
} 
$start_from = ($page-1) * 20;

$sort_by = $_REQUEST['sort_by'];
$sort_type = $_REQUEST['sort_type'];

if($sort_by=="")
{
	$sort_by="f_name";
}

if($sort_type=="")
{
	$sort_type="ASC";
}

//print_r($_POST);
if($_POST['open'])

{

	$sturfid=$_POST['sturfid'];

	$studentid=$_POST['studentid'];

	for($i=0;$i<sizeof($studentid);$i++)

	{

		

		$sturfid1=$sturfid[$i];
		
		$studentid1=$studentid[$i];
		//print_r($studentid1);
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
    <td >
    <?
	$check_cat1=='';
	$check_cat2=='';
	if($subj==1)
	{
		$check_cat1='selected';
		
	}
	if($subj==2)
	{
		$check_cat2='selected';
	}
	
	?>
    <select  name="subj" size="1" >
    <option value='0' >-- Select Category --</option>
    <option value='1' <?=$check_cat1?>>Teaching</option>
    <option value='2' <?=$check_cat2?>>Non Teaching</option>
    </select>
    </td>
</tr>
 </table>
 <br>
<div align="center">
<input class="bgbutton" type="submit" name="search" value="Search" ></div>
<br>
 <?php  
 if(!$subj)
 die();     

$SQL = "SELECT * from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='')";
	
	
	$flag = 0;
	 if($subj != 0)
	{
		if($flag == 0)
		{
			$SQL .= "and  category = $subj" ;
			$flag = 1;
		}

		else

		{

			$SQL .= " AND category = $subj";

		}

	}

     	$SQL.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 20";

     	$rs = execute($SQL);

		$num = rowcount($rs);

	if($num == 0)

	{

		die("No records found");

	}

	?>

	<table border='1'  align="center" width="90%"> 
    <tr>
<!--<td class="row3" align='LEFT' nowrap>Check</td>
-->	<td class="row3" align='center' nowrap>SL.No</td>

	<td class="row3" align='center'><a href="<?php echo "staffrfidupdate_1.php?sort_by=f_name&sort_type=ASC&subj=$subj";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Name<a href="<?php echo "staffrfidupdate_1.php?sort_by=f_name&sort_type=DESC&subj=$subj";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>

	<td class="row3" align='center'><a href="<?php echo "staffrfidupdate_1.php?sort_by=EmployeeCode&sort_type=ASC&subj=$subj";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Id<a href="<?php echo "staffrfidupdate_1.php?sort_by=EmployeeCode&sort_type=DESC&subj=$subj";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font>
</a></td>

	<td class="row3" align='center'>RFID</td>

	<td class="row3" align='center'>Department</td>

	<td  class="row3" align='center'>Designation</td>
</tr>
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
	 <!--<td align="center" width="3%"><input type="checkbox" name="studentid[]" value="<?=$r["id"]?>"></td>-->
		<td  class="CBody" align="center">

        <?=$i+1?>

		</td>		

		<td  class="CBody" align="LEFT">

			&nbsp;<?php echo $r["f_name"] . " " . $r["s_name"] ?>

		</td>

		<td  class="CBody" align="center">&nbsp;<?php echo $r["EmployeeCode"]?></td>

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
	 ?>
     <tr>
     <td align="center" nowrap="nowrap" colspan="6">
    <?php
 $tempsql=$SQL;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
$sql2 ="SELECT COUNT(id) ".$tempsql1;

 $rs_result = mysql_query($sql2);

 $row = mysql_fetch_row($rs_result);

 $total_records = $row[0];

 $total_pages = ceil($total_records / 20);

  

 echo "<p align='center'>";

 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='staffrfidupdate_1.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&subj=".$subj."' title='Click to go to First page..'  > First </a> &nbsp;";

 $prv=$page-1;

 if($prv>0)
  echo "<a href='staffrfidupdate_1.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&subj=".$subj."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";

 echo "&nbsp;(Page $page of $total_pages)&nbsp;";

 $nxt=($page+1); 

 if($nxt<=$total_pages)
  echo "<a href='staffrfidupdate_1.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&subj=".$subj."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";

 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='staffrfidupdate_1.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&subj=".$subj."' title='Click to go to Last page..' >Last</a> &nbsp;";

  echo "<br>Total $total_records Staff(s)</p>";
?>
</td>
</tr>
     </table>

     <br>
<div align="center"><input class="bgbutton" type="submit" name="open" value="UPDATE" ></div>
    </form>

    

 </body>

</html>



