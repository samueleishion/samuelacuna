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
		default:
			break; 
	} 
}

?>