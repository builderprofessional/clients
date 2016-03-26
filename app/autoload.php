<?php

use ThirdEngine\PropelSOABundle\Utility\DocBlockUtility;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

$loader = require __DIR__.'/../vendor/autoload.php';
require_once(__DIR__ . '/../src/Engine/EngineBundle/Validation/is_email.php');

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

DocBlockUtility::allowAnnotations($loader);
return $loader;
