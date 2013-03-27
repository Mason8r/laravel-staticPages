<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="pl" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <title>@yield('title')</title>
</head>
<body>
<header>
</header>
<div class="container">
@yield('content')
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<script src="../js/jqtablesorter.js"></script>
<script src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
  $("#tosort").tablesorter(); 
  $('#noresults').tablesorter();
}); 
</script>
</body>
</html>