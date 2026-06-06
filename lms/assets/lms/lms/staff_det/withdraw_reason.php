<html>
<title>Withdraw</title>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$id=$_REQUEST['id'];
	$reason=$_REQUEST['reason'];
	$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
	?>
<head>


</head>
        <?php
if($_POST['del'])
{
	
		$submit_code=execute("select * from staff_leave where status=1 and status_approve=1 and reject=0 and approved=0 and status_reason=1 and id='$id'");
		if(mysql_num_rows($submit_code)>=1)
		{
			//submited
			 execute("update staff_leave set 	status_reason='2',status_approve='2',user='$user',status_with_staff='$leave_add',submit_with='1',withd_commt='$reason' where id='$id'");
		}
		$submit_code_1=execute("select * from staff_leave where status=1 and status_approve=1 and reject=0 and approved=1 and status_reason=1 and id='$id'");
		if(mysql_num_rows($submit_code_1)>=1)
		{
			$pay_validate_check='';
			$pay_out_ee=fetcharray(execute("select type from staff_leave where status=1 and id='$id'"));
			if($pay_out_ee[0]=='EE' || $pay_out_ee[0]=='6')
			{
				$past_date=fetcharray(execute("select hd_ee_da_date from staff_leave where status=1 and status_approve=1 and reject=0 and approved=1 and status_reason=1 and id='$id'"));
				
				if(strtotime($past_date['hd_ee_da_date'])<=strtotime($with_date_test))
				{
					$pay_validate_check='1';
				}
			}
			else
			{
				$past_date=fetcharray(execute("select t_date from staff_leave where status=1 and status_approve=1 and reject=0 and approved=1 and status_reason=1 and id='$id'"));
				
				if(strtotime($past_date['t_date'])<=strtotime($with_date_test))
				{
					$pay_validate_check='1';
				}
			}
			
		if($pay_validate_check)
		{
			//past date
			execute("update staff_leave set 	status_reason='0',status_approve='2',user='$user',status_with_staff='$leave_add',with_color='#FF0000',submit_with='2',withd_commt='$reason' where id='$id'");
		}
		else
		{
			//echo "future";
			//future date
			 execute("update staff_leave set 	status_reason='0',status_approve='2',user='$user',status_with_staff='$leave_add',withd_commt='$reason' where id='$id'");
		}
      	
		}
	
		?>
		<Script language="JavaScript">
		alert("Withdraw !");
		window.opener.location.href='leave.php?tab=1';
		window.close();
		</Script>
        <?
}
		?>
<body>
<form Name="frm"  method="post">
<input type="hidden" name="id" value="<?=$id?>"/>

<table  align='center' border="1" width="60%" cellpadding="3" cellspacing="0">
    <tr>
	<td align="center">
    <textarea rows="5" cols="40" name='reason'  style="background-color: #FFFFCC" placeholder="Add The Reason For Withdrawing*" required ><?=stripslashes($reason)?></textarea>
    </td>
    </tr>
</table>

<br>
<div align='center'><input type='submit' name='del' value='Withdraw' class='bgbutton'></div>
</form>

</BODY>
</HTML>
