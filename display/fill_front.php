<script>
	angularModule.controller('frontController', function ($scope) {
	  $scope.items = <?php echo json_encode($local_variables) ?>
	});
</script>