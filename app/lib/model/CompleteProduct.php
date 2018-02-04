<?php
namespace Walltwisters\model; 

require_once 'Product.php';
require_once 'ProductDescription.php';
require_once 'Image.php';
require_once 'Item.php';

class CompleteProduct extends Product {
    protected $productDescriptions;
    protected $imageBaseInfos;
    protected $items;
    
    public function __construct() {
        $this->productDescriptions = [];
        $this->items = [];
    }
    
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function addImageBaseInfo($imageBaseInfo) {
        $this->imageBaseInfos[] = $imageBaseInfo;
    }
    
    public function addItem($item) {
        $this->items[] = $item;
    }
    
    public function addProductDescription($productDescription) {
        $countryId = $productDescription->countryId;
        $languageId = $productDescription->languageId;
        $this->productDescriptions[$countryId][$languageId] = $productDescription;
    }
}