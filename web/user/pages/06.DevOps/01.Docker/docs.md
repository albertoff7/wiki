---
title: Docker
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

Docker es un proyecto de código abierto que automatiza el despliegue de aplicaciones dentro de contenedores de software, proporcionando una capa adicional de abstracción y automatización de virtualización de aplicaciones en múltiples sistemas operativos.​

### Instalación Centos
```bash
yum-config-manager --add-repo  https://download.docker.com/linux/centos/docker-ce.repo
dnf install https://download.docker.com/linux/centos/7/x86_64/stable/Packages/containerd.io-1.2.6-3.3.el7.x86_64.rpm -y
dnf install docker-ce -y
systemctl enable --now docker
curl -L "https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m)" -o docker-compose
mv docker-compose /usr/bin && chmod +x /usr/bin/docker-compose
```
### Comandos Docker
```bash
# Crear contenedor con utilizando red del host
docker build --network host -t <tag_name:v1.0> .

# Ver la IP de un contenedor
podman inspect -f "{{.NetworkSettings.IPAddress}}" nginx 

# Vaciar sistema de volumenes e imagenes obsoletas
docker system prune --all
docker system prune --volumes

# Borrar todos los contenedores // cuidado!!
docker rm -f $(docker ps -a -q)

# Correr un contenedor efimero
docker run -it -rm registry.access.redhat.com/ubi8/ubi:latest bash
```