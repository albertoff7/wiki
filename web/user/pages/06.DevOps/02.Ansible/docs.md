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
```bash
# Ping
ansible all -m ping

# Recuperar ansible facts
ansible all -m setup
```
