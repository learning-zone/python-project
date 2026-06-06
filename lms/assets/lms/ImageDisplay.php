<!DOCTYPE html>
<html>
<head>
<script src="jquery/1.10.2/jquery.min.js">
</script>
<script>
function fadeIn(obj) {
    $(obj).fadeIn(1000);
}
</script>
</head>
<body>

<div id="image">
    <img id="preload" onload="fadeIn(this)" src="7.jpg" style="display:none;" />
</div>

</body>
</html>