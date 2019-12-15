#! /bin/bash
case $(head -n1 /etc/issue | cut -f 1 -d ' ') in
    Debian)     type="debian" ;;
    Ubuntu)     type="ubuntu" ;;
    Amazon)     type="amazon" ;;
    *)          type="rhel" ;;
esac
#Firstly, install original vestacp
./install/vst-install-$type.sh -a no -n yes -w yes -f
#Replace by our modified source code
cp -r * /usr/local/vesta/
#/usr/local/vesta/php/bin/php /usr/local/vesta/softaculous/cli.php --repair
