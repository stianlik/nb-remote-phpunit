<?php

namespace Foogile\NetBeans\PhpUnit;

class Arguments
{
    public $logJunit;
    public $colors = false;
    public $configuration;
    public $suitePath;
    public $suiteArguments = array();
    
    public function __toString()
    {
        $parts = array();
        
        if ($this->logJunit) {
            $parts[] = "--log-junit {$this->logJunit}";
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
