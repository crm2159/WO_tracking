<?php


include_once 'resources/init.php';
include_once 'resources/head.php';
include_once 'resources/header.php';

protect();
?>
<form href="#" method="post">

	<ul>
		<li>
			<label for="wo_num">Work Order</label>
			<input type="number" name="wo_num">
		</li>
		<li>
			<label for="op_num">Operation number</label>
			<input type="number" name="op_num">
		</li>
		<li>
			<label for="user_id"></label>
			<select name="user_id">
				<option value ="1">Carl</option>
				<option value ="2">Alani</option>
				<option value ="3">Rob</option>
				<option value ="4">Alyssa</option>
				<option value ="5">Charlie</option>
			</select>
		</li>
		<li>
			<label for="date">Date</label>
			<input type="date" name="date">
		</li>
		<li>
			<label for="time"></label>
			<input type="time" name="time">
		</li>
		<li>
			Start / stop <br>
			<input type="radio" name="start_stop" value = "start">Start<br>
			<input type="radio" name="start_stop" value = "stop">Stop<br>
		</li>
	</ul>

	<input type="submit" value="submit">

</form>
<?php

include 'resources/foot.php';