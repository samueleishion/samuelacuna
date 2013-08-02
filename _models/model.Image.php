<?

class Image {
	private $dblink; 
	private $id; 
	private $name; 
	private $datetime; 
	private $project; 
	
	public function __construct($dblink) {
		$this->dblink = $dblink; 
		$this->clear(); 
	} 
	
	public function instantiate($id) {
		$id = clean($id); 
		$result = mysqli_query($this->dblink,"SELECT * FROM images WHERE id='$id'");
		if(mysqli_num_rows($result)==1) {
			while($row=mysqli_fetch_array($result)) {
				$this->id 		= $row['id']; 
				$this->name		= $row['imgurl']; 
				$this->datetime = $row['datetime']; 
				$this->project 	= $row['project'];
			} 
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
			try {
				mysqli_query($this->dblink,"INSERT INTO images (imgurl,datetime,project) VALUES ('$name','$date','$proj')");
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			$result = mysqli_query($this->dblink,"SELECT * FROM images WHERE imgurl='$name' AND datetime='$date' AND project='$proj'"); 
			while($row=mysqli_fetch_array($result)) {
				$this->instantiate($row['id']); 
			}
		} else {
			try {
				mysqli_query($this->dblink,"UPDATE images SET imgurl='$name', datetime='$date', project='$proj' WHERE id='$id'");
			} catch(mysqli_sql_exception $e) {
				return false; 
			} 
		}
		
		return true;  
	}
	
	public function delete() {
		$id = $this->id; 
		
		if($id!=0) {
			try {
				mysqli_query($this->dblink,"DELETE FROM images WHERE id='$id'");
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			  
			if(is_file($_SESSION['DESpath'].'_views/_imgs/_uploads'.$this->name)) {
				unlink($_SESSION['DESpath'].'_views/_imgs/_uploads'.$this->name);
			}
			$this->clear();
			return true;  
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
		return '<img src="'.$_SESSION['DESpath'].'_views/_imgs/_upload'.$this->name.'" id="img'.$this->id.'">';  
	}
	
	public function sysout() {
		return $this->id.', '.$this->name.', '.$this->datetime.', '.$this->project; 
	}
	
}

?>