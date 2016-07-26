<?

/*
 * Descartes PHP Framework
 * 	controller.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Model builder and view selector.   
 * 
 */

require_once('api.php'); 
require_once('settings.php'); 

class Controller extends API {

	private $dblink; 

	public function __construct($dblink, $route) {

		$this->dblink = $dblink; 
		$this->request = new Request(); 
		$this->response = new Response(); 
		
		$this->parseRequest($route); 
		echo $this->response->getJSON(); 
	}

	private function manager($route) {
		$R = array(); 

		switch($route['view']) {
			case 'projects': 
				include_once('_models/model.Project.php'); 
				$R= array(); 
				$result = mysqli_query($this->dblink,"SELECT id FROM projects WHERE status='1' AND page='portfolio' ORDER BY id DESC"); 
				while($row=mysqli_fetch_array($result)) {
					$proj = new Project($this->dblink); 
					$proj->instantiate($row['id']); 
					array_push($R,$proj->__toJSON()); 
				}

				$this->response->setStatus(Response::$STATUS['ok']); 
				$this->response->setMessage("API.getAllProjects OK");
				$this->response->setData($R); 
				break; 
			case 'project': 
				$R = array(); 
				if(array_key_exists('page', $route) && $route['page']!="") {
					include_once('_models/model.Project.php'); 
					$R = array(); 
					$p = clean($route['page']); 
					$result = mysqli_query($this->dblink,"SELECT id FROM projects WHERE id='$p'"); 
					while($row=mysqli_fetch_array($result)) {
						$proj = new Project($this->dblink); 
						$proj->instantiate($row['id']); 
						array_push($R,$proj->__toJSON()); 
					}

					$this->response->setStatus(Response::$STATUS['ok']); 
					$this->response->setMessage("API.getProject(".$route['page'].") OK");
					$this->response->setData($R); 
				} else {
					$this->response->setStatus(Response::$STATUS['bad_request']); 
					$this->response->setMessage("Missing project id");
					$this->response->setData($R); 
				}
				break; 
			default: 
				$this->response->setStatus(Response::$STATUS['not_found']); 
				$this->response->setMessage("Endpoint not found");
				$this->response->setData($R); 
				break; 
		}
	}

	private function parseRequest($route) {
		$this->manager( $this->parseURI($route) ); 
	}

	private function parseURI($uri) {
		$routes = explode("/",$uri); 
		$rndex = 0; 
		$result = array(); 
		$result["other"] = ""; 

		foreach($routes as $route) {
			if($route==""||$route=="htdocs"||$route=="samuelacuna") continue; 
			switch($rndex) {
				case 0:
					$result["view"] = $route; 
					break; 
				case 1:
					$result["page"] = $route; 
					break; 
				default: 
					$result["other"] .= "/".$route; 
					break; 
			}
			$rndex++; 
		}

		return $result; 
	}
}

?>