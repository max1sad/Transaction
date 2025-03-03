<?php
include_once('db.php');
include_once('model.php');

$user_id = isset($_GET['user'])
    ? (int)$_GET['user']
    : null;

if ($user_id) {
    $conn = get_connect();
    // Get transactions balances
    //echo  "SADASD";
    $transactions = get_user_transactions_balances($user_id, $conn);
    $result = '';
    foreach ($transactions as $tr) {
        $result .= '<tr>
                        <td>'.$tr['month'].'</td>
                        <td>'.$tr['summ'].'</td>
                        <td>'.$tr['count_trn'].'</td>
                    </tr>';
    }
    echo $result;
    // TODO: implement
}else{echo  "NO";}
