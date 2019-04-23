#!/bin/bash
TEST=$(cat /etc/passwd | grep Apache | awk -F':' '{print $1}')
if ($TEST)
	then
		echo $TEST
fi