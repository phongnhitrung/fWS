---
# __SO SÁNH LITESPEED VS NGINX VS APACHE__
---

## __1. Chức năng__

|                 |                          | LITESPEED   | APACHE      | NGINX       | FWS         |
| --------------- | ------------------------ | ----------- | ----------- | ----------- | ----------- |
| Static content  | HTTP1                    | yes         | yes         | yes         | yes         |
|                 | HTTPS                    | yes         | yes         | yes         | yes         |
|                 | HTTP2                    | yes         | yes         | yes         | yes         |
|                 | compressed content       | yes         | yes         | yes         | yes         |
|                 | encoding content         | yes         | yes         | yes         | yes         | 
| Dynamic content | FPM-PHP                  | yes         | yes         | yes         | yes         |
|                 | Python                   | yes         | yes         | yes         | yes         |
|                 | Perl                     | yes         | yes         | yes         | yes         |
|                 | Django                   | yes         | yes         | yes         | yes         |
|                 | GRPC                     | no          | no          | yes         |             |
|                 | WEBSOCKET                | yes         | yes         | yes         | yes         |
|                 | Java scripting           | yes         | yes         | yes         | yes         |
|                 | Lua scripting            | yes         | yes         | yes         | yes         |
|                 | WSCGI                    | yes         | yes         | yes         | yes         |
|                 | SCGI                     | yes         | yes         | yes         | yes         |
|                 | MEMCACHED                | yes         | yes         | yes         | yes         |
| Streaming       | FLV                      | yes         | yes         | yes         | yes         |
|                 | HDS                      | no          | yes         | yes         |             |
|                 | HLS                      | no          | yes         | yes         |             |
|                 | RTMP                     | no          | no          | yes         |             |
|                 | DASH                     | no          | no          | yes         |             |
|                 | MP4                      | yes         | yes         | yes         | yes         |
| Caching         | static cache             | yes         | yes         | yes         | yes         |
|                 | dynamic                  | yes         | yes         | yes         | yes         |
|                 | cache control            | yes         | yes         | yes         | yes         |
| Load balancer   | L7 LB                    | yes         | yes         | yes         | yes         |
|                 | L4 LB                    | yes         | yes         | yes         | yes         |
|                 | Round robin LB           | yes         | yes         | yes         | yes         |
|                 | Least connect LB         | yes         | yes         | yes         | yes         |
|                 | Session persistence LB   | yes         | yes         | yes         | yes         |
|                 | Passive healthcheck      | yes         | yes         | yes         | yes         |
|                 | Active healthcheck       | no          | yes         | yes         |             |
| Security        | Rate limit               | yes         | yes         | yes         | yes         |
|                 | WAF integration          | yes         | yes         | yes         | yes         |
|                 | Access Control (ACL)     | yes         | yes         | yes         | yes         |
|                 | Captcha                  | yes         | yes         | yes         | yes         |
|                 | SSO                      | no          | yes         | yes         |             |
| Usability       | Zero downtime reload     | yes         | yes         | yes         | yes         |
|                 | Statistic                | yes         | yes         | yes         | yes         |
|                 | Optional Logging         | yes         | yes         | yes         | yes         |
|                 | Realtime statistic       | yes         | yes         | yes         | yes         |


## __2. Hiệu năng__

Các bài đo trên cấu hình phần cứng: Intel Xeon CPU E7- 4870 4 Core @ 2.40GHz; 4GB RAM. 

Tham khảo số liệu tại https://blog.litespeedtech.com/2018/03/05/compare-openlitespeed-to-nginx-and-apache/

|                               | LITESPEED   | APACHE      | NGINX       | FWS         |
| ----------------------------- | ----------- | ----------- | ----------- | ----------- |
| Small static file (<4k)       | 40k rps     | 12k rps     | 26k rps     | 550k rps    |
| Wordpress                     | 22k rps     | 2k rps      | 9k rps      | 316k rps    |


