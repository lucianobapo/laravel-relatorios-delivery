#!/bin/sh
#fix to Monolog files
chgrp www-data -R storage/logs/
chmod -R ug+w storage/logs/
chmod -R o-w storage/logs/

find storage/logs/ -type f -exec chmod ugo-x {} \;
find storage/logs/ -type d -exec chmod ugo+x {} \;

find storage/logs/ -type f -exec chmod g-s {} \;
find storage/logs/ -type d -exec chmod g+s {} \;

setfacl -dR -m u::rwx storage/logs/
setfacl -dR -m g::rwx storage/logs/

#fix to Bootstrap cache files
chgrp www-data -R bootstrap/cache/
chmod -R ug+w bootstrap/cache/
chmod -R o-w bootstrap/cache/

find bootstrap/cache/ -type f -exec chmod ugo-x {} \;
find bootstrap/cache/ -type d -exec chmod ugo+x {} \;

find bootstrap/cache/ -type f -exec chmod g-s {} \;
find bootstrap/cache/ -type d -exec chmod g+s {} \;

setfacl -dR -m u::rwx bootstrap/cache/
setfacl -dR -m g::rwx bootstrap/cache/