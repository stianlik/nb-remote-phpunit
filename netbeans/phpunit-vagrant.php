<?php

namespace Foogile\NetBeans\PhpUnit;

/**
 * Assuming this file is placed in /vagrant/vendor/foogile/nb-remote-phpunit/netbeans
 */

set_include_path(get_include_path() . ':' . __DIR__ . '/../../../../');

require 'vendor/autoload.php';

$localVagrantPath = realpath(__DIR__ . '/../../../../');
$pathMappings = array ($localVagrantPath => '/vagrant');
$tmpPath = '/vagrant/tmp';
$remotePhpUnitPath = '/vagrant/vendor/bin/phpunit';
$remoteVagrantPath = '/vagrant';

$testRunner = new TestRunner(
    new ArgumentParser(),
    new ArgumentMapper($tmpPath, $pathMappings),
    new LogMapper(array_flip($pathMappings)),
    new VagrantRemoteHost($localVagrantPath, $remoteVagrantPath),
    $remotePhpUnitPath
);

$testRunner->run($argv);