<?php 
include 'action.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // print_r($_POST);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $address = $_POST['address'];
  $nationality = $_POST['nationality'];
  $gender = $_POST['gender'];
  $birthDate = $_POST['birthDate'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $jobTitle = $_POST['jobTitle'];
  $joiningDate  = date("Y-m-d") ;
  $checkQuery = "SELECT id FROM embloyees WHERE email=?";
  $prep = $connection -> prepare($checkQuery);
  $prep -> bind_param("s", $email);
  $prep -> execute();
  $prep -> store_result();
  if($prep -> num_rows > 0){
    echo "<script>alert('email already exists!')</script>";
  } else {
    $newUser = "INSERT INTO embloyees(fname, lname, password, address, nationality, gender, birthDate, phone, email, jobTitle, joiningDate)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $prep = $connection -> prepare($newUser);
    $prep -> bind_param("sssssssisss", $fname, $lname, $password, $address, $nationality, $gender, $birthDate, $phone, $email, $jobTitle, $joiningDate);
    if($prep -> execute()){
      echo "<script>alert('Embloyee created!')</script>";
      header("Location:login.php");
    } else{
      echo "error";
      echo "<script>alert('error')</script>";
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
  <title>Embloyee register</title>
</head>
<body>
    <form method="post" action="embloyeeRegister.php">
        <h1>Create a new embloyee</h1>
        <label>First Name</label>
        <input type="text" name="fname"><br>
        <label>Last Name</label>
        <input type="text" name="lname"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <label>Address</label>
        <input type="text" name="address"><br>
        <label for="nationality">Nationality</label>
        <input type="text" name="nationality">
        <label for="gender">Gender</label>
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>
        <label>Birth Date</label>
        <input type="date" name="birthDate"><br>
        <label>Phone</label>
        <input type="text" name="phone"><br>
        <label>Email</label>
        <input type="email" name="email"><br>
        <label>Job title</label>
        <input type="text" name="jobTitle"><br>
        <input type="submit" value="Create user"><br>
    </form>

</body>
</html>
