<?php
/**
 * Created by PhpStorm.
 * User: fabia_ovv7omp
 * Date: 16.09.2018
 * Time: 12:50
 */

require_once("../resources/config.php");
include("../src/database/DBsource.php");

echo "Library path: ";
echo LIBRARY_PATH;

echo "<br>Document root: ";
echo $_SERVER["DOCUMENT_ROOT"];

echo "<br>Config:";
print_r($config['db']['db1']);

echo "<br>Test connection:";
$db = new DBsource();

//echo $db->connect();
echo "<br>hi: ";
print_r($db->get_dbs());

echo "<br>Queryresult:";
$query = "select * from t_buckets";
$result = $db->dbQuery($query);
if($result->num_rows > 0) {
    while($row=$result->fetch_assoc()) {
        echo "Bucket name: ".$row['t_buckets_name']."<br>";
    }
}