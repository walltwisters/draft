<?php
namespace Walltwisters\lib\repository; 

use Walltwisters\lib\model\User;
use Walltwisters\lib\model\Country;
use Walltwisters\lib\model\Privileges;

class UserRepository extends BaseRepository { 
    
    public function __construct($tableName = null, $objectName = null) {
        parent::__construct($tableName, $objectName);
    }
    
    protected function getColumnNamesForInsert() {
        throw new Exception("Not implemented");
    }
    
    protected function getColumnValuesForBind($aggregate) {
        throw new Exception("Not implemented");
    }
    
    public function LoginUser($userName, $password) {
         $sql = "SELECT * FROM users WHERE username = '$userName'";
        $result = self::$conn->query($sql);
        if ($result === FALSE) {
            throw new DatabaseException(self::$conn->error);
        }
        $row = $result->fetch_assoc();
        if ($row){
            $pwd = $row['password'];
            $salt = $row['passwordsalt'];
            $str = $salt . $password;
            $hash = md5($str);
            if (strtoupper($hash) == strtoupper($pwd)) {
                $id = $row['id'];
                $name = $row['name'];
                $lastname = $row['lastname'];
                $privileges = $row['privileges'];
                $user = new User($id, $name, $lastname, $userName, $privileges, []);
                $countries = $this->getCountriesForUser($user);
                $user->countries = $countries;
                return $user;
            }
        }
        return false;
    }
    
    private function PasswordCryp($password) {
        $salt = uniqid();
        $strn = $salt . $password;
        $hash = md5($strn);
       
        return [$hash, $salt];
    }
    
  
    
    public function AddUser($user) {
        $name = $user->name;
        $lastname = $user->lastname;
        $username = $user->username;
        $privileges = $user ->privileges;
        $countriesIds = $user -> countries;
        list($password, $salt) =$this->PasswordCryp($user->password);
        $sql = ("INSERT INTO users(name,lastname,username,password, passwordsalt, privileges) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt = self::$conn->prepare($sql);
        $bindresult = $stmt->bind_param("sssssi", $name, $lastname, $username, $password, $salt, $privileges);
        if (!$bindresult ) {
            throw Exception('fail to bind');
        }
        $res = $stmt->execute();
        if ($res) {
            $lastIdRes = self::$conn->query("SELECT LAST_INSERT_ID()");         
            $row = $lastIdRes->fetch_row();                                       
            $userid = $row[0];
            $this->AddUserCountry($userid, $countriesIds);
            $user->id = $userid;
            return $user;
        }
        throw new Exception($stmt->error);
    }
    
    private function AddUserCountry($userid, $countriesIds) {
        foreach ($countriesIds as $countryId){
        $sql = ("INSERT INTO user_country(user_id,country_id) VALUES(?, ?)");
        $stmt = self::$conn->prepare($sql);
        $bindresult = $stmt->bind_param("ii", $userid, $countryId);
        $stmt->execute();
        }
        
        
    }
    private function getCountriesForUser($user) {
        $user_id = $user->id;
        $sql = ("SELECT countries.* FROM countries, user_country WHERE user_country.user_id = $user_id
                AND countries.id = user_country.country_id;");
        $result = self::$conn->query($sql);
        if ($result === FALSE) {
            throw new Exception(self::$conn->error);
        }
        $countries = [];
        while ( $row = $result->fetch_object('Walltwisters\lib\model\Country')){
            $countries[] = $row;
        }
        if (empty($countries)) {
            throw new Exception('failed');
        }
        return $countries;
                
    }
    
   
    
    
    
  
} 