<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Dropbox/OAuth/Storage/Encrypter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Dropbox/OAuth/Storage/PDO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Dropbox/OAuth/Storage/Session.php');

/**
 * A bootstrap for the Dropbox SDK usage examples
* @link https://github.com/BenTheDesigner/Dropbox/tree/master/examples
*/

// Prevent access via command line interface
if (PHP_SAPI === 'cli') {
    exit('dropbox_bootstrap.php must not be run via the command line interface');
}

// Don't allow direct access to the bootstrap
if(basename($_SERVER['REQUEST_URI']) == 'dropbox_bootstrap.php'){
    exit('dropbox_bootstrap.php does nothing on its own. Please see the examples provided');
}

// Set error reporting
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('html_errors', 'On');

// Register a simple autoload function
spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once($_SERVER['DOCUMENT_ROOT'].'./' . $class . '.php');
});

// Set your consumer key, secret and callback URL
$key    = 'b2ojg708w76j2k5';
$secret = 'aqp6y2pfzv9j4jh';

// Check whether to use HTTPS and set the callback URL
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
$callback = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Instantiate the Encrypter and storage objects
$encrypter = new \Dropbox\OAuth\Storage\Encrypter('aXXXXXXXsXXXXXXXXXXXXXcXXXvXXXqX');

// User ID assigned by your auth system (used by persistent storage handlers)
$userID = 1;

// Instantiate the database data store and connect
$storage = new \Dropbox\OAuth\Storage\PDO($encrypter, $userID);
$storage->connect('localhost', 'db_baseball', 'root', '', 3306);

// Create the consumer and API objects
$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
$dropbox = new \Dropbox\API($OAuth);
