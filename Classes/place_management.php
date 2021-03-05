<?php
namespace Classes;
use Exception;
include_once dirname(__FILE__) . '/db_connect.php';

class Position {
    private $position;
    private $water;
    private $last_position_array = array("LATITUDE", "LONGITUDE", "WATER", "CREATED_ON");
	//created_on contient la date de création au format Guadeloupe
    
    public function test()
    {
        var_dump(get_object_vars($this));
    }
    
    public function export()
    {
        return get_object_vars($this);
    }
    
    public function __construct()
    {}
    
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    
    public function createPosition($latitude, $longitude, $water) {
        $instance = \ConnectDB::getInstance();
        $mysql_db_conn = $instance->getConnection();
        
        $latitude = mysqli_real_escape_string($mysql_db_conn, $latitude);
        $longitude = mysqli_real_escape_string($mysql_db_conn, $longitude);
        $water = mysqli_real_escape_string($mysql_db_conn, $water);
        
        $sql = "INSERT INTO kialo_xydata (latitude, longitude, water) VALUES ($latitude, $longitude, $water)";
        
        //echo $sql;
        
        try
        {
            if (mysqli_query($mysql_db_conn, $sql))
            {
                //echo("0");
                return 0;
            }
            else
            {
                //echo("-1");
                return -1;
            }
        }
        catch (Exception $e)
        {
            echo ("Erreur : " . $e);
        }
    }
    
    public function getLastPosition($duration) {
        $instance = \ConnectDB::getInstance();
        $mysql_db_conn = $instance->getConnection();
        //duration est la période en heures, par défaut 12h
        $duration = mysqli_real_escape_string($mysql_db_conn, $duration);
		
        //CONVERT_TZ('2004-01-01 12:00:00','GMT','MET')
		
        $sql = "SELECT latitude, longitude, water, date_format(coalesce(CONVERT_TZ(created_on, 'System','America/Guadeloupe'), created_on), '%d-%m %H:%i') as created_on from kialo_xydata where id in ( SELECT MAX(id) FROM `kialo_xydata` WHERE created_on > DATE_SUB(NOW(), INTERVAL $duration HOUR) GROUP BY round(latitude, 3), round(longitude, 3))";
        $data = NULL;
        try
        {
            if ($sql_result = mysqli_query($mysql_db_conn, $sql))
            {
                while ($line = mysqli_fetch_assoc($sql_result))
                {
                    $data[] = $line;
                }
            } else {
                return -1;
            }
        } catch (Exception $e) {
            echo ("Erreur : " . $e);
        }
        
        mysqli_free_result($sql_result);
        
        if (count($data) > 0)
        {
            $this->last_position_array = $data;
            return 0;
        }
        else
        {
            $this->last_position_array = NULL;
            return 1;
        }
        

        
    }
    
    
    
}