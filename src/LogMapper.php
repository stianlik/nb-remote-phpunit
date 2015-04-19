<?php

namespace Foogile\NetBeans\PhpUnit;

class LogMapper
{
    private $pathMappings;
    
    public function __construct($pathMappings = array())
    {
        $this->pathMappings = $pathMappings;
    }
    
    public function toLocal($log)
    {
        return str_replace(
            array_keys($this->pathMappings),
            array_values($this->pathMappings),
            $log
        );
    }
}
