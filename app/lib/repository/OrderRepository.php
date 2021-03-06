<?php
namespace Walltwisters\lib\repository; 

use Walltwisters\lib\model\Customer;

class OrderRepository extends BaseRepository { 
    protected function getColumnNamesForInsert() {
        throw new Exception("Not implemented");
    }
    
    protected function getColumnValuesForBind($aggregate) {
        throw new Exception("Not implemented");
    }
    
    public function insertCustomer(Customer $customer) {
        $stmt = self::$conn->prepare("INSERT INTO customers(firstname,lastname,address,zipcode,city,country,email,phonenumber) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $bindresult = $stmt->bind_param("ssssssss", $fn, $ln, $a, $z, $c, $co, $e, $t);
        $fn = $customer->getFirstName();
        $ln = $customer->getLastName();
        $a = $customer->getAddress();
        $z = $customer->getZipCode();
        $c = $customer->getCity();
        $co = $customer->getCountry();
        $e = $customer->getEmail();
        $t = $customer->getPhoneNumber();
        
        $stmt->execute();
    }
    
} 