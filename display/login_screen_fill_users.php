<script>
	angularModule.controller('userController', function ($scope) {
	  $scope.users = <?php echo json_encode($local_variables) ?>
	});
</script>