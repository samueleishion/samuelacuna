<?

function clean($str) { return htmlentities(stripslashes($str)); }
function cleanView($str) { return strtolower(clean($str)); }
function encode($str) { return hash('ripemd160',$str); } 
function now() { return date('Y\/m\/d H\:i\:s'); }

?>