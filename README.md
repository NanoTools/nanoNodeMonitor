# Nano Node Monitor

[![StyleCI](https://styleci.io/repos/124749081/shield?branch=master)](https://styleci.io/repos/124749081)

Nano Node Monitor is a server-side PHP-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

Here is what it looks like on a desktop computer ...

![Desktop screenshot](https://i.imgur.com/1k5BCfc.png)


... and on a mobile device: 

![Mobile screenshot](https://i.imgur.com/PTSwL69.jpg)


## Prerequisites

- Running Nano Node with RPC enabled ([Tutorial](https://github.com/nanocurrency/raiblocks/wiki/Docker-node))
- Webserver with PHP ([Tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04))
- PHP-Curl Module

    `sudo apt-get install php-curl`

## Installation

In your empty webserver directory, e.g. `/var/www/html`, execute:

    git clone https://github.com/dbachm123/nanoNodeMonitor .

 
If you want it to run a subdirectory remove the `.` at the end.

In the `modules` folder, create your own config file by executing:

    cp config.sample.php config.php

If you run a standalone node you might need to modify the IP-address and the port for the RPC in the file `config.php`. It should match the corresponding entries in `~/RaiBlocks/config.json`, e.g.

```
// ip address for RPC (default: [::1])
$nanoNodeRPCIP   = '127.0.0.1';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';
```

## Updating
Switch to your installation directory and execute `git pull`.

## Links

* [Installation Official Nano Node with Docker (Official Nano Repo Wiki)](https://github.com/nanocurrency/raiblocks/wiki/Docker-node)
* [Installation brianpugh Nano Node with Docker (1NANO)](https://1nano.co/support-the-network/)
* [brianpugh/raiblocks-docker - Docker Hub](https://hub.docker.com/r/brianpugh/raiblocks-docker/)


## Support

Feel free to change your representative to my Nano node `xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj` to support further decentralization within the Nano network. In case of problems, please send an [issue](https://github.com/dbachm123/nanoNodeMonitor/issues). You might also find me on [r/nanocurrency](https://www.reddit.com/r/nanocurrency/) and [r/nanodev](https://www.reddit.com/r/NanoDev/comments/7x87tu/phpnodexrai_node_monitor_tool_now_with_nano/) on reddit. 

Donations are welcome to: [xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj](https://www.nanode.co/account/xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj)

Have fun! :)





