<?

class Gallery {
	private $dblink;
	private $projects; 
	
	public function __construct($dblink) {
		$this->dblink = $dblink; 
		$this->instantiate(); 
	} 
	
	public function instantiate() {
		$this->projects = array(); 
		require_once("model.Project.php"); 
		$result = mysqli_query($this->dblink,"SELECT * FROM projects"); 
		while($row = mysqli_fetch_array($result)) {
			$p = new Project(); 
			$p->instantiate($row['id']); 
			array_push($this->projects,$p); 
		}
	}
	
	public function show() {
		$str = ''; 
		for($i=0; $i<count($this->projects); $i++) {
			$str .= $this->projects[$i]->showCover(); 
		}
		return $str; 
	}
}
?>