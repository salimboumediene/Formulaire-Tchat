<?php

use App\Response;
use App\DBH;

require __DIR__ . "/../vendor/autoload.php";

try {

    /**
     * Must be compared to route path
     * @var string
     */
    $url = filter_input(INPUT_SERVER, "REDIRECT_URL");

    if (!$url) {
        throw new OutOfBoundsException(
            "Can't access directly to front controller"    
        );
    }

    /**
     * Routes collection
     * @var StdClass $routing
     */
    $routing = json_decode(file_get_contents(__DIR__ . "/../app/config/routing.json"));

    foreach ($routing as $value) {
        if (preg_match(
                "/^" . str_replace( "/", "\/", $value->path) . "$/",
                $url
        )) {
            unset($url);
            unset($routing);
            $tmp = explode("::", $value->controller);
            $controllerName = $tmp[0];
            $methodName  = $tmp[1];
            unset($tmp);
            $controller = new $controllerName();
            unset($controllerName);
            $response = $controller->{$methodName}();
            unset($methodName);
            unset($controller);
            break;
        }

    }
    if (!isset($response)) {

        /**
         * @var \App\Response $response
         */
        $response = new Response;

        $response->setStatus(404, "Not Found");
        $response->addHeader("Content-Type", "text/html; charset=utf-8");
        $response->setBody("Not Found!");
    }
    header($response->getStatus());
    foreach ($response->getHeader() as $name => $value) {
        header($name . ": " . $value);
    }
    echo $response;

} catch (Throwable $e) {

    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: text/html; charset=utf-8");
    die(
        "<h1>Erreur</h1>"
        . "<p>"
        . "<b>message</b> " . $e->getMessage() . " <br>"
        . "<b>line</b> " . $e->getLine() . " <br>"
        . "<b>file</b> " . $e->getFile() . " <br>"
      . "</p>"
    );

}
