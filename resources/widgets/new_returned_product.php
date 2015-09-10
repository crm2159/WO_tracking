<?php 
$products = array();
foreach(get_list_from_db('products', 'product_id, product_name', '1 ORDER BY `product_id`') as $product_info){
	$products[$product_info['product_id']] = $product_info['product_name'];
}
?>
<!-- Modal for new_location -->
<div id="new_returned_product" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a product associated with an RIR</h4>
      </div>
      <div class="modal-body">
        <p>Enter information about the product</p>
		<ul>
			<li>		
				<select name="type">				
					<option value="" disabled selected>Choose a product</option>
					<?php
					foreach($products as $product_id=> $product_name){
						echo '<option value="' . $product_name . '">' . $product_name . '</option>';
					}
					?>
				</select>
			</li>
			<li>
				<input type="text" name="sn" placeholder="serial number">
			</li>
			<li>
				<input type="date" name="date_received" >
			</li>
			<li>
				<input type="text" class="autocomplete site_name" id="product_site_name" name="site_name" placeholder="site name">
			</li>
			<li>
				<label for="current_location" class="">Current location</label>
				<select name="current_location">
					<option value="unknown">unknown</option>
					<option value="at_source">at source</option>
					<option value="with_patient">with patient</option>
					<option value="in_transit">in transit</option> <!--add tracking number?-->
					<option value="jhi">jhi</option>
				</select>
			</li>

			<li>
				<textarea type="text" name="investigation_rec" placeholder="Recommended investigation"></textarea>
			</li>
			<li>
				<textarea type="text" name="findings" placeholder="">No findings</textarea>
			</li>
		</ul>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="" data-dismiss="modal">Cancel</button>
		<button type="button" class="submit-ajax" data-dismiss="modal" onclick="ajax_post($('#new_returned_product input, #new_returned_product select, #new_returned_product textarea').serialize(),'new_list_item&table=rir_items','add_product_to_rir');">Add</button>
      </div>
    </div>

  </div>
</div>
