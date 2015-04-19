<?php

namespace Foogile\NetBeans\PhpUnit;

class VagrantRemoteHost implements RemoteHostInterface
{
    private $localVagrantPath;
    private $remoteVagrantPath;
    
    public function __construct($localVagrantPath, $remoteVagrantPath = '/vagrant')
    {
        $this->localVagrantPath = $localVagrantPath;
        $this->remoteVagrantPath = $remoteVagrantPath;
    }
  
    public function put($localPath, $remotePath)
    {
        copy($localPath, $this->vagrantPath($remotePath));
    }
    
    public function get($remotePath, $localPath)
    {
        copy($this->vagrantPath($remotePath), $localPath);
    }

    public function exec($command)
    {
        exec("cd $this->localVagrantPath && vagrant ssh --command '$command'");
    }
    
    private function vagrantPath($remote)
    {
        return str_replace($this->remoteVagrantPath, $this->localVagrantPath, $remote);
    }
}
