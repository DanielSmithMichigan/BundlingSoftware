<?php
	class fFooter {
		public function displayFooter() {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$slot_name = '__PAGE_FOOTER__';
			$template_name = 'page_footer';
			$displayer->getAndFillSlot($template_name, $slot_name);
		}
	}
?>