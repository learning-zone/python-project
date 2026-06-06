<?php

require("../../db1.php");
$mailid=$_REQUEST['mailid'];

$qury=fetchrow(execute("select mail_content,mail_subject  FROM `mail_det` where id='$mailid'"));
echo "Subject :- ".$qury[1];

echo $qury[0];
?>