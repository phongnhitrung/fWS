FWS User Guide
---
1. Architecture of web-server
-->/usr/fws/
	|                  |-->/usr/fws/bin/: Executable files and running scripts of web-server
|                  |                         |-->/usr/fws/bin/fws_core: Executable file of web-server
|                  |                         |-->/usr/fws/bin/fws_cli_core: CLI of web-server
|                  |-->/usr/fws/config/: Configuration files of web-server
|                                                |-->/usr/fws/config/fws.conf: TCP/IP stack config for web-server
|                                                |-->/usr/fws/config/main.conf: HTTP layer main config for web-server (include config for websites)
|                                                |-->/usr/fws/config/sites/: Config for websites
|-->/usr/bin/
|                  |-->/usr/bin/fws: running script of web-server
|                  |-->/usr/bin/fws_cli: running CLI script of web-server
|-->/data/fws/: Store logs and cached files when running web-server
                      |-->/data/fws/cached/: Store cached files
                      |-->/data/fws/rotated_logs/: Store rotated logs
                      |-->/data/fws/logs: Store current logs of web-server
                                                   |-->/data/fws/logs/access\[0-N\].log: Access log (N access logs for N cores of web-server)
                                                   |-->/data/fws/logs/error\[0-N\].log: Error log (error, warning and info message when loading configuration) 
                                                   |-->/data/fws/logs/system\[0-N\].log: System log (handle exceptions messages)
                                                   |-->/data/fws/logs/stats\[0-N\].log: Statistic log
                                                   |-->/data/fws/logs/stderr.log: Debug and backtrace log of web-server
2. Config application
##2.1 Config TCP/IP stack for application
```
host-ipv4-addr=<ipv4 address assigned for webserver>
netmask-ipv4-addr=<ipv4 subnet mask of webserver>
gw-ipv4-addr=<ipv4 gateway address of webserver>
host-ipv6-addr=<ipv6 address assigned for webserver>
gw-ipv6-addr=<ipv6 gateway address of webserver>
netmask-ipv6-addr=<ipv6 subnet mask of webserver>
drop_limited_packet=<advanced options: set 1 for rate limit and anti-synflood at TCP/IP stack>
```
##2.2 Config HTTP layer for application
```
client_body_timeout <Timeout for waiting to receive a request. If loading request time is over this parameter, the request will be deny to protec from Slow DDOS attack types>
include <configuration file for a certain website>
```
##2.3 Config websites
###2.3.1General template config
```
server {
    listen       <service port of website>
    server_super_name <Advanced option: This option is used to permit a sub-domain inheriting all configs of main domain>
    server_name  <domain or sub-domain of website>

    ssl_certificate <Path to PEM ceriticate file for HTTPS website>
    ssl_certificate_key <Path to PEM private key file for HTTPS website>
    access_logging on #Permit or not permit to dump access log for the website

    location / {
				        <Config for features: reverse proxy, antiddos layer7, statistic caching>
    }
}
```
###2.3.2 Reverse proxy config

```
upstream <upstream name for this website> {
    <ip address of backend 1>:<port of backend 1>
    ...
    <ip address of backend N>:<port of backend N>
}
server {
    ...

    location / {
				        ...
        proxy_pass on
        server_addr <upstream name for this website>                        
				        ...                     
    }
}
```
###2.3.2 Statistic caching config

```

```
###2.3.3 AntiDDOS layer7 config
```
server {
    ...

    location / {
				        ...
        domain_conn_limit <limit maximum concurrent connections for this website>   
        domain_track_itv 10   
        domain_recent_limit <limist maximum connections can be created in 10s for this website>
        domain_recent_limit <limist maximum requests can be created in 10s for this website>
        
        testcookie on #Using this option to prevent from fromcrawlers/tools scanning this website
        testcookie_whiteuri <white URI> #Using this option to bypass a certain URI in this website from AntiDDOS Layer7 feature (For example: API links for mobile application of this website)
        testcookie_whiteip <white IP> #Using this option to bypass a certain IP from AntiDDOS Layer7 feature for this website(For example: IP of Google Bot)
				        ...                     
    }
}
```
3. Bash commands of web-server
- Start web-server: `fws`
- Start CLI:  `fws_cli`
- Reload config: `pidof fws_core | xargs kill -1`
- Rotate log: `pidof fws_core | xargs kill -USR1`
- Dump pcap for traffic of webserver:  `pidof fws_core | xargs kill -USR2`
4. CLI commands of web-server: Advanced features (updating)
