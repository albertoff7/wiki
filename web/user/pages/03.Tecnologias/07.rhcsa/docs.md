---
title: RHCSA
---

### Comandos útiles
```bash
## Listar información sobre HW (discos por ejemplo)
$ lshw -class disk
  *-disk
       description: ATA Disk
       product: VBOX HARDDISK
       vendor: VirtualBox
       physical id: 0.0.0
       bus info: scsi@2:0.0.0
       logical name: /dev/sda
       version: 1.0
       serial: VBbc6fb6e6-ad49f2a9
       size: 30GiB (32GB)
       capabilities: partitioned partitioned:dos
       configuration: ansiversion=5 logicalsectorsize=512 sectorsize=512 signature=24a9ac0f
      
## Ver discos sin lsblk
cat /proc/partitions
major minor  #blocks  name
   8     0   78125000 sda
   8     1     104391 sda1
   8     2   78019672 sda2
 253     0   78019156 dm-0
 253     1   72581120 dm-1
 253     2    5406720 dm-2
 
## Listar discos con fdisk 
fdisk -l
   Device Boot      Start         End      Blocks   Id  System
/dev/sda1   *           1          13      104391   83  Linux
/dev/sda2              14        9726    78019672+  8e  Linux LVM

## Ver multipath
multipath -l
```