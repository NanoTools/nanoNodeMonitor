# phpNodeXRai

phpNodeXRai is a server-side PHP-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

![phpNodeXRaiImage](https://i.imgur.com/yqxnKfI.png) 

Currently, the following information is displayed:
* Current block number
* Number of unchecked blocks
* Number of peers
* System load
* Node address
* Balances
* Voting weight
* Representative 

## Installation

To use phpNodeXRai, you will need to setup a Nano node and a webserver on the same machine.

### Prepare Nano node

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

### Prepare your webserver


In your webserver directory, e.g. `/var/www/html`, execute 
`git clone https://github.com/dbachm123/phpNodeXRai .` (notice the '.' at the end!), so that `index.php` is callable via http://[your-ip-address]/index.php

You can modify the IP-address and the port for the RPC  in the file `config.php` - it should match the entries in `RaiBlocks/config.json`, see above. Here, you can also specify your Nano donation account. 

If you are running a Nano node on an Ubuntu 16.04 DigitalOcean system using Nginx as webserver, here is a step-by-step list of tutorials to get you started:

* [How to run your own Nano node on DigitalOcean](https://medium.com/@seanomlor/how-to-run-your-own-raiblocks-node-on-digitalocean-6a5a2492c29b)

* [How To Install Linux, Nginx, MySQL, PHP (LEMP stack) in Ubuntu 16.04](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04) (mysql not needed)

* You might need to additionally install php7.0-curl, i.e. `sudo apt-get install php7.0-curl`


## Support

Feel free to change your representative to my Nano node `xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj` to support further decentralization within the Nano network. In case of problems, please send an [issue](https://github.com/dbachm123/phpNodeXRai/issues). 

Donations are welcome to: [xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj](https://www.nanode.co/account/xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj)

Have fun! :)





