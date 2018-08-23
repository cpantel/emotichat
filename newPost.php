<?php
require_once dirname(__FILE__) . '/EmoticonService.php';

EmoticonService::create($_REQUEST['remitente'],$_REQUEST['mensaje']);

header('Location: /');
