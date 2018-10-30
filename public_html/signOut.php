<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: rami
 * Date: 30.10.18
 * Time: 1:05 PM
 */

session_unset();
session_destroy();

header("Location: index.php");
die();