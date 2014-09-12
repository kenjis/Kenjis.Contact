<?php
/**
 * Constants
 *
 * [
 *  $context1 => [$config_name => $config_value],
 *  $context2 => [$config_name => $config_value],
 * ]
 *
 * default constants:
 *  'namespace' => 'Kenjis\Contact',
 *  'app_class' => 'Kenjis\Contact\App',
 *  'tmp_dir' => "{$appDir}/var/tmp",
 *  'log_dir' => "{$appDir}/var/log",
 *  'lib_dir' => "{$appDir}/var/lib",
 *  'resource_dir' => "{$appDir}/src/Resource"
 */

$masterDb = $slaveDb = require __DIR__  .'/db/sqlite.php';
//list($masterDb, $slaveDb) = require __DIR__  .'/db/mysql.php';

return [
    'prod' => [
        // optional
        'master_db' => $masterDb,
        'slave_db' => $slaveDb,
        'contact_form' => [
            'subject'     => 'Contact Form',
            'admin_email' => 'admin@example.org',
            'admin_name'  => 'Administrator',
        ],
    ],
    'dev' => [],
    'api' => [],
    'test' => []
];
