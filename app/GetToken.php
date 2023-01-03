<?php
//echo "Hello";
require_once('./src/server.php');
//request token
$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();



?>