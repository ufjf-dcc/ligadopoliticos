
<?php
require_once 'config/database.php';
//Configura o Doctrine Cli
$config = array('data_fixtures_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/fixtures',
                'models_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/models',
                'migrations_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/migrations',
                'sql_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/sql',
                'yaml_schema_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/schema');
$cli = new Doctrine_Cli($config);
$cli->run($_SERVER['argv']); ?>