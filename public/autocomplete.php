<?php

require_once('../vendor/autoload.php');

$memcache = new Memcache;

$obj_index = new \Search\Index('products');

//get user query
$str_query = '';
if(isset($_GET['q'])) {
    $str_query = $_GET['q'];
} elseif (isset($_POST['q'])) {
    $str_query = $_POST['q'];
}

//check cache for query string
$cache_hit = $memcache->get($str_query);

header('Content-Type: application/json');

if ($cache_hit) {
	//hit, send the cached results
	echo $cache_hit;
} else {
	//miss, continue with search
	$obj_response = $obj_index->search((new \Search\Query('name_ngram:'.$str_query))->limit(10));

	$arr_docs = [];
	foreach($obj_response->results as $obj_result) {
    	$arr_docs[] = [
        	'name' => htmlspecialchars($obj_result->doc->name),
        	'url' => htmlspecialchars($obj_result->doc->url)
    	];
	}
	$json_out = json_encode($arr_docs);
	//insert query string and search results into cache
	$memcache->set($str_query, $json_out, false, 0);
	//send the search results
	echo $json_out;
}





