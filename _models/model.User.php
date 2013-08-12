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

class User {
	
	private $dblink; 
	private $id; 
	private $uname;
	private $pword;  
	private $type; 
	
	public function __construct($dblink) {
		$this->dblink = $dblink; 
		$this->clear(); 
	}
	
	public function instantiate($id) {
		$id = clean($id); 
		$result = mysqli_query($this->dblink,"SELECT * FROM users WHERE id='$id'"); 
		if(mysqli_num_rows($result)==1) {
			while($row=mysqli_fetch_array($result)) {
				$this->setId($row['id']); 
				$this->setName($row['uname']); 
				$this->setType($row['type']); 
			}
		}
	}
	
	public function getId() { return $this->id; } 
	public function getUname() { return $this->uname; } 
	public function getType() { return $this->type; } 
	
	private function setId($int) { $this->id = clean($id); }
	public function setUname($str) { $this->uname = clean($str); } 
	public function setPassword($str) { $this->pword = encode(clean($str)); }  
	public function setType($str) { $this->type = clean($str); }  
	
	public function save() {
		$id = $this->id; 
		$uname = $this->uname; 
		$pword = $this->pword; 
		$type = $this->type; 
		
		if($id==0) {
			try {
				mysqli_query($this->dblink,"INSERT INTO users (uname,pword,type) VALUES ('$uname','$pword','$type')"); 
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
			$result = mysqli_query($this->dblink,"SELECT * FROM users WHERE uname='$uname' AND pword='$pword' AND type='$type'");
			while($row=mysqli_fetch_array($result)) {
				$this->login($row['id']); 
			} 
		} else {
			try {
				mysqli_query($this->dblink,"UPDATE users SET uname='$uname' AND pword='$pword' AND type='$type'"); 
			} catch(mysqli_sql_exception $e) {
				return false; 
			}
		}
		
		return true; 
	} 
	
	public function login($uname,$pword) {
		$pword = encode(clean($pword)); 
		$uname = clean($uname);  
		try {
			$result = mysqli_query($this->dblink,"SELECT * FROM users");  
			while($row = mysqli_fetch_array($result)) {
				if($uname==$row['uname'] && $pword==$row['pword']) {
					$this->instantiate($row['id;']); 
					$_SESSION[$DESlogged] = true; 
					$_SESSION[$DESuid] = $row['id'];  
				}
			}
		} catch(mysqli_sql_exception $e) {
			return false; 
		}
		
		return true; 
	} 
	
	public function logout() {
		session_unset(); 
		session_destroy(); 
		$this->clear(); 
	}
	
	public function clear() {
		$this->setId(0);   
		$this->setUname(''); 
		$this->setPword(''); 
		$this->setType(0); 
	}
}

?>