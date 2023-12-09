<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/2/2023
 * Time: 2:37 PM
 */


use DI\ContainerBuilder;

//return [
//    'host' => 'localhost',
//    'user' => 'reysey',
//    'password' => 'reysey',
//    'dbname' => 'fast_hd_grabber_db',
//];

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => function () {
        return new PDO('mysql:host=localhost;dbname=fast_hd_grabber_db', 'reysey', 'reysey');
    },
]);

return $containerBuilder->build();
