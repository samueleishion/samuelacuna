<?

require_once('settings.php'); 
require_once('../_views/_incs/fs.php'); 

if(isset($_POST) || isset($_REQUEST)) {
	$action = (isset($_REQUEST)) ? clean($_REQUEST['action']) : clean($_POST['action']); 
	switch($action) {
		case 'login': 
			$_SESSION['DESlogged']=1; 
			break; 
		case 'logout':
			$_SESSION['DESlogged']=0; 
			break; 
		default:
			break; 
	}
} 

?>