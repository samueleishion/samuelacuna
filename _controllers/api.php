<?

/*
 * 
 * 	api.php
 * 
 * @author: Samuel Acuna
 * @date: 07/2016
 * 
 * API Requests and Responses manager
 * 
 */

class API {
	private $request;
	private $response; 
	private $action; 
	private $map;  

	public function __construct() {

		// add mapping requests and methods 
		$this->map = array(
			'loadDOM' => 'loadDOM'
		); 

		$this->request = new Request(); 
		$this->response = new Response(); 

		$this->parseRequest(); 
		echo $this->response->getJSON(); 

	}

	// -------------------------
	// 	API metods here vvvvvv

	private function loadDOM() {
		
		$page = $this->request->get('page'); 

		$this->response->setStatus(Response::$STATUS['ok']); 
		$this->response->setMessage("API.loadDOM OK"); 
		$this->response->setData($R); 
	}

	// 	API methods here ^^^^^
	// -------------------------

	private function response_error() {
		$this->response->setStatus(Response::$STATUS['bad_request']); 
		$this->response->setMessage("There was an error while processing your request. Please try again later."); 
		$this->response->setData(""); 
	}

	private function parseRequest() {
		
		$this->action = $this->request->get("action"); 

		if($this->action==null || !array_key_exists($this->action, $this->map)) {
			$this->response_error(); 
			return; 
		} else {
			$method = $this->map[$this->action]; 
			$this->$method(); 
		}

	}

}

class Request {

	private $request; 

	public function __construct() {

		if(isset($_REQUEST)) $this->request = $_REQUEST; 
		elseif(isset($_POST)) $this->request = $_POST; 
		elseif(isset($_GET)) $this->request = $_GET;
		else $this->request = null; 

	}

	public function get($property) {
		if(array_key_exists($property, $this->request)) 
			return $this->clean( $this->request[$property] ); 
		return null; 
	}

	private function clean($str) {
		return htmlentities(stripslashes($str)); 
	}
}

class Response {

	private $response; 

	public static $STATUS = array(
		'ok' => 200, 
		'bad_request' => 400, 
		'unauthorized' => 401, 
		'forbidden' => 403, 
		'not_found' => 404, 
		'error' => 500, 
		'unavailable' => 503 
	); 

	public function __construct() {

		$this->response = array(
			'status' => '', 
			'message' => '', 
			'data' => ''
		); 
	}

	public function setStatus($status) {
		$this->response['status'] = $status; 
	}

	public function setMessage($message) {
		$this->response['message'] = $message; 
	}

	public function setData($data) {
		$this->response['data'] = $data; 
	}

	public function getJSON() {
		return json_encode($this->response); 
	} 
}

?>
