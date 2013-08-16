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
				$desc = encodequotes($_POST['desc']); 
				$time = now(); 
				$proj->setName($name); 
				$proj->setDescription($desc); 
				$proj->setDate($time);
				$proj->setCover(1); 
				$proj->setStatus(0); 
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
		case 'editproject':
			require_once('../_models/model.Project.php'); 
			$proj = new Project($dblink); 
			$id = clean($_POST['project']); 
			$newname = clean($_POST['newname']); 
			$newdesc = encodequotes($_POST['newdesc']); 
			$types = $_POST['types']; 
			$proj->instantiate($id); 
			$proj->setName($newname); 
			$proj->setDescription($newdesc);
			$proj->setTypes(''); 
			foreach($types as $key => $t) {
				$t = clean($t); 
				$proj->addType($t);    
			}
			if($proj->save()) echo 'changed successfully'; 
			else echo 'failure';  
			break; 
		case 'upload': 
			require_once('../_models/model.Image.php'); 
			$succeed = 0; 
			$error = 0; 
			$result = 0; 
			foreach($_FILES['file']['error'] as $key => $val) {
				if($val==UPLOAD_ERR_OK) {
					$img = new Image($dblink);
					$rand = encode(rand(0,1000000));  
					$name = $rand.clean($_FILES['file']['name'][$key]); 
					$img->setName($name); 
					$img->setDate(now()); 
					$img->setProject(clean($_REQUEST['project']));
					copy($_FILES['file']['tmp_name'][$key],'../_views/_imgs/_uploads/'.$name); 
					$img->save(); 
					$size = filesize($_FILES['file']['tmp_name'][$key]); 
					$result .= '<br>File '.$succeed.' - '.$name;
					$succeed++;  
				} else {
					$result .= '<br>Image #'.$key.' failed to upload.'; 
					$error++; 
				}
			}
			
			echo '<br>'.$succeed.' files were uploaded successfully!'; 
			if($error>0) {
				// $plural = ; 
				echo '<br>Unfortunately, '.$error.' file'.($error>1) ? 's ' : ' '.'were not uploaded. =('; 
			} 
			echo $result; 
			break; 
		case 'imgcover':
			require_once('../_models/model.Project.php'); 
			$id = clean($_POST['project']); 
			$img = clean($_POST['image']); 
			$proj = new Project($dblink); 
			$proj->instantiate($id); 
			$proj->setCover($img); 
			if($proj->save()) echo 'cover changed';
			else echo 'failure';   
			break;  
		case 'delimg':
			require_once('../_models/model.Image.php'); 
			require_once('../_models/model.Project.php'); 
			$projectid = clean($_POST['project']); 
			$imageid = clean($_POST['image']); 
			$proj = new Project($dblink); 
			$proj->instantiate($projectid); 
			if($proj->getCover()==$imageid) {
				$proj->setCover(1); 
				$proj->save(); 
			} 
			$proj->clear(); 
			$image = new Image($dblink); 
			$image->instantiate($imageid); 
			if($image->delete()) echo 'image deleted successfully'; 
			else echo 'failure';   
			break; 
		case 'projectstatus':
			require_once('../_models/model.Project.php'); 
			$id = clean($_POST['project']); 
			$status = clean($_POST['status']); 
			$proj = new Project($dblink); 
			$proj->instantiate($id); 
			$proj->setStatus($status); 
			if($proj->save()) echo 'successfully changed status'; 
			else echo 'failure'; 
			break; 
		default:
			break; 
	} 
}

?>