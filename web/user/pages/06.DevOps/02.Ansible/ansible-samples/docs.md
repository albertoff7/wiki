---
title: 'Ansible Samples'
published: true
visible: true
---

### 1. Ejemplos prácticos
#### 1.1 Mostrar variables de un bucle
```yaml
- name: Fact dump
  hosts: localhost
  user: alberto
  tasks:
   - name: Print all facts
     debug:
       var:  item.device
     loop: "{{ ansible_facts.mounts }}"
```

#### 1.2 Pausa de una reproducción

```yaml
# Pause for 5 minutes to build app cache.
- pause:
    minutes: 5
```

#### 1.3 Esperar a que levante instancia EC2

```yaml
  - name: Wait for SSH to come up
    wait_for:
      host: "{{ item.public_dns_name }}"
      port: 22
      delay: 60
      timeout: 320
      state: started
    with_items: "{{ ec2.instances }}"
```

#### 1.4 SSH sin confirmación (yes)

- Para desactivar el chequeo de SSH al agregar un host, dos opciones:

```yaml
## Ponemos variable de entorno en false
ANSIBLE_HOST_KEY_CHECKING=false

## Ponemos variable en ansible.cfg en false
host_key_checking = False
```

#### 1.5 Utilizar una clave .PEM para conectarse a un host remoto

- Una utilidad de éste punto es por ejemplo, crear una relación de confianza de forma automática.

```yaml
## Le pasamos en ejecución
ansible-playbook samples/5_aws-create-role/main.yml --private-key=/home/clave.pem

## En la reproducción
- name: Configuracion de la instancia AWS
  hosts: lab
  user: ec2-user
  vars:
    - ansible_ssh_private_key_file: /home/alberto/Descargas/redhatcertspainKEY.pem
```

#### 1.6 Leer de nuevo el inventario

- Cuando realizamos algún cambio sobre el inventario, es posible que necesitemos que ansible vuelva a releerlo. Para forzar esa nueva lectura, podemos agregar una tarea del tipo `meta: refresh_inventory`:

```yaml
  tasks:
    - import_tasks: tasks/provision.yml
    - meta: refresh_inventory
```

#### 1.7 Ansible ad-hoc

```bash
## Agregar usuario
ansible lab1 -m user -a "name=alberto state=present" --ask-pass

## Copiar clave en host
ansible lab1 -m authorized_key -a "user=alberto state=present key=\"{{ lookup('file', '/home/alberto/.ssh/id_rsa.pub') }}\"" --ask-pass

## Añadir usuario al sudoers
ansible lab1 -m lineinfile -a "path=/etc/sudoers state=present line=\"alberto	ALL=(ALL)	NOPASSWD: ALL\"" --ask-pass
```

#### 1.8 Combinar cláusulas when y with_items

```yaml
---
- name: Dar de alta usuarios
  hosts: lab1
  vars_files:
    - lock.yml
    - userslist.yml
  tasks:
    - name: Agregar cuando el usuario sea developer
      #user:
      #  name: "{{ item.username }}"
      debug:
        msg: "{{ item.username }}"
      with_items:
        - "{{ users }}"
      when: item.username == "Bill"
```

#### 1.9 Password desde archivo ansible vault

- xxx

```yaml
---
- name: Dar de alta usuarios en lab1
  hosts: lab1
  vars_files:
    - password_archive.yml
  tasks:
    - name: Agregar cuando el usuario
      user:
        name: alberto
        state: present
        password: "{{ var_password | password_hash ('sha512') }}"
```
#### 2.0 Condicionales JINJA2

```yaml
HOSTNAME="{{ ansible_hostname }}"
HOST_FQDN="{{ ansible_fqdn }}"
OS="{{ ansible_os_family }}"
BIOS_VERSION="{{ ansible_bios_version }}"
TOTAL_MEMORY_MB="{{ ansible_memtotal_mb }}"
{% if ansible_devices.xvda.size is defined %}
VDA_DISK_SIZE="{{ ansible_devices.xvda.size }}"
{% else %}
VDA_DISK_SIZE="NULO"
{% endif %}
{% if ansible_devices.xvdb.size is defined %}
VDB_DISK_SIZE="{{ ansible_devices.xvdb.size }}"
{% else %}
VDA_DISK_SIZE="NULO"
{% endif %}
```
#### 2.1 Variables hosts e inventario

```yaml
---
- name: PLAY TEST 16
  hosts: localhostgroup, redhat
  tasks:
    - name: DEBUG TEST
      debug:
        msg: "{{inventory_hostname }} {{ groups.redhat }}"
        
---
- name: PLAY TEST 16
  hosts: localhostgroup, redhat
  tasks:
    - name: DEBUG TEST
      debug:
        msg: "Hola {{ inventory_hostname }}"
      when: inventory_hostname in groups.redhat
```

#### 2.2 Crear un fichero de inventario con todos los nodos del inventario

```yaml
---
- name: PLAYBOOK 16
  hosts: all
  tasks:
    - name: Asegurarse de que existe el directorio /tmp2
      file:
        state: directory
        path: /tmp2

    - name: Generar lista de nodos
      template:
        src: templates/hosts.j2
        dest: /tmp2/nodes.txt

templates/hosts.j2
{% for mypersonalhost in groups.all %}
{{ mypersonalhost }}
{% endfor %}
```

#### 2.3 Otra forma de pasar una key en el módulo `authorized_key`

```yaml
## Tarea para configurar las instancias EC2 recien creadas
- name: Copiar clave ssh en hosts remotos
  authorized_key:
    user: ec2-user
    state: present
    key: "{{ item }}"
  with_file:
    - /root/.ssh/id_rsa.pub
```

#### 2.4 Plantilla para generar FQDN de todos los host del inventario


```yaml
{% for host in groups.real %}
{{ hostvars[host].ansible_fqdn }}
{% endfor %}
```

#### 2.5 Condicional when en base a variable

```yaml
---
- name: LAST
  hosts: redhat
  vars:
    - users:
        - username: cool1
          uid: 1201
        - username: cool2
          uid: 1202
        - username: cool3
          uid: 2201
        - username: cool4
          uid: 2202
  tasks:
    - name: PLAY
      user:
        name: "{{ item.username }}"
        uid: "{{ item.uid }}"
      when: item.uid is match("^1.*")
      loop: "{{ users }}"

```

#### 1.4 xxxx

- xxx

```yaml

```

#### 1.4 xxxx

- xxx

```yaml

```

#### 1.4 xxxx

- xxx

```yaml

```
