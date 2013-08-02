<?

header("Access-Control-Allow-Origin: http://localhost:8888/"); 

// connect to database
$dbhost = 'localhost'; 
$dbuser = 'root';
$dbpass = 'root'; 
$dbtabl = 'Descartes'; 

// create database if it doens't exist
$dblink = mysqli_connect($dbhost,$dbuser,$dbpass); 
mysqli_query($dblink,"CREATE DATABASE IF NOT EXISTS $dbname;"); 
$dblink = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); 

// start session
session_start(); 

?>