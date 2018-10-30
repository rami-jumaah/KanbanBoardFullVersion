<?php
session_start();
require_once ('../src/config.php');
require_once ('../src/DBsource.php');
$DBsource = new DBsource($config);
/**
 * Created by IntelliJ IDEA.
 * User: rami
 * Date: 30.10.18
 * Time: 4:50 PM
 */

if (isset($_SESSION["t_users_name"])){
    $data = json_decode(file_get_contents('php://input'), true);

    // TODO validate $data['content'] and $data['state']
    // TODO user id isnstead of content
    $sql = 'DELETE FROM T_tasks WHERE t_tasks_content = "' . $DBsource->escapeString($data['content']) . '"';
    $DBsource->dbQuery($sql);
    if ($data['state'] !== 'delete') {
        echo 'Hello ' . htmlspecialchars($data['content']) . '!' . $_SESSION["t_users_name"];
        $sql = 'INSERT INTO T_tasks SET t_tasks_content = "' . $DBsource->escapeString($data['content']) . '", t_buckets_name = "'
            . $DBsource->escapeString($data['state']) .'", fk_tasks_users = "' . $DBsource->escapeString($_SESSION["t_users_id"]) .'"';
        $DBsource->dbQuery($sql);
    }


}
