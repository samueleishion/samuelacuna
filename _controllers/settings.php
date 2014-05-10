<?

/*
 * Descartes PHP Framework
 * 	settings.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Settings config file for site.  
 * 
 */

$sitename = 'samuelacuna'; 	// The name of your company/brand/website
$siteurl = 'http://localhost:8888/'; 	// The domain of your website
$dbhost = 'localhost'; 	// The hosting server of your database
$dbuser = 'root'; 		// The username of your database
$dbpass = 'root'; 		// The password to your database
$dbname = 'samuelacuna'; 	// The database name


// *********************************
// No need to edit beyond this point. 

// $prefix = projectPrefix($sitename); 
// $DESpath;
// $DESlogged; 
// $DESuid; 
// $DESpath 	= $prefix.'path';  
// $DESlogged	= $prefix.'logged'; 
// $DESuid 	= $prefix.'uid'; 

// Connect to database
header("Access-Control-Allow-Origin: ".$siteurl); 
try {
	$dblink = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(); 
} catch (mysqli_sql_exception $e) {
	echo "Database error. Please try again later."; 
}

// Start session
session_start(); 
$_SESSION['DESpath'] 	= '/'.$sitename.'/';  

?>