<ul class="nav navbar-nav menu_items">
	<?php foreach($local_variables['menu'] as $menu_item): ?>
		<li class="menu_option <?php echo $menu_item['menu_item_name'] === $local_variables['curr_action']?'active':''; ?>">
			<a class="<?php echo $menu_item['menu_item_name'];?> active hide_footer">
				<span class="typcn typcn-<?php echo $menu_item['glyphicon'];?>"></span>
				<?php echo $menu_item['menu_item_display'];?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<ul class="nav navbar-nav pull-right">
	<li>
		<a class="hide_menu">
			<span class="typcn typcn-arrow-minimise"></span>
			Hide Menu
		</a>
	</li>
</ul>

