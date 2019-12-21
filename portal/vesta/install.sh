#! /bin/bash
case $(head -n1 /etc/issue | cut -f 1 -d ' ') in
    Debian)     type="debian" ;;
    Ubuntu)     type="ubuntu" ;;
    Amazon)     type="amazon" ;;
    *)          type="rhel" ;;
esac
#Firstly, install original vestacp
./install/vst-install.sh --nginx yes --phpfpm yes --apache no --named yes --remi yes --vsftpd no --proftpd yes --iptables yes --fail2ban yes --quota yes --exim yes --dovecot yes --spamassassin yes --clamav yes --softaculous yes --mysql yes --postgresql yes --force
#Replace by our modified source code
cp -r * /usr/local/vesta/
#/usr/local/vesta/php/bin/php /usr/local/vesta/softaculous/cli.php --repair
