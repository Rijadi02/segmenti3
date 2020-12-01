<?php


class ProjectAgent extends Db_object
{
    protected static $db_table = "project_agent";
    protected static $db_table_fields = array('id', 'project_id', 'agent_id', 'time_from', 'time_to');

    public $id;
    public $project_id;
    public $agent_id;
    public $time_from;
    public $time_to;

   



  
    
}
