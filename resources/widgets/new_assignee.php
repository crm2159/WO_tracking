<!-- Modal for new_assignee -->
<div id="new_assignee" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Assignee</h4>
      </div>
      <div class="modal-body">
        <p>Enter information for a new assignee</p>
		<ul>
			<li>
				<input type="text" name="firstname" placeholder="firstname">
			</li>
			<li>
				<input type="text" name="lastname" placeholder="lastname">
			</li>
			<li>
				<input type="text" name="email" placeholder="email">
			</li>
			<li>
				<input type="text" name="role" placeholder="role">
			</li>
		</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="" data-dismiss="modal">Cancel</button>
		<button type="button" class="submit-ajax" data-dismiss="modal" onclick="ajax_post($('#new_assignee input').serialize(),'new_list_item&table=rir_assignees','on_result');">Add</button>
      </div>
    </div>

  </div>
</div>