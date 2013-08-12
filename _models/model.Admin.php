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
		$menu = '<li id="catadd">Add a category</li>'; 
		$result = mysqli_query($this->dblink,"SELECT * FROM projects"); 
		while($row = mysqli_fetch_array($result)) {
			$menu .= '
  <li id="cat'.$row['id'].'">"'.$row['projname'].'</li>'; 
		}
		return $menu;  
	}
	
	public function getProjectToEdit($id) {
		require_once("model.Project.php"); 
		$proj = new Project($this->dblink); 
		$proj->instantiate(clean($id)); 
		$images = $proj->getProjectImages(); 
		$out = ''; 
		foreach($images as $key => $val) {
			$out .= '<img src="'.$_SESSION['DESpath'].'_views/_imgs/_uploads/'.$images[$key]->getName().'"> edit | delete'; 
		}  
		return $out; 
	}
}
?>