<?php
$result = array();
if (!empty($_GET['s'])) {
    $sn = $_GET['s'];

    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
    $result = $db->getScoresByNumber($sn);
} else {
    $result['error'] = '404';
}
$json_response = json_encode($result);
echo $json_response;