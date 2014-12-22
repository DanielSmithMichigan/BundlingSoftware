<div class="menu_div">
	<div class="menu_line_item textured_bg menu_expander">
		<span class="menu expand_menu typcn typcn-arrow-maximise"></span>
		<span class="menu contract_menu typcn typcn-arrow-minimise"></span>
		<div class="menu_text inline_block_display">
			Minimize
		</div>
	</div>
	<div ng-controller="menuController" id="angular_menu_controller">
		<div ng-repeat="menu_item in menu_items" class="menu_line_item textured_bg">
			<span class="menu typcn {{menu_item.menu_item_name}} typcn-{{menu_item.glyphicon}}"></span>
			<div class="menu_text inline_block_display">
				{{menu_item.menu_item_display}}
			</div>
		</div>
	</div>
</div>
