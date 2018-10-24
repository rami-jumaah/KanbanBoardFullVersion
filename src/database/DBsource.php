<?php
/**
 * Created by PhpStorm.
 * User: fabia_ovv7omp
 * Date: 26.09.2018
 * Time: 09:27
 */

//require_once("../../resources/config.php");
include("../resources/config.php");

class DBsource
{
    private $dbsource;
    private $connLink;
    
    public $query;
    
    private $errno;
    private $error;
	
    
    public function __construct()
    {
        global $config, $dbsource;
        
        $dbsource = $config['db']['db1'];
        $this->connLink = new mysqli($dbsource['host'],$dbsource['dbuser'],$dbsource['dbpwd'],$dbsource['dbname']);
    }

    

    public function get_dbs()
    {
        return $this->dbsource;
    }

    public function dbQuery($Query)
    {
        $this->query = $Query;
        $result = $this->connLink->query($Query);
        return $result;
    }
    
    public function escapeString($string)
    {
    	return $this->connLink->escape_string($string);
    }
    
    public function numRows($result)
    {
    	return $result->num_rows;
    }
    
    public function fetchAssoc($result)
    {
    	return $result->fetch_assoc();
    }
    
    public function fetchArray($result, $resultType = MYSQLI_ASSOC)
    {
    	return $result->fetch_array($resultType);
    }
    
    public function fetchAll($result, $resultType = MYSQLI_ASSOC)
    {
    	return $result->fetch_all($resultType);
    }
    
    public function fetchRow($result)
    {
    	return $result->fetch_row($result);
    }
    
    public function freeResult($result)
    {
    	$this->connLink->free_result($result);
    }

    public function close()
    {
        $this->connLink->close();
    }
    
    public function sql_error()
    {
    	if(empty($error))
	    {
	    	
	    }
    }


}