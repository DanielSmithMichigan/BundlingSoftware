<?php
	class dDisplayer {
		public $stored_html = '';
		public $commands = array();
		public function getTemplate($template_name, $local_variables = array(), $slot_name = false) {
			ob_start();
			$full_page_name = $template_name . '.php';
			include($full_page_name);
			$html = '';
			if ($slot_name !== false) {
				$html .= '<div class="'.$slot_name.'">';
			}
			$html .= ob_get_contents();
			if ($slot_name !== false) {
				$html .= '</div>';
			}
			ob_end_clean();
			return $html;
		}
		public function buildReplaceCommand($html, $slot_name) {
			$command = array();
			$command['action'] = 'replace';
			$command['slot_name'] = $slot_name;
			$command['html'] = $html;
			return $command;
		}
		public function getAndReplaceSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables);
			$this->commands[] = $this->buildReplaceCommand($html, $slot_name);
		}
		public function getCommands () {
			return $this->commands;
		}
		public function getAndFillSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables, $slot_name);
			$this->fillSlot($slot_name, $html);
		}
		public function getAndBeginPage($template_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables);
			$this->beginPage($html);
		}
		public function beginPage($html) {
			$this->stored_html = $html;
		}
		public function fillSlot($slot_name, $new_html) {
			$replace_name = $this->getReplaceName($slot_name);
			$this->stored_html = str_replace($replace_name, $new_html, $this->stored_html);
		}
		public function getAndAppendSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables, $slot_name);
			$this->appendSlot($slot_name, $html);
		}
		public function appendSlot($slot_name, $html) {
			$replace_name = $this->getReplaceName($slot_name);
			$html .= PHP_EOL.$replace_name;
			$this->stored_html = str_replace($replace_name, $html, $this->stored_html);
		}
		public function getReplaceName($slot_name) {
			return '<!-- '.$slot_name.' -->';
		}
		public function performDisplay() {
			echo $this->stored_html;
		}
		public function performCommands() {
			asd(json_encode($this->commands));
			echo json_encode($this->commands);
		}
		public function getDisplay() {
			return $this->stored_html;
		}
		public function clear() {
			$this->stored_html = '';
		}
	}
?>