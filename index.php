<?php 
include "action.php";
if(isset($_SESSION['role'])){
  header("Location: {$_SESSION['role']}.php");
} else {
  header("Location: login.php");
}
?>
