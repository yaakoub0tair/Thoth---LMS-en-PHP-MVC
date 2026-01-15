<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;

$app = new Application();
$app->router->get('/',function(){

        include '../views/user.php';
});
$app->router->get('/contact',function(){
        include '../views/login.php';
});
$app->router->get('/about',function(){
        echo "about";
});
$app->run();

        



