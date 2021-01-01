# Nano Node Monitor

![GitHub release](https://img.shields.io/github/release/NanoTools/nanoNodeMonitor.svg?style=flat-square) [![StyleCI](https://styleci.io/repos/118352667/shield?branch=master)](https://styleci.io/repos/118352667) [![Docker Pulls](https://img.shields.io/docker/pulls/nanotools/nanonodemonitor.svg?style=flat-square)](https://hub.docker.com/r/nanotools/nanonodemonitor/)

Nano Node Monitor is a server-side PHP-based monitor for Nano and Banano nodes. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

![Light](https://i.imgur.com/fbaAFvC.png)

![Dark](https://i.imgur.com/1Gu9ohX.png)

![Banano](https://i.imgur.com/FMO8H9u.png)


## Docker Installation

### Pulling Docker image

    sudo docker pull nanotools/nanonodemonitor

### Running

#### Standalone

    sudo docker run -d -p 80:80 -v ~:/opt --restart=unless-stopped nanotools/nanonodemonitor

This will create a directory called _nanoNodeMonitor_ inside your home directory with the _config.php_ inside it.
Edit it according to your needs and you're good to go!

#### Docker Compose

1. Create a directory called _nano_ and go inside it: `mkdir nano && cd nano`

2. Create a new file called _docker-compose.yml_ with the following contents:

```
version: '3'
services:
  monitor:
    image: "nanotools/nanonodemonitor"
    restart: "unless-stopped"
    ports:
     - "80:80"
    volumes:
     - "~:/opt"
  node:
    image: "nanocurrency/nano"
    restart: "unless-stopped"
    ports:
     - "7075:7075"
     - "127.0.0.1:7076:7076"
    volumes:
     - "~:/root"
```
3. Nice! Now execute `sudo docker-compose up -d` to start everything.

4. Inside your home directory you will find a new directory called _nanoNodeMonitor_, edit the _config.php_: `cd ~/nanoNodeMonitor`

5. You will have to change the node IP to the name of the nodes Docker container e.g. `nano_node_1`. Edit the other things as well if you want to.

6. Done! 

## Manual Installation

### Prerequisites

- Running Nano Node with RPC enabled ([Tutorial](https://docs.nano.org/running-a-node/node-setup/))
- Webserver with PHP 7.2
- PHP-Curl Module

    `sudo apt-get install php-curl`

### Installation

In your empty webserver directory, e.g. `/var/www/html`, execute:

    git clone https://github.com/NanoTools/nanoNodeMonitor .

If you want it to run a subdirectory remove the `.` at the end.

In the `modules` folder, create your own config file by executing:

    cp config.sample.php config.php

## Usage

You will have to add your node's account to the config file `config.php` by modifying the following lines. Make sure to remove the `//` in front of `$nanoNodeAccount`:

```
// account of this node 
$nanoNodeAccount = 'nano_1youraccountname24cq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj';
```


If you are running a standalone node you might need to modify the IP-address and the port for the RPC in the file `config.php`. It should match the corresponding entries in `~/Nano/config.json`, e.g.

```
// ip address for RPC (default: [::1])
$nanoNodeRPCIP   = '127.0.0.1';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';
```

## Creating a Theme

If you're interested in creating your own theme in addition to the official Light,  Dark, and Banano themes, we've made it very simple for you to do so. Check out the [Wiki](https://github.com/NanoTools/nanoNodeMonitor/wiki/Create-a-theme) for more info.

## Support

Donations to the development of Nano Node Monitor are very welcome to: 

    nano_1ninja7rh37ehfp9utkor5ixmxyg8kme8fnzc4zty145ibch8kf5jwpnzr3r

Or [sponsor the development on GitHub](https://github.com/sponsors/BitDesert)! Thanks!