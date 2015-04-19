<?php

namespace Foogile\NetBeans\PhpUnit;

class Command
{
    private $phpunit;
    
    /**
     * @var Arguments Mapped input arguments
     * @var string $phpunit PHPUnit command on remote host
     */
    private $arguments;
    
    public function __construct(Arguments $arguments, $phpunit = 'phpunit')
    {
        $this->arguments = $arguments;
        $this->phpunit = $phpunit;
    }
    
    public function __toString()
    {
        return "$this->phpunit $this->arguments";
    }
}
