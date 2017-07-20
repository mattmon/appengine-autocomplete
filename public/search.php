<?php
require_once('../vendor/autoload.php');
$obj_index = new \Search\Index('products');

$str_query = '';
if(isset($_GET['q'])) {
    $str_query = $_GET['q'];
} elseif (isset($_POST['q'])) {
    $str_query = $_POST['q'];
}

$obj_response = $obj_index->search((new \Search\Query($str_query))->limit(200));

$arr_docs = [];
foreach($obj_response->results as $obj_result) {
    $arr_docs[] = [
        'name' => htmlspecialchars($obj_result->doc->name)
    ];
}

header('Content-Type: application/json');
echo json_encode($arr_docs);