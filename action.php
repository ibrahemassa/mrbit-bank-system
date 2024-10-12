<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$sname = "localhost";
$uname = "root";
$passwd = "";
$dbname = "bitBankdb";

$connection = new mysqli($sname, $uname, $passwd, $dbname);
if ($connection->connect_error) {
    die($connection->connect_error);
}

// $db = "CREATE DATABASE {$dbname}";
$embloyees = "CREATE TABLE embloyees(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  fname VARCHAR(255) NOT NULL,
  lname VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  nationality VARCHAR(255) NOT NULL,
  gender VARCHAR(255) NOT NULL,
  birthDate VARCHAR(255) NOT NULL,
  phone INT(12) NOT NULL,
  email VARCHAR(255) NOT NULL,
  jobTitle VARCHAR(255) NOT NULL,
  joiningDate VARCHAR(255) NOT NULL
)";

$users = "CREATE TABLE users(
  accountNumber INT(11) PRIMARY KEY AUTO_INCREMENT,
  fname VARCHAR(255) NOT NULL,
  lname VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  nationality VARCHAR(255) NOT NULL,
  gender VARCHAR(255) NOT NULL,
  birthDate VARCHAR(255) NOT NULL,
  phone INT(12) NOT NULL,
  curBalance INT(11) NOT NULL,
  transactionHistory VARCHAR(255) NOT NULL
)";
// if($connection -> query($users)){
//   echo 'good';
// } else {
//   echo 'no';
// }
?>
