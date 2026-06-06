<?php
session_start();
require("../db.php");

/*
.


Date: 30-06-2003
Ashwith Rai

*/


$DOJ="$djyear-$djmnth-$djday";

$sql = "INSERT INTO trans_helper_master(helper_name,personal_details,date_of_join,address,experiance_yrs,licence_det,reneval_det) VALUES ('$helpername','$perdet','$DOJ','$add','$years','$licdet','$redet')" ;

execute($sql);


header("Location: add_helper_master.php");


?>
