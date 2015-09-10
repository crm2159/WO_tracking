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
			<a class="navbar-brand" rel="home" href="index.php" style="color:#FF4c4c; font-style: bold; font-family: calibri; font-size: 24px"><image src="resources/images/halloween247.png">  jWeb</a>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<?php 
				if($_SESSION != null && isset($_SESSION['logged_in'])){
					?>
					<li><a href="new_field_report.php">New Field Report</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Returns<b>▾</b></a>
						<ul class="dropdown-menu">
							<li><a href="new_rir.php">New RIR</a></li>
							<li><a href="search_rirs.php">Search RIRs</a></li>
							<li><a href="new_returned_product.php">New Returned Product</a></li>
							<li><a href="search_rir_items.php">Search Returned Products</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Work Orders <b>▾</b></a>
						<ul class="dropdown-menu">
							<li><a href="add_wo.php">Add Work Order</a></li>
							<li><a href="report_wo_status.php">Report WO Status</a></li>
						</ul>
					</li>
					<li><a href="account_settings.php">Settings</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Documents <b>▾</b></a>
						<ul class="dropdown-menu">
							<li><a href="new_doc_number.php">Assign New Document</a></li>
							<li><a href="search_docs.php">Search Docs</a></li>
						</ul>
					</li>

					<?php
					echo '<li><a href="logout.php">Logout</a></li>';
				} else {
					echo '<li><a href="login.php">Login</a></li>';
					echo '<li><a href="new_user.php">Sign up</a></li>';
				}
				
				?>
					
			</ul>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3" id="msg"></div>
	</div>
</div>
