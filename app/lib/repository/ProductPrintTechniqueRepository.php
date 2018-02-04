<?php
namespace Walltwisters\repository; 

require_once 'data/BaseRepository.php';
require_once 'model/ProductPrintTechnique.php';

class ProductPrintTechniqueRepository extends BaseRepository {
    public function __construct() {
        parent::__construct("print_techniques", "Walltwisters\model\ProductPrintTechnique");
    }
    
    protected function getColumnNamesForInsert() {
        return ['technique', 'description'];
    }
    
    protected function getColumnValuesForBind($technique) {
        $tech = $technique->technique;
        $description = $technique->description;
       
        return [['s', &$tech], ['s', &$description]];
    }
    
    public function getAllProductPrintTechniques() {
        return $this->getAll();
    }

}