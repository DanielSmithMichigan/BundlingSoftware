<script>
	angularModule.controller('menuFrontController', function ($scope) {
	  $scope.menu_items = <?php echo json_encode($local_variables) ?>
	});
</script>