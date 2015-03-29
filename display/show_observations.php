<div class="container">
	<button type="button" class="btn btn-primary add_observation">
		Add Observation
	</button>
	<button type="button" class="btn btn-danger delete_observations pull-right">
		Delete All Observations
	</button>
</div>
<br /><br />
<div class="panel panel-default">
	<ul class="list-group">
		<?php foreach($local_variables['observations'] as $observation): ?>
			<li class="list-group-item">
				<button type="button" class="btn btn-danger btn-xs delete_observation" style="margin-right: 10px">
					<div class="params">
						<input type="hidden" class="observation_no" name="observation_no" value="<?php echo $observation['observation_no']; ?>" />
					</div>
					Delete
				</button>
				<?php echo $observation['observation_body']; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>