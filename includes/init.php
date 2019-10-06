<?php


defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/'.'videotube');
define('INCLUDE_PATH', SITE_ROOT.DS.'includes');




require_once('functions.php');
require_once('classes/config.php');
require_once('classes/sessions.php');
require_once('classes/db_object.php');
require_once('classes/user.php');
require_once('classes/imageUpload.php');
require_once('classes/videoUploadData.php');
require_once('classes/categories.php');



?>