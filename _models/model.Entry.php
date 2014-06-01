<?

/*
 * Descartes PHP Framework
 * 	model.Entry.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Model - Project object that stores 
 * a blog entry 
 * 
 */
require_once('model.Project.php'); 

class Entry extends Project { 

	private $dblink; 

	public function __construct($dblink) {
		parent::__construct($dblink);  
		$this->dblink = parent::getLink(); 
		//parent::setFilter("blog"); 
		//$this->filter = "blog"; 
	} 
}

?> 