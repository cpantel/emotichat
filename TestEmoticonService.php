<?php
require_once dirname(__FILE__) . '/EmoticonService.php';

final class EmoticonServiceTest extends PHPUnit_Framework_TestCase {
   public function testParseLine() {
        $this->assertArraySubset([['text','hola']],EmoticonService::parseLine('hola'));
        $this->assertArraySubset([['emoticon','e1']],EmoticonService::parseLine(':-)'));
        $this->assertArraySubset([['text','hola '],['emoticon','e1']],EmoticonService::parseLine('hola :-)'));
        
        $this->assertArraySubset([['emoticon','e1'],['text',' hola']],EmoticonService::parseLine(':-) hola'));

   }


}
