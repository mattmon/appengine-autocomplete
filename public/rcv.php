<?php

require_once('../vendor/autoload.php');

$obj_schema = new Demo\ProductSchema();
$obj_index = new \Search\Index('products');



$request = file_get_contents('php://input');

header("HTTP/1.0 204 No Content");

$msg = json_decode($request);

$data = base64_decode($msg->message->data);

// Can create ~15k documents before timeout occurs
// Load and process file
$arr_products = json_decode($data);
$arr_product_docs = [];
$obj_tkzr = new \Search\Tokenizer();
foreach($arr_products as $arr_product) {

    // Prepare doc
    $arr_product_docs[] = $obj_schema->createDocument([
        'sku' => $arr_product[0],
        'name' => $arr_product[1],
        'url' => $arr_product[2],
        'name_ngram' => $obj_tkzr->edgeNGram($arr_product[1])
    ]);

    // Insert batch
    if(count($arr_product_docs) >= 100) {
        //echo "Inserting batch of " . count($arr_product_docs) . "<br/>";
        $obj_index->put($arr_product_docs);
        $arr_product_docs = [];
    }
}

// Insert last batch
if(count($arr_product_docs) >= 1) {
    //echo "Inserting batch of " . count($arr_product_docs) . "<br/>";
    $obj_index->put($arr_product_docs);
    $arr_product_docs = [];
}

