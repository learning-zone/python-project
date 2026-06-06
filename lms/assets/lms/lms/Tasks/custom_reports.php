<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2013 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.9, 2013-06-02
 */

/* Include PHPExcel */
 
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

//date_default_timezone_set('Asia/Pacific');


require_once("Classes/PHPExcel.php");


include("../db5.php");


$from_date = $_REQUEST['from_date'];
$to_date = $_REQUEST['to_date'];
$status = $_REQUEST['status'];



$today=date('Y-m-d');
$today_sec = strtotime ( '-1 day' , strtotime ($today));
$yesterday = date ( 'Y-m-d' , $today_sec );


if($from_date!="")
{

	$from_date_sec = strtotime ( $from_date );
	$from_date_start = date ( 'Y-m-d' , $from_date_sec );


	if($to_date=="")
	{

		$to_date_start=date('Y-m-d');

	}
	else
	{

		$to_date_sec = strtotime ( $to_date );
		$to_date_start = date ( 'Y-m-d' , $to_date_sec );		

	}
	
	if($to_date_sec<=$from_date_sec)
	{
		$to_date_start_temp=$from_date_start;
		$from_date_start=$to_date_start;
		$to_date_start=$to_date_start_temp;
		
	}

}

	$sql="SELECT pseudo_name, date, file_number, order_number, queue_number, process_status, comments FROM tasks_m WHERE process_status='$status' AND date BETWEEN '$from_date_start' AND '$to_date_start'";
	$result=mysql_query($sql);
	
	if(mysql_num_rows($result)>0)
	{
	// Create new PHPExcel object
		//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		//echo date('H:i:s') , " Set document properties" , EOL;
		
		$objPHPExcel->getProperties()->setCreator("Jack")
									 ->setTitle("Processed Orders")
									 ->setSubject("Processed Orders")
									 ->setDescription("Processed Orders")
									 ->setCategory("Processed Orders");
			// Add some data, we will use printing features
			//echo date('H:i:s') , "Processed Orders" , EOL;
			
	   $i=1;
	   $k=1;
	
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'Name');
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, 'Date');
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, 'File #');
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, 'Order #');
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, 'Queue');
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, 'Status');
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, 'Comment');
		
	   	while($data=mysql_fetch_array($result))
		{
			
			$i++;
			
			$pseudo_name =$data['pseudo_name'];
			$date = $data['date'];
			$file_number = $data['file_number'];
			$order_number = $data['order_number'];
			$queue_number = $data['queue_number'];
			$process_status = $data['process_status'];
			$comments = $data['comments'];
			
			
		  	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $k);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $pseudo_name);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $date);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $file_number);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $order_number);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $queue_number);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $process_status);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $comments);
			
			
			$k++;
	
			// Set page orientation and size
			//echo date('H:i:s') , " Set page orientation and size" , EOL;
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			
			// Rename worksheet
			//echo date('H:i:s') , " Rename worksheet" , EOL;
			$objPHPExcel->getActiveSheet()->setTitle("$status Orders");
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

				// Save Excel 95 file
			//echo date('H:i:s') , " Write to Excel5 format" , EOL;
			$callStartTime = microtime(true);
			
			$user_names="$status Orders".".php";
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save(str_replace('.php', '.xls',  "$user_names"));
			$callEndTime = microtime(true);
			$callTime = $callEndTime - $callStartTime;
			
			$my_path=str_replace('.php', '.xls', "$user_names");
			$email_filename=str_replace('.php', '.xls', pathinfo("$user_names", PATHINFO_BASENAME));
			 
			//echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo("$user_names", PATHINFO_BASENAME)) , EOL;
			
			//echo 'Call time to write Workbook was ' , sprintf('%.2f',$callTime) , " seconds" , EOL;
			
			//echo date('H:i:s') , " Done writing files" , EOL;
			
			echo 'Files have been created in ' , getcwd() , EOL;

		}	// end of while
			
		
	}	// end of if, sendin mails to only modified leads
	
	$click_here="<a href='http://tfkpo.bpm360.in/renew/Tasks/$status Orders.xls' target='_blank' title='Download' >Click Here </a>";
	
	echo "<br />$click_here to Download";
	
	/*	
		$my_path = $_SERVER['DOCUMENT_ROOT']."/Tasks/reports/";
		$my_name = "Reports";  // from name
		$my_mail = "renewinfosys@gmail.com";   // from mail
		$my_replyto = $my_mail;   //reply to
		$my_subject = "Processed Orders";  //subject
		$my_message = "Please Find Attached Report\n";
			
		$tomail=$email_id;
		$tomail="jackson@renewinfosys.com";
		
		// mail_attachment($email_filename, $my_path, $tomail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
	*/

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) 
{
    $file = $path.$filename;
	$file_size = filesize($file);
	
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
	
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
	
	$bcc="jackson@renewinfosys.com";
	
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
	$header .= "Cc:".$cc. "\r\n";
	$header .= "Bcc:".$bcc. "\r\n";

    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
	
    if (mail($mailto, $subject, "", $header)) {
        echo "E-Mail Sent ... $mailto OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}	// mail_attachment