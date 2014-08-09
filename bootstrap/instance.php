<?php
/**
 * Application instance script
 *
 * @return $app  \BEAR\Sunday\Extension\Application\AppInterface
 *
 * @global $context string configuration context
 */
namespace Kenjis\Contact;

use BEAR\Package\Bootstrap\Bootstrap;

// set default charset
ini_set('default_charset', 'UTF-8');

require_once __DIR__ . '/autoload.php';

$app = Bootstrap::getApp(
    __NAMESPACE__,
    isset($context) ? $context : 'prod',
    dirname(__DIR__) . '/var/tmp'
);

return $app;