---
title: 'RHCSA 8'
---

RHCSA es la certificación oficial de Administrador de Sistemas RHEL. A continuación se detallan algunos de los puntos clave de estudio en la preparación del exámen oficial EX200.

### 1. Arranque
#### 1.1 Restaurar contraseña de root.
Es muy posible que al hacernos cargo como administradores de un host RHEL, no sepamos cual es la contraseña de root.

##### Procedimiento restaurar root password:

```bash
## Romper el arranque por defecto de la máquina en la carga del grub. 
## Añadimos rd.break al final de la línea.
linux16 /vmlinuz-3.10.0-514.el7.x86_64 root=/dev/mapper/cl-root ro crashkernel=auto rd.lvm.lv=cl/root rd.lvm.lv=cl/swap rhgb quiet LANG=en_US.UTF-8 rd.break

## Montamos /sysroot.
mount -o remount,rw /sysroot

## Accedemos con chroot
chroot /sysroot/

## Cambiamos la password.
passwd

## Etiquetamos el disco con autorelabel.
touch /.autorelabel

## Reinciamos el sistema.
systemctl reboot (exit/exit)
```

#### 1.2 Modos de arranque.
- Cuando el FSTAB está dañado, es posible que el sistema no arranque.
- Se puede forzar al sistema para arranque en un modo diferente al establecido por defecto.
- Las diferencias entre cada modo están relacionadas con el nivel de recursos que carga.
- Los dos modos más usados son `emergency` y `rescue`.

##### Procedimiento restaurar FSTAB:

```bash
## Añadir al final de la línea systemd.unit=emergency.target.
linux16 /vmlinuz-3.10.0-514.el7.x86_64 root=/dev/mapper/cl-root ro crashkernel=auto rd.lvm.lv=cl/root rd.lvm.lv=cl/swap rhgb quiet LANG=en_US.UTF-8 systemd.unit=emergency.target
        
<introducir password de root>

## Montar sistema raiz.
mount -o remount,rw /

## Forzar montaje de fstab para tratar de identificar la línea con error.
mount -a
mount:mount point /fail does not exist

## Modificar fstab corrigiendo el error.
vi /etc/fstab

## Montar sistemas de archivos y reiniciar sistema.
mount -a
systemctl reboot (exit/exit)
```

#### 1.3 Restaurar GRUB.
En ocasiones el GRUB (menú cargador de arranque) puede presentar un fallo y el sistema puede no arrancar.
El siguiente comando puede generar un archivo GRUB, que posteriormente deberá copiarse sobre el original.

```bash
## Generar grub
grub2-mkconfig > /tmp/grub.cfg

## Archivo grub que lee el sistema
/boot/grub2/grub.cfg
```

### 2. Conectar a una RED con nmcli
Nmcli es una utilidad para gestionar las interfaces de red del sistema. Una de las principales tareas de un administrador es la de "atachar" un sistema a una red para permitir la comunicación con otros hosts.
#### 2.1 nmcli.
A continuación la compilación de comandos para conectar una red.

```bash
## Ver los dispositivos
nmcli dev

## Ver las conexiones
nmcli con show

## Agregar una conexión
nmcli con add con-name lab ifname ens3 type ethernet ipv4.method manual ipv4.address 172.25.250.11/24 ipv4.gateway 172.25.250.254 ipv4.dns 172.25.250.254

nmcli con mod "lab" connection.autoconnect yes
nmcli con up lab


```

#### 2.2 Ficheros.
Todas las configuraciones se guardan en ficheros en la ruta `/etc/sysconfig/network-scripts`.

```bash
[root@localhost network-scripts]# pwd
/etc/sysconfig/network-scripts
[root@localhost network-scripts]# cat ifcfg-enp0s3 
TYPE="Ethernet"
PROXY_METHOD="none"
BROWSER_ONLY="no"
BOOTPROTO="dhcp"
DEFROUTE="yes"
IPV4_FAILURE_FATAL="no"
IPV6INIT="yes"
IPV6_AUTOCONF="yes"
IPV6_DEFROUTE="yes"
IPV6_FAILURE_FATAL="no"
IPV6_ADDR_GEN_MODE="stable-privacy"
NAME="enp0s3"
UUID="ac29c7ba-c68e-4742-848c-bc72112f9ff1"
DEVICE="enp0s3"
ONBOOT="yes"
```

### 3. Discos y particiones.
#### 3.1 Particionado estándar.

```bash
## Particionar un disco con etiqueta MSDOS
$ parted /dev/vdb mklabel msdos

## Crear una partición
$ parted /dev/vdb mkpart primary xfs 2048s 1001MB
$ parted /dev/vdb print

## Registrar cambios en el sistema
$ udevadm settle

## Dar formato a la partición
$ mkfs.xfs /dev/vdb1

## Crear punto de montaje
$ mkdir /archive

## Ver particiones de un disco
$ lsblk --fs /dev/vdb
$ lsblk --fs /dev/sda
NAME        FSTYPE      LABEL UUID                                   MOUNTPOINT
sda                                                                  
├─sda1      ext4              6c745ec4-8b9e-43b3-83b3-aa4851f4719b   /boot
└─sda2      LVM2_member       TLwgJj-pVMV-K3g0-17oq-ExG7-pm83-72yTKA 
  ├─cl-root xfs               c21f744c-021b-4ebc-b45d-794631e1c9c7   /
  └─cl-swap swap              4fca73fc-d4a7-427a-b08f-80aa179e36e0   [SWAP]

## Agregarlo al FSTAB
 vim /etc/fstab
  UUID=e3db1abe-6d96-4faa-a213-b96a6f85dcc1   /archive   xfs   defaults   0   0
  
## Recargar systemctl
$ systemctl daemon-reload

## Montar en punto de montaje
$ mount /archive
$ mount | grep /archive

## Montar todos
$ mount -a
```

#### 3.2 Particionado SWAP.

```bash
## Crear una partición SWAP
parted /dev/vdb mkpart myswap linux-swap 1MB 1000MB

## Registrarlo en el sistema
udevadm settle

## Formatear la partición
mkswap /dev/vdb1

## Montar la swap
swapon /dev/vdb1

## Ver partición
lsblk --fs /dev/vdb1

## Montar la partición de forma permanente
vi /etc/fstab
UUID=cb7f71ca-ee82-430e-ad4b-7dda12632328   swap   swap   defaults   0   0

## Recargar systemctl
systemctl daemon-reload
```

#### 3.3 Particionado LVM.

```bash
## Etiquetar un disco como GPT
$ parted -s /dev/vdb mklabel gpt

## Crear particiones
$ parted -s /dev/vdb mkpart primary 1MiB 257MiB
$ parted -s /dev/vdb set 1 lvm on
$ parted -s /dev/vdb mkpart primary 258MiB 514MiB
$ parted -s /dev/vdb set 2 lvm on

## Registrar cambios
$ udevadm settle

## Crear PV
$ pvcreate /dev/vdb1 /dev/vdb2

## Crear VG
$ vgcreate servera_01_vg /dev/vdb1 /dev/vdb2

## Crear LV
$ lvcreate -n servera_01_lv -L 400M servera_01_vg

## Formatear partición creada
$ mkfs -t xfs /dev/servera_01_vg/servera_01_lv

## Crear punto de montaje
$ mkdir /data

## Montar permanente
$ vi /etc/fstab
  /dev/servera_01_vg/servera_01_lv    /data    xfs  defaults  1 2

## Reload systemctl
$ systemctl daemon-reload

## Montar "en caliente"
$ mount /data
```

#### 3.4 Extensión LVM.

```bash
## Ver un VG y su espacio
$ vgdisplay servera_01_vg
$ df -h /data

## Crear una nueva partición y registrarla en LVM
$ parted -s /dev/vdb mkpart primary 515MiB 1027MiB
$ parted -s /dev/vdb set 3 lvm on

## Registrar cambios en el sistema
$ udevadm settle

## Crear PV
$ pvcreate /dev/vdb3

## Extender el VG
$ vgextend servera_01_vg /dev/vdb3
$ vgdisplay servera_01_vg

## Extender el LV
$ lvextend -L 700M /dev/servera_01_vg/servera_01_lv

## Aumentar el sistema de ficheros
 #XFS
$ xfs_growfs /data
 #EXT4
$ resize2fs /dev/vg01/lv01

## Comprobar nuevo espacio en disco
$ df -h /data
```

### 4. ACL
#### 4.1 Gestión de usuarios y grupos.

```bash
## Agregar grupo
groupadd sysgrp

## Agregar usuario a grupo
useradd -G sysgrp andrew
useradd -G sysgrp harry
useradd -G sysgrp natasha

## Agregar usuario sin shell
useradd sarah -s /sbin/nologin

## Cambiar password de usuarios
passwd harry
passwd andrew
passwd sarah
passwd natasha
```

#### 4.2 ACLs.




### 5. Permisos especiales y SELinux
#### 5.1 Permisos especiales Linux.
Los permisos especiales agregan un cuarto tipo de permisos que proporcionan funciones adicionales sobre ficheros y directorios.
##### 5.1.1 Permiso especial SUID (u+s). chmod 4xxx.
- Archivos: El archivo se ejecuta como el usuario propietario del archivo.
- Directorios: No tiene efecto.
- Ejemplo passwd (propietario root)

```bash
## Si el usuario no posee permisos de ejecución la "s" se remplaza por una "S" mayúscula.
[user@host ~]$ ls -l /usr/bin/passwd
-rwsr-xr-x. 1 root root 35504 Jul 16 2010 /usr/bin/passwd
```

##### 5.1.2 Permiso especial SGID (g+s). chmod 2xxx.
- Archivos: El archivo se ejecuta como el grupo propietario, no como el usuario que lo ejecuta.
- Directorios: Los archivos creados en un directorio con éstos permisos heredarán la propiedad de grupos del directorio y no del usuario que la creo.
- Se usa para directorios colaboratios.

```bash
## Si el grupo no posee permisos de ejecución la "s" se remplaza por una "S" mayúscula.
[user@host ~]$ ls -ld /usr/bin/locate
-rwx--s--x. 1 root slocate 47128 Aug 12 17:17 /usr/bin/locate
```

##### 5.1.3 Permiso especial sticky bit (o+t). chmod 1xxx.
- Archivos: Sin efecto
- Directorios: Sólo el propietario de los archivos y root pueden eliminar los archivos dentro de un directorio.
- Ejemplo: El directorio /tmp

```bash
[user@host ~]$ ls -ld /tmp
drwxrwxrwt. 39 root root 4096 Feb 8 20:52 /tmp
```

#### 5.2 Crear y configurar directorios con GID definido para la colaboración.

```bash
## Crear el directorio
mkdir -p /redhat/sysgrp

## Cambiar el grupo del directorio
chgrp sysgrp /redhat/sysgrp

## Agregar permisos especiales
chmod 2770 /redhat/sysgrp

## Crear archivo
touch /redhat/sysgrp/file1
ls -ltr /redhat/sysgrp/file1 --> root sysgrp /redhat/sysgrp/file1
```

#### 5.3 SELinux.
### 6. Almacenamiento VDO, Stratis, autoFS
#### 6.1 VDO.
#### 6.2 Stratis.
#### 6.3 autoFS.
#### 6.4 NFS.
### 7. Otras tareas de administracion
#### 7.1 Gestion de usuarios.
#### Repositorios YUM.
#### NTP.
#### Firewalld.
#### Perfiles de ajuste.
#### Nice/Renice.
#### Journalctl.
#### SSH.