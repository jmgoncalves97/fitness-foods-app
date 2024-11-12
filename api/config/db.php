<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=$host;dbname=$dbname",
    'username' => "$username",
    'password' => "$password",
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
