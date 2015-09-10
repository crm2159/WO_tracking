<?php 
$products = array();
foreach(get_list_from_db('products', 'product_id, product_name', '1 ORDER BY `product_id`') as $product_info){
	$products[$product_info['product_id']] = $product_info['product_name'];
}
?>
<!-- Modal for new_location -->
<div id="add_returned_product" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a product associated with an RIR</h4>
      </div>
      <div class="modal-body">
        <p>Search for a returned product to add</p>
		<?php
		//tell the included file whether or not to define your own columns. Should probably be a function. this is messy
		$choose_columns = false;
		$columns = ['id', 'sn', 'type'];
		include 'resources/widgets/search_rir_items.php';
		?>
		<div id="results">
			<table class="table">
				<thead>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="" data-dismiss="modal">Cancel</button>
		<button type="button" class="submit-ajax" data-dismiss="modal" onclick="add_checked('results', 'assoc_items_table');">Add</button>
      </div>
    </div>

  </div>
</div>
