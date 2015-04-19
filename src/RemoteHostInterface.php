<?php

namespace Foogile\NetBeans\PhpUnit;

interface RemoteHostInterface
{
    public function put($localPath, $remotePath);
    public function get($remotePath, $localPath);
    public function exec($command);
    public function delete($remotePath);
}
