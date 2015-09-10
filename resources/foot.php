
</div>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<link href="css/jquery-ui.css" rel="stylesheet">
	<link href="css/jquery-ui.theme.css" rel="stylesheet">
	<link href="css/jquery-ui.structure.css" rel="stylesheet">
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.11.3.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/rir_functions.js"></script>
</body>	
</html>

<?php
if(isset($_SESSION['expire_time'])){
	global $expire_time;
	$_SESSION['expire_time'] = time() + 60* $expire_time;
}