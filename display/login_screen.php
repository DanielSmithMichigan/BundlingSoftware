<div class="vert_center_parent page_fill_minus_header">
	<div class="vert_center_child page_fill">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 text-center">
				<div class="row">
					<h2>Select a User</h2>
				</div>
				<?php foreach($local_variables as $user): ?>
					<button type="button" class="btn btn-primary user_selector">
						<input type="hidden" class="user_no" value="<?php echo $user['user_no']; ?>" />
						<?php echo $user['user_name']; ?>
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>