<?php 
include 'action.php';

if($_SESSION['role'] != "user")
  header("Location:login.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $data = $connection -> query("SELECT curBalance, transactionHistory FROM users WHERE id=" . $_SESSION['id']) -> fetch_assoc();
  $curBalance = $data['curBalance'];
  $curHistory = $data['transactionHistory'];
  $curBalance += $_POST['amount'];
$curHistory = $curHistory . "<br>Deposit {$_POST['amount']}$: " . date("Y-m-d h:ia");
  if($connection -> query("UPDATE users SET curBalance={$curBalance}, transactionHistory='{$curHistory}' WHERE id={$_SESSION['id']}"));
    echo "<script>alert('Deposit successful')</script>";
}

$query = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$userData = $connection -> query($query) -> fetch_assoc();
$acNo = $userData['id'];
unset($userData['id']);
$userData['account number'] = $acNo;
echo "<h1>Welcome {$userData['fname']} {$userData['lname']}</h1>";
foreach ($userData as $k => $v) {
  if($k == 'password' || $k == 'fname' || $k == 'lname')
    continue;
  echo "<h4>{$k}: {$v}</h6>"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/user.css">
  <title>User page</title>
</head>
<body>
  <form action="user.php" method="post">
    <label for="amount">Deposit: </label>
    <input type="text" name="amount" placeholder="Amount to deposit">
    <input type="submit" value="Deposit">
  </form>
  <a class="logout-button" href="logout.php">Logout</a>
</body>
</html>


