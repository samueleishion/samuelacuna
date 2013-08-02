<?

class Project {
	private $dblink;
	 
	public function __construct($dblink) {
		$this->dblink = $dblink;
		$this->clear();  
	}
	
	public function instantiate($id) {
		
	}
	
	public function clear() {
		$this->id = 0; 
		$this->name = ''; 
		$this->datetime = now(); 
		$this->cover = ''; 
		$this->type = 0;  
	}
}

?>