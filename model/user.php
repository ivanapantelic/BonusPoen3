<?php 
class User{
    public $id;
    public $username;
    public $password;
    
    //php manual - constructors and destructors
    public function __construct($id = null, $username = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    public static function logIn(User $user, mysqli $connect){
        
        //isključivo dvostruki navodnici
        $query_string = "SELECT * FROM user WHERE username='$user->username' AND password='$user->password'";
        //izvršavanje upita u bazi
        return $connect->query($query_string);
        
        //return true;
    }
}
?>