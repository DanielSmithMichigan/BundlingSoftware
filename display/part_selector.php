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
					<li>
						<a href="#" class="filter_selector">
							<div class="params" style="display: none">
								<input type="hidden" name="filter_key" value="<?php echo $filter_key; ?>" />
								<input type="hidden" name="filter_distinct_value" value="<?php echo $filter_distinct_value; ?>" />
								<input type="hidden" name="bundle_no" value="<?php echo $local_variables['bundle_no']; ?>" />
							</div>
							<?php echo $filter_distinct_value; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endforeach; ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h4>Select the part you would like to add to your bundle</h4>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- __PARTS__ -->
		</div>
	</div>
</div>
<!-- __BUNDLE_PARTS__ -->