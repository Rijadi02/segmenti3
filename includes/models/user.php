<?php


class User extends Db_object
{
    protected static $db_table = "user";
    protected static $db_table_fields = array('id', 'username', 'password','role_id');

    public $id;
    public $username;
    public $password;
    public $role_id;


    public static function user_exists($username)
    {
        $the_result_array = self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE username = '" . $username . "' LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_role($role)
    {
        return self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE role_id = '" . $role . "'");
    }

    


    // public function get_book()
    // {
    //     return Books::find_by_no($this->collection, $this->book_no);
    // }
 
    
}
