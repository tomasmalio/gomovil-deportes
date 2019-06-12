#!/bin/bash
username=$(cat /etc/passwd | grep Apache | awk -F':' '{print $1}')
if [ -n "$username" ]; then
	sudo -u root chown -R $username:$username assets/
	sudo -u root chown -R $username:$username css/
	sudo -u root chown -R $username:$username less/
	sudo -u root chown -R $username:$username tmp/
fi