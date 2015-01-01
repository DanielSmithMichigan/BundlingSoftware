<div class="bundle_parts_footer">
	<div class="row">
		<div class="col-sm-2">
			Bundled Parts:
		</div>
		<?php foreach($local_variables['bundled_parts'] as $part): ?>
			<div class="col-sm-1 bundled_part">
				<span class="typcn typcn-delete text-danger remove_part">
					<div class="params">
						<input type="hidden" name="bundle_part_no" class="bundle_part_no" value="<?php echo $part['bundle_part_no']; ?>" />
						<input type="hidden" name="bundle_no" class="bundle_no" value="<?php echo $local_variables['bundle_no']; ?>" />
					</div>
				</span>
				<b>#<?php echo $part['part_num']; ?></b>
			</div>
		<?php endforeach; ?>
	</div>	
</div>