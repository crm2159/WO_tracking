<!--#header start-->
	<body>
	<div class="container-fluid">
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" rel="home" href="index.php" style="color:red; font-style: italic">JHI Field Report System</a>
	</div>
	
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="new_field_report.php">New Field Report</a></li>
			<li><a href="">Assign</a></li>
			<li><a href="">Stats</a></li>
		
	<?php 
		if(isset($_SESSION['logged_in'])){
			echo "<a href="logout.php"><li>Logout</li></ul>";
		} else {
			include "widgets/login.php";
		}
	?>
	</ul>
	</div>
</div>