---
title: Utils
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

Colección general de comandos y utilidades

```bash
## Crear archivo de 98MB
dd if=/dev/zero of=BORRAME.txt bs=1024 count=100000

## Date Eval AHORA
AHORA='date +"[%Y-%m-%d %T] [%A %d %B %Y]"'
echo "$(eval ${AHORA}) Fin script" >> $LOG_RESUMEN

## Fecha de ayer en PERL
FECHAAYER=`perl -e 'use POSIX qw(strftime); print strftime "%Y%m%d", localtime(time()-24*3600);'`

## Crear JavaDump de un proceso Java
/usr/jdk/jdk1.7.0_171/bin/jmap -dump:file=10082018_TEST.heap.hprof 16969

## Agregar/Borrar/Ver una ruta
ip route add 172.43.0.0/22 via 172.56.2.1
ip route del 172.43.0.0/22
ip route show

## Asignar IP con ifconfig
ifconfig eth0 172.16.25.125

## Asignar Mascara de red
ifconfig eth0 netmask 255.255.255.224

## Asignar broadcast
ifconfig eth0 broadcast 172.16.25.63

## Asignar los tres anteriores
ifconfig eth0 172.16.25.125 netmask 255.255.255.224 broadcast 172.16.25.63

## TCP DUMP
tcpdump -i ens1 -p icmp
tcpdump -vvv -i ens1 -p icmp -s 0 -e -w prueba.tcpdump

## Cambiar password en un comando
echo redhat | passwd --stdin root

## ARP
arp -an

## Secuencia del 1 al 3 con for en una línea
for i in $(seq 1 3); do sha1sum /dev/zero & done

## Cambiar MTU de una interfaz de red
ifconfig ens3 mtu 1400

## Escritura a disco
iostat
iotop

## Esperar hasta que un archivo se cree
while [ $(ls /var/log/sa | wc -l) -eq 0 ]; do sleep 1s; done

## NEXT
```

