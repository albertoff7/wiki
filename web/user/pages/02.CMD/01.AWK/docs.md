---
title: AWK
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

AWK diseñado para procesar datos basados en texto, ya sean ficheros o flujos de dato.

### Colección AWK

###### Columna mayor que un valor (tiempo de acceso)
```bash
awk '{ if($11 > 60000000) print $0;}' access_log.2016-03-02
awk '{ if( $9 == 200 ) print $0;}' access_log.2016-03-02
echo "uno dos" | nawk -v var1="${var_1}" -v var2="${var_2}" '{ if( $1 == var1 ) print $0;} {print var2}'
```
###### Busqueda multiple (alternativa a grep)
```bash
nawk -v MAQUINA="${MAQUINA}" -v EVENTO="${EVENTO}" -v OK="${OK}" 'BEGIN{FS=":|;|]"; OFS=";"} $3 == MAQUINA && $4 == EVENTO && $5 == OK {print $1}'
```
###### Media aritmética awk
```bash
awk 'BEGIN {FS = ",[ \t]*|[ \t]+" } { s += $1; print $2, $1 } END { print s/NR}'
```
```bash
for i in 1
	do
		echo 0
		echo 10
	done | awk 'BEGIN {FS = ",[ \t]*|[ \t]+" } { s += $1; print $2, $1 } END { print "La suma es ", s , "La media es ", s/NR}'
```
###### Número más alto
```bash
awk '$1 > max { max=$1; linea=$6 }; END { print max, linea}'
```
###### Palabra como separador FS
```bash
echo "holaadiospaco" |nawk -F'adios' '{print $2}'
```
###### Rango de campos
```bash
nawk '{ for (x=7; x<=20; x++) {  printf "%s ", $x } printf "\n" }'
```
###### Sumar campos
```bash
| awk '{ sum += $1 } END { print sum }'
```

###### Lineas anteriores posteriores NAWK
```bash
nawk 'c-->0;$0~s{if(b)for(c=b+1;c>1;c--)print r[(NR-c+1)%b];print;c=a}b{r[NR%b]=$0}' b=2 a=4 s="java" archivo_log.log
```
