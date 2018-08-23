<?php
require_once dirname(__FILE__) . '/MiEmoticonService.php';

final class MiEmoticonServiceTest extends PHPUnit_Framework_TestCase {
   public function testParseLine() {
        $this->assertArraySubset([['text','hola']],MiEmoticonService::parseLine('hola'));
        $this->assertArraySubset([['emoticon','e1']],MiEmoticonService::parseLine(':-)'));
        $this->assertArraySubset([['text','hola '],['emoticon','e1']],MiEmoticonService::parseLine('hola :-)'));
        
        $this->assertArraySubset([['emoticon','e1'],['text',' hola']],MiEmoticonService::parseLine(':-) hola'));

   }


}
