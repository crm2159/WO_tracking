<?php

include "resources/init.php";

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/styles.css"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/scripts.js"></script>




<h1>Jarvik Heart, Inc. Work Order Tracking</h1>

<br>
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Regular Entry</a></li>
	<li><a href="#tabs-2">Manual Entry</a></li>
	<li><a href="#tabs-3">Machine Shop WO Entry</a></li>
</ul>
<div id="tabs-1">
<form method="post">
	<ul>
		<li>
			<label for="WO_num">Work Order</label>
			<input type="number" name="WO_num"  placeholder="Halllo">
		</li>
		<li>
			<label for="op_num">Operation number</label>
			<input type="number" name="op_num" placeholder="Halllo">
		</li>
		<li>
			<label for="user_id">Operator</label>
			<select name="user_id">
				<option value ="" disabled selected style='display:none;'>Who are you?</option>
				<option value ="1">Carl</option>
				<option value ="2">Chaz</option>
				<option value ="3">Alyssa</option>
				<option value ="4">Rob</option>
				<option value ="5">Alani</option>
				<option value ="6">Jeff</option>
				<option value ="7">Shelby</option>
				<option value ="8">Other</option>
			</select>
		</li>
		<li style="margin-left:200px">			
			<div name="startstop" style="width:200px">
				<input type="radio" name="start_stop" value = "start">    Start<br>
				<input type="radio" name="start_stop" value = "stop">    Stop<br>
			</div>
		</li>
		<li>
			<label for="notes">Notes (optional)</label>
			<input type="text" name="notes" placeholder="Halllo">
		</li>
	</ul>
	
	<input type="submit" value="SUBMIT" style="margin-left:200px">
</form>
</div>


<div id="tabs-2">


<form method="post">

	<ul>
	<h3>If you've forgotten to punch-in and/or out, fill out the info below</h3>
		<li>
			<label for="WO_num">Work Order</label>
			<input type="number" name="WO_num" placeholder="Halllo">
		</li>
		<li>
			<label for="op_num">Operation number</label>
			<input type="number" name="op_num" placeholder="Halllo">
		</li>
		<li>
			<label for="user_id">Operator</label>
			<select name="user_id">
				<option value ="" disabled selected style='display:none;'>Who are you?</option>
				<option value ="1">Carl</option>
				<option value ="2">Chaz</option>
				<option value ="3">Alyssa</option>
				<option value ="4">Rob</option>
				<option value ="5">Alani</option>
				<option value ="6">Jeff</option>
				<option value ="7">Shelby</option>
				<option value ="8">Other</option>
			</select>
		</li>
		<li>
			<label for="qty">Quantity (optional)</label>
			<input type="number" name="qty" placeholder="Halllo">
		</li>
		<li>
			<label for="start_time_manual">Start Date/Time</label>
			<input type="datetime-local" name="start_time_manual">
		</li>
		<li>
			<label for="stop_time_manual">Stop Date/Time</label>
			<input type="datetime-local" name="stop_time_manual">
		</li>
		<li>
			<label for="notes">Notes (optional)</label>
			<input type="text" name="notes" placeholder="Halllo">
		</li>
	</ul>

	<input type="submit" value="SUBMIT" style="margin-left:200px">

</form>
</div>

<div id="tabs-3">

<form method="post">

<ul>
	<h3>Enter WO information</h3>
		<li>
			<label for="WO_num">Work Order</label>
			<input type="number" name="WO_num" placeholder="Halllo">
		</li>
		<li>
			<label for="op_num">Operation number</label>
			<input type="number" name="op_num" placeholder="Halllo">
		</li>
		<li>
			<label for="user_id">Operator</label>
			<select name="user_id">
				<option value ="" disabled selected style='display:none;'>Who are you?</option>
				<option value ="1">Carl</option>
				<option value ="2">Chaz</option>
				<option value ="3">Alyssa</option>
				<option value ="4">Rob</option>
				<option value ="5">Alani</option>
				<option value ="6">Jeff</option>
				<option value ="7">Shelby</option>
				<option value ="8">Other</option>
			</select>
		</li>
		<li>
			<label for="qty">Quantity (optional)</label>
			<input type="number" name="qty" placeholder="Halllo">
		</li>
		<li>
			<label for="start_time_manual">Start Date/Time</label>
			<input type="datetime-local" name="start_time_manual">
		</li>
		<li>
			<label for="stop_time_manual">Stop Date/Time</label>
			<input type="datetime-local" name="stop_time_manual">
		</li>
		<li>
			<label for="notes">Notes (optional)</label>
			<input type="text" name="notes" placeholder="Halllo">
		</li>
	</ul>

	<input type="submit" value="SUBMIT" style="margin-left:200px">

</form>
</div>

<?php
if (isset($_POST)){
	
	
	insert_in_table('WO_ops', $_POST);
	
}
