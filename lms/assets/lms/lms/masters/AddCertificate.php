<?php
session_start();
	include("../db1.php");
	$CertificateName=$_GET['CertificateName'];
	$sql1=execute("select * from certificate_m where name='$CertificateName'") or die(error_description());

	if(rowcount($sql1)!=1)
	{
	$sql=execute("insert into certificate_m(name) values('$CertificateName')") or die(error_description());
	}
	header("Location:ViewCertificate.php");
?>

