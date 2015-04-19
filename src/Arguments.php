<?php

namespace Foogile\NetBeans\PhpUnit;

class Arguments
{
    public $logJunit;
    public $colors;
    public $configuration;
    public $suitePath;
    public $suiteArguments = array();
    
    public function __toString()
    {
        $parts = [];
        
        if ($this->log) {
            $parts[] = "--log-junit {$this->log}";
        }
        
        if ($this->colors) {
            $parts[] = '--colors';
        }
        
        if ($this->configuration) {
            $parts[] = "--configuration {$this->configuration}";
        }
        
        if ($this->suitePath) {
            $parts[] = $this->suitePath;
            foreach ($this->suiteArguments as $argument) {
                $parts[] = "--run=$argument";
            }
        }
        
        return implode(' ', $parts);
    }
}
