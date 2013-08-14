<?

require_once('_libs/functions.php'); 
require_once('settings.php'); 

if(isset($_POST) || isset($_REQUEST)) {
	$action = (isset($_REQUEST)) ? clean($_REQUEST['action']) : clean($_POST['action']);
	switch($action) {
		case 'login':
			require_once('../_models/model.Admin.php'); 
			$uname = clean($_POST['uname']); 
			$pword = clean($_POST['pword']); 
			$admin = new Admin($dblink); 
			$admin->instantiate($uname,$pword); 
			if($admin->login()) echo 'success'; 
			else echo 'failure';  
			break; 
		case 'logout':
			require_once('../_models/model.Admin.php'); 
			$admin = new Admin($dblink); 
			$admin->instantiateById($_SESSION['DESuid']); 
			$admin->logout(); 
			break; 
		case 'loadproject':
			require_once('../_models/model.Admin.php'); 
			$admin = new Admin($dblink); 
			$project = clean($_POST['project']); 
			$admin->instantiateById($_SESSION['DESuid']);  
			echo $admin->getProjectToEdit($project); 
			break; 
		case 'addproject': 
			require_once('../_models/model.Project.php'); 
			$proj = new Project($dblink); 
			$name = strtolower(clean($_POST['name'])); 
			if(!projectNameRepeat($dblink,$name)) {
				$desc = clean($_POST['desc']); 
				$time = now(); 
				$proj->setName($name); 
				$proj->setDescription($desc); 
				$proj->setDate($time);
				$proj->setCover(1); 
				if($proj->save()) echo 'success';
				else echo 'failure';
			} else echo 'get a new name';  
			break; 
		case 'delproject':   
			require_once('../_models/model.Project.php'); 
			$proj = new Project($dblink); 
			$id = clean($_POST['project']); 
			$proj->instantiate($id); 
			if($proj->delete()) echo 'deleted';
			else echo 'still active';  
			break; 
		default:
			break; 
	} 
}

?>