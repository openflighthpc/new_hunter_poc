# New Hunter PoC 

## Usage 

### Register Node 

A client needs to register itself with the server, the simplest way to do so is to simply curl the script from the server and pipe through bash (piping adds the SSH pub key of the server to the client).

```shell
curl http://SERVER_IP/register.php |/bin/bash
```

Additionally, the client can provide it's name to the server with HTTP args

```shell
curl http://SERVER_IP/register.php?name=node01 |/bin/bash
```

### Collect Node Info

Once a node has registered itself, the server can collect all the information from it with the collection script

```shell
bash collect.sh node01
```

### Process

After a node's information has been collected, logical information can be assigned to it, such as:
- IP/network information to interface/mac-addresses
- Node profile (to determine source script directory) 
- Grouping information

Additionally, the software would provide group processing helpers such that multiple nodes can have logical information assigned to them at once. There could be default groupings based off of collected hardware information. For example, nodes can be grouped if they have the same type & count of CPU + the same amount of memory.

### Generate

Once logical configuration information has been assigned to the nodes then build scripts can be generated. 

The concept behind generating the scripts is to simply combine multiple directories of scripts together with a config file containing node-specific variables. Between the bash scripts and the variables there will be a full set of customisations & configurations for the node to be setup.
