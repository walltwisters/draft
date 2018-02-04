<?php
namespace Walltwisters\model;

use Walltwisters\model\SectionBaseInfo;

require_once 'model/SectionBaseInfo.php';



class SectionDescription extends \Walltwisters\model\SectionBaseInfo {
    private $countryId;
    private $languageId;
    
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public static function create( $title, $saleslineHeader, $saleslineParagraph, $countryId, $languageId, $sectionId) {
        $obj = new sectionDescription();
        $obj->title = $title;
        $obj->saleslineHeader = $saleslineHeader;
        $obj->saleslineParagraph = $saleslineParagraph;
        $obj->countryId = $countryId;
        $obj->languageId = $languageId;
        $obj->id = $sectionId;
        return $obj;
    }
}