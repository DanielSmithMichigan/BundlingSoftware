<?php foreach($local_variables['parts'] as $part): ?>
	<div class="col-sm-2">
		<div class="well well-sm">
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
			<div class="text-center">
				<button type="button" class="btn btn-primary add_part">
					<div class="params">
						<input type="hidden" name="bundle_no" class="bundle_no" value="<?php echo $local_variables['bundle_no']; ?>" />
						<input type="hidden" name="part_no" class="part_no" value="<?php echo $part['part_no']; ?>" />
					</div>
					Add Part
				</button>
			</div>
		</div>
	</div>
<?php endforeach; ?>