<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("classes/DB.php");
include_once("classes/Message.php");
include_once("classes/Validator.php");

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "root");
define("DBNAME", "minibd");


