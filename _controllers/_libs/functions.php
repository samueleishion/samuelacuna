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

?>