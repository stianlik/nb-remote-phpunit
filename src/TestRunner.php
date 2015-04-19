<?php

namespace Foogile\NetBeans\PhpUnit;

class TestRunner
{
    /**
     * @var ArgumentParser
     */
    private $argumentParser;
    
    /**
     * @var ArgumentMapper
     */
    private $argumentMapper;
    
    /**
     * @var LogMapper
     */
    private $logMapper;
    
    /**
     * @var RemoteHostInterface
     */
    private $remote;
    
    /**
     * @var string Path to PHPUnit command
     */
    private $remotePhpUnitPath;
    
    public function __construct(
        ArgumentParser $argumentParser,
        ArgumentMapper $argumentMapper,
        LogMapper $logMapper,
        RemoteHostInterface $remoteHost,
        $remotePhpUnitPath = 'phpunit'
    ) {
        $this->argumentParser = $argumentParser;
        $this->argumentMapper = $argumentMapper;
        $this->logMapper = $logMapper;
        $this->remote = $remoteHost;
        $this->remotePhpUnitPath = $remotePhpUnitPath;
    }
    
    public function run($argv)
    {
        // Parse arguments
        $arguments = $this->parser->parse($argv);
        $remoteArguments = $this->argumentMapper->toRemote($arguments);
        
        // Transfer NetBeans test suite
        $this->remote->put($arguments->suitePath, $remoteArguments->suitePath);
        
        // Execute commands
        $this->remote->exec($this->buildCommand($arguments));
        
        // Translate and save log files
        $this->remote->get($remoteArguments->logJunit, $arguments->logJunit);
        $log = $this->read($arguments->logJunit);
        $this->write($arguments->logJunit, $this->logMapper->toLocal($log));
    }
        
    protected function buildCommand($arguments)
    {
        return new Command($arguments, $this->remotePhpUnitPath);
    }
    
    private function write($path, $contents)
    {
        file_put_contents($path, $contents);
    }
    
    private function read($path)
    {
        return file_get_contents($path);
    }
}
