#!/bin/bash

client=$1

export ANSIBLE_HOST_KEY_CHECKING=false
ansible-playbook -i $dir/ansible_hosts -l $client facts.yml
