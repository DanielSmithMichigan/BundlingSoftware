<div class="container">
	<button type="button" class="btn btn-primary create_bundle">
		New Bundle
	</button>
	<button type="button" class="btn btn-danger delete_all_bundles pull-right">
		Delete All Bundles
	</button>
</div>
<br />
<?php foreach($local_variables['bundles'] as $bundle): ?>
	<div class="product_bundle_container panel panel-default">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="#" class="add_parts">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<span class="typcn typcn-plus"></span>
						Add/Remove Parts
					</a>
				</li>
				<li class="override_header">
					<a href="#" class="override_description">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<span class="typcn typcn-edit"></span>
						<span data-toggle="modal" data-target="#modal_<?php echo $bundle['bundle_no']; ?>">Override Description
						<div class="modal fade" id="modal_<?php echo $bundle['bundle_no']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
									 <a class="close destroy_summernote" data-dismiss="modal">×</a>
									 <h3>Enter your description</h3>
								 </div>
								 <div class="modal-body">
									 <textarea class="summernote" id="summernote_<?php echo $bundle['bundle_no']; ?>">
										
									 </textarea>
									 <textarea id="bundle_description_<?php echo $bundle['bundle_no']; ?>" style="display:none;">
										<?php echo $bundle['description_override']; ?>
									 </textarea>
								 </div>
								 <div class="modal-footer">
									 <a href="#" class="save_description_override" data-dismiss="modal">Save</a>
								 </div>
								</div>
							</div>
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="duplicate_bundle">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<span class="typcn typcn-tabs-outline"></span>
						Duplicate
					</a>
				</li>
				<li>
					<a href="#" class="adjust_price">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
							<input type="hidden" name="price_adjustment" value="<?php echo round($bundle['price_adjustment'], 2); ?>" />
						</div>
						<span class="typcn typcn-calculator"></span>
						Adjust Price
					</a>
				</li>
				<li role="presentation" class="dropdown alter_title" data-title="Warranty">
					<a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
						<span class="change_me">
							Parts Warranty
							<?php 
								if(!empty($bundle['warranty_parts'])) {
									echo ': '.$bundle['warranty_parts'];
								}
							?>
						</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<?php foreach($local_variables['warranty_options'] as $warranty_option): ?>
							<li role="presentation">
								<a role="menuitem" class="update_warranty_parts">
									<div class="params">
										<input type="hidden" name="bundle_warranty" value="<?php echo $warranty_option; ?>" />
										<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
									</div>
									<?php echo $warranty_option; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li role="presentation" class="dropdown alter_title" data-title="Warranty">
					<a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
						<span class="change_me">
							Labor Warranty
							<?php 
								if(!empty($bundle['warranty_labor'])) {
									echo ': '.$bundle['warranty_labor'];
								}
							?>
						</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<?php foreach($local_variables['warranty_options'] as $warranty_option): ?>
							<li role="presentation">
								<a role="menuitem" class="update_warranty_labor">
									<div class="params">
										<input type="hidden" name="bundle_warranty" value="<?php echo $warranty_option; ?>" />
										<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
									</div>
									<?php echo $warranty_option; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<a class="delete_bundle">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<span class="typcn typcn-trash"></span>
						Delete
					</a>
				</li>
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
					Type
				</th>
				<th>
					QTY
				</th>
				<th>
					Price
				</th>
			</tr>
			<?php foreach($bundle['parts'] as $part): ?>
				<tr class="<?php echo($part['type'] === 'primary')?'':''?>">
					<?php foreach($local_variables['part_columns'] as $part_column): ?>
						<td>
							<?php echo $part[$part_column]; ?>
						</td>
					<?php endforeach; ?>
					<td>
						<?php echo ucfirst($part['type']); ?>
					</td>
					<td>
						<?php echo $part['qty']; ?>
					</td>
					<td>
						$<?php echo number_format($part['price'], 2); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php if($bundle['modified_price']): ?>
				<tr>
					<th>
						Price (Before Modification)
					</th>
					<td colspan="<?php echo $local_variables['num_part_col'] + 1; ?>">
					
					</td>
					<th>
						$<?php echo number_format($bundle['price'], 2); ?>
					</th>
				</tr>
				<tr>
					<th>
						Price Adjustment
					</th>
					<td colspan="<?php echo $local_variables['num_part_col'] + 1; ?>">
						<div class="params">
							<input type="hidden" name="bundle_no" value="<?php echo $bundle['bundle_no']; ?>" />
						</div>
						<a class="remove_price_modification" style="cursor: pointer">(remove modification)</a>
					</td>
					<th>
						$<?php echo number_format($bundle['price_adjustment'], 2); ?>
					</th>
				</tr>
			<?php endif; ?>
			<tr>
				<th>
					Total
				</th>
				<td colspan="<?php echo $local_variables['num_part_col'] + 1; ?>">
				
				</td>
				<th>
					$<?php echo number_format($bundle['final_price'], 2); ?>
				</th>
			</tr>
		</table>
	</div>
<?php endforeach; ?>

