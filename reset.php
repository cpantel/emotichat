<?php
require_once dirname(__FILE__) . '/EmoticonService.php';

EmoticonService::truncateDB();

header('Location: /');