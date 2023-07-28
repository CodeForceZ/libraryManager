<?php
require_once('vendor/autoload.php');
(Dotenv\Dotenv::createImmutable(__DIR__))->load();
require_once('helpers/session.php');
require_once('helpers/autoloader.php');
require_once('helpers/misc_functions.php');
require_once('helpers/misc_variables.php');
require_once('libraries/Database.php');
require_once('libraries/FormValidator.php');
require_once('libraries/FormGenerator.php');
load_classes($_ENV["BASE_PATH"], 'controllers');
load_classes($_ENV["BASE_PATH"], 'models');

?>