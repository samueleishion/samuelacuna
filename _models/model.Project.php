<?

/*
 * Descartes PHP Framework
 * 	model.Project.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Model - Project object that stores 
 * a project with its images  
 * 
 */

require_once("model.Image.php"); 

class Project {

	private $dblink; 
	private $id; 
	private $name; 
	private $desc; 
	private $types; 
	private $cover; 
	private $datetime; 
	private $status; 
	private $page; 
	
	public function __construct($dblink) {
		$this->dblink = $dblink; 
		$this->clear(); 
		//$this->filter = "portfolio"; 
	}
	
	public function instantiate($id) { 
		$id = clean($id); 
		$page = $this->page; 
		$result = mysqli_query($this->dblink,"SELECT * FROM projects WHERE id='$id'"); 
		if(mysqli_num_rows($result)==1) { 
			while($row=mysqli_fetch_array($result)) {
				$this->setId($row['id']); 
				$this->setName($row['projname']); 
				$this->setDescription($row['projdesc']); 
				$this->setDate($row['datetime']); 
				$this->setCover($row['cover']); 
				$this->setTypes($row['type']); 
				$this->setStatus($row['status']); 
				$this->setPage($row['page']); 
			} 
			return true; 
		}
		return false; 
	}
	
	public function instantiateByName($name) {
		$name = clean($name); 
		$page = $this->page; 
		$result = mysqli_query($this->dblink,"SELECT id FROM projects WHERE projname='$name' AND page='$page'"); 
		if(mysqli_num_rows($result)==1) {
			while($row=mysqli_fetch_array($result)) {
				$id = $row['id']; 
			}
			return $this->instantiate($id); 
		}
		return false; 
	}
	
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return decodequotes($this->desc); }
	public function getTypes() { return $this->types; }
	public function getCover() { return $this->cover; }
	public function getDate() { return $this->datetime; }
	public function getStatus() { return $this->status; } 
	public function getPage() { return $this->page; } 
	
	private function setId($int) { $this->id = clean($int); }
	public function setName($str) { $this->name = strtolower(clean($str)); }
	public function setDescription($str) { $this->desc = encodequotes($str); }
	public function setTypes($str) { $this->types = clean($str); }
	public function setCover($str) { $this->cover = clean($str); }
	public function setDate($date) { $this->datetime = clean($date); }
	public function setStatus($int) { $this->status = clean($int); }
	public function setPage($str) { $this->page = clean($str); } 
	
	public function addType($type) {
		$type = ''.$type;  
		$thistemp = explode(',',$this->types);
		$typetemp = explode(',',$type);
		$added = false; 
		for($n = 0; $n < count($typetemp); $n++) {
			$isthere = false; 
			for($i = 0; $i < count($thistemp); $i++) {
				if($thistemp[$i]==$typetemp[$n]) $isthere = true;  
			}
			
			if(!$isthere) {
				if(strlen($this->types)==0) $this->types = $typetemp[$n]; 
				else $this->types .= ','.$typetemp[$n]; 
				$added = $added || true; 
			}
			$thistemp = explode(',',$this->types);
		}
		return $added; 
	}
	
	public function removeType($type) {
		$type = ''.$type; 
		$thistemp = explode(',',$this->types); 
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
		
		$this->types = implode(',',$thistemp); 
	}
	
	public function save() {
		$id = $this->id; 
		$name = $this->name; 
		$desc = encodebrackets($this->desc); 
		$date = now(); 
		$cover = $this->cover; 
		$type = $this->types; 
		$status = $this->status;
		$page = $this->page; 
		
		if($id==0) {
			try {
				mysqli_query($this->dblink,"INSERT INTO projects (projname,projdesc,datetime,cover,type,status,page) VALUES ('$name','$desc','$date','$cover','$type','$status','$page')"); 
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			$result = mysqli_query($this->dblink,"SELECT * FROM projects WHERE projname='$name' AND datetime='$date' AND cover='$cover' AND type='$type' AND status='$status' AND page='$page'"); 
			while($row=mysqli_fetch_array($result)) {
				$this->instantiate($row['id']); 
			}
		} else {
			try {
				mysqli_query($this->dblink,"UPDATE projects SET projname='$name', projdesc='$desc', datetime='$date', cover='$cover', type='$type', status='$status', page='$page' WHERE id='$id'"); 
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
	
	public function clear() {
		$this->id = 0; 
		$this->name = ''; 
		$this->datetime = now(); 
		$this->cover = ''; 
		$this->types = ''; 
	}
	
	protected function getLink() {
		return $this->dblink; 
	}
	
	public function showCover() {
		include_once("model.Image.php"); 
		$i = new Image($this->dblink); 
		$i->instantiate($this->cover);
		return '<li class="mix '.$this->splitTypes().'" data-cat="1"><div><a href="'.(($this->page=="portfolio") ? 'project' : 'blog').'?v='.$this->name.'" class="cover" id="'.$this->name.'" style="background-image:url(\''.$_SESSION['DESpath'].'_views/_imgs/_uploads/'.$i->getName().'\'); "><div class="covertext" id="'.$this->name.'">'.strtoupper($this->name).'</div></a></a>';  
		// return '<img src="_views/_imgs/_uploads/'.$i->getName().'" class="cover"><div id="covertext">'.$this->name.'</div>'; 
	}
	
	public function show() { 
		if($this->page=="blog") {
			$i = new Image($this->dblink); 
			$i->instantiate($this->cover); 
			$cover = $i->getName(); 
			$show = '<div class="entrycover" style="background-image:url(_views/_imgs/_uploads/'.$cover.');"></div>'; 
			$show .= '<div class="middle entry"><content class="markdown">'; 
			$show .= '<h1>'.ucfirst($this->name).'</h1>'; 
			$show .= '<span class="datetime">by Samuel Acu&ntilde;a, '.date('M jS, Y',strtotime($this->datetime)).'</span>';
			$show .= '<div class="entrytext">'.htmlspecialchars(decodequotes($this->desc)).'</div></content>'; 
			$show .= '</div>'; 
		} else {
			$imgs = $this->getProjectImages();
			$show = '<div class="middle"><content class="markdown">'; 
			$show .= '<h1>'.ucfirst($this->name).'</h1>'; 
			$show .= '<div class="entrytext">'.htmlspecialchars(decodequotes($this->desc)).'</div></content>'; 
			// $show .= '<div class="middle"><content>'; 
			foreach($imgs as $i) {
				$show .= $i->show(); 
			} 
			$show .= '</content></div>'; 
			$show .= '</div>'; 
		} 

		return $show;  
	}
	
	public function getProjectImages() {
		include_once("model.Image.php"); 
		$list = array(); 
		$proj = $this->id; 
		if($proj!=0) {
			$result = mysqli_query($this->dblink,"SELECT * FROM images WHERE project='$proj' ORDER BY id DESC");
			while ($row=mysqli_fetch_array($result)) {
				$img = new Image($this->dblink); 
				$img->instantiate($row['id']); 
				array_push($list,$img); 
			} 
		}
		return $list; 
	}
	
	public function __toString() {
		return $this->id.':'.$this->name.', '.$this->desc.' ('.$this->datetime.')'; 
	}
	
	public function isInstance() {
		return $this->id!=0; 
	}
	
	private function splitTypes() {
		$str = ''; 
		$types = explode(',',$this->types); 
		foreach($types as $key => $val) {
			$str .= 'category_'.$val.' ';  
		}
		return $str; 
	}
}

?>