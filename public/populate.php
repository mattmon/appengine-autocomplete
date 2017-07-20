<?php

require_once('../vendor/autoload.php');

$obj_schema = new Demo\ProductSchema();
$obj_index = new \Search\Index('products');

// Clear out old data
/*
$x = 0;
while($x <= 100) {
    $obj_response = $obj_index->search((new \Search\Query())->limit(200));
    $arr_ids = [];
    foreach($obj_response->results as $obj_result) {
        $arr_ids[] = $obj_result->doc->getId();
    }
    echo "Deleting " . count($arr_ids) . "<br />";
    $obj_index->delete($arr_ids);
    $x++;
} 
*/




// Can create ~15k documents before timeout occurs
// Load and process file
$arr_products = json_decode(file_get_contents('../resources/products.json'));
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
        echo "Inserting batch of " . count($arr_product_docs) . "<br/>";
        $obj_index->put($arr_product_docs);
        $arr_product_docs = [];
    }
}

// Insert last batch
if(count($arr_product_docs) >= 1) {
    echo "Inserting batch of " . count($arr_product_docs) . "<br/>";
    $obj_index->put($arr_product_docs);
    $arr_product_docs = [];
}

