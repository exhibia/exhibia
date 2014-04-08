#!/bin/bash

export CRONPATHPAS=/var/www/html/    
export PLUGINS=$CRONPATHPAS/include/addons
cd $CRONPATHPAS

    rm update_results.json -f 2> /dev/null
    if [[ "pgrep -flx 'php -q update_records.php'" ]]
    then
    #    echo "Restarting timers"
    #    kill $pid
    kill `pgrep -flx 'php -q update_records.php'` 2>/dev/null
    
        break
    fi
    php -q update_records.php > /dev/null &

    if [[ "pgrep -flx 'php -q update_butler.php'" ]]
    then
    #   echo "Restarting Auto Bidder"
    kill `pgrep -flx 'php -q update_butler.php'` 2>/dev/null
    
   
        break
    fi
   php -q update_butler.php > /dev/null &
 
    cd $PLUGINS/autolister
    if [[ "pgrep -flx 'php -q update_autolister.php'" ]]
    then
    #   echo "Restarting Auto Bidder"'
    kill `pgrep -flx 'php -q update_autolister.php'` 2>/dev/null
        break
    fi
    php -q update_autolister.php > /dev/null &

    
    cd $PLUGINS/set_and_forget
    if [[ "pgrep -flx 'php -q update_set_and_forget.php'" ]]
    then
    #   echo "Restarting Auto Bidder"
	  
#	  kill `pgrep -flx 'php -q update_set_and_forget.php'` 2>/dev/null
        break
    fi
#   php -q update_set_and_forget.php > /dev/null &

    if [[ "pgrep -flx 'php -q update_bingo.php'" ]]
    then
    #   echo "Restarting Auto Bidder"
	  
	  kill `pgrep -flx 'php -q update_bingo.php'` 2>/dev/null
        break
    fi
#   php -q update_bingo.php > /dev/null &
   
   
