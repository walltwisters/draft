<?php
namespace Walltwisters\lib\model; 


class ProductFormat {
    private $id;
    private $format;
    private $description;
    
    
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value){
        $this->$name = $value;
    }
}

