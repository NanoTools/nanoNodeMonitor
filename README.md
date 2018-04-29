# Nano Node Monitor

![GitHub release](https://img.shields.io/github/release/NanoTools/nanoNodeMonitor.svg?style=flat-square) [![StyleCI](https://styleci.io/repos/118352667/shield?branch=master)](https://styleci.io/repos/118352667) [![Docker Pulls](https://img.shields.io/docker/pulls/nanotools/nanonodemonitor.svg?style=flat-square)](https://hub.docker.com/r/nanotools/nanonodemonitor/)

Nano Node Monitor is a server-side PHP-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

![Light](https://i.imgur.com/fbaAFvC.png)

![Dark](https://i.imgur.com/1Gu9ohX.png)


## Prerequisites

- Running Nano Node with RPC enabled ([Tutorial](https://github.com/nanocurrency/raiblocks/wiki/Docker-node))
- Webserver with PHP ([Tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04))
- PHP-Curl Module

    `sudo apt-get install php-curl`

## Installation

In your empty webserver directory, e.g. `/var/www/html`, execute:

    git clone https://github.com/NanoTools/nanoNodeMonitor .

 
If you want it to run a subdirectory remove the `.` at the end.

In the `modules` folder, create your own config file by executing:


    cp config.sample.php config.php

You will have to add your node's account to the config file `config.php` by modifying the following lines. Make sure to remove the `//` in front of `$nanoNodeAccount`:

```
// account of this node 
$nanoNodeAccount = 'xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj'; 
```


If you are running a standalone node you might need to modify the IP-address and the port for the RPC in the file `config.php`. It should match the corresponding entries in `~/RaiBlocks/config.json`, e.g.

```
// ip address for RPC (default: [::1])
$nanoNodeRPCIP   = '127.0.0.1';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';
```

## Updating

Switch to your installation directory and execute `git pull`.

## Creating a Theme

If you're interested in creating your own theme in addition to the official Light and Dark themes, we've made it very simple for you to do so. Check out the [Wiki](https://github.com/NanoTools/nanoNodeMonitor/wiki/Create-a-theme) for more info.


## Links

* [Installation Official Nano Node with Docker (Official Nano Repo Wiki)](https://github.com/nanocurrency/raiblocks/wiki/Docker-node)
* [Easy-Nano-Node 5 minute installation](https://nanotools.github.io/easy-nano-node/)

## Support

Feel free to change your representative to my Nano node `xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj` to support further decentralization within the Nano network. In case of problems, please send an [issue](https://github.com/NanoTools/nanoNodeMonitor/issues). 

Donations to the development of Nano Node Monitor are very welcome to: [xrb_1nanomon9uycemhgonue4twmcqmsu7oxw43maro8amj751ozpus8r8gsic48](https://www.nanode.co/account/xrb_1nanomon9uycemhgonue4twmcqmsu7oxw43maro8amj751ozpus8r8gsic48)

Have fun! :)
