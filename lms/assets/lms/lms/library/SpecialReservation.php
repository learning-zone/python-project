<html>
<head>
<?
include ("../db.php");
$var100=execute("select * from lib_book_details where id=$id");
if(isset($inss))
	{
		$Tdate =date('Y-m-d');	 
		$var200=execute("select a.*,b.* from lib_membership_det a,lib_membership_m b where a.m_id=b.id and a.mbno='$uname' and b.pwd='$psword'"); 
		if(rowcount($var200)==0)
			{
				die("<font color=red size=2><b>1.Member Does Not Exists.<br>2.Enter Valid Username And Password</b></font>");
			}
		else
			{	
				$nnnm=execute("select * from special_reservation_temp where  m_id='$uname'");
				if(rowcount($nnnm)!=0)
				die("<font color=red><b>You have  already reserved some other book using this card</b></font>");
				execute("insert into special_reservation_temp(bok_id,resdate,m_id,end_date) values($id,'$Tdate','$uname','0000-00-00')")or die(mysql_error());
				echo"<b>This Member Is In Quee For This Book...!</b>";
				$uname="";
				$psword="";
			}
	}
?>
<body>
<form name=frm>
<input type=hidden name=id value='<?=$id?>'>
<table class=forumline align=center>
	<tr>
		<td class=head colspan=2 align='center'>Special Reservation</td>
	</tr>
	<tr>
		<td>Card Number</td>
		<td><input type=text name=uname value=<?=$uname?>></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type=Password name=psword value=<?=$psword?>></td>
	</tr>
	<tr>
		<td colspan=2 align=center><input type=Submit name=inss value=Submit></td>
	</tr>
</table>
</form>