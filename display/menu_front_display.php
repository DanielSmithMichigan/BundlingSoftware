<div class="menu_front_div">
	<div ng-controller="menuFrontController">
		<div ng-repeat="menu_item in menu_items" class="new_box">
			<span class="front_menu typcn {{menu_item.menu_item_name}} typcn-{{menu_item.glyphicon}}"></span>
			<div class="front_menu_text inline_block_display">
				{{menu_item.menu_item_display}}
			</div>
		</div>
	</div>
</div>
