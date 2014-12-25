<div>
	<div ng-controller="userController">
		<div ng-repeat="user in users" class="new_box user_selector"><input type="hidden" class="user_no" value="{{user.user_no}}" />{{user.user_name}}</div>
	</div>
</div>