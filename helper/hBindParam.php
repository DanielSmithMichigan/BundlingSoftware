<?php 
class hBindParam{ 
    private $values = array(), $types = ''; 
    
	public function addString($string){
		$this->add('s', $string);
	}
	public function addNumber($string){
		$this->add('i', $string);
	}
    public function add( $type, &$value ){ 
        $this->values[] = &$value; 
        $this->types .= $type; 
    } 
	
	public function hasBindings() { 
		return (count($this->values) > 0);
	}
    
    public function get(){ 
		$arr = array();
		$arr[] = $this->types;
		foreach($this->values as &$value) {
			$arr[] = $value;
		}
        return($arr); 
    } 
	
	public function bindAll($sql_data) {
		foreach($sql_data as $sql_binding) {
			$this->add($sql_binding['type'], $sql_binding['value']);
		}
	}
} 
?> 