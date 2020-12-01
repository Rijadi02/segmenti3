<?php


class Agents extends Db_object
{
    protected static $db_table = "agents";
    protected static $db_table_fields = array('id', 'name');

    public $id;
    public $name;
    public $site;

    public static function user_exists($username)
    {
        $the_result_array = self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE username = '" . $username . "' LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_site($id)
    {
        return self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE site = '" . $id . "'");
    }

    // public function get_book()
    // {
    //     return Books::find_by_no($this->collection, $this->book_no);
    // }
 
    
}
