<?php foreach($local_variables['bundles'] as $bundle): ?>
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
				  <span class="navbar-brand"><?php echo $bundle['bundle_name']; ?></span>
				</div>
			</nav>
			<table class="table">
				<tr>
					<th>
					</th>
					<?php foreach($local_variables['part_column_names'] as $part_column): ?>
						<th>
							<?php echo $part_column; ?>
						</th>
					<?php endforeach; ?>
					<th class="text-right">
						Price
					</th>
					<th>
					</th>
				</tr>
				<?php foreach($bundle['parts'] as $part): ?>
					<tr>
						<th>
						</th>
						<?php foreach($local_variables['part_columns'] as $part_column): ?>
							<td>
								<?php echo $part[$part_column]; ?>
							</td>
						<?php endforeach; ?>
						<td class="text-right">
							$<?php echo number_format($part['cust_disp_price'], 2); ?>
						</td>
						<th>
						</th>
					</tr>
				<?php endforeach; ?>
				<?php if($bundle['no_parts_flag']): ?>
					<tr>
						<td>
						</td>
						<td>
							Labor Cost
						</td>
						<td class="text-right">
							$<?php echo $bundle['price_adjustment']; ?>
						</td>
						<td>
						</td>
					</tr>
				<?php endif; ?>
				<?php if(!empty($bundle['bundle_warranty'])): ?>
					<tr>
						<th>
						</th>
						<th>
							Warranty
						</th>
						<th class="text-right">
							<?php echo $bundle['bundle_warranty']; ?>
						</th>
						<th>
						</th>
					</tr>
				<?php endif; ?>
				<tr>
					<th>
					</th>
					<th>
						Total
					</th>
					<th class="text-right">
						$<?php echo number_format($bundle['final_price'], 2); ?>
					</th>
					<th>
					</th>
				</tr>
			</table>
		</div>
	</div>
<?php endforeach; ?>

