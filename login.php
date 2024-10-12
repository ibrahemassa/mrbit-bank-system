<?php 
include "action.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if($_POST['role'] == 'embloyee')
    $check = "SELECT id, password FROM embloyees WHERE email=?";
  else 
    $check = "SELECT id, password FROM users WHERE email=?";
  $prep = $connection -> prepare($check);
  $prep -> bind_param('s', $email);
  $prep -> execute();
  $prep -> store_result();
  if($prep -> num_rows > 0){
    $prep -> bind_result($id, $hashedPassword);
    $prep -> fetch();
    if(password_verify($password, $hashedPassword)){
      $_SESSION['id'] = $id;
      $_SESSION['role'] = $_POST['role'];
      if($_POST['role'] == 'embloyee')
          header("Location:embloyee.php");
      else
          header("Location:user.php");
    } else {
      echo "<script>alert('Invalid email or password');</script>";
    }
  } else{
      echo "<script>alert('Invalid email or password');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Login</title>
</head>
<body>
  <form method='post' action='login.php'>
    <label for="email">Email</label><br>
    <input type="email" name="email">
    <label for="password">Password</label><br>
    <input type="password" name="password">
    <div class="radio-buttons">
      <input type="radio" id="embloyee" name="role" value="embloyee">
      <label for="embloyee">Embloyee</label>
      <input type="radio" id="user" name="role" value="user">
      <label for="user">User</label>
    </div>


    <input type="submit" value="Login">
  </form>
</body>
</html>
