<?php
/**
 * Created by PhpStorm.
 * User: fabia_ovv7omp
 * Date: 16.09.2018
 * Time: 12:36
 */

$config = array(
    "db" => array(
        "db1" => array(
            "dbname" => "",
            "dbuser" => "user",
            "dbpwd" => "password",
            "host" => "localhost"
        )
    ),
    "urls" => array(
        "baseurl" => "localhost"
    ),
    "paths" => array(
        "resources" => "some/path",
        "images" => array(
            "images" => $_SERVER["DOCUMENT_ROOT"]."/images"
        )
    )
);

define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));