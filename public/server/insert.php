<?php
$result = array();
if (isset($_POST['sch'])) {
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
    $school_name = $_POST['sch'];
    $picked = $_POST['picked'];
    $scores = $_POST['score'];
    $passed = $_POST['pass'];
    $result = $db->insertSchool($school_name, $scores, $passed, $picked);

} else {
    $result['post'] = $_POST;
    $result['error'] = '501';
}
$json_response = json_encode($result);
echo $json_response;