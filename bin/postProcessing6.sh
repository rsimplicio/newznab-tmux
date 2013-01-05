#!/usr/bin/env bash
set -e

source ../edit_these.sh
eval $( sed -n "/^define/ { s/.*('\([^']*\)', '*\([^']*\)'*);/export \1=\"\2\"/; p }" $NEWZPATH/www/config.php )

while :
do

  echo "Processing Others....." && $PHP processOthers.php &
  echo "Processing Unwanted....." && $PHP processUnwanted.php &

  wait
  sleep 30

done
exit
