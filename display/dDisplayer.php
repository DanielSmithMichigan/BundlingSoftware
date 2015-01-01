<?php
	class dDisplayer {
		public $stored_html = '';
		public $commands = array();
		public $interfaces = array();
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
		public function buildReplaceSlotCommand($html, $slot_name) {
			$command = array();
			$command['action'] = 'replace_html';
			$command['slot_name'] = $slot_name;
			$command['html'] = $html;
			return $command;
		}
		public function buildReplaceDataCommand($var_name, $var_data, $controller_id) {
			$command = array();
			$command['action'] = 'replace_data';
			$command['var_name'] = $var_name;
			$command['var_data'] = $var_data;
			$command['controller_id'] = $controller_id;
			return $command;
		}
		public function addGenericCommand($action, $properties = array()) {
			$command = array();
			$command['action'] = $action;
			$command['properties'] = $properties;
			$this->addCommand($command);
		}
		public function addCommand($command) {
			$this->commands[] = $command;
		}
		public function getAndReplaceSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables);
			$command = $this->buildReplaceSlotCommand($html, $slot_name);
			$this->addCommand($command);
		}
		public function replaceData($var_name, $var_data, $controller_id = 'frontController') {
			$command = $this->buildReplaceDataCommand($var_name, $var_data, $controller_id);
			$this->addCommand($command);
		}
		public function getCommands () {
			return $this->commands;
		}
		public function getAndFillSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables, $slot_name);
			$html = $this->fillSlot($slot_name, $html, $this->stored_html);
			$this->replaceStoredHtml($html);
		}
		public function getAndBeginPage($template_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables);
			$this->replaceStoredHtml($html);
		}
		public function replaceStoredHtml($html) {
			$this->stored_html = $html;
		}
		public function fillSlot($slot_name, $new_html, $input_html) {
			$replace_name = $this->getReplaceName($slot_name);
			return(str_replace($replace_name, $new_html, $input_html));
		}
		public function getAndAppendSlot($template_name, $slot_name, $local_variables = array()) {
			$html = $this->getTemplate($template_name, $local_variables, $slot_name);
			$this->appendSlot($slot_name, $html, $this->stored_html);
		}
		public function appendSlot($slot_name, $html, $input_html) {
			$replace_name = $this->getReplaceName($slot_name);
			$html .= PHP_EOL.$replace_name;
			$html = str_replace($replace_name, $html, $input_html);
			$this->replaceStoredHtml($html);
		}
		public function getReplaceName($slot_name) {
			return '<!-- '.$slot_name.' -->';
		}
		public function performDisplay() {
			echo $this->stored_html;
		}
		public function performCommands() {
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