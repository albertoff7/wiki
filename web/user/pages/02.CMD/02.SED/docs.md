---
title: SED
page-toc:
  active: true
taxonomy:
    category: docs
---
#### Utilidades Sed

```bash
#Quitar líneas en blanco
sed '/^$/d' mi_fichero.txt
sed '/./!d' mi_fichero.txt

#Sustituir apóstrofe
sed -e "s/\\'//g"

#Sustituir en un mismo fichero (no Solaris)
sed -i 
