<?php 
include 'action.php';

if($_SESSION['role'] != "embloyee")
  header("Location:login.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // print_r($_POST);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $address = $_POST['address'];
  $nationality = $_POST['nationality'];
  $gender = $_POST['gender'];
  $birthDate = $_POST['birthDate'];
  $phone = $_POST['phone'];
  $curBalance = $_POST['balance'];
  $transactionHistory = "account created: ". date("Y-m-d");
  $checkQuery = "SELECT id FROM users WHERE email=?";
  $prep = $connection -> prepare($checkQuery);
  $prep -> bind_param("s", $email);
  $prep -> execute();
  $prep -> store_result();
  if($prep -> num_rows > 0){
    echo "<script>alert('email already used!')</script>";
  } else {
    $newUser = "INSERT INTO users(fname, lname, email, password, address, nationality, gender, birthDate, phone, curBalance, transactionHistory)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $prep = $connection -> prepare($newUser);
    $prep -> bind_param("ssssssssiis", $fname, $lname, $email, $password, $address, $nationality, $gender, $birthDate, $phone, $curBalance, $transactionHistory);
    if($prep -> execute()){
      echo "<script>alert('User created!')</script>";
    } else{
      echo "error";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Embloyee dashboard</title>
</head>
<body>
  <a class="logout-button" href="logout.php">Logout</a>
  <form method="post" action="embloyee.php">
        <h1>Create a new user</h1>
        <label>First Name</label>
        <input type="text" name="fname"><br>
        <label>Last Name</label>
        <input type="text" name="lname"><br>
        <label>Email</label>
        <input type="email" name="email"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <label>Address</label>
        <input type="text" name="address"><br>
        <label for="nationality">Nationality</label>
        <input type="text" name="nationality">
        <label>Birth Date</label>
        <input type="date" name="birthDate"><br>
        <label for="gender">Gender</label>
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>
        <label for="phone">Phone</label>
        <input type="text" name="phone"><br>
        <label for="balance">initial balance</label>
        <input type="text" name="balance" value="0">
        <input type="submit" value="Create user"><br>
    </form>
  <a class="logout-button" href="allUsers.php">All users</a>
</body>
</html>
