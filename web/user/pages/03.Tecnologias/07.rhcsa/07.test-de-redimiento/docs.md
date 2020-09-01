---
title: 'Test de redimiento'
---

## Fuente
[https://www.ibm.com/cloud/blog/using-fio-to-tell-whether-your-storage-is-fast-enough-for-etcd](https://www.ibm.com/cloud/blog/using-fio-to-tell-whether-your-storage-is-fast-enough-for-etcd)

## Pruebas rendimiento
```bash
## Prueba de rendimiento sobre discos SSD
[root@host tmp]# dd if=/dev/zero of=test1.img bs=1G count=1 oflag=dsync
1073741824 bytes (1,1 GB) copiados, 2,91631 s, 368 MB/s
```

## Prueba ioping
```bash
[root@test-iscsi-1 ~]# ioping -c 10 .
4 KiB <<< . (xfs /dev/dm-0): request=1 time=408.8 us (warmup)
4 KiB <<< . (xfs /dev/dm-0): request=2 time=831.0 us
4 KiB <<< . (xfs /dev/dm-0): request=3 time=801.3 us
4 KiB <<< . (xfs /dev/dm-0): request=4 time=786.6 us
4 KiB <<< . (xfs /dev/dm-0): request=5 time=570.6 us
4 KiB <<< . (xfs /dev/dm-0): request=6 time=602.5 us
4 KiB <<< . (xfs /dev/dm-0): request=7 time=647.0 us
4 KiB <<< . (xfs /dev/dm-0): request=8 time=634.8 us
4 KiB <<< . (xfs /dev/dm-0): request=9 time=765.5 us
4 KiB <<< . (xfs /dev/dm-0): request=10 time=691.1 us

--- . (xfs /dev/dm-0) ioping statistics ---
9 requests completed in 6.33 ms, 36 KiB read, 1.42 k iops, 5.55 MiB/s
generated 10 requests in 9.00 s, 40 KiB, 1 iops, 4.44 KiB/s
min/avg/max/mdev = 570.6 us / 703.4 us / 831.0 us / 89.8 us
```

## Prueba fio
```bash
## VM dominio iscsi:
[root@test-iscsi-1 ~]# fio --randrepeat=1 --ioengine=libaio --direct=1 --gtod_reduce=1 --name=test --filename=test --bs=1M --iodepth=64 --size=1G --readwrite=randrw --rwmixread=75
test: (g=0): rw=randrw, bs=(R) 1024KiB-1024KiB, (W) 1024KiB-1024KiB, (T) 1024KiB-1024KiB, ioengine=libaio, iodepth=64
fio-3.7
Starting 1 process
Jobs: 1 (f=1): [m(1)][100.0%][r=97.0MiB/s,w=30.0MiB/s][r=97,w=30 IOPS][eta 00m:00s]
test: (groupid=0, jobs=1): err= 0: pid=4265: Thu Jul  9 09:09:23 2020
   read: IOPS=98, BW=98.2MiB/s (103MB/s)(750MiB/7634msec)
   bw (  KiB/s): min=43008, max=108544, per=95.68%, avg=96256.00, stdev=15539.37, samples=15
   iops        : min=   42, max=  106, avg=94.00, stdev=15.18, samples=15
  write: IOPS=35, BW=35.9MiB/s (37.6MB/s)(274MiB/7634msec)
   bw (  KiB/s): min=14336, max=59392, per=95.10%, avg=34952.53, stdev=14050.33, samples=15
   iops        : min=   14, max=   58, avg=34.13, stdev=13.72, samples=15
  cpu          : usr=0.29%, sys=0.58%, ctx=710, majf=0, minf=7
  IO depths    : 1=0.1%, 2=0.2%, 4=0.4%, 8=0.8%, 16=1.6%, 32=3.1%, >=64=93.8%
     submit    : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
     complete  : 0=0.0%, 4=99.9%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.1%, >=64=0.0%
     issued rwts: total=750,274,0,0 short=0,0,0,0 dropped=0,0,0,0
     latency   : target=0, window=0, percentile=100.00%, depth=64

Run status group 0 (all jobs):
   READ: bw=98.2MiB/s (103MB/s), 98.2MiB/s-98.2MiB/s (103MB/s-103MB/s), io=750MiB (786MB), run=7634-7634msec
  WRITE: bw=35.9MiB/s (37.6MB/s), 35.9MiB/s-35.9MiB/s (37.6MB/s-37.6MB/s), io=274MiB (287MB), run=7634-7634msec

Disk stats (read/write):
    dm-0: ios=750/274, merge=0/0, ticks=315361/156325, in_queue=471686, util=9.48%, aggrios=750/274, aggrmerge=0/0, aggrticks=316264/159969, aggrin_queue=475725, aggrutil=9.46%
  sda: ios=750/274, merge=0/0, ticks=316264/159969, in_queue=475725, util=9.46%
  
## Segunda prueba
[root@host:_data__ssd]# fio --rw=write --ioengine=sync --fdatasync=1 --directory=./test --size=22m --bs=2300 --name=mytest
mytest: (g=0): rw=write, bs=(R) 2300B-2300B, (W) 2300B-2300B, (T) 2300B-2300B, ioengine=sync, iodepth=1
fio-3.7
Starting 1 process
mytest: Laying out IO file (1 file / 22MiB)
Jobs: 1 (f=1): [W(1)][100.0%][r=0KiB/s,w=1800KiB/s][r=0,w=801 IOPS][eta 00m:00s]
mytest: (groupid=0, jobs=1): err= 0: pid=37979: Wed Jul 22 15:33:30 2020
  write: IOPS=808, BW=1816KiB/s (1860kB/s)(21.0MiB/12402msec)
    clat (usec): min=48, max=1245, avg=61.61, stdev=17.30
     lat (usec): min=48, max=1245, avg=61.67, stdev=17.31
    clat percentiles (usec):
     |  1.00th=[   51],  5.00th=[   54], 10.00th=[   56], 20.00th=[   57],
     | 30.00th=[   58], 40.00th=[   59], 50.00th=[   60], 60.00th=[   61],
     | 70.00th=[   62], 80.00th=[   64], 90.00th=[   69], 95.00th=[   73],
     | 99.00th=[  122], 99.50th=[  128], 99.90th=[  143], 99.95th=[  161],
     | 99.99th=[  717]
   bw (  KiB/s): min= 1760, max= 1846, per=99.97%, avg=1815.54, stdev=22.28, samples=24
   iops        : min=  784, max=  822, avg=808.58, stdev= 9.88, samples=24
  lat (usec)   : 50=0.31%, 100=97.44%, 250=2.23%, 750=0.01%
  lat (msec)   : 2=0.01%
  fsync/fdatasync/sync_file_range:
    sync (usec): min=1017, max=2808, avg=1174.03, stdev=77.96
    sync percentiles (usec):
     |  1.00th=[ 1090],  5.00th=[ 1106], 10.00th=[ 1123], 20.00th=[ 1139],
     | 30.00th=[ 1139], 40.00th=[ 1156], 50.00th=[ 1156], 60.00th=[ 1172],
     | 70.00th=[ 1172], 80.00th=[ 1188], 90.00th=[ 1221], 95.00th=[ 1254],
     | 99.00th=[ 1467], 99.50th=[ 1565], 99.90th=[ 2024], 99.95th=[ 2409],
     | 99.99th=[ 2540]
  cpu          : usr=0.21%, sys=1.44%, ctx=30090, majf=0, minf=29
  IO depths    : 1=200.0%, 2=0.0%, 4=0.0%, 8=0.0%, 16=0.0%, 32=0.0%, >=64=0.0%
     submit    : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
     complete  : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
     issued rwts: total=0,10029,0,0 short=10029,0,0,0 dropped=0,0,0,0
     latency   : target=0, window=0, percentile=100.00%, depth=1
  ```