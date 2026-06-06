<?php
  session_start();
  require("../db.php");
  
  $subj = $_POST['subj'];
?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<Script language="JavaScript">
function start()
{
 document.frm.dob.options[0].selected=true;
}
function delete_me(id1)
{

	if(confirm("Are you sure that you want to delete this record"))
	{
		window.location.href = "delete.php?delete_id=" + id1;
	}
}

function check_data()
{
  document.frm.submit();
}
</script>
</head>
<body topmargin="15" leftmargin="5" onLoad="start()" link="#000000">
<form method="POST"  action="s.php" name="frm">
<center>
<table width="80%" border=0 class="forumline">
<tr>
<td Class="head" colspan=4 align=center >View Designationwise Staff Details</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Designation</td>
		  <td><select name="subj" size=1>
<option value=0>----------------All----------------</option>
<?php

$sql="select * from staff_des ";
$rs=execute($sql);
$num=rowcount($rs);
if($num!=0)
  {
	for($i=0;$i<$num;$i++)
	{
            $row=fetcharray($rs,$i);
	    echo "<option value=$row[d_id]>$row[d_name]</option>";
	}

  }
?>
	

</select></td>
		  
        </tr>
		</table>
		  <br>
		  
		
 <center>          
<input type="button" value="Search" name="B1" onClick="check_data()" class='bgbutton'></font>
</center>
        
        
     
      <input type="hidden" name="display" value="<?php echo $display?>">
    </form>
    </td>
 </body>
</html>

