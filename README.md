# syno-ddns-spdyn-ipv6

custom ddns script to update ipv6 address

how to install

edit `/etc.defaults/ddns_provider.conf`
```
[SPDyn]
        modulepath=/usr/syno/bin/ddns/spdyn.php
        queryurl=https://spdyn.de/
```

---
copy the php script to `/usr/syno/bin/ddns`

make sure the script has execute permission 

`chmod +x /usr/syno/bin/ddns/spdyn.php`