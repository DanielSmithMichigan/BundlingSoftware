<script>
	angularModule.controller('menuController', function ($scope) {
	  $scope.menu_items = <?php echo json_encode($local_variables) ?>
	});
</script>