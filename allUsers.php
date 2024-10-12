<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="./css/allUsers.css">
</head>
<body>
    <a href="embloyee.php">Back</a>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
    </table>
    <?php
    include "action.php";
    $query = "SELECT * FROM users";
    $result = $connection->query($query);
    while ($row = $result->fetch_assoc()) {
        echo "<table>
        <tr>
            <td>{$row["fname"]}</td>
            <td>{$row["lname"]}</td>
            <td>{$row["email"]}</td>
            <td><a href='edit.php?id={$row["id"]}'>Edit</a></td>
        </tr>";
    }
    ?>
</body>
</html>
