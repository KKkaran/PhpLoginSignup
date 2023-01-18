<?php
declare(strict_types=1);
spl_autoload_register(function($class){
    require __DIR__ . "/src/". $class .".php";
});
set_exception_handler("ErrorHandler::handleException");
header("Content-Type:application/json; charset=utf-8");

$parts = explode("/",$_SERVER["REQUEST_URI"]);

if($parts[2] != "server"){
    http_response_code(404);
    exit;
}

$id = $parts[3] ?? null;
$database = new Database("localhost","family", "root", "karansodhi");
$gateway = new UserGateway($database);

$controller = new Controllers($gateway);
$controller -> processRequest($_SERVER["REQUEST_METHOD"],$id);