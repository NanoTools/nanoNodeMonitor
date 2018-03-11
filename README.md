# Nano Node Monitor

Nano Node Monitor is a server-side PHP-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

Here is what it looks like on a desktop computer ...

![Desktop screenshot](https://i.imgur.com/yZtAtTN.png)


... and on a mobile device: 

![Mobile screenshot](https://i.imgur.com/GZONaxe.jpg)

Currently, the following information is displayed:
* Node version
* Current block number
* Number of unchecked blocks
* Number of peers
* System load
* System uptime
* Memory usage
* Node address
* Balances
* Voting weight
* Representative
* Market data from coinmarketcap.com 

## Installation

To use Nano Node Monitor, you will need to setup a Nano node (either [standalone](https://github.com/nanocurrency/raiblocks/releases) or as a [docker image](https://github.com/nanocurrency/raiblocks/wiki/Docker-node)), and a webserver on the same (Linux) machine. See the [Links](#links) section below for tutorials on that. 

### Prepare Nano node (without docker)

First, enable RPC in the Nano node by modifying `RaiBlocks/config.json` as follows:

```
"rpc_enable": "true",
    "rpc": {
        "address": "::ffff:127.0.0.1",
        "port": "7076",
        "enable_control": "false",
        "frontier_request_limit": "16384",
        "chain_request_limit": "16384"
    },
```

This will enable RPC in the Nano node over localhost (`127.0.0.1`) without giving public access to the RPC. You can easily test this by calling `curl -g -d '{ "action": "version" }' '127.0.0.1:7076'` on a terminal on the machine where the Nano node and the webserver are running. With a working RPC, the Nano node should respond for example with:
```
{
    "rpc_version": "1",
    "store_version": "10",
    "node_vendor": "RaiBlocks 9.0"
}
```

### Prepare Nano node (with docker)

If you are using a docker image for your Nano node, you are most likely either using the [docker image from the nanocurrency github](https://github.com/nanocurrency/raiblocks/wiki/Docker-node) or [Brian Pugh's docker image](https://hub.docker.com/r/brianpugh/raiblocks-docker/). In both, the RPC access is limited to the local machine using either `-p [::1]:7076:7076` or `-p 127.0.0.1:7076:7076`. `[::1]` is the IPV6 address of the local machine; `127.0.0.1` is its IPV4 address. No further action necessary and you can test the RPC interface with the same `curl` command as shown above: `curl -g -d '{ "action": "version" }' '127.0.0.1:7076'` or `curl -g -d '{ "action": "version" }' '[::1]:7076'`, respectively.


### Setup Nano Node Monitor

To setup Nano Node Monitor, install a webserver with PHP support first, e.g. Nginx. Here is a [step-by-step tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04) to get Nginx and PHP running on a DigitalOcean droplet with Ubuntu 16.04. You might need to additionally install php7.0-curl, i.e. `sudo apt-get install php7.0-curl`

In your empty webserver directory, e.g. `/var/www/html`, execute 
`git clone https://github.com/dbachm123/nanoNodeMonitor .` (notice the '.' at the end!), so that `index.php` is callable via http://[your-ip-address]/index.php

In the `modules` folder, create your own config file by executing `cp config.sample.php config.php`. You will need to modify the IP-address and the port for the RPC in the file `config.php`. For the non-docker Nano node, it should match the corresponding entries in `RaiBlocks/config.json`, e.g.

```
// ip address for RPC (default: 127.0.0.1)
$nanoNodeRPCIP   = '127.0.0.1';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';
```

This setting also works with [Brian Pugh's docker image](https://hub.docker.com/r/brianpugh/raiblocks-docker/). For the [docker image from the nanocurrency github](https://github.com/nanocurrency/raiblocks/wiki/Docker-node), use:

```
// ip address for RPC (default: 127.0.0.1)
$nanoNodeRPCIP   = '[::1]';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';
```

## Updating
Switch to your installation directory and execute `git pull`.

## Links

* [Installation Nano Node with Docker (1NANO)](https://1nano.co/support-the-network/)
* [Docker node · nanocurrency/raiblocks Wiki](https://github.com/nanocurrency/raiblocks/wiki/Docker-node)
* [brianpugh/raiblocks-docker - Docker Hub](https://hub.docker.com/r/brianpugh/raiblocks-docker/)


## Support

Feel free to change your representative to my Nano node `xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj` to support further decentralization within the Nano network. In case of problems, please send an [issue](https://github.com/dbachm123/nanoNodeMonitor/issues). You might also find me on [r/nanocurrency](https://www.reddit.com/r/nanocurrency/) and [r/nanodev](https://www.reddit.com/r/NanoDev/comments/7x87tu/phpnodexrai_node_monitor_tool_now_with_nano/) on reddit. 

Donations are welcome to: [xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj](https://www.nanode.co/account/xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj)

Have fun! :)





