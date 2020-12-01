<?php
class SubProject extends Db_object
{
    protected static $db_table = "sub_project";
    protected static $db_table_fields = array('id', 'project_id', 'site_manager','agents');

    public $id;
    public $project_id;
    public $site_manager;
    public $agents;


    public static function find_by_project($id)
    {
        return self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE project_id = '" . $id . "'");
    }

    public static function get_agent_number($id){
        return self::find_by_query("SELECT SUM(agents) AS agents_working FROM " . self::$db_table . " WHERE project_id = '" . $id . "'");
    }
    
    public static function find_by_sitemanager($id)
    {
        return self::find_by_query("SELECT * FROM " . self::$db_table . " WHERE site_manager = '" . $id . "'");
    }    
}
