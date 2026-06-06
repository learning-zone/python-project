<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>Oberoi</title>
<link rel='stylesheet' href='http://oberoi.myschoolone.com/renew/Code/LightBox/lightbox.css' />
<script src='http://oberoi.myschoolone.com/renew/Code/LightBox/jquery/1.10.2/jquery.min.js'></script>
<script src='http://oberoi.myschoolone.com/renew/Code/LightBox/jquery/jquery.lightbox.js'></script>
<script>
    $(document).ready(function(){
        //Assign the lightbox event to elements
        $('.iframe').lightbox({iframe:true, width:'60%', height:'60%'});                                
        //Preserving a JavaScript event for inline calls.
        $('#click').click(function(){ 
            $('#click').css({'background-color':'#f00', 'color':'#fff', 'cursor':'inherit'}).text('Open this window again and this message will still be here.');
            return false;
        });
    });
</script>

</head>
<body>
Dear $name_dis_manger ,<br><br> 
$name_dis_staff has applied for  $leave_type_name[0] from  $adate to $bdate , i.e for  $days  day .
Kindly click to <a class='iframe' href='http://oberoi.myschoolone.com/renew/staff_det/date_approval_email.php?insids=834&user='$user'>approve</a> / <a class='iframe' href='http://oberoi.myschoolone.com/renew/staff_det/date_approval_email.php?insids=834'>reject</a> the leave request on the LMS.
</body>
</html>