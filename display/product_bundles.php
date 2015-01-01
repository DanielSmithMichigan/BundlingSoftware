<?php foreach($local_variables['bundles'] as $bundle): ?>
	<div class="panel panel-default">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
			  <span class="navbar-brand"><?php echo $bundle['bundle_name']; ?></span>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="#" class="add_parts">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<span class="typcn typcn-plus"></span>
						Add Part
					</a>
				</li>
			  <li><a href="#"><span class="typcn typcn-tabs-outline"></span>Duplicate</a></li>
			</ul>
			<ul class="nav navbar-nav pull-right">
			  <li><a href="#"><span class="typcn typcn-trash"></span>Delete Bundle</a></li>
			</ul>
		</nav>
		<table class="table">
			<tr>
				<?php foreach($local_variables['part_column_names'] as $part_column): ?>
					<th>
						<?php echo $part_column; ?>
					</th>
				<?php endforeach; ?>
				<th>
					QTY
				</th>
				<th>
					Price
				</th>
			</tr>
			<?php foreach($bundle['parts'] as $part): ?>
				<tr>
				<?php foreach($local_variables['part_columns'] as $part_column): ?>
					<td>
						<?php echo $part[$part_column]; ?>
					</td>
				<?php endforeach; ?>
				<td>
					<?php echo $part['qty']; ?>
				</td>
				<td>
					<?php echo round($part['price'], 2); ?>
				</td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<th>
					Total
				</th>
				<td colspan="<?php echo $local_variables['num_part_col']; ?>">
				
				</td>
				<th>
					<?php echo round($bundle['price'], 2); ?>
				</th>
			</tr>
		</table>
	</div>
<?php endforeach; ?>

