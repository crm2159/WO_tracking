<?php 

$products = array();
foreach(get_list_from_db('products', 'product_id, product_name', '1 ORDER BY `product_id`') as $product_info){
	$products[$product_info['product_id']] = $product_info['product_name'];
}
?>
<p>Enter information about the product</p>
	<div id="search_terms">
		<input name="table" value="rir_items" hidden>
		<ul>
			<li>
				<?php
				//must be specified before load
				if (!isset($choose_columns) || $choose_columns == true){
				?>
				<select name="columns[]" multiple>				
					<option value="" disabled selected>Choose fields</option>
						<?php
					foreach(get_column_list('rir_items') as $value){
						echo '<option name="' . $value['Field'] . '" selected="selected">' . $value['Field'] . '</option>';
					}
										
					?>	
				</select>
				<?php
				
				} else{
				//load columns as defined on page where included
					foreach($columns as $c){
						echo '<input name="columns[]" value = "' . $c . '" hidden>';
					}
				}
				?> 
				<select name="type[]" multiple>				
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
		</ul>
	</div>
  <button type="button" onclick="ajax_post($('#search_terms input,#search_terms select').serialize(), 'search_table','fill_results_table');">Search</button>
  