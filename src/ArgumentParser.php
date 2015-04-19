<?php

namespace Foogile\NetBeans\PhpUnit;

class ArgumentParser
{
    /**
     * @param array $input Arguments from command line
     * @return Arguments
     */
    public function parse($input)
    {
        $output = new Arguments();
        while(next($input)) {
            $this->parseArgument($input, $output);
        }
        return $output;
    }
    
    private function parseArgument(&$input, Arguments &$output)
    {
        $current = current($input);
        switch ($current) {
            case '--log-junit':
                $output->logJunit = next($input);
                break;
            case '--colors':
                $output->colors = true;
                break;
            case '--configuration':
                $output->configuration = next($input);
                break;
            default:
                $this->parseSuiteArguments($input, $output);
                break;
        }
    }
    
    private function parseSuiteArguments(&$input, Arguments &$output)
    {
        $current = current($input);
        if (preg_match('/^--run=/', $current)) {
           $output->suiteArguments[] = substr($current, 6);
        } else if (!preg_match('/^--?/', $current)) {
           $output->suitePath = $current;
        }
    }
}
