<?php

namespace Foogile\NetBeans\PhpUnit;

class ArgumentParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArgumentParser
     */
    private $parser;
    
    private $input;
    
    protected function setUp()
    {
        $this->parser = new ArgumentParser;
    }
        
    public function test_shouldParseColors()
    {
        $this->assertTrue($this->parser->parse(array('phpunit', '--colors'))->colors);
        $this->assertFalse($this->parser->parse(array('phpunit'))->colors);
    }
    
    public function test_shouldIgnoreUnrecognizedOptions()
    {
        $input = array(
            '/path/to/phpunit-test.php',
            '--some-arg',
            '--colors',
            '--configuration',
            '/someconfig.xml'
        );
        $result = $this->parser->parse($input);
        
        $this->assertTrue($result->colors);
        $this->assertEquals('/someconfig.xml', $result->configuration);
        $this->assertEmpty($result->suitePath);
        $this->assertEmpty($result->suiteArguments);
    }
}
