<?php
require_once dirname(__FILE__) . '/functions.php';
require_once dirname(__FILE__) . '/EmoticonService.php';

class MiEmoticonService extends EmoticonService {
   static public function parseLine($line) {
     return parent::parseLine($line);
   }
   
}

//MiEmoticonService::init();
