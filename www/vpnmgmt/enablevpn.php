<?php
// echo "Enabling VPN service...";
// remove disabled marker file
$result = unlink('/var/www/vpnmgmt/vpn.disabled');
// set openvpn service to start automatically on boot
$result = shell_exec('sudo update-rc.d openvpn enable');
// remove any existing nat postrouting rules
$result = shell_exec('sudo iptables -t nat -F POSTROUTING');
// add nat postrouting rule for tun0
$result = shell_exec('sudo iptables -t nat -A POSTROUTING -o tun0 -j MASQUERADE');
// save iptables
$result = shell_exec("sudo su -c 'iptables-save > /etc/iptables/rules.v4'");
?>
