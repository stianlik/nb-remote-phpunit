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
        $cur = current($input);
        switch ($cur) {
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
                $output->suitePath = current($input);
                $this->parseSuiteArguments($input, $output);
                break;
        }
    }
    
    private function parseSuiteArguments(&$input, Arguments &$output)
    {
        while (next($input)) {
            $output->suiteArguments[] = substr(current($input), 6);
        }
    }
}
