<?php
$result = array();
if (!empty($_GET['s'])) {
    $table = $_GET['s'];
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
    $result = $db->getTableByName($table);
} else {
    $result['error'] = '404';
}
$json_response = json_encode($result);
echo $json_response;