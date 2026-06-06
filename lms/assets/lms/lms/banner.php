<?php
session_start();
require_once("db1.php");

$parent=$_SESSION['parent'];

$per00=$_SESSION['per00'];

$user=$_SESSION['user'];

$stuid=$_SESSION['student_id'];

$usernamedet=$_SESSION['usernamedet'];

$_DATABASE_=$_SESSION['_DATABASE_'];

$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];


//print_r($_SESSION);

if($REMOTE_ADDR=='223.239.132.155');

{

    //echo "loged in";

    //print_r($_SESSION);

}



if($usernamedet=='')

    $usernamedet='dob';

$PHP_SELF=$_SERVER['PHP_SELF'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
 <style type="text/css">
<!--
*{
    margin: 1px;
}
body {
	
	background:#FFF;	
	background-repeat:repeat-x,y;
	border-bottom-left-radius:13px;
	border-bottom-right-radius:13px;
	border-top-left-radius:13px;
	border-top-right-radius:13px;

	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	color:#000;
	margin-top:1px;
}
.select 
{

	font-size:13px;
	color:#000033;
	background:#F1F1FA;
	border: 1px solid #B0C6EA;							

}

.banner
{
	font-size: 13px;
	color : #000000;
	font-weight :;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
}

td.banner
{ 
	text-decoration: none; color : #0A2756; 
}

td.banner:hover
{ 
	text-decoration: underline; color : #DD6900; 
}

td.banner:active
{
	color : #000000; 
}
.bgbutton {
  display: inline-block;
  padding: 3px 6px;
  margin-bottom: 0;
  font-size: 13px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
       -o-user-select: none;
          user-select: none;
		  
}

.bgbutton:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

.bgbutton:hover,
.bgbutton:focus {
  color: #333333;
  text-decoration: none;
}

.bgbutton:active,
.bgbutton.active {
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
          box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}

.bgbutton.disabled,
.bgbutton[disabled],
fieldset[disabled] .bgbutton {
  pointer-events: none;
  cursor: not-allowed;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
          box-shadow: none;
}

.bgbutton {
  color: #333333;
  border-color: #3672BA;
  /*background-color: #9999;*/
  /*border-color: #cccccc;*/
}

.bgbutton:hover,
.bgbutton:focus,
.bgbutton:active,
.bgbutton.active,
.open .dropdown-toggle.bgbutton {
  color: #333333;
  background-color: #ebebeb;
  border-color: #adadad;
}

.bgbutton:active,
.bgbutton.active,
.open .dropdown-toggle.bgbutton {
  background-image: none;
}

.topictitle3,div    { font-weight: normal;  color : #000000; font-size:13px;  }
a.topictitle3:link   { text-decoration: none; color : #0A2756;font-size:13px;  }
a.topictitle3:active    { text-decoration: none; color : #000000;font-size:13px; }
a.topictitle3:hover { text-decoration: none; color:#000; font-size:13px; }

-->
</style>
<?php
if($per00==2)

{



  $adm_excs1=execute("select first_name, last_name, $usernamedet, msgphone, class_section_id from student_m where id='$stuid'");

	while($adm_excs=fetcharray($adm_excs1))

	{

		if($parent==1)

		{

			$user=$adm_excs[2];

		}

		else

		{

			$user=$adm_excs[0]." ".$adm_excs[1];

		}

		$fname=$adm_excs[0];
		$lname=$adm_excs[1];

		$mobilenumber=$adm_excs[3];

		$class_section_id=$adm_excs['class_section_id'];

		$selop='disabled';

	}

}

$class_section_name=fetchrow(execute("select section_name from `class_section` where id='$class_section_id'"));



/*$branch=$_SESSION['branch'];
$sem=$_SESSION['sem'];*/

if($_SESSION['AcademicYear']=='')

{

	$a_year=date("Y");

	$temp_month_detalis=date("m");

	if($temp_month_detalis<6)

	{

		$a_year=$a_year-1;

	}

	else

	{

		$a_year=date("Y");

	}

}

else

$a_year=$_SESSION['AcademicYear'];

?>
  <script LANGUAGE="JavaScript">
    function reload2(str) {

        var url = "accyear.php";

        url = url + "?q=" + str;

        url = url + "&sid=" + Math.random();

        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp = new XMLHttpRequest();

        } else {// code for IE6, IE5

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            }

        }

        xmlhttp.open("GET", url, true);

        xmlhttp.send();

    }

    function reload(str) {

        var url = "sessionfile.php";

        url = url + "?q=" + str;

        url = url + "&sid=" + Math.random();

        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp = new XMLHttpRequest();

        } else {// code for IE6, IE5

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById("txtHint9").innerHTML = xmlhttp.responseText;

            }

        }

        xmlhttp.open("GET", url, true);

        xmlhttp.send();

    }

    function reload1(str) {

        var url = "sessionfilesem.php";

        url = url + "?q=" + str;

        url = url + "&sid=" + Math.random();

        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp = new XMLHttpRequest();

        } else {// code for IE6, IE5

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                //document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;

            }

        }

        xmlhttp.open("GET", url, true);

        xmlhttp.send();

    }

        </script>
<base target="main">
</head>
<body class='banner1'>
<form name="frm1" method="post">
<style type="text/css">
div.inline { float:left; }
.clearBoth { clear:both; }

</style>
<?php
if($per00==2)
{
?>

<table width="100%" class="head1" valign='top' cellpadding="0" cellspacing="0" border="0" bgcolor="#F1F1F1" bordercolor="#0066FF">

<tr height="5">
    <td align="center" ><font color="#000000" size="4px">&nbsp;&nbsp;<br /> Banner</font></td>  
</tr>
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>

</table>

<?

}

?>

<!--<table width="100%" class="head1" valign='top' cellpadding="0" cellspacing="0" border="0" bgcolor="#F1F1F1" bordercolor="#0066FF">

<tr height="30" >

<td class="head1" align="left" valign="middle"   nowrap>

&nbsp;&nbsp;

	<A HREF='Frame.php' title='Home Page' style="color:#D8D8D8;" target="_parent" >

		<input type="button" name="home" value="Home" class="bgbutton"/></A>

		&nbsp;&nbsp;&nbsp;&nbsp;

		<?php echo "Date : ";

		echo date("d-m-Y"); ?>

         &nbsp;&nbsp;

		<?php

	/*	if($parent==1)

		{

			echo $fname." ".$lname;

        	$semname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem'"));

			echo " ( ".$semname[0]." $class_section_name[0]"." )";



		}*/

		?></font>

		</td>

            

	</td>
    <td class="head1" align="right" valign="middle" nowrap>
        <?php
        
        if($user=='teena.ca@aurionpro.com'){
                
            $display="Teena";
        }else{
            $display=$user;
        }
        ?>

    <font color="#000000"><?php echo $display; ?></font>

			&nbsp;&nbsp;

            <A HREF='../index.php' title='Log Out' style="color:#D8D8D8;" Target="_top">

            <input type="button" name="Logout" value="Logout" class="bgbutton"/></A>&nbsp;&nbsp;</font>
        </td>

   </tr>

</table>-->

<?php

if($per00==1)

{

?>

<table width="100%" class="head1" valign='top' cellpadding="0" cellspacing="0" border="0" bgcolor="#F1F1F1" bordercolor="#0066FF" style="border-top:none; ">

<tr height='62'  align='center' >

<?php

	$qry = "select * from usermenu a,modules b where a.username='$user' and a.module='Main' and a.submodule='Main' and a.access='Yes' and a.linkname=b.module order by b.id";

	$rs3 = execute($qry);
     ?>
        <td  valign='middle' style='border-left-style:hidden; border-right-style:hidden; border-bottom-style:hidden;' width='70' >
        <a href='Frame.php' title='Home Page' style="color:#D8D8D8; border-bottom-style:hidden;" target="_parent"  class='topictitle3'>
        <img src='./images/menu/home.png' border='0' height='25'><br><font color='#000' size='-1' >Home</font></a></td>
        <?

	while($row3 = fetcharray($rs3))
	{		

		$diname=fetcharray(execute("select imgpath,Display_name from links where linkname='$row3[linkname]' and module='Main'"));
        
       
		echo "
		<td  valign='middle' style='border-left-style:hidden; border-right-style:hidden; border-bottom-style:hidden;' width='70' >
		<a href='$row3[linkpath]$row3[parameter]' title='$diname[1]' target='contents' style='color:#F1F1F1;' class='topictitle3'>
		<img src='$diname[0]' border='0' height='25'><br><font color='#000' size='-1' >$diname[1]</font></a></td>
		";

	}
       ?>
        <td  valign='middle' style='border-left-style:hidden; border-right-style:hidden; border-bottom-style:hidden;' align="right" >
           
            <font color="#000" class='topictitle3'><?php echo $display; ?>&nbsp;</font><br>
            <a href='../index.php' title='Log Out' Target="_top"  class='topictitle3'>
            <img src='./images/menu/logout.png' border='0' align="absmiddle" class='topictitle3'>&nbsp;Log Out &nbsp;&nbsp;
            </a>
        </td>
       <?



?>

</tr>

</table>


<?php

}

?>

<br class="clearBoth" />

</form>



</body>



</html>