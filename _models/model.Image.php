<?

class Image {
	private $dblink; 
	private $id; 
	private $name; 
	private $datetime; 
	private $project; 
	
	public function __construct($dblink) {
		$this->$dblink = $dblink; 
		$this->clear(); 
	} 
	
	// @pre: id is clean
	public function instantiate($id) {
		$result = mysqli_query($this->dblink,"SELECT * FROM images WHERE id='$id'");
		if(mysqli_num_rows($result)==1) {
			$this->id 		= $row['id']; 
			$this->name		= $row['imgurl']; 
			$this->datetime = $row['datetime']; 
			$this->project 	= $row['project']; 
			return true; 
		} 
		return false; 
	}
	
	public function setUrl($file) { $this->name = $file; }
	public function setDate($date) { $this->datetime = $date; }
	public function setProject($project) { $this->project = $project; }
	
	public function save() {
		$id = $this->id;
		$name = $this->name; 
		$date = now(); 
		$proj = $this->project; 
		 
		if($id==0) {
			mysqli_query($this->dblink,"INSERT INTO images (imgurl,datetime,project) VALUES ('$name','$date','$proj)"); 
		} else {
			mysqli_query($this->dblink,"UPDATE images SET imgurl='$name', datetime='$date', project='$proj' WHERE id='$id'"); 
		}
		
		return !mysqli_error();  
	}
	
	public function delete() {
		$id = $this->id; 
		
		if($id!=0) {
			mysqli_query($this->dblink,"DELETE FROM images WHERE id='$id'"); 
			unlink($_SESSION['DESpath'].'_views/_imgs/_uploads'.$this->name); 
			
			if(!mysqli_error() && !is_file($_SESSION['DESpath'].'_views/_imgs/_uploads'.$this->name)) {
				return true;
				$this->clear();   
			}
		}
		
		return false; 
	}
	
	public function clear() {
		$this->id = 0; 
		$this->name = ''; 
		$this->datetime = now(); 
		$this->project = 0; 
	}
	
	public function show() {
		return '<img src="'.$this->name.'" id="img'.$this->id.'">';  
	}
	
	
}

?>