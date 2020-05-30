---
title: Ovirt
---

## Actualizar Ovirt
- Primero el host Engine (que es la máquina de control, expone un portal web "Virtual Manager" para gestionar los nodos de ovirt).
```bash
engine-upgrade-check
yum update ovirt\*setup\*
yum upgrade
```
- Posteriormente actualizar cada nodo. Si se actualiza el kernel es necesario reinicio de la máquina.
- Ponemos en mantenimiento el nodo que queremos actualizar.
	- Desde consola gráfica.
	- Desde línea de comandos.
```bash
host-engine --set-maintenance --mode=local
```
- Actualizamos server.
	- Desde la consola gráfica (virtual manager), pulsando en actualizar.
	- Desde línea de comandos conectando por ssh al host a actualizar.
```bash
yum upgrade -y
```

## Gluster
### CMD utils
```bash
gluster peer status
systemctl status ovirt-ha-agent
systemctl restart vdsmd
gluster vol status
systemctl status gluster
gluster vol info engine
```

