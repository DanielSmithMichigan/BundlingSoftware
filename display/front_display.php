<div class="menu_front_div">
	<div ng-controller="frontController">
		<div ng-repeat="item in items" class="new_box">
			<span ng-if="item.glyphicon" class="front_menu typcn {{item.item_name}} typcn-{{item.glyphicon}}"></span>
			<input ng-if="item.inputs" ng-repeat="(key,val) in item.inputs" type="hidden" name="{{key}}" value="{{val}}" />
			<div class="front_menu_text inline_block_display">
				{{item.item_display}}
			</div>
		</div>
	</div>
</div>
