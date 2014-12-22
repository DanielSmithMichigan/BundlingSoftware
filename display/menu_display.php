<div class="menu_div">
	<div class="menu_line_item textured_bg menu_expander">
		<span class="menu expand_menu typcn typcn-arrow-maximise"></span>
		<span class="menu contract_menu typcn typcn-arrow-minimise"></span>
		<div class="menu_text inline_block_display">
			Minimize
		</div>
	</div>
	<div>
		<div ng-controller="menuController">
			<div ng-repeat="menu_item in menu_items" class="new_box user_selector"><input type="hidden" class="user_no" value="{{user.user_no}}" />{{user.user_name}}</div>
		</div>
	</div>
	<div class="menu_line_item textured_bg">
		<span class="menu typcn <?php echo $menu_item['menu_item_name']; ?> typcn-<?php echo $menu_item['glyphicon']; ?>"></span>
		<div class="menu_text inline_block_display">
			<?php echo $menu_item['menu_item_display']; ?>
		</div>
	</div>
</div>ssss