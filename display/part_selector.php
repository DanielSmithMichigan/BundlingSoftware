<div class="panel panel-default">
	<div class="panel-body">
		<?php foreach($local_variables['filters'] as $filter_key=>$filter): ?>
		<div class="btn-group alter_title" data-title="<?php echo $filter; ?>" role="group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<div class="change_me"><?php echo $filter; ?>: </div>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#" class="clr">(reset)</a></li>
				<?php foreach($local_variables['filter_distinct_values'][$filter_key] as $filter_distinct_value): ?>
					<li><a href="#"><?php echo $filter_distinct_value; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endforeach; ?>
	</div>
</div>