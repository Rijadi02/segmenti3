<?php 



class Db_object{

    protected static $db_table = "users";
    protected static $db_table_fields = [];

	public static function find_all(){
		return static::find_by_query("SELECT * FROM " . static::$db_table . " order by id desc");
    }
    
    public static function find_all_limit($limit){
		return static::find_by_query("SELECT * FROM " . static::$db_table . " order by id desc LIMIT $limit");	
	}

    public static function find_all_order_by_date(){

        return static::find_by_query("SELECT * FROM " . static::$db_table . " order by date desc");

    }

	public static function find_by_id($id){
		
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    
    

	public static function find_by_id_user($id){
		
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id_student = $id ");

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}



    public static function find_email($email)
    {
        $q = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE email = '$email' LIMIT 1");
        return !empty($q) ? array_shift($q) : false;
    }
    
	public static function find_by_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$the_object_array = array();

		while ($row = mysqli_fetch_array($result_set)) {
			$the_object_array[] = static:: instantation($row);
		}
		return $the_object_array;
	}



	public static function instantation($the_record){

		$calling_class = get_called_class();

		$the_object = new $calling_class;
		
        foreach ($the_record as $the_attribute => $value) {
        		if ($the_object->has_the_attribute($the_attribute)) {
        			$the_object->$the_attribute = $value;
        		}
            }

        return $the_object;
	}  

	private function has_the_attribute($the_attribute){

		$object_properties = get_object_vars($this);

		return array_key_exists($the_attribute, $object_properties);

    }
    
  


	public function properties(){

		//return get_object_vars($this);

		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}
		}

		return $properties;

	}


    protected function clean_properties(){
        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {

            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
	}

	public function save($id = null)
    {
        return isset($id) ? $this->update($id) : $this->create();
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
        $q = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $q .= "VALUES ('" . implode("','", array_values($properties)) . "')";
        if ($database->query($q)) {
            $database->the_insert_id();
            return true;
        } else {
            return false;
        }
        
    }
    public function update($id)
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            if(empty($value))
            {
                continue;
            }
            else
            {
                $properties_pairs[] = "{$key}='{$value}'";
            }

        }
        $q = "UPDATE " . static::$db_table . " SET ";
        $q .= implode(", ", $properties_pairs);
        $q .= " WHERE id = " . $database->escape_string($id) . "";
        $database->query($q);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function update_null($id)
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value)
        {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $q = "UPDATE " . static::$db_table . " SET ";
        $q .= implode(", ", $properties_pairs);
        $q .= " WHERE id = " . $database->escape_string($id) . "";
        $database->query($q);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public static function get_all_data($object)
    {
        $properties = $object->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            if(empty($value))
            {
                continue;
            }
            else
            {
                $properties_pairs[] = "{$key}='{$value}'";
            }
        }
        $q = "SELECT * FROM " . static::$db_table . " WHERE ";
        $q .= implode(" AND ", $properties_pairs);
        $q .= " LIMIT 1";
        $the_result_array = static::find_by_query($q);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

	public function delete($id)
    {
        global $database;
        $q = "DELETE FROM `" . static::$db_table . "` where id = $id";
        $database->query($q);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public static function count_items()
    {
        global $database;
        $result = $database->query("SELECT * FROM " . static::$db_table);
        return $result->num_rows;
    }
}
