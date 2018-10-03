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

    public function __construct()
    {
        global $config;
        $this->dbsource = $config['db']['db1'];
    }


    public function connect()
    {
        global $connLink, $dbsource;
        $connLink = mysqli_connect($dbsource['host'],$dbsource['dbuser'],$dbsource['dbpwd'],$dbsource['dbname'])
            or die('Connection failed');
        return "connection worked";
    }

    public function get_dbs()
    {
        return $this->dbsource;
    }

}