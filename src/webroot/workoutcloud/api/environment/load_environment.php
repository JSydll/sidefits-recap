<?php
// Built global environment variables
$ENV_VARS = parse_ini_file(__DIR__."/../../env.ini");
// Load composer autoload script
require($ENV_VARS["COMPOSER_URL"]);


// MYSQL CONNECTION TO DATABASE ///////////////////////////////////
// Connect to the MySQL DB and prepare the components of the mysqli statements
// Create the connection object
$mysql_con = new mysqli($ENV_VARS['MYSQL_DOMAIN'], $ENV_VARS['MYSQL_USR'], $ENV_VARS['MYSQL_PASS'], $ENV_VARS['MYSQL_DB_NAME']);

// Check if there was an error in connecting with the db
if ($mysql_con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysql_con->connect_errno . ") " . $mysql_con->connect_error;
}

// Set NAMES to UTF-8 for all queries
$mysql_con->query("SET NAMES 'utf8'");

// The connection is ready and can be used now.

// NEO4JPHP CONNECTION TO DATABASE /////////////////////////////////
// Built up connection and return it to the client object
$neo4jclient = new Everyman\Neo4j\Client($ENV_VARS['NEO4J_DOMAIN'], $ENV_VARS['NEO4J_PORT']);
$neo4jclient->getTransport()
  //->useHttps()
  ->setAuth($ENV_VARS['NEO4J_USR'], $ENV_VARS['NEO4J_PASS']);  
// Additional options like https encription should be made here

// The connection is established and can be used.
?>