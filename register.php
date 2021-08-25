<?php

// General vars
$key = '';
$datetime = date("Y-m-d_G-i-s");
$nodefile = "cache/nodes.txt";
$ansiblefile = "cache/ansible_hosts";

// Get client IP
$ip = $_SERVER['REMOTE_ADDR'];

// Use hstname if specified
if (isset($_GET['name'])) {
    $name = $_GET['name'];
} else {
    $name = 'client_' . $datetime;
}

// Exit if nodename already taken
if ( exec("grep '^" . $name . "$' " . $nodefile) ) {
    exit("echo 'Node already exists'\n");
}

// Add to nodefile & ansible
file_put_contents($nodefile, $name . "\n", FILE_APPEND);
file_put_contents($ansiblefile, $name . "    ansible_host='" . $ip . "'\n", FILE_APPEND);

// Add ssh key to client
echo "echo 'Adding SSH Pub Key'\n";
echo "grep -q '" . $key . "' /root/.ssh/authorized_keys || echo '" . $key . "' >> /root/.ssh/authorized_keys\n";
echo "chmod 600 /root/.ssh/authorized_keys\n";

// Now run collect.sh to gather client information
//    bash collect.sh $name
?>
