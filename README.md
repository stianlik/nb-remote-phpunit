# NetBeans remote PHPUnit runner

Custom PHPUnit script that enables NetBeans to run tests on a remote
host. Mainly developed to make Vagrant environments more convenient to
work with, but it can easily be extended to communicate with other
remote hosts.

## Installation

The package should be installed using composer:

```Shell
compose require foogile/nb-remote-phpunit
```

Subsequent sections desribe more specific installations.

### Vagrant

Default Vagrant test scripts can be installed using the following commands:

```Shell
vagrant ssh;
cd /vagrant
compose require foogile/nb-remote-phpunit
```

### Other

See "Custom test runner".

## Usage

Activate remote execution in NetBeans 8 as follows:

1. Right click your project and click "Properties"
2. Navigate to "Testing" > "PHPUnit"
3. Check "Use Custom PHPUnit Script" and point "PHPUnit Script"
   to `VAGRANT_PATH/vendor/foogile/nb-remote-phpunit/netbeans/phpunit-vagrant.php`,
   where `VAGRANT_PATH` is an absolute path to your vagrant folder.
4. Run tests as you would normally do

## Custom test runner

You can run tests on custom remote hosts by implementing a custom remote host
and providing a custom NetBeans PHPUnit script.

For example:

```PHP
class SSHRemoteHost implements RemoteHostInterface
{
    public public put($localPath, $remotePath)
    {
        exec("scp $src myhost.com:$dst");
    }
    
    public function get($remotePath, $localpath)
    {
        exec("scp myhost.com:$remotePath $localPath");
    }

    public function exec($command)
    {
        exec("ssh -e myhost.com '$command'");
    }
```

See `netbeans/phpunit-vagrant.php` for an example of a custom NetBeans
PHPUnit script.

Pull requests are welcome :)

## Credits

Based on the blog post [Running PHPUnit tests on a VM, from NetBeans](http://www.brianfenton.us/2012/03/running-phpunit-tests-on-vm-from.htm).
