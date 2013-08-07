<?

class Project {
	private $dblink;
	private $id; 
	private $name; 
	private $datetime; 
	private $cover; 
	private $type; 
	 
	public function __construct($dblink) {
		$this->dblink = $dblink;
		$this->clear();  
	}
	
	public function instantiate($id) {
		$id = clean($id);
		$result = mysqli_query($this->dblink,"SELECT * FROM projects WHERE id='$id'"); 
		if(mysqli_num_rows($result)==1) {
			while($row=mysqli_fetch_array($result)) {
				$this->id 		= $row['id']; 
				$this->name 	= $row['projname']; 
				$this->datetime = $row['datetime']; 
				$this->cover 	= $row['cover']; 
				$this->type 	= $row['type'];  
			}
			return true; 
		} 
		return false; 
	}
	
	public function instantiateByName($name) {
		$result = mysqli_query($this->dblink,"SELECT id FROM projects WHERE projname='$name'"); 
		if(mysqli_num_rows($result)==1) {
			while($row=mysqli_fetch_array($result)) {
				$this->instantiate($row['id']);
				return true;  
			}
		} 
		
		return false; 
	}
	
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDate() { return $this->datetime; }
	public function getCover() { return $this->cover; }
	public function getType() { return $this->type; }
	
	public function setName($name) { $this->name = $name; }
	public function setDate($date) { $this->datetime = $date; }
	public function setCover($img) { $this->cover = $img; }
	public function setType($type) { $this->type = ''.$type; }
	
	public function addType($type) {
		$type = ''.$type;  
		$thistemp = explode(',',$this->type);
		$typetemp = explode(',',$type);
		$added = false; 
		
		for($n = 0; $n < count($typetemp); $n++) {
			$isthere = false; 
			for($i = 0; $i < count($thistemp); $i++) {
				if($thistemp[$i]==$typetemp[$n]) $isthere = true;  
			}
			
			if(!$isthere) {
				if(strlen($this->type)==0) $this->type = $typetemp[$n]; 
				else $this->type .= ','.$typetemp[$n]; 
				$added = $added || true; 
			}
			$thistemp = explode(',',$this->type);
		}
		
		return $added; 
	}

	public function removeType($type) {
		$type = ''.$type; 
		$thistemp = explode(',',$this->type); 
		$typetemp = explode(',',$type);
		$remoded = false; 
		
		for($i = 0; $i < count($thistemp); $i++) {
			for($k = 0; $k < count($typetemp); $k++) {
				if($thistemp[$i]==$typetemp[$k]) {
					unset($thistemp[$i]); 
					break; 
				}
			}
		}
		
		$this->type = implode(',',$thistemp); 
	}
	
	public function save() {
		$id = $this->id; 
		$name = $this->name; 
		$date = now(); 
		$cover = $this->cover; 
		$type = $this->type; 
		
		if($id==0) {
			try {
				mysqli_query($this->dblink,"INSERT INTO projects (projname,datetime,cover,type) VALUES ('$name','$date','$cover','$type')"); 
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			$result = mysqli_query($this->dblink,"SELECT * FROM projects WHERE projname='$name' AND datetime='$date' AND cover='$cover' AND type='$type'"); 
			while($row=mysqli_fetch_array($result)) {
				$this->instantiate($row['id']); 
			}
		} else {
			try {
				mysqli_query($this->dblink,"UPDATE projects SET projname='$name', datetime='$date', cover='$cover', type='$type' WHERE id='$id'"); 
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
				mysqli_query($this->dblink,"DELETE FROM projects WHERE id='$id'"); 
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			
			$imgs = $this->getProjectImages(); 
			foreach($imgs as $i) {
				$i->delete(); 
			}
			$this->clear(); 
			return true; 
		}
		
		return false; 
	}
	
	// returns an array of Images belonging to this Project 
	private function getProjectImages() {
		include_once("model.Image.php"); 
		$list = array(); 
		$proj = $this->id; 
		if($proj!=0) {
			$result = mysqli_query($this->dblink,"SELECT * FROM images WHERE project='$proj'");
			while ($row=mysqli_fetch_array($result)) {
				$img = new Image($this->dblink); 
				$img->instantiate($row['id']); 
				array_push($list,$img); 
			} 
		}
		return $list; 
	}
	
	public function clear() {
		$this->id = 0; 
		$this->name = ''; 
		$this->datetime = now(); 
		$this->cover = ''; 
		$this->type = '';  
	}
	
	public function showCover() {
		include_once("model.Image.php"); 
		$i = new Image($this->dblink); 
		$i->instantiate($this->cover);
		return '<a href="project?v='.$this->name.'" class="cover" id="'.$this->name.'" style="background-image:url(\'_views/_imgs/_uploads/'.$i->getName().'\'); "><div class="covertext" id="'.$this->name.'">'.$this->name.'</div></a>';  
		// return '<img src="_views/_imgs/_uploads/'.$i->getName().'" class="cover"><div id="covertext">'.$this->name.'</div>'; 
	}
	
	public function show() {
		$show = $this->name;  
		$imgs = $this->getProjectImages();
		foreach($imgs as $i) {
			$show .= $i->show(); 
		} 
		return $show;  
	}
	
	public function sysout() {
		error_log($this->id.', '.$this->name.', '.$this->datetime.', '.$this->type); 
	}
}

?>