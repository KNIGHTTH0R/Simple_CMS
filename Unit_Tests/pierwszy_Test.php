<?php
use PHPUnit\Framework\TestCase;

require 'src/kod.php';

class DataTest extends TestCase
{

    public function testAdd()
    {
	$tt = new Testowa();
        $this->assertTrue($tt->test());
    }
}
?>
