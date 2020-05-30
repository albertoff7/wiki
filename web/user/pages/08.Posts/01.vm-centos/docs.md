---
title: 'Virtualbox Centos'
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

#### Habilitar virtualización anidada VirtualBox

Listar el nombre e ID de las VMs creadas con Virtualbox en nuestro host afitrión, esto lo haremos con la utilizada de comandos de VBoxManage.exe de Virtualbox. En el caso de Windows, desde una CMD accedemos a la ruta donde se encuentra este binario.
```bash
C:\Program Files\Oracle\VirtualBox
```
Listamos las VMs disponibles.
```bash
VBoxManage list vms
```
Modificamos la característica de la VM seleccionada, forzando así que se habilite la virtualización anidada con el parámetro --nested-hw-virt on.
```bash
VBoxManage modifyvm "Nombre-VM o {ID-VM}" --nested-hw-virt on
```

#### Aumentar un disco en una máquina virtual
```bash
#Ir a la ruta donde esta el fichero del disco duro
cd C:\Users\Alberto\VirtualBox VMs\Centos8v2 clonar\

#Ejecutar comando
"C:\Program Files\Oracle\VirtualBox\VBoxManage.exe" modifyhd "Centos8v2 clonar.vdi" --resize 100194
0%...10%...20%...30%...40%...50%...60%...70%...80%...90%...100%
```
