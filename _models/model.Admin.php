<?

/*
 * Descartes PHP Framework
 * 	model.User.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Model - User object that holds
 * information of logged users. 
 * 
 */

require_once('model.User.php'); 
 
class Admin extends User {
	
	private $dblink; 
	
	public function __construct($dblink) {
		parent::__construct($dblink);  
		$this->dblink = parent::getLink(); 
	}
	
	public function getMenu() {
		$menu = '<li class="curtainOpen" id="addProject">Add a project</li>'; 
		$result = mysqli_query($this->dblink,"SELECT * FROM projects"); 
		while($row = mysqli_fetch_array($result)) {
			$menu .= '
  <li id="proj'.$row['id'].'">'.$row['projname'].'</li>'; 
		}
		return $menu;  
	}
	
	public function getProjectToEdit($id) {
		require_once("model.Project.php"); 
		$proj = new Project($this->dblink); 
		$proj->instantiate(clean($id)); 
		$images = $proj->getProjectImages();  
		$out = ''; 
		 
		if($proj->isInstance()) { 
			$out = '<input type="text" value="'.ucfirst($proj->getName()).'"><br>
 <textarea>'.$proj->getDescription().'</textarea><br>
 <input type="hidden" id="project" value="'.$proj->getId().'">
 <input type="button" class="submit" id="addimages" value="Add Images">
 <input type="button" class="submit" id="delproject" value="Delete Project"><br>'; 
		}  
		
		foreach($images as $key => $val) {
			$out .= '<img src="'.$_SESSION['DESpath'].'_views/_imgs/_uploads/'.$images[$key]->getName().'"> edit | delete'; 
		}  
		return $out; 
	}
}
?> 