<?php

set_include_path("./src");

require_once("control/Router.php");

$router = new Router(getenv("SCRIPT_NAME"),dirname(getenv("SCRIPT_NAME")));
$router->main();

?>
