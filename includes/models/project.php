<?php


class Project extends Db_object
{
    protected static $db_table = "project";
    protected static $db_table_fields = array('id', 'name', 'manager','agents');

    public $id;
    public $name;
    public $manager;
    public $agents;


    public static function find_by_manager($id)
    {
        return self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE manager = '" . $id . "'");
    }

    public static function get_project($id)
    {
        $the_result_array = self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE id = '" . $id . "' LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

   
 
    
}
