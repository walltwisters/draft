<?php
namespace Walltwisters\lib\model; 

class ImageBaseInfo implements \JsonSerializable {
    protected $id;
    protected $categoryId;
    protected $category; //type of picture, product, interior, slider etc.
    protected $imageName;
    
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
   
    public static function createBaseInfo($id, $imageName, $categoryId, $category = null) {
        $obj = new ImageBaseInfo();
        $obj->id = $id;
        $obj->imageName = $imageName;
        $obj->categoryId = $categoryId;
        $obj->category = $category;
        return $obj;
    }
    
    public function jsonSerialize() {
        return ['id' => $this->id, 'name' => $this->imageName, 'categoryId' => $this->categoryId, 'category' => $this->category];
    }
}
