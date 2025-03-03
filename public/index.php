<?php

include_once('db.php');
include_once('model.php');
include_once('test.php');

$conn = get_connect();
/*$users = get_users($conn);
var_dump($users);
foreach ($users as $user) {
    echo $user['id'].' name '.$user['name'].'  ';
}*/
// Uncomment to see data in db
//run_db_test($conn);

$month_names = [
    '01' => 'January',
    '02' => 'Februarry',
    '03' => 'March'
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User transactions information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>User transactions information</h1>
<form action="data.php" method="get" id="user_form">
    <label for="user">Select user:</label>
    <select name="user" id="user">
        <?php
        $users = get_users($conn);
        foreach ($users as $user) {
            echo "<option value=\"".$user["id"]."\">".$user["name"]."</option>";
        }
        ?>
    </select>
    <input id="submit" type="submit" value="Show">
</form>

<div id="data">
    <h2 id="h2_head">Transactions of `User name`</h2>
    <table>
        <tr><th>Mounth</th><th>Amount</th><th>Count</th></tr>
        <tbody id="body_data"></tbody>
    </table>
</div>
<script src="script.js"></script>
</body>
</html>
