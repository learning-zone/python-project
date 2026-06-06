<?php
		include("db1.php");

		session_start();
			
		$user=$_SESSION['user'];

		$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];

		$PHP_SELF=$_REQUEST['linkpath'];
		
		$Display_name=$_REQUEST['Display_name'];
		
		$ln=$_REQUEST['linkname'];
		
		$linkID=$_REQUEST['linkID'];
				
		$date = getdate();

		$today = getdate();

		$month = $today['mon'];

		$day = $today['mday'];

		$year = $today['year'];

		$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));

		$last_date=explode('-',$ndate);

		$day=trim($last_date[0]);

		$month=trim($last_date[1]);

		$year=trim($last_date[2]);
		
		
		$qry="INSERT INTO log (username,address,accessdate,urladdress,linkname,module,trans_date) ";

		$qry.=" VALUES('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";

		$qry.=" '$PHP_SELF','$ln','$linkID','$date[year]-$date[mon]-$date[mday]')";
		
		//echo "<br>".$qry;

		$result=execute($qry) or die(mysql_error()."error1");
		
		
		if($result){

			$lastID=fetcharray(execute("SELECT `module` FROM `log` ORDER BY `id` DESC LIMIT 1"));
			//echo "<br>".$linkID[0];
				
		}
		
				
		$newe=explode('?',$_REQUEST['linkpath']);

		if(sizeof($newe)==1)

			$addr=$_REQUEST['linkpath'].'?branch='.$_SESSION['branch'].'&sem='.$_SESSION['sem'];

		else

			$addr=$_REQUEST['linkpath'].'&branch='.$_SESSION['branch'].'&sem='.$_SESSION['sem'];

	
		header("Location: $addr");
		
		
		
?>



