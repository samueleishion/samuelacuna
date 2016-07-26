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

class Controller extends API {

	public function __construct($route) {

		$this->request = new Request(); 
		$this->response = new Response(); 
		
		$this->parseRequest($route); 
		echo $this->response->getJSON(); 
	}

	private function manager($route) {
		$R = array(); 

		switch($route['view']) {
			case 'projects': 
				$R['data'] = 'data'; 

				$this->response->setStatus(Response::$STATUS['ok']); 
				$this->response->setMessage("API.getAllProjects OK");
				$this->response->setData($R); 
				break; 
			case 'project': 
				$R = array(); 
				if(array_key_exists('page', $route) && $route['page']!="") {
					$R['data'] = 'data'; 

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