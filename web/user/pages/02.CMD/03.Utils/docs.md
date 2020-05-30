---
title: Utils
page-toc:
  active: true
taxonomy:
    category: docs
---

Colección general de comandos y utilidades

```bash
#Crear archivo de 98MB
dd if=/dev/zero of=BORRAME.txt bs=1024 count=100000

#Date Eval AHORA
AHORA='date +"[%Y-%m-%d %T] [%A %d %B %Y]"'
echo "$(eval ${AHORA}) Fin script" >> $LOG_RESUMEN

#Fecha de ayer en PERL
FECHAAYER=`perl -e 'use POSIX qw(strftime); print strftime "%Y%m%d", localtime(time()-24*3600);'`

#Crear JavaDump de un proceso Java
/usr/jdk/jdk1.7.0_171/bin/jmap -dump:file=10082018_TEST.heap.hprof 16969
```
