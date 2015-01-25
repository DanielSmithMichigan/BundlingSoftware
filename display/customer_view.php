<?php foreach($local_variables['bundles'] as $bundle): ?>
	<div class="panel panel-default">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
			  <span class="navbar-brand"><?php echo $bundle['bundle_name']; ?></span>
			</div>
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

