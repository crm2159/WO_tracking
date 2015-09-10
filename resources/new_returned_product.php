<?php
include 'resources/init.php';
include 'resources/head.php';
include 'resources/header.php';
?>
<?php 
protect(0,false,true);



if (!empty($_POST)){
	insert_in_table('design_docs', $_POST);
	print_r($_POST);
	die();
}

$products = array();
foreach(get_list_from_db('products', 'product_id, product_name', '1 ORDER BY `product_id`') as $product_info){
	$products[$product_info['product_id']] = $product_info['product_name'];
}
$doc_types = array();
foreach(get_list_from_db('doc_types', 'id, doc_type', '1 ORDER BY `doc_type`') as $doc_info){
	$doc_types[$doc_info['id']] = $doc_info['doc_type'];
}
$doc_locations = array();
foreach(get_list_from_db('doc_locations', 'id, doc_location', '1 ORDER BY `doc_location`') as $doc_location_info){
	$doc_locations[$doc_location_info['id']] = $doc_location_info['doc_location'];
}

?>
<div class="container">
<h2>Document Number</h2>
<form action="" method="POST">
<div id = "assign_docs" >
	<ul>
		<li>
			<label for="type" class="left-label">Type</label>
			<select name="type" id="doc_type" >
				<?php
				foreach($doc_types as $id=> $doc_type){
					echo '<option value="' . $id . '">' . $doc_type . '</option>';
				}
				?>
			</select>
			<!-- Trigger the modal with a button -->
			<button type="button" data-toggle="modal" data-target="#new_doc_type"><b>+</b></button>
		</li>
		<li>
			<label for="title" class="left-label">document title</label>
			<input type="text" name="title" placeholder="title">
		</li>
		<li>
			<label for="current_owner" class="left-label">Current owner</label>
			<input type="text" name="current_owner" value = "<?php echo (get_user_info('firstname', $_SESSION['user_id']) . ' ' . get_user_info('lastname', $_SESSION['user_id']))?>">
		</li>
		<li>
			<label for="prefix" class="left-label">number</label>
			<input type="number" name="prefix" min="00001" max="99999" id="doc_number" onkeyup="check_range(this)" placeholder="5-digit">
			<input type="number" name="suffix" min="000" max="999" id="suffix" onkeyup="check_range(this)" placeholder="3-digit">
			<button type="button" name="new_doc_num" onclick="get_doc_num(this, 'design_doc');">*</button>
		</li>
		<li>
			<label for="status" class="left-label">status</label>
			<select type="text" name="status">
				<option value="active">active</option>
				<option value="obsolete">obsolete</option>
				<option value="reserved">reserved</option>
			</select>
		</li>
		<li>
			<label for="location_access" class="left-label">Location - Access</label>
			<select name="location_access" placeholder="location">
				<?php
				foreach($doc_locations as $id=> $location){
					echo '<option value="' . $id . '">' . $location . '</option>';
				}
				?>
			</select>
			<button class="add-button" type="button" data-toggle="modal" data-target="#new_doc_location"><b>+</b></button>
		</li>
		<li>
			<label for="location_original" class="left-label">Location - Original</label>
			<input type="text" name="location_original" placeholder="location">
		</li>
		<li>
			<label for="original_owner" class="left-label">Original owner</label>
			<input type="text" name="original_owner" placeholder="original owner">
		</li>
		<li>
			<label for="date_assigned" class="left-label">Date</label>
			<input type="date" name="date_assigned" value="<?php echo date("Y-m-d");?>" readonly="true">
		</li>
		
		<li>
			<label for="assoc_systems" class="left-label">Associated items <br><small>Select all that apply using CTRL</small></label>
			<select name="assoc_systems[]" multiple>
				<?php
				foreach($products as $product_id=> $product_name){
					echo '<option value="' . $product_id . '">' . $product_name . '</option>';
				}
				?>
			</select>
		</li>
		<li>
			<input type="submit" value="submit">
		</li>
	</ul>
</div>
</form>
<!-- Modal for new doctype-->
<div id="new_doc_type" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Document Type</h4>
      </div>
      <div class="modal-body">
        <p>Enter the new document type</p>
		<ul>
			<li>
				<input type="text" name="doc_type" placeholder="document type">
			</li>
		</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="" data-dismiss="modal">Cancel</button>
		<button type="button" class="submit-ajax" data-dismiss="modal" onclick="ajax_post($('#new_doc_type input').serialize(),'new_list_item&table=doc_types','on_result');">Add</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal for new_location -->
<div id="new_doc_location" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Location</h4>
      </div>
      <div class="modal-body">
        <p>Enter the new location</p>
		<ul>
			<li>
				<input type="text" name="doc_location" placeholder="Location">
			</li>
		</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="" data-dismiss="modal">Cancel</button>
		<button type="button" class="submit-ajax" data-dismiss="modal" onclick="ajax_post($('#new_doc_location input').serialize(),'new_list_item&table=doc_locations','on_result');">Add</button>
      </div>
    </div>

  </div>
</div>
</div>
</div>
<?php
include 'resources/foot.php';