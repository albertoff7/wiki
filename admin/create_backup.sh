#!/bin/bash
MARC_TEMP=`date +%d%m%y%H%M%S`
PROYECTO=learn
cd /var/opt/badenpow/learn/web
tar cvf ${PROYECTO}_${MARC_TEMP}.tar * .htaccess
mv ${PROYECTO}_${MARC_TEMP}.tar ../backup
