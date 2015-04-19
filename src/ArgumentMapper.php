<?php

namespace Foogile\NetBeans\PhpUnit;

class ArgumentMapper
{
    const LOG_NAME = 'nb-phpunit-log.xml';
    const SUITE_NAME = 'NetBeansSuite.php';
    
    private $pathMappings;
    private $temporaryPath;
    
    /**
     * @param string $temporaryPath Temporary path on remote host
     * @param array $pathMappings Associative array of path mappings. Example: [ "/local/path" => "/remote/path" ]
     */
    public function __construct($temporaryPath, $pathMappings = [])
    {
        $this->pathMappings = $pathMappings;
        $this->temporaryPath = $temporaryPath;
    }
    
    /**
     * @param Arguments $arguments Original arguments
     * @return Arguments
     */
    public function toRemote(Arguments $arguments)
    {
        $out = new Arguments;
        $out->colors = $arguments->colors;
        $out->configuration = $this->getRemotePath($arguments->configuration);
        $out->logJunit = $this->getRemoteTemporaryPath(self::LOG_NAME);
        $out->suitePath = $this->getRemoteTemporaryPath(self::SUITE_NAME);
        $out->suiteArguments = array_map(array($this, 'remotePath'), $arguments->suiteArguments);
    }
    
    private function getRemotePath($localPath)
    {
        return str_replace(
            array_keys($this->pathMappings),
            array_values($this->pathMappings),
            $localPath
        );
    }
    
    private function getRemoteTemporaryPath($filename)
    {
        return "$this->temporaryPath/$filename";
    }
    
}
