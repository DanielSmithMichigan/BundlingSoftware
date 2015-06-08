<?php if(count($local_variables['observations']) > 0): ?>
	<div class="container">
		<h3>Observations</h3>
		<table class="table">
			<?php foreach($local_variables['observations'] as $observation): ?>
				<tr>
					<td>
					<?php echo $observation['observation_body']; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php endif; ?>
<?php $order_num = 1; ?>
<div class="container">
	<?php foreach($local_variables['bundles'] as $bundle): ?>
		<div class="panel panel-default">
			<nav class="navbar navbar-default navbar-condensed">
				<div class="navbar-header">
				  <span class="navbar-brand"><?php echo 'Option '.$order_num++; ?></span>
				</div>
			</nav>
			<table class="table table-condensed"> 
				<colgroup>
					<col class="col-xs-1"></col>
					<col class="col-xs-3"></col>
					<col class="col-xs-4"></col>
					<col class="col-xs-3"></col>
					<col class="col-xs-1"></col>
				</colgroup>
				<tr>
					<th>
					</th>
					<th>
					</th>
					<th>
					</th>
					<th class="text-right">
						Price
					</th>
					<th>
					</th>
				</tr>
				<?php if (empty($bundle['description_override'])): ?>
					<?php foreach($bundle['parts_by_appliance'] as $appliance): ?>
						<tr>
							<th>
							</th>
							<td>
								<?php echo $appliance['title']; ?>
							</td>
							<td>
								<?php echo join(", ", $appliance['part_names']); ?>
							</td>
							<td>
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
							<td>
							</td>
							<td class="text-right">
								$<?php echo $bundle['price_adjustment']; ?>
							</td>
							<td>
							</td>
						</tr>
					<?php endif; ?>
				<?php else: ?>
					<?php echo $bundle['description_override']; ?>
				<?php endif; ?>
				<?php if(!empty($bundle['warranty_parts']) && empty($bundle['warranty_labor'])): ?>
					<tr>
						<th>
						</th>
						<th>
							Parts Warranty
						</th>
						<th>
						</th>
						<th class="text-right">
							<?php echo $bundle['warranty_parts']; ?>
						</th>
						<th>
						</th>
					</tr>
				<?php endif; ?>
				<?php if(!empty($bundle['warranty_labor']) && empty($bundle['warranty_parts'])): ?>
					<tr>
						<th>
						</th>
						<th>
							Labor Warranty
						</th>
						<th>
						</th>
						<th class="text-right">
							<?php echo $bundle['warranty_labor']; ?>
						</th>
						<th>
						</th>
					</tr>
				<?php endif; ?>
				<?php if(!empty($bundle['warranty_labor']) && !empty($bundle['warranty_parts'])): ?>
					<tr>
						<th>
						</th>
						<th>
							Parts Warranty: <?php echo $bundle['warranty_parts']; ?>
						</th>
						<th>
							
						</th>
						<th class="text-right">
							Labor Warranty: <?php echo $bundle['warranty_labor']; ?>
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
					<th>
					</th>
					<th class="text-right">
						$<?php echo number_format($bundle['final_price'], 2); ?>
					</th>
					<th>
					</th>
				</tr>
			</table>
		</div>
	<?php endforeach; ?>
</div>

