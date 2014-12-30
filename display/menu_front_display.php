<div class="vert_center_parent page_fill_minus_header">
	<div class="vert_center_child page_fill">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 text-center">
				<div class="row">
					<div class="page-header">
						<h2>What do you want to do?</h2>
					</div>
				</div>
				<?php foreach($local_variables as $menu_item): ?>
					<button class="btn btn-primary <?php echo $menu_item['menu_item_name']; ?>">
						<span class="typcn typcn-<?php echo $menu_item['glyphicon']; ?>"></span>
						<?php echo $menu_item['menu_item_display']; ?>
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
