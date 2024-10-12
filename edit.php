<?php 
function add_param($name, &$query, &$places, &$params){
    $query .="{$name}=?, ";
    if($name == 'phone' && $name == 'curBalance')
        $places .= "i";
    else
        $places .= "s";
    $params[] = $_POST[$name];
}

function updateQuery($connection, $query, $places, $params){
    $prep = $connection -> prepare($query);
    $prep -> bind_param($places, ...$params);
    if($prep -> execute()){
        header("Location:allUsers.php");
    } else {
        echo "Error";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "action.php";
    $id = $_POST['id'];
    $query = "UPDATE users SET ";
    $elems = array_slice($_POST, 1);
    $params = [];
    $places = "";
    foreach ($elems as $k => $v) {
        if($k != 'submit'){
        add_param($k, $query, $places, $params);
        }
    }
    $query = substr($query, 0, -2); 
    $query .= " WHERE id=?";
    $places .= "i"; 
    $params[] = $id;
    updateQuery($connection, $query, $places, $params);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Edit</title>
</head>
<body>
<?php 
include "action.php";
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = "SELECT * FROM users WHERE id=?";
  $prep = $connection -> prepare($query);
  $prep -> bind_param("i", $id);
  $prep -> execute();
  $result = $prep -> get_result();
  if($result -> num_rows > 0){
    $row = $result -> fetch_assoc();
    echo '<form action="edit.php" method="post">';
    echo '<input type="hidden" name="id" value="' .$id. '">';
    foreach ($row as $k => $v) {
        if($k == 'id' || $k == 'password' || $k == 'transactionHistory') 
            continue;
        echo '<div><label for="'. $k .'">'. $k .' </label>';
        echo '<input type="text" placeholder="' .$k . '" name="' .$k . '" value="'. $v . '"><br>';
        echo '</div>';
        echo "<br>";
    }
    }
    echo '<div>
            <input type="submit" name="submit" value="Submit"></input>
          </div>
';
    echo "</form>";
  } else {
    echo "Error 404";
  }
?>
</body>
</html>