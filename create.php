<?php
require_once dirname(__FILE__) . '/MiEmoticonService.php';

MiEmoticonService::createDB();

header('Location: /');
