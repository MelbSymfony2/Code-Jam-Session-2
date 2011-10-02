<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 27/08/11
 * @author camm (camm@flintinteractive.com.au)
 */

require_once(__DIR__.'/../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php');
require_once(__DIR__.'/../vendor/doctrine-common/lib/Doctrine/Common/Annotations/AnnotationRegistry.php');
use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src'),
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-fixtures/lib',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Gedmo' => __DIR__ . '/../vendor/doctrine-extensions/lib',
    'CodeJamTestSuite\\'         => __DIR__
));
$loader->registerPrefixes(array(
//    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
//    'Twig_'            => __DIR__.'/../vendor/twig/lib',
));

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');


