<?php

namespace Demo;

/**
 * ProductSchema
 */
class ProductSchema extends \Search\Schema
{
    /**
     * Configure the schema on construction
     */
    public function __construct()
    {
        $this
            ->addText('sku')
            ->addText('name')
            ->addText('name_ngram');
    }
}