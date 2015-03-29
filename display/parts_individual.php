<?php foreach($local_variables['parts'] as $part): ?>
	<div class="col-sm-2">
		<div class="well well-sm">
			<div>
				<h4>#<?php echo $part['part_num']; ?></h4>
				<p><?php echo $part['part_description']; ?></p>
				<?php foreach($local_variables['part_display_config'] as $col => $name): ?>
					<p>
						<?php echo $name; ?>: 
						<?php if (is_numeric($part[$col])): ?>
							$<?php echo round($part[$col], 2); ?>
						<?php else: ?>
							<?php echo $part[$col]; ?>
						<?php endif; ?>
					</p>
				<?php endforeach; ?>
			</div>
			<div class="add_part_section">
				<div class="text-center">
					<div>Add Part As</div>
					<button type="button" class="add_part_button btn btn-primary add_part">
						<div class="params">
							<input type="hidden" name="bundle_no" class="bundle_no" value="<?php echo $local_variables['bundle_no']; ?>" />
							<input type="hidden" name="part_num" class="part_num" value="<?php echo $part['part_num']; ?>" />
							<input type="hidden" name="type" class="type" value="primary" />
						</div>
						Primary
						$<?php echo number_format($part['price_primary'], 2); ?>
					</button>
					<button type="button" class="add_part_button btn btn-danger add_part">
						<div class="params">
							<input type="hidden" name="bundle_no" class="bundle_no" value="<?php echo $local_variables['bundle_no']; ?>" />
							<input type="hidden" name="part_num" class="part_num" value="<?php echo $part['part_num']; ?>" />
							<input type="hidden" name="type" class="type" value="secondary" />
						</div>
						Secondary
						$<?php echo number_format($part['price_secondary'], 2); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>