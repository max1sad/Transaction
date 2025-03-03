<?php

/**
 * Return list of users.
 */
function get_users($conn)
{
    // TODO: implement

    $sql = 'SELECT DISTINCT users.id, name FROM 
    users JOIN user_accounts ON users.id = user_accounts.user_id JOIN transactions
    ON user_accounts.id = transactions.account_from OR user_accounts.id = transactions.account_to';
    $result = $conn->query($sql);
    while ($row = $result->fetchAll()) {
        $arr_resl[] = $row;
    }
    return $arr_resl[0];
}

/**
 * Return transactions balances of given user.
 */
function get_user_transactions_balances($user_id, $conn)
{
    // TODO: implement
    $sql = 'WITH account_from as (
        SELECT  
        strftime(\'%Y-%m\', trdate) as month, amount, account_from, account_to from 
        users JOIN user_accounts ON users.id = user_accounts.user_id 
        JOIN transactions on user_accounts.id = transactions.account_from
            where users.id = '.$user_id.'
        ),
        account_to as (
        SELECT 
        strftime(\'%Y-%m\', trdate) as month, amount, account_from, account_to from 
        users JOIN user_accounts ON users.id = user_accounts.user_id 
        JOIN transactions on user_accounts.id = transactions.account_to
            where users.id = '.$user_id.'
        ),
        user_accounts_id as (
            SELECT user_accounts.id FROM 
            users JOIN user_accounts ON users.id = user_accounts.user_id 
            where users.id = '.$user_id.'
        )
        SELECT 
        sum(
            case when account_from.account_to not in (SELECT * FROM user_accounts_id) 
            then amount else 0 END) - 
        (select sum(
            case when account_to.account_from not in (SELECT * FROM user_accounts_id)
            then amount else 0 END
        ) from account_to GROUP BY month)  as "summ", month, 
        count(*) + (select count(*) from account_to GROUP BY month) as count_trn
        FROM account_from 
        GROUP BY month';
    $result = $conn->query($sql);
    while ($row = $result->fetchAll()) {
        $arr_resl[] = $row;
    }
    return $arr_resl[0];
    
}
