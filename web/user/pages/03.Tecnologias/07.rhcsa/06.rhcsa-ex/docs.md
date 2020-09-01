---
title: 'RHCSA 8 Docs'
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
- El modo `emergency` arranca sólo una shell, no inicia servicios ni puntos de montaje. Es bueno para depuración porque permite arrancar el sistema paso a paso.
- En el modo `rescue` todo está montado, pero los servicios no están iniciados. Es equivalente al nivel 1 de ejecución de init.

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

###### Selección de un objetivo diferente en el momento del arranque

```bash
systemd.unit=rescue.target
systemd.unit=emergency.target
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
nmcli dev status

## Ver las conexiones
nmcli con show
nmcli con show --active

## Agregar una conexión ## CITI(MAGD)
nmcli con add con-name lab ifname ens3 type ethernet ipv4.method manual ipv4.address 172.25.250.11/24 ipv4.gateway 172.25.250.254 ipv4.dns 172.25.250.254

## Modificar una conexión
nmcli con mod "lab" connection.autoconnect yes

## Levantar/tirar una conexión
nmcli con up lab
nmcli con down lab

## Recargar conexión
nmcli con reload

## Eliminar una conexión de red
nmcli con del static-ens3

## Visualizar estadísticas de rendimiento
ip -s link show ens3

## Visualizar tabla de rutas
ip route

## Seguimiento de rutas
tracepath google.es

## Identificar puertos abiertos
ss -ta
netstat -an

## Ver dirección IP
ip addr
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

## Agregarlo al FSTAB
 vim /etc/fstab
  UUID=234asdf-34sfa5-24dad-asdf-5sasdbasdf   /archive   xfs   defaults   0   0
  
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
UUID=4adf43-aasd4-as45-ghs76-sfdgd574ghjf6896   swap   swap   defaults   0   0

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
$ vgcreate vg1 /dev/vdb1 /dev/vdb2

## Crear LV
$ lvcreate -n lv1 -L 400M vg1

## Formatear partición creada
$ mkfs -t xfs /dev/vg1/lv1

## Crear punto de montaje
$ mkdir /data

## Montar permanente
$ vi /etc/fstab
  /dev/vg1/lv1    /data    xfs  defaults  1 2

## Reload systemctl
$ systemctl daemon-reload

## Montar "en caliente"
$ mount /data

## Para reducir un volumgroup
vgreduce vg1 /dev/xvdb4

## Para mover datos de un PV a otro PV
pvmove -i2 -v /dev/xvdb4
```

#### 3.4 Extensión LVM.

```bash
## Ver un VG y su espacio
$ vgdisplay vg1
$ df -h /data

## Crear una nueva partición y registrarla en LVM
$ parted -s /dev/vdb mkpart primary 515MiB 1027MiB
$ parted -s /dev/vdb set 3 lvm on

## Registrar cambios en el sistema
$ udevadm settle

## Crear PV
$ pvcreate /dev/vdb3

## Extender el VG
$ vgextend vg1 /dev/vdb3
$ vgdisplay vg1

## Extender el LV
$ lvextend -L 700M /dev/vg1/lv1

## Aumentar el sistema de ficheros
 #XFS
$ xfs_growfs /data
 #EXT4
$ resize2fs /dev/vg1/lv1

## Comprobar nuevo espacio en disco
$ df -h /data
```

### 4. ACL, usuarios de sistema y grupos
#### 4.1 Gestión de usuarios y grupos.

```bash
## Agregar grupo
groupadd grupo1

## Agregar usuario a grupo
useradd -G grupo1 alberto

## Agregar usuario sin shell
useradd alberto2 -s /sbin/nologin

## Cambiar password de usuarios
passwd alberto
```

#### 4.2 ACLs.
- Las ACLs en linux son permisos especiales adicionales de usuarios y/o grupos nominales que se agregan a ficheros y/o directorios.
- Los sistemas de archivos tienen que tener habilitada la compatibilidad con ACL, en RHEL8 xfs, ext3 y ext4 tienen habilitada ésta característica por defecto.
- El permiso de ejecución en un directorio habilita la búsqueda dentro del mismo.
- La máscara ACL define los permisos máximos del directorio o archivo para usuarios nombrados, propietario del grupo y grupos nombrados.
- La X en los permisos se utiliza de forma recursiva para asignar permiso de ejecución a directorios (para permitir la búsqueda dentro de ellos).
- Los permisos del propietario del archivo de ACL y el propietario del archivo estándar son equivalentes, se puede usar indistintamente `chmod` y `setfacl`.
- Los permisos de otro de ACL y otro éstandar son equivalentes, se puede usar indistintamente `chmod` y `setfacl`.

##### Visualizar la configuración ACL de un archivo

```bash
$ getfacl reports.txt
# file: reports.txt
# owner: user
# group: operators
user::rwx
user:alberto:---
user:1005:rwx #effective:rwgroup::rwx #effective:rwgroup:alberto:r--
group:2222:rwx #effective:rwmask::rwother::---
```

##### Adición o modificación de la ACL

```bash
setfacl -m u:name:rX file
```

##### Uso de getfacl como entrada

```bash
$ getfacl file-A | setfacl --set-file=file-B
```

##### Configurar una máscara explícita
Restringe a cualquiera de los usuarios nombrados, el propietario del grupo y cualquiera de los grupos nombrados a permiso de solo lectura, independientemente de su configuración existente. Los usuarios propietario del archivo y otro no se ven afectados por la máscara.

```bash
$ setfacl -m m::r file
```

##### Modificaciones ACL recursivas

```bash
$ setfacl -R -m u:name:rX directory
```

##### Eliminación de ACL

```bash
## Para eliminar una entrada
$ setfacl -x u:name,g:name file

## Para eliminar todas las entradas
$ setfacl -b file
```

#### 4.3 ACLs predeterminadas.
- Se utilizan para que los archivos y directorios creados dentro de un directorio hereden ACLs.
- El directorio debe tener su propia ACL, ya que la ACL predeterminada sólo aplica a la herencia dentro del directorio.

```bash
setfacl -m d:u:name:rx directory
```

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
mkdir -p /redhat/grupo1

## Cambiar el grupo del directorio
chgrp grupo1 /redhat/grupo1

## Agregar permisos especiales
chmod 2770 /redhat/grupo1

## Crear archivo
touch /redhat/grupo1/file1
ls -ltr /redhat/grupo1/file1 --> root grupo1 /redhat/grupo1/file1
```

#### 5.3 SELinux.
- SELinux proporciona funciones de seguridad adcionales a los permisos basado en objetos, que deniega o permite el acceso a archivos y recursos del sistema.
- Son conjuntos de políticas que controlan cómo se usa un archivo o recurso.
- Tiene 3 modos, enforcing (activado y estableciendo control), permissive (activado y reportando abusos) y disabled (deshabilitado). 
- Muchos comandos (cp, ps, ls, etc) utilizan la opción `-Z` para mostrar o configurar contextos SELinux.

##### 5.3.1 Cambiar modo SELinux

```bash
## Obtener modo
getenforce

## Configurar modo
setenforce 1 (Enforcing)
setenforce 0 (Permissive)

## Si lo queremos configurar al arrancar, pasando un parámetro al kernel.
enforcing=0 | enforcing=1
selinux=0 | selinux=1

## Configurarlo de forma persistente
/etc/selinux/config
```

##### 5.3.2 Contextos
- Un contexto es una etiqueta de seguridad aplicada a un proceso, un archivo/directorio o un puerto.

```bash
## Cambiar el contexto de forma persistente
## -a (add), -d (delete), -l (list)
semanage fcontext -l
semanage fcontext -a -t httpd_sys_content_t '/data1(/.*)?'

## Restaurar contextos definidos
restorecon -RFv /data1

## Expresión semanage fcontext más utilizada, aplica al directorio y recursivamente en él.
(/.*)?
```

##### 5.3.3 Booleanos
- Modifican el comportamiento de la política de SELinux.

```bash
## Enumerar booleanos
getsebool -a
abrt_anon_write --> off
abrt_handle_event --> off
abrt_upload_watch_anon_write --> on

## Modificar booleanos
setsebool -P httpd_enable_homedirs on
#(-P para hacer persistentes los cambios en los reinicios)

## Ver booleanos
semanage boolean -l | grep httpd_enable_homedirs
httpd_enable_homedirs (on , on) Allow httpd to enable homedirs 

## Ver booleanos cuyo estado difiere del predeterminado
semanage boolean -l -C
```

##### 5.3.4 Resolución de problemas SELinux
- Utiliza el comando `sealert` para visualizar información relativa a alertas SELinux.
- Uno de los problemas más comunes es el de un contexto de archivos incorrecto.

```bash
## Ver alertas
sealert -a /var/log/audit/audit.log
sealert -l 23sdfvad-248d-48a2-a7d9-r42odk27shnle8
ausearch -m AVC -ts recent
```

##### 5.3.5 SELinux y puertos (etiquetado)
- El control de puertos mediante SELinux verifica si un proceso tiene permitido utilizar dicho puerto, en base a una etiqueta.

```bash
## Listado de etiquetas de puertos
semanage port -l

## Administración de etiquetas
## -a (add), -d (delete), -l (list)
semanage port -a -t http_port_t -p tcp 82
```
### 6. Almacenamiento VDO, Stratis, NFS, autoFS
#### 6.1 VDO.
- VDO reduce y optimiza el espacio en disco, aumenta el rendimiento.
- Se sitúa una capa por encima de "RAID Layer" y sobre VDO se puede utilizar LVM para gestionar particiones.

```bash
## Instalar VDO
yum install vdo kmod-kvdo

## Creación de volumen VDO
## (Si me omite el tamaño físico, el volumen VDO tendrá el mismo tamaño que el dispositivo físico)
vdo create --name=vdo1 --device=/dev/vdd --vdoLogicalSize=100G

## Estado de un volumen VDO
vdo status --name=vdo1

## Ver estadísticas de un volumen VDO
vdostats --human-readable

## Formatear VDO con XFS
mkfs.xfs -K /dev/mapper/vdo1

## Montar en fstab
lsblk --output=UUID /dev/mapper/labvdo
UUID=ef8c...39b1 /labvdovol xfs defaults,x-systemd.requires=vdo.service 0 0
```

#### 6.2 Stratis.
- Permite crear un pool al que asignar discos y crear FS.
- Es un tipo de almacenamiento dinámico.

```bash
## Instalar stratis
yum install stratis-cli stratis

## Habilitar el servicio
systemctl enable --now stratisd

## Crear un pool stratis
stratis pool create pool1 /dev/vdb

## Ver lista de pools
stratis pool list

## Agregar dispositivos de bloque a un pool
stratis pool add-data pool1 /dev/vdc

## Ver dispositivos de bloque de un pool
stratis blockdev list pool1

## Crear FS en stratis
stratis filesystem create pool1 filesystem1

## Crear snapshot
stratis filesystem snapshot pool1 filesystem1 snapshot1

## Ver FS disponibles
stratis filesystem list

## Montar stratis de forma persistente 
## (retrasa el montaje hasta iniciar el servicio stratisd)
UUID=31b9...8c55 /dir1 xfs defaults,x-systemd.requires=stratisd.service 0 0

## Destruir stratis
stratis filesystem destroy stratispool1 stratis-filesystem1
```

#### 6.3 NFS.
- Sistema de archivos en red que admite características nativas de sistemas de archivos y permisos Linux/Unix.
- La versión predeterminada en RHEL 8 es NFSv4.2. 
- NFSv2 ya no se admite.
- Utiliza el protocolo TCP para comunicarse con el servidor.

```bash
## Montar disco NFS
sudo mount -t nfs -o rw,sync serverb:/share /share-client

## Montar en FSTAB
serverb:/share /share-client nfs rw,soft 0 0
mount /share-client
```

###### nfsconf
- Herramienta para gestionar los archivos de configuración de cliente y servidor NFS.
- Configuración en `/etc/nfs.conf`.

```bash
## Obtener valor NFS
sudo nfsconf --get nfsd vers4.2

## Actualizar valor NFS
nfsconf --set nfsd vers4.2 y

## Quitar valor NFS
sudo nfsconf --unset nfsd vers4.2

## Para configurar un cliente NFS
sudo nfsconf --set nfsd udp n
sudo nfsconf --set nfsd vers2 n
sudo nfsconf --set nfsd vers3 n

sudo nfsconf --set nfsd tcp y
sudo nfsconf --set nfsd vers4 y
sudo nfsconf --set nfsd vers4.0 y
sudo nfsconf --set nfsd vers4.1 y
sudo nfsconf --set nfsd vers4.2 y
```

#### 6.4 autoFS.
- No están conectados permanentemente, lo que libera recursos de red y sistemas.
- Se configura en el lado del cliente.
- NFS es el sistema de archivos predeterminado para autoFS, aunque pueden utilizarse otros también.

```bash
## Instala autofs
yum install autofs

## Habilitar servicio
systemctl enable --now autofs

## Agregar archivo de asignación maestra en /etc/auto.master.d (debe tener extensión .autofs)
vi /etc/auto.master.d/demo.autofs

	## Montaje indirecto
	/shares /etc/auto.indirect
		## Archivo de asignación /etc/auto.indirect
   		 vi /etc/auto.indirect
    	 test1 	-rw,sync 	serverb:/shares/test1
         
    ## Montaje indirecto de comodines
    /shares /etc/auto.indirect
    	## Archivo de asignación /etc/auto.indirect
   		 vi /etc/auto.indirect
    	 *	-rw,sync	serverb:/shares/&
    
	## Montaje directo (el directorio /mnt existe, autofs creará y eliminará automáticamente el directorio /mnt/docs
    /- /etc/auto.direct
    	## Archivo de asignación /etc/auto.direct
        /NFS_MOUNT/docs 	-rw,sync 	serverb:/shares/docs
```

### 7. Otras tareas de administracion
#### 7.1 Gestion de arranque
##### Modos de arranque y sistemctl
```bash
## Listar dependencias de un modo
systemctl list-dependencies graphical.target | grep target
graphical.target
* └─multi-user.target
* ├─basic.target
* │ ├─paths.target
* │ ├─slices.target
...output omitted...

## Listar objetivos/modos disponibles
systemctl list-units --type=target --all

## Obtener modo de arranque por defecto
systemctl get-default
graphical.target

## Setear un objetivo de arranque por defecto
systemctl set-default graphical.target
Removed /etc/systemd/system/default.target.
Created symlink /etc/systemd/system/default.target -> /usr/lib/systemd/system/graphical.target.

## Selección de un objetivo en tiempo de ejecucción
systemctl isolate multi-user.target

## Ver detalles de un objetivo
systemctl cat graphical.target

## Enmascarar un servicio (deshabilitarlo para que no se use)
systemctl mask nftables
```

#### 7.2 Repositorios YUM.
- Los repositorios software permiten la instalación de paquetes con la herramienta `yum`.

```bash
## Los archivos de los repositorios se guardan en
/etc/yum.repos.d/docker.repo
[docker-ce-stable]
name=Docker CE Stable - $basearch
baseurl=https://download.docker.com/linux/centos/7/$basearch/stable
enabled=1
gpgcheck=1
gpgkey=https://download.docker.com/linux/centos/gpg
 
## Agregar un repositorio
yum-config-manager --add-repo="http://dl.fedoraproject.org/pub/epel/8/x86_64"

## Instalar paquete de repositorio
rpm --import http://dl.fedoraproject.org/pub/epel/RPM-GPG-KEYEPEL-8
yum install http://dl.fedoraproject.org/pub/epel/8/x86_64/e/epelrelease-8-2.noarch.rpm

## Consultar repositorios
yum repolist all

## Ver un paquete
yum list rht-system

## Instalar un paquete
yum install ansible

## Instalar grupo de paquetes
yum group install "RPM Development Tools"

## Para buscar un paquete
yum search ansible

## Para obtener información de un paquete
yum info httpd

## Para buscar paquetes con coincidencias con /var/www/html
yum whatprovides /var/www/html

## Para actualizar un paquete
yum update kernel

## Borrar un paquete
yum remove httpd

## Logs de transacciones
/var/log/dnf.rpm.log

## Historial de transacciones
yum history

## Instalar rpm en local
yum install packete_86_64.rpm
```

#### 7.3 Hora y NTP.
- Servicio que sirve para sincronizar la hora con servidores ntp.
- El estrato de la fuente NTP determina su calidad, estando el reloj más preciso en `stratum 0` y un servidor que sincroniza a partir de un servidor NTP estando en `stratum 2`.

```bash
## Mostrar la hora y los parametros NTP
timedatectl

## Ver zonas horarias
timedatectl list-timezones

## Configurar una hora
timedatectl set-timezone America/Phoenix

## Activar la sincronzicación automática
timedatectl set-ntp true

## Ver las fuentes de CHROND
chronyc sources -v

## Fichero de configuración de chronyd
/etc/chrony.conf

## Configurar sincronización con servidor NTP
server classroom.example.com iburst

## Reiniciar servicio
systemctl restart chronyd

## Para averiguar la zona de un país se puede utilizar
tzselect
```

#### 7.4 Firewalld.
- Es un administrador de firewall dinámico para simplificar la administración del tráfico de la red.
- El control se realiza mediante zonas predefinidas `public`, `dmz`, `work`, etc, las cuales se pueden configurar.
- Los servicios contienen un conjunto de reglas predefinidas, que pueden agregarse sobre una zona para modificar las reglas de acceso. Se encuentran definidos en `/usr/lib/firewalld/services`.
- Los comandos se aplicarán en tiempo de ejecución a menos que se especifique `--permanent` como opción.

```bash
## Consultar la zona predeterminada
firewall-cmd --get-default-zone

## Configurar una zona predeterminada
firewall-cmd --set-default-zone=ZONA

## Mostrar todo los configurado para una zona
firewall-cmd --list-all [--zone=ZONE] 
firewall-cmd --list-all --permanent [--zone=ZONE] 

## Agregar el servicio a una zona
firewall-cmd --add-service=SERVICE [--zone=ZONE]

## Agregar puerto a una zona
firewall-cmd --add-port=86/tcp [--zone=ZONE]
firewall-cmd --add-port=86/tcp --permanent [--zone=ZONE]

## Recargar firewalld
firewall-cmd --reload
```

#### 7.5 Perfiles de ajuste tuned.
- Utilizamos el demonio tuned para ajustar el rendimiento del S.O.

```bash
## Instalar y habilitar tuned
yum install tuned
systemctl enable --now tuned

## Ver que perfil de ajuste se utiliza
tuned-adm active

## Listar perfiles disponibles
tuned-adm list

## Recomendar un perfil de ajuste
tuned-adm recommend

## Activar/desactivar perfil de ajuste
tuned-adm off
tuned-adm profile virtual-guest
```

#### 7.6 Nice/Renice.
- Cambian la prioridad con la que ejecuta un proceso.
- El nivel `-20` es el de máxima prioridad.
- El nivel `19` es el de mínima prioridad.

```bash
## Para iniciar un proceso con un `nivel bueno` que queramos
nice -n 15 sha1sum &

## Para cambiar el nivel bueno de un proceso
renice -n 15 <PID>
renice -n 15 3521
```

#### 7.7 Journalctl.
- Inspecciona los registros del sistema.

```bash
## Configurar almacenamiento persistente
vim /etc/systemd/journald.conf
	...output omitted...
	[Journal]
	Storage=persistent
	...output omitted...
## Reiniciar servicio
systemctl restart systemd-journald.service

## Para inspeccionar registros de error de un arranque anterior
journalctl -b -1 -p err

## Para inspeccionar registros
journalctl -xe

## Para un subsistema especifico
journalctl _SYSTEMD_UNIT=sshd.service _PID=1145

## Para inspeccionar un pid en concreto
journalctl -f _PID=2356

## Para inspeccionar parámetros con detalle
journalctl -o verbose
```

#### 7.8 SSH.

```bash
## Generar clave SSH
ssh-keygen -b 4096 -t rsa

## Copiar clave pública en authorized_keys del usuario en sistema remoto
ssh-copy-id root@10.10.0.5
```

#### 7.9 Enlaces duros
- Sólo se pueden utilizar entre archivos normales, no directorios ni archivos especiales.
- Sólo se pueden usar si ambos archivos están en el mismo sistema de archivos.
- Son dos referencias a un mismo inodo.

#### 7.10 RPM

```bash
## Listar paquetes instalados
rpm -qa

## Información del changelog de un paquete
rpm -q --changelog audit

## Instalación de un paquete
rpm -ivh paquete_x86_64.rpm

````

#### 7.11 Otros comandos de interés

```bash
## Configurar el hostname
hostnamectl set-hostname alberto1sample.com
hostnamectl status

## Configurar la vigencia de las contraseñas de usuarios
chage -m 0 -M 90 -W 7 -I 17 user03

## Para controlar por defecto la vigencia de las contraseñas para todos los usuarios creados en el sistema
/etc/login.defs

## Envío manual de mensajes syslog (al /var/log/boot.log)
logger -p local7.notice "Test message"

## Sincronizar un directorio en otro
rsync -av /var/log/ /tmp
rsync -av /var/log remotehost:/tmp

## Extraer el contenido de un paquete
rpm2cpio wonderwidgets-1.0-4.x86_64.rpm | cpio -id
rpm2cpio wonderwidgets-1.0-4.x86_64.rpm | cpio -id "*txt"

## LSOF enumera los archivos abiertos y el proceso que accede a ellos
lsof /mnt/data

## Buscar archivos con locate
locate passwd
## Si se quiere actualizar la BBDD donde busca (que no es en tiempo real)
updatedb

## Utilidades para realizar un informe del sistema
sosreport
kdump

## Para configurar el idioma del sistema
/etc/locale.conf
localectl set-locale LANG=fr_FR.utf8

## Temporizadores 
/usr/lib/systemd/system		 ## No modificar
/etc/systemd/system		 ## Copiar archivos *.timer

## Archivos clean
/usr/lib/tmpfiles.d/*.conf		 ## No modificar
/etc/tmpfiles.d/*.conf		 ## Copiar archivos *.conf
## Crear directorio /run/hello si no existe y purgar archivos mayores a 30 segundos
d /run/hello 0700 root root 30s
## Aplicar opciones de crear
systemd-tmpfiles --create /etc/tmpfiles.d/momentary.conf
## Aplicar opciones de limpiar
systemd-tmpfiles --clean /etc/tmpfiles.d/momentary.conf

## Listar información sobre los discos
blkid

## Listar formato de un dispotivo de bloque
file -s /dev/sda1

## Borrar tabla de particiones de un dispositivo
wipefs -a /dev/sda1
```