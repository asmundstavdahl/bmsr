Brain Memory Strain Relief
==========================

Dev setup
---------
```sh
composer install
# ???
bin/console app:populate 5
screen -dmS bmsr bin/console server:run
firefox localhost:8000
# ???
screen -r bmsr
# Ctrl+A, d
# ???
# profit
```
