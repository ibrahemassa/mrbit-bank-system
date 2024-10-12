<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  session_start();
  $_SESSION['id'] = $_POST['name'];
  $_SESSION['role'] = 'user';
  header("Location:user.php");
}
?>

<form method='post' action='test.php'>
  <input type="text" name="name">
  <label for="name">Name</label>
  <input type="submit" value="submit">

</form>
