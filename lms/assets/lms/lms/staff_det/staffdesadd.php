<?php

session_start();

require("../db.php");



$stype = $_POST['stype'];

$type_code = $_POST['type_code'];

$sgroup = $_POST['sgroup'];

$priority = $_POST['priority'];



$sid = $_POST['sid'];

$stafftype = $_POST['stafftype'];

$typecode = $_POST['typecode'];

$sgroup = $_POST['sgroup'];



$Types = $_POST['Types'];



if($_GET['msg_upd']=='ok')

	$msg = "**** Updated Successfully ****";

?>

<html>

<head>

	<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">

	<script language="javascript">

		function checkadd()

			{

				document.Addstafftype.stype.value = document.Addstafftype.stype.value.replace(/^\s+|\s+$/g, '');

				document.Addstafftype.type_code.value = document.Addstafftype.type_code.value.replace(/^\s+|\s+$/g, '');

				

				if (document.Addstafftype.sgroup.selectedIndex==0)

				{

					alert("Please Select A Staff Group..");

					document.Addstafftype.sgroup.focus();

					return false

				}

				if(document.Addstafftype.stype.value == ''){

					alert("Staff Designation cannot be empty");

					document.Addstafftype.stype.focus();

					return false;	

				}

				if(document.Addstafftype.type_code.value == ''){

					alert("Staff Code cannot be empty");

					document.Addstafftype.type_code.focus();

					return false;	

				}

					document.Addstafftype.submit();

			}

		function EditClick()

			{



				document.form1.action="alterstaffdes.php?Types=Mod";



				document.form1.submit();

			 }



		function DeleteClick()

			{

				var rc;

				rc=document.form1.rc.value;	

				var flag=0;

				if(confirm(" Do u want to Delete the Records Corresponding to Selected Staff Types"))

					{

						document.form1.action="alterstaffdes.php?Types=Del";

						document.form1.submit();

					}

			}

			function selectMe()

{

	var i,j,x,y,yy;

	i = document.form1.length;

	x=0;

	yy=0;

	for(j=0;j<i;j++)

	{



		if(document.form1[j].Sel != "CheckBox")

		{

			flag = document.form1[j].checked;

			document.form1[j].checked = !flag;

			if(flag== true)

			{

				x=x+1;

			}

			else

			{

				yy=yy+1;

			}

		}

		if(document.form1[j].SelectAll == "CheckBox")

		{

			flag = document.form1[j].checked;

			document.form1[j].checked = !flag;



		}

	}

}

</script>

<title></title>

</head>

<body>

<form name="hdfrm" method="post">

  <input type="hidden" name="sid" value>

  <input type="hidden" name="dname" value>

  <input type="hidden" name="sgroup" value>

</form>

<form Name="Addstafftype" action="addstaff_des.php" method="Post">

<div align="center">&nbsp;<? print "$msg";?></div>

<table class=forumline align=center width="90%">

				<tr>

					<td Class="Head" align=center colspan=4> Add Staff Designation</td>

				</tr>

    <tr height='20'>

      <TD align="center" class="row3">Staff Designation</td>

	  <TD align="center" class="row3">Designation Code</td>

	  <TD align="center" class="row3">Staff Group</td>

	  <td align="center" class="row3">Priority</td>

    </tr>

    <tr>

      <td align="center"><input type="text" size="20" name="stype"></td>

	  <td align="center" ><input type="text" size="10s" name="type_code"></td>

      <td align="center"><select name="sgroup">

			<option value="0"> <-- Select --> </option>

				<?php

				$sql1 = "SELECT * FROM staff_group where status =1";

				$rs = execute($sql1);

				$num = rowcount($rs);

				for($i=0;$i<$num;$i++){

					$r = fetcharray($rs,$i);

						echo "<option value='" . $r["id"] . "'>" . $r["name"] . "</option>";

				}

				?>     </select>

		</td><td align="center"><input type="text" size="5" name="priority<?=$r["d_id"]?>" value="<?=$r["priority"]?>"></td></tr>

</table><br>

		<div align="center">

        <input type="button" value="ADD" onClick="checkadd()" class="bgbutton"></td>

	</div>

</form>

<?php

		$sql1 = "SELECT * FROM staff_des ORDER BY group_id,priority";

		$rs = execute($sql1);

		$rc = rowcount($rs);

		$sql1 = "SELECT * FROM staff_group where status =1";

		if($rc)

			{

?>

		<form method="post" id="form1" name="form1">

			<table width="80%" align=center ></table>

				<input type="hidden" name="rc" value="<?=$rc?>">

				<input type="hidden" name="fn" value>

			<table border="0" class=forumline align=center width="90%">

				<tr>

					<td Class="Head" align=center colspan=5> Modify Staff Designation</td>

				</tr>

				<tr >

					<td align="center" Class="row3"><div id="checkAll" onMouseOver="this.style.backgroundColor='green';

					this.style.cursor='hand';this.style.color='white'"

					onMouseOut="this.style.backgroundColor='#E9D0B6';this.style.cursor='default';this.style.color='black'"

					onClick="selectMe()"

					Title="Click to Select all Students"><b>Select</b></div></td>

				  <TD align="center" Class="row3" >Staff Designation</td>

					<TD align="center" Class="row3" >Designation Code</td>

					<TD align="center" Class="row3" >Staff Group</td>

					<td align="center" class="row3">Priority</td>

				</tr>

<?php

	for($i=0;$i<$rc;$i++){

		$r = fetcharray($rs,$i);

		      if($i%2)

                    echo "<tr>";

               else

                    echo "<tr class='clsname'>";

?>

				

					<td align="center"><input type="checkbox" name="sid[]" Value="<?=$r["d_id"]?>"></td>

					<td align="left" style="padding-left: 5%"><input type="text" size="50" name="stafftype<?=$r["d_id"]?>" value="<?=$r["d_name"]?>"></td>

					<td align="center"><input type="text" size="10" name="typecode<?=$r["d_id"]?>" value="<?=$r["d_code"]?>"></td>

					<td align="center"><select name="sgroup<?=$r["d_id"]?>">

<?php

	$rs1 = execute($sql1);

	$num1 = rowcount($rs1);

	for($j=0;$j<$num1;$j++){

		$r2 = fetcharray($rs1,$j);

		if($r2["id"] == $r["group_id"]){

			echo "<option value='" . $r2["id"] . "' selected>" . $r2["name"] . "</option>" ;

	}elseif($r2["id"] == $sgroup)	{

				echo "<option value='" . $r2["id"] . "' selected>" . $r2["name"] . "</option>" ;

	}else{

			echo "<option value='" . $r2["id"] . "'>" . $r2["name"] . "</option>";

		}

	}

?>

     </select></td><td align="center"><input type="text" size="5" name="priority<?=$r["d_id"]?>" value="<?=$r["priority"]?>"></td></tr>

<?php

	}

?>

</table>

<br>

<div align="center"><input Type="Button" Value="Modify" onClick="EditClick()" class="bgbutton">

   </div>

</form> <br>

<?php

}

?>

</body>

</html>

