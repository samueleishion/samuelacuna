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
		$menu = '<li class="curtainOpen" id="addProject">+ Add an entry</li>'; 
		$result = mysqli_query($this->dblink,"SELECT * FROM projects ORDER BY id DESC"); 
		while($row = mysqli_fetch_array($result)) {
			$menu .= '
  <li id="proj'.$row['id'].'">('.(($row['page']=='portfolio') ? 'P' : 'B').') '.$row['projname'].'</li>'; 
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
			$out = '<input type="text" id="newname" value="'.ucfirst($proj->getName()).'"><br>
 <textarea id="newdesc">'.$proj->getDescription().'</textarea>
 <div class="types">'; 
 			$result = mysqli_query($this->dblink,"SELECT * FROM types"); 
			while($row=mysqli_fetch_array($result)) {
				$checked = (stringContains($proj->getTypes(),$row['id'])) ? ' checked="checked"' : ' '; 
				$out .= '<input type="checkbox" name="types[]" value="'.$row['id'].'"'.$checked.'><label for="types[]">'.$row['tagname'].'</label>'; 
			}
 			$out .= '
 </div><br>	
 <input type="hidden" id="project" value="'.$proj->getId().'">
 <input type="button" class="submit" id="editproject" value="Save changes">
 <input type="button" class="submit" id="addimages" value="Add Images">
 <input type="button" class="submit" id="delproject" value="Delete Project">
 <div class="status">
  <input type="hidden" id="status" value="'.$proj->getStatus().'">
  <div class="button" id="slide">
   <div class="submit" id="knob"></div>
  </div>
  <div class="label">private</div>
 </div><br>'; 
		}  
		
		foreach($images as $key => $val) {
			$out .= '<img src="'.$_SESSION['DESpath'].'_views/_imgs/_uploads/'.$images[$key]->getName().'"> <span class="submit" id="imgcover" image="'.$images[$key]->getId().'">cover</span> | <span class="submit" id="delimg" image="'.$images[$key]->getId().'">delete</span>'; 
		}  
		return $out; 
	}
}
?> 