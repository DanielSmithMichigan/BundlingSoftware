<?php
	class fUpdateParts extends fInterface {
		public function displayFileUpload() {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'file_upload';
			$slot_name = '__PAGE_MAIN__';
			$local_variables = array();
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
		public function performFileUpload($params) {
			$bFileUpload = hObjectPooler::getObject('bFileUpload');
			$bFileUpload -> uploadFile($params);
		}
	}
?>
