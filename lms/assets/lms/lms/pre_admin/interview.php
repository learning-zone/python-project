<?php

session_start();

include("../db.php");

$AcademicYear=$_SESSION['AcademicYear'];

$academic_year = $AcademicYear;

if(!$_POST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];

}

elseif($_POST)

{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$name=$_POST['name'];

	$mark=$_POST['mark'];

	$Description=$_POST['Description'];

	

	$id = $_POST['id'];

	$name1 = $_POST['name1'];

	$mark1 = $_POST['mark1'];

	$description1 = $_POST['description1'];

	

}

else

{

	$branch=$_REQUEST['branch'];

	$sem=$_REQUEST['sem'];

}

if(isset($_POST['studdet']))

{

	if(($name == '') or ($mark == '') or ($Description == '') or ($branch == '0') or ($sem == '0') )

	{

		?>

        <script type="text/javascript">

		alert("Please Enter all the Details");

		</script>

        <?php

	}

	else

	{

		$sql2=execute("select * from interview where  class='$sem' and acc_year='$AcademicYear' and name='$name' ");

		if(rowcount($sql2)>=1)

		{

			?>

			<Script language="JavaScript">

			alert("Duplicate entry not allowed");

			</Script>

			<?php

		}

		else

		{

			

			execute("INSERT INTO interview (id, class, acc_year, name, Description,status,mark) VALUES (NULL,  '$sem', '$AcademicYear', '$name', '$Description',1, '$mark')") or die(mysql_error());

			?>

			<Script language="JavaScript">

			alert("Updated successfully");

			</Script>

			<?php	

		}

	}

}

?>



<html>

<head>

<title>Student Application form</title>

</head>



<body>

<script LANGUAGE="JavaScript">

function reload()

{

	document.frm.action='interview.php';

	document.frm.submit();

	

}

function EditClick()

{

	//document.form1.action="alterinterview.php?Types=Mod";

	document.frm.action="alterinterview.php";

	document.frm.submit();

}

</script>
<form method='post' action="" name="frm" >
<table class='forumline' align='center' width="70%" >
<tr>
	<td Class="Head" colspan='2' align='center'>TRACKING ITEMS</td>
</tr>
<tr height='25'>
		<td width="31%" align="right">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
		<td width="69%"><input type='text' name='name' value="" size="42"></td>
</tr>
<tr height='25'>
		<td align="right">Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
		<td><input type='text' name='mark' size="5" value=""></td>
</tr>
<tr height='25'>
    	<td align="right">Notes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td ><textarea name="Description" rows="3" cols="30"></textarea></td>
</tr>
</table>
<br>

	<div align=center>

	<input type="submit" class='bgbutton' value="SAVE" name="studdet">

	</div>

    <br>

    <?php

	$sql2 = execute("select * from interview order by id");

	if(rowcount($sql2)==0)

	die();

	$rtk=rowcount($sql2);	

	?>

    <table align='center' class='forumline' width='70%' border="1" >

	<tr>

        <td Class='head' align='center'>SELECT</td>

		<td align='center' class='head' width="10%" nowrap>Sl No.</td>

        <td align='center' class='head' width="25%" nowrap>Description</td>

        <td align='center' class='head' width="5%" nowrap>Mark</td>

      <td align='center' class='head' width="65%" nowrap>Notes</td>

	</tr>

    <?php

	for($t=0;$t<$rtk;$t++)

	{

	$r=fetcharray($sql2);

	if($t%2)

               echo "        <tr class='clsname'> ";

               else

               echo "        <tr> ";

			   ?>

    <td align='center'><input type="checkbox" name="id[]" Value="<?php echo $r[0]?>"></td>

	<td align='center' nowrap><?php echo $t + 1; ?></td>

	<td align='center'><input type="text" size="25" name="name1<?php echo $r[0]; ?>" value="<?php echo $r['name']?>"></td>

    <td align='center'><input type="text" size="25" name="mark1<?php echo $r[0]; ?>" value="<?php echo $r['mark']?>"></td>

	<td align='center'><input type="text" size="25" name="description1<?php echo $r[0]; ?>" value="<?php echo $r['description']?>"></td>

               <?php

	}

	/*

	$k=1;

	while($r=fetcharray($sql2))

	{	

    if($k%2)

               echo "        <tr class='clsname'> ";

               else

               echo "        <tr> ";

	?>

	

    <td align='center'><input type="checkbox" name="id[]" Value="<?php $r['name']; ?>"></td>

		<td align='center'  nowrap><?php echo $k; ?></td>

        <td align="justify" >&nbsp;&nbsp;<?php	echo $r['name']; ?></td>

        <td align="center" >&nbsp;&nbsp;<?php	echo $r['mark']; ?></td>

        <td align='center'  nowrap><?php echo $r['description']; ?></td>

	</tr>

	<?php

	$k++;

	}

	*/

	?>



	<?php

	?>

    </table>

    <br>

<center>

		<INPUT type="button" onClick="EditClick()" VALUE="Modify" CLASS="bgbutton">       

</center>

	</form>

<script language="JavaScript" type="text/javascript">

var frmvalidator  = new Validator("frm");

frmvalidator.addValidation("branch","dontselect=0","Please Slect Branch name");

frmvalidator.addValidation("sem","dontselect=0","Please Slect class");

frmvalidator.addValidation("name","req","Please Enter Name");

frmvalidator.addValidation("mark","req","Please Enter Marks");

frmvalidator.addValidation("Description","req","Please Enter Descripton");

</script>

</body>

</html>

