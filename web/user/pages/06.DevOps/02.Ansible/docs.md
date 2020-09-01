---
title: Ansible
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

Ansible es una plataforma de software libre para configurar y administrar ordenadores. Combina instalación multi-nodo, ejecuciones de tareas ad hoc y administración de configuraciones. Adicionalmente, Ansible es categorizado como una herramienta de orquestación.

## MAIN:
### Instalar ansible (centos 8)
```bash
yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm -y
yum install ansible -y
```

```bash
# Ping
ansible all -m ping

# Recuperar ansible facts
ansible all -m setup
```
