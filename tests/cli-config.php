<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 30/08/11
 * @author camm (camm@flintinteractive.com.au)
 */

$paths = array(__DIR__ . '/../src/Entity');
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'dbname' => 'melbsf2_codejam2',
    'user' => 'root',
    'password' => 'root',
    'host' => 'localhost',
);
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, true);
$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));