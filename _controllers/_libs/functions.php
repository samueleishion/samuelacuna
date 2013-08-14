<?

/*
 * Descartes PHP Framework
 * 	functions.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Library containing standard functions.   
 * 
 */
 
$test = 'scope'; 

function clean($str) { return htmlentities(stripslashes($str)); }
function cleanView($str) { return strtolower(clean($str)); }
function encode($str) { return hash('ripemd160',$str); } 
function now() { return date('Y\/m\/d H\:i\:s'); }
function projectPrefix($str) { return substr(strtoupper($str),0,3); }

function getAllProjects($dblink) {
	$list = array(); 
	$result = mysqli_query($dblink,"SELECT id FROM projects ORDER BY id DESC"); 
	while($row=mysqli_fetch_array($result)) {
		array_push($list,$row['id']); 
	}
	return $list; 
}

function projectNameRepeat($dblink,$name) {
	$result = mysqli_query($dblink,"SELECT id FROM projects WHERE projname='$name'"); 
	if(mysqli_num_rows($result)>0) return true; 
	return false; 
}

?>