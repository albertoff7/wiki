---
title: 'Ansible Docs'
body_classes: header-animated
visible: true
hero_classes: ''
hero_image: ''
content:
    items: '@self.children'
    limit: '5'
    order:
        by: date
        dir: desc
    pagination: '1'
    url_taxonomy_filters: '1'
---

### 1. Presentación e instalación.
#### 1.1 Presentación.
- Ansible es un lenguaje de automatización de código abierto impulsado por Redhat.
- No tiene agentes, es simple (lenguaje YAML), potente y permite automatizar tareas para equipos de diferentes S.O. y equipos de red (como un router cisco). 
- Utiliza el protocolo de red SSH para comunicarse con los nodos.
- Para ejecutar algunas tareas no será necesario ningún requisito en el host administrado, para otras, que el host administrado tenga python instalado.
- Algunos de sus casos de uso son, administración de configuraciones, implementación de aplicaciones, aprovisionamiento, entrega continua, seguridad y conformidad, orquestación.

Primer comando:
```bash
$ ansible all -m ping
15.236.89.88 | SUCCESS => {
    "ansible_facts": {
        "discovered_interpreter_python": "/usr/libexec/platform-python"
    },
    "changed": false,
    "ping": "pong"
}
```
#### 1.2 Instalación de ansible.
- Ansible debe instalarse en un nodo de control Linux/Unix desde el cual se ejecutará.
- Necesita Python 3 (versión 3.5 o posterior) o Python 2 (versión  2.7 o posterior) en el nodo de control.
- El método de instalación depende de su S.O. en linux normalmente agregar el repositorio e instalar con la herramienta de paquetes de la distribución.
- Docu oficial: [https://docs.ansible.com](https://docs.ansible.com)

```bash
$ ansible --version
ansible 2.9.7
  config file = /ALBERTO/software/ansible/ansible.cfg
  configured module search path = ['/root/.ansible/plugins/modules', '/usr/share/ansible/plugins/modules']
  ansible python module location = /usr/lib/python3.6/site-packages/ansible
  executable location = /bin/ansible
  python version = 3.6.8 (default, Nov 21 2019, 19:31:34) [GCC 8.3.1 20190507 (Red Hat 8.3.1-4)]

$ ansible -m setup localhost |grep -i ansible_python_version
        "ansible_python_version": "3.6.8",
```

### 2. Implementación I.
#### 2.1 Inventario.
- El inventario es el conjunto de hosts que ansible administra.
- El archivo por defecto del inventario es `/etc/ansible/hosts`.
- En runtime en la ejecución, se puede indicar un inventario manualmente `--inventory invent.txt` o `-i invent.txt`.
- También se puede especificar el inventario en la variable `inventory = invent.txt` del archivo `ansible.cfg`.
- Los hosts pueden agruparse en grupos y las playbooks aplicarse a grupos.

```bash
[web]
web1.alberto.ws
web2.alberto.ws
172.2.1.14

[db]
db1.alberto.ws
db2.alberto.ws
```

- Los grupos pueden contener grupos secundarios.
- Se pueden definir variables en el inventario que apliquen a hosts y/o grupos.
- Los inventarios estáticos utilizan un fichero de texto.
- Los inventarios dinámicos utilizan scripts que generan dinamicamente los hosts y grupos en base a condiciones.
- El grupo all contiene todos los hosts del inventario.

#### CMD Utils:
- **Grupos anidados**

```bash
[uk]
uk1.alberto.ws
uk2.alberto.ws

[spain]
spain01.alberto.ws
spain02.alberto.ws

[europe:children]
uk
spain
```

- **Rangos**

```bash
[uk]
uk[1:2].alberto.ws
[spain]
spain[01:02].alberto.ws
```

- **Listar hosts de un grupo**

```bash
$ ansible europe --list-hosts
 hosts (4):
uk1.alberto.ws
uk2.alberto.ws
spain01.alberto.ws
spain02.alberto.ws
```

- **Listar hosts sin grupo**

```bash
$ ansible ungrouped -i inventory --list-hosts
 [WARNING]: No hosts matched, nothing to do
 hosts (0):
```

#### 2.2 Archivos de configuración.
- La configuración de ansible se guarda en un archivo de nombre `ansible.cfg`.
- Sólo se utiliza un archivo de configuración (el de mayor precedencia), no se combinan si existen varios.

##### 2.2.1 Precedencia de archivos de configuración:
- Si la variable de entorno `ANSIBLE_CONFIG` está definida se utiliza el `ansible.cfg` al que apunte.
- Si no existe `ANSIBLE_CONFIG` y existe `./ansible.cfg` en el directorio actual `./`, se utiliza éste `ansible.cfg`.
- Si no existe `ANSIBLE_CONFIG`, ni `./ansible.cfg`, utiliza el archivo que esté en el home del usuario ` ~/.ansible.cfg`.
- Si no existe ninguno de los anteriores y existe en `/etc/ansible/ansible.cfg`, utiliza ese archivo.
- Si no existe ningún archivo, ansible utiliza valores predeterminados.

**Para ver que archivo de configuración se está utilizando.**
```bash
$ ansible --version
ansible 2.9.7
  config file = /ALBERTO/software/ansible/ansible.cfg

## o también con la opción -v

$ ansible all --list-hosts -v
Using /ALBERTO/software/ansible/ansible.cfg as config file
  hosts (1):
    15.236.89.88
```

##### 2.2.2 Parametros del archivo de configuración.
- El archivo ansible.cfg está divido en secciones, delimitadas por `[]`.
- Cada sección contiene parámetros definidos como clave-valor.
	- Sección `[defaults]` establece valores predeterminados para la operación de ansible.
```bash
[defaults]
inventory = ./inventory ;Ruta del archivo de inventario.
remote_user = user ;Nombre de usuario para iniciar en host remoto. Si no se indica se usa el actual.
ask_pass = false ;Si solicita pass SSH. Normalmente en false al existir relación de confianza.
```
	- Sección `[privilege_escalation]` configura la escalación de privilegios en hosts administrados.
```bash
[privilege_escalation]
become = true ;Si se debe cambiar de forma automática el usuario para la ejecución en el host remoto.
become_method = sudo ;Método utilizado, por lo general sudo o su.
become_user = root ;Usuario al que se cambia en el host administrado.
become_ask_pass = false ;Si se debe solicitar contraseña para become_method.
```

#### 2.3 Comandos Ad-Hoc.
- La ejecución de comandos Ad-Hoc está pensada para tareas rápidas que no necesiten ser guardadas.

```bash
ansible host-pattern -m module [-a 'module arguments'] [-i inventory]
```
- Los módulos son herramientas que utilizan los comandos ad-hoc para ejecutar tareas.
- La mayoría de módulos son idempotentes (se pueden ejecutar de forma segura varias veces).
- Si un comando ad hoc no especifica qué módulo usar con la opción -m, ansible usa el módulo command de facto.
- Si la ejecución requiere procesamiento de la shell, se puede usar el módulo `shell`.
- `command` y `shell` requieren python en el nodo administrado, como alternativa se puede usar el módulo `raw` típicamente usado con routers o para instalar python.
- Puede utilizar módulos privados o de terceros, ansible trata de buscarlos en `ANSIBLE_LIBRARY` o si no se estableció, mediante la palabra library en el `ansible.cfg`. También busca en el directorio actual `./library`. Para escribir módulos consultar [documentación](https://docs.ansible.com/ansible/latest/dev_guide/developing_modules.html)

**Para listar los modulos instalados en un sistema**
```bash
ansible-doc -l
```

**Para ver la documentación de un módulo**
```bash
ansible-doc <module>
ansible-doc ping

# Ver documentación de forma abreviada
ansible-doc -s yum
```

##### 2.3.1 Módulos ansible

- GENERAL => `command`: Ejecuta un comando en la línea de comandos del host administrado
- ARCHIVOS => `copy`: copiar un archivo local en el host administrado 
- ARCHIVOS => `file`: establecer permisos y otras propiedades de archivos
- ARCHIVOS => `lineinfile`: garantizar que una línea particular esté o no esté en un archivo
- ARCHIVOS => `synchronize`: sincronizar contenido usando rsync
- SOFTWARE => `package`: administrar los paquetes utilizando el gestor de paquetes nativo del sistema
- SOFTWARE => `yum`: administrar paquetes usando el administrador de paquetes YUM
- SOFTWARE => `apt`: administrar paquetes usando el administrador de paquetes APT
- SOFTWARE => `dnf`: administrar paquetes usando el administrador de paquetes DNF
- SOFTWARE => `gem`: administrar gems de Ruby
- SOFTWARE => `pip`: administrar paquetes de Python desde PyPI
- SISTEMA => `firewalld`: administrar puertos y servicios arbitrarios con firewalld
- SISTEMA => `reboot`: reiniciar una máquina
- SISTEMA => `service`: administrar servicios
- SISTEMA => `user`: agregar, eliminar y administrar cuentas de usuario
- RED => `get_url`: descargar archivos por HTTP, HTTPS o FTP
- RED => `nmcli`: administrar redes
- RED => `uri`: interactuar con servicios web

##### 2.3.2 Configuraciones línea de comandos ad-hoc.
- Las directivas en línea de comando prevalecen sobre las impuestas en archivos de configuración.

| Directiva | Opción línea de comandos |
| ---- | ---- |
| inventoy | `-i`|
| remote_user | `-u`|
| become | `--become, -b`|
| become_method | `--become-method`|
| become_user | `--become-user`|
| become_ask_pass | `--ask-become-pass, -K`|

#### CMD Utils

- **Para ejecutar un comando ad-hoc con varios argumentos**

```bash
$ ansible -m user -a 'name=alberto uid=4000 state=present' host1.alberto.ws
servera.lab.example.com | SUCCESS => {
 "ansible_facts": {
 "discovered_interpreter_python": "/usr/libexec/platform-python"
 },
 "changed": true,
 "comment": "",
 "createhome": true,
 "group": 4000,
 "home": "/home/alberto",
 "name": "alberto",
 "shell": "/bin/bash",
 "state": "present",
 "system": false,
 "uid": 4000
}
```

- **Para ejecutar un comando en host administrados (haciendo uso del módulo command)**

```bash
ansible redhat -m command -a /usr/bin/hostname -o
redhat1.alberto.ws | CHANGED | rc=0 >> (stdout) redhat1.alberto.ws
```

- **Para copiar texto a un archivo remoto**

```bash
ansible all -m copy -a 'content="Administrado por ANSIBLE\n" dest=/etc/motd' -u apache
```

- **Agregar relación de confianza a todos los hosts utilizando ansible**

```yaml
- name: Public key is deployed to managed hosts for Ansible
  hosts: all
  tasks:
    - name: Ensure key is in root's ~/.ssh/authorized_hosts
      authorized_key:
        user: root
        state: present
        key: '{{ item }}'
     with_file:
       - ~/.ssh/id_rsa.pub
```

- **Permitir que un usuario escale a root sin contraseña (en S.O.)**

```bash
# Dejando un archivo propiedad de root con permisos 0400 en el directorio `/etc/sudoers.d`
someuser ALL=(ALL) NOPASSWD:ALL
```

### 3. Implementación II.
#### 3.1 Guías/playbooks.
- Las guías permiten la ejecución de tareas complejas en un conjunto de hosts.
- Son un conjunto ordenado de tareas en formato `YAML`.
- Para aumentar el detalle de salida se pueden agregar `-v`, `-vv`, `-vvv`, `-vvvv`.
- Para ejecutar un simulacro (sin ejecutar la guía), utilizamos la opción `-C` en runtime.
- Para añadir varias reproducciones a una misma guía, copiamos la misma estructura a nivel `- name`.
- Al nivel de host y tasks, se pueden utilizar los atributos `remote_user`, `become`, `become_method`, `become_user`, que prevalecen sobre los definidos en `ansible.cfg`.

**Guía simple**

```yaml
---
- name: Configure important user consistently
  hosts: redhat
  
  tasks:
   - name: alberto exists with UID 4000
     user:
       name: alberto
       uid: 4000
       state: present
```

**Resultado**

```bash
ansible-playbook alta_user.yaml 

PLAY [Configure important user consistently] *********************************************************************

TASK [Gathering Facts] *********************************************************************************************
ok: [15.236.89.88]

TASK [alberto1 exists with UID 4000] ******************************************************************************
changed: [15.236.89.88]

PLAY RECAP *********************************************************************************************************
15.236.89.88               : ok=2    changed=1    unreachable=0    failed=0    skipped=0    rescued=0    ignored=0   
```

##### 3.1.1 Sintaxis
- **Líneas múltiples**

```yaml
include_newlines: |
 Example Company
 123 Main Street
 Atlanta, GA 30303
```
```yaml
fold_newlines: >
 This is an example
 of a long string,
 that will become
 a single sentence once folded.
```
- **Diccionarios**

```yaml
 name: svcrole
 svcservice: httpd
 svcport: 80
```
```yaml
 {name: svcrole, svcservice: httpd, svcport: 80}
```

- **Listas**

```yaml
 hosts:
 - servera
 - serverb
 - serverc
```
```yaml
hosts: [servera, serverb, serverc]
```

#### CMD Utils
- **Instalar y arrancar apache**

```yaml
---
- name: Install and start Apache HTTPD
  hosts: web
  tasks:
   - name: httpd package is present
     yum:
       name: httpd
       state: present
   - name: correct index.html is present
     copy:
       src: files/index.html
       dest: /var/www/html/index.html
   - name: httpd is started
     service:
       name: httpd
       state: started
       enabled: true
 ```
 
- **Guía con varias reproducciones**

```yaml
---
- name: Enable intranet services
  hosts: web
  become: yes
  tasks:
   - name: latest version of httpd and firewalld installed
     yum:
       name:
        - httpd
        - firewalld
       state: latest
   - name: test html page is installed
     copy:
       content: "Welcome to the example.com intranet!\n"
       dest: /var/www/html/index.html
   - name: firewalld enabled and running
     service:
       name: firewalld
       enabled: true
       state: started
   - name: firewalld permits access to httpd service
     firewalld:
       service: http
       permanent: true
       state: enabled
       immediate: yes
   - name: httpd enabled and running
     service:
       name: httpd
       enabled: true
       state: started
	   
-  name: Test intranet web server
   hosts: localhost
   become: no
   tasks:
    - name: connect to intranet web server
      uri:
        url: http://web.alberto.ws
        return_content: yes
        status_code: 200
 ```
 
### 4. Variables y hechos.
#### 4.1 Gestión de variables.
- Las variables se utilizan para gestionar valores dinámicos para un entorno en un proyecto Ansible.
- Pueden incluir `usuarios`, `paquetes`, `servicios`, `archivos`, `archivos de internet`.
- Los nombres válidos de las variables sólo pueden contener `letras`, `números` y `_`.
- Existen tres niveles de alcance:
	- Global scope: Establecidas en línea de comando o configuración Ansible.
	- Play scope: Establecidas en la reproducción playbook.
	- Host scope: Establecidas a nivel inventario en hosts y grupos de hosts.

##### 4.1.1 Precedencia.
Si la misma variable se define en varios niveles:
- Las variables a nivel línea de comando, tienen precedencia sobre el resto.
- Las variables definidas a nivel de guía playbook están en el siguiente nivel.
- Las definidas en inventario son las de menor precedencia.

##### 4.1.2 Definición de variables.
- Bloque vars al inicio de la guía.

```yaml
- hosts: all
  vars:
    user: joe
    home: /home/joe
```
- Ficheros externos, directiva `vars_files`.

```yaml
- hosts: all
  vars_files:
    - vars/users.yml
```
```bash
$ cat vars/users.yml

user: joe
home: /home/joe
```

- Variables de host en inventario.

```yaml
[web]
172.0.2.16 ansible_user=alberto
```

- Variables de grupo hosts en inventario.

```yaml
[web]
172.0.2.16
172.0.2.17

[servers:vars]
user=alberto
```
```yaml
[web]
web1.alberto.ws
web2.alberto.ws

[back]
back1.alberto.ws
back2.alberto.ws

[servers:children]
web
back

[servers:vars]
user=alberto
```

- Variables directorios `group_vars` y `hosts_vars`.
	- Crear archivo llamado ` group_vars/web` para definir variables del grupo web.
	- Crear archivo llamado ` host_vars/web1.alberto.ws` para definir variables del server web1.alberto.ws.
	- Los archivos anteriores también pueden ser directorios y alojar varios archivos.

```yaml
user: alberto
```

- Variables en runtime.

```bash
$ ansible-playbook main.yml -e "package=apache"
```

- Matrices como variables.
Dado la siguiente distribución de variables:

```yaml
users:
  alberto:
     first_name: Alberto
     last_name: Fernandez
     home_dir: /users/albertof
 ana:
    first_name: Ana
    last_name: Dud
    home_dir: /users/anad
```

Accedemos a ellas:

```yaml
# Returns 'Alberto'
users['alberto']['first_name']
# Returns '/users/anad'
users['ana']['home_dir']

# o alternativamente y menos recomendable

# Returns 'Alberto'
users.alberto.first_name
# Returns '/users/anad'
users.ana.home_dir
```

##### Estructura de un proyecto

```bash
project
├── ansible.cfg
├── group_vars
│ ├── datacenters
│ ├── datacenters1
│ └── datacenters2
├── host_vars
│ ├── demo1.example.com
│ ├── demo2.example.com
│ ├── demo3.example.com
│ └── demo4.example.com
├── inventory
└── playbook.yml
```


##### 4.1.3 Uso de variables.
Se debe colocar la variable entre corchetes y comillas dobles.

```yaml
name: "{{ user }}"
```

##### 4.1.4 Captura de salida de comando con variables registradas.
- Para capturar la salida de un comando podemos utilizar la declaración `register`.
- Para mostrar el resultado en una guía podemos utilizar `debug`.

```yaml
---
- name: Installs a package and prints the result
  hosts: all
  tasks:
   - name: Install the package
     yum:
       name: httpd
       state: installed
     register: install_result
     
   - name: Debug de la variable
     debug: var=install_result
```

#### 4.2 Secretos
- Variables cifradas, usualmente utilizadas para datos sensibles como contraseñas o claves API.
- Utilizamos la herramienta ansible-vault incluída con ansible por defecto.

##### 4.2.1 Gestión de secretos.
- Crear un archivo cifrado.

```bash
$ ansible-vault create secret.yml
New Vault password: contrasena
Confirm New Vault password: contrasena
```

La contraseña se puede introducir también desde un archivo, lo que abrirá en editor de texto predeterminado.
```bash
ansible-vault create --vault-password-file=archivo_pass.txt secret.yml
```

- Ver un archivo cifrado.

```bash
ansible-vault view secret.yml
ansible-vault view --vault-password-file=archivo_pass.txt secret.yml
```

- Edición de archivo existente.

```bash
$ ansible-vault edit secret.yml
```

- Cifrado de archivo existente

```bash
 ansible-vault encrypt secret1.yml secret2.yml
 
 # Para guardar el archivo cifrado en un nuevo archivo utilizamos (sólo para un archivo de entrada).
 ansible-vault encrypt secret1.yml --output=secret_cifrado.yml
```

- Descifrado de archivo existente.

```bash
$ ansible-vault decrypt secret1.yml --output=secret1-decrypted.yml
```

- Cambio de contraseña de un archivo cifrado.

```bash
$ ansible-vault rekey secret.yml
$ ansible-vault rekey --new-vault-password-file=NEW_VAULT_PASSWORD_FILE secret.yml
```

- Al ejecutar una guía que acceda a archivos cifrados es necesario proporcionar la password.

```bash
$ ansible-playbook --vault-id @prompt site.yml
$ ansible-playbook  --vault-password-file=archivo_pass_sin_cifrar.txt site.yml
```

##### Buenas prácticas variables y secretos.

```bash
.
├── ansible.cfg
├── group_vars
│ └── webservers
│ └── vars
├── host_vars
│ └── demo.example.com
│ ├── vars
│ └── vault
├── inventory
└── playbook.yml
```

#### 4.3 Gestión de datos.
- Variables detectadas automáticamente por Ansible en un host administrado.
- Usualmente sirven para ejecutar una acción en playbooks condicionado según el valor de la variable.
- Datos recopilados pueden ser `nombre de host`, `kernel`, `IP`, `interfaces red`, `S.O.`, `CPU`, `RAM`, `Disco libre`.

**Imprimir datos recopilados en `ansible facts`.**

```bash
$ ansible webserver -m setup
```
```yaml
- name: Fact dump
  hosts: all
  tasks:
   - name: Print all facts
     debug:
        var: ansible_facts
```
```bash
[root@localhost ansible]# ansible-playbook facts.yml 

PLAY [Fact dump] *********************************************************************************************************************************

TASK [Gathering Facts] ***************************************************************************************************************************
ok: [15.236.89.88]

TASK [Print all facts] ***************************************************************************************************************************
ok: [15.236.89.88] => {
    "ansible_facts": {
        "all_ipv4_addresses": [
            "172.31.36.14",
            "172.18.0.1",
            "172.17.0.1"
```

**Ejemplos de variables**
```bash
ansible_facts['hostname']
ansible_facts['fqdn']
ansible_facts['default_ipv4']['address']
ansible_facts['devices']['vda']['partitions']['vda1']['size']
```

**Desactivar recopilación de datos**
```yaml
---
- name: This play gathers no facts automatically
  hosts: large_farm
  gather_facts: no
 
# Para activar la recopilación de datos, más adelante en la misma reproducción:
 tasks:
 - name: Manually gather facts
   setup:
```

##### 4.3.1 Datos personalizados en `ansible_facts`.
- Son datos personalizados que se recopilan como ansible_facts con el resto de datos.
- Se crean incluyendo en `/etc/ansible/facts.d` un archivo en formato `INI` de extensión `.fact`.

```yaml
[packages]
web_package = httpd
db_package = mariadb-server
[users]
user1 = joe
user2 = jane
```
```bash
# Para recuperar los datos:
$ ansible demo1.example.com -m setup
```

### 5. Control de tareas.
#### 5.1 Bucles.
- La iteración de una tarea sobre un conjunto de elementos se realiza utilizando `loop`.
- Alguna formas anteriores a ansible 2.5 de realizar bucles son utilizando `with_items`, `with_file`, `with_sequence`.

```yaml
- name: Postfix and Dovecot are running
  service:
     name: "{{ item }}"
     state: started
  loop:
     - postfix
     - dovecot
```

- Bucle utilizando variables.

```yaml
vars:
  mail_services:
     - postfix
     - dovecot
tasks:
  - name: Postfix and Dovecot are running
    service:
       name: "{{ item }}"
       state: started
    loop: "{{ mail_services }}"
```

- Bucle utilizando una lista de hashes o diccionarios

```yaml
- name: Users exist and are in the correct groups
  user:
    name: "{{ item.name }}"
    state: present
    groups: "{{ item.groups }}"
  loop:
    - name: jane
      groups: wheel
    - name: joe
      groups: root
```

- Variables de registro con bucles.

```yaml
---
- name: Loop Register Test
  gather_facts: no
  hosts: localhost
  tasks:
    - name: Looping Echo Task
      shell: "echo This is my item: {{ item }}"
      loop:
        - one
        - two
      register: echo_results
     
   - name: Show echo_results variable
     debug:
        var: echo_results
```

#### 5.2 Tareas condicionales.
- Los condicionales permiten la ejecución de tareas en base a si un host cumple una condición específica.
- Para ejecutar condicionales utilizamos la cláusula `when`. Si se cumple la condición, se ejecuta la tarea.

**Condición si una variable es booleana**

```yaml
---
- name: Simple Boolean Task Demo
  hosts: all
  vars:
      run_my_task: true
 tasks:
     - name: httpd package is installed
       yum:
           name: httpd
       when: run_my_task
```

**Condición si una variable tiene un valor**

```yaml
---
- name: Test Variable is Defined Demo
  hosts: all
  vars:
    my_service: httpd
  tasks:
    - name: "{{ my_service }} package is installed"
      yum:
          name: "{{ my_service }}"
      when: my_service is defined
```

**Otros ejemplos de condicionales**

|OPERACIÓN| EJEMPLO|
|------|------|
|Igual (el valor es una cadena) |ansible_machine == "x86_64"|
|Igual (el valor es numérico) |max_memory == 512|
|Menor que |min_memory < 128|
|Mayor que |min_memory > 256|
|Menor que o igual a |min_memory <= 256|
|Mayor que o igual a |min_memory >= 512|
|No es igual a |min_memory != 512|
|La variable existe |min_memory is defined|
|La variable no existe |min_memory is not defined|
|La variable booleana es true, los valores de 1, True, o yes son true.| memory_available|
|La variable booleana es false. Los valores de 0, False, o no son false. |not memory_available|
|El valor de la primera variable está presente como valor en la lista de la segunda variable|ansible_distribution in supported_distros|

```yaml
---
- name: Demonstrate the "in" keyword
  hosts: all
  gather_facts: yes
  vars:
     supported_distros:
       - RedHat
       - Fedora
  tasks:
     - name: Install httpd using yum, where supported
       yum:
         name: http
         state: present
  when: ansible_distribution in supported_distros
```

**Varios condicionales**

- Cuando una de las dos declaraciones es verdadera.

```yaml
when: ansible_distribution == "RedHat" or ansible_distribution == "Fedora"
```

- Cuando ambas declaraciones deben ser vedaderas para que se cumpla la condición.

```yaml
when: ansible_distribution_version == "7.5" and ansible_kernel == "3.10.0-327.el7.x86_64"
```

```yaml
when:
  - ansible_distribution_version == "7.5"
  - ansible_kernel == "3.10.0-327.el7.x86_64"
```

- Cuando agrupamos varias condiciones y/o bucles.

```yaml
when: >
    ( ansible_distribution == "RedHat" and
    ansible_distribution_major_version == "7" )
    or
    ( ansible_distribution == "Fedora" and
    ansible_distribution_major_version == "28" )
```

```yaml
- name: install mariadb-server if enough space on root
  yum:
     name: mariadb-server
     state: latest
  loop: "{{ ansible_mounts }}"
  when: item.mount == "/" and item.size_available > 300000000
```

#### 5.3 Handlers.
- Los manejadores son tareas que responden a una notificación que desencadena otra tarea.
- Las tareas notifican a los manejadores cuando se produce algún cambio en el host administrado.
- Cada manejador tiene un nombre único y se ejecuta al final de la lista de tareas de la playbook.
- Una tarea tiene que declarar que notifica al manejador si quiere que se ejecute.
- Si se declara varias veces, sólo se ejecuta una vez al final de las tareas de la playbook.
- Usualmente utilizados para reiniciar servicios y hosts.
- Se ejecutan por el orden indicado en la sección handlers.

```yaml
tasks:
 - name: copy demo.example.conf configuration template
   template:
      src: /var/lib/templates/demo.example.conf.template
      dest: /etc/httpd/conf.d/demo.example.conf
   notify:
     - restart mysql
     - restart apache
  
handlers:
 - name: restart mysql
   service:
     name: mariadb
     state: restarted
 - name: restart apache
   service:
     name: httpd
     state: restarted
```

#### 5.4 Manejo de fallos.

- Por defecto si una tarea falla, ansible cancela el resto de la playbook en ese host.
- Puede forzar que una playbook siga ejecutandose si una tarea falla con `ignore_errors: yes`.

```yaml
- name: Latest version of notapkg is installed
  yum:
    name: notapkg
    state: latest
  ignore_errors: yes
```

- Puede forzar los manejadores si una tarea falla con `force_handlers: yes`.

```yaml
---
- hosts: all
  force_handlers: yes
  tasks:
   - name: a task which always notifies its handler
     command: /bin/true
     notify: restart the database
     
   - name: a task which fails because the package doesn't exist
     yum:
        name: notapkg
        state: latest
        
  handlers:
   - name: restart the database
     service:
        name: mariadb
        state: restarted
```

- Se puede marcar una tarea como fallida si cumple una condición o si utiliza el módulo fail (para ejecutar tareas intermedias).

```yaml
tasks:
 - name: Run user creation script
   shell: /usr/local/bin/create_users.sh
   register: command_result
   failed_when: "'Password missing' in command_result.stdout"
```

```yaml
tasks:
 - name: Run user creation script
   shell: /usr/local/bin/create_users.sh
   register: command_result
   ignore_errors: yes
   
 - name: Report script failure
   fail:
     msg: "The password is missing in the output"
   when: "'Password missing' in command_result.stdout"
```

**Changed**

- Cuando una tarea realiza un cambio en un host administrado, informa el estado `changed` y notifica a los handlers.
	- Si queremos eliminar esa modificación utilizaremos `changed_when: false`, la tarea sólo reportará ok o failed.

```yaml
 - name: get Kerberos credentials as "admin"
   shell: echo "{{ krb_admin_pass }}" | kinit -f admin
   changed_when: false
```

- Para informar `changed` según la salida del módulo recopilada en una variable.

```yaml
tasks:
 - shell:
      cmd: /usr/local/bin/upgrade-database
   register: command_result
   changed_when: "'Success' in command_result.stdout"
   notify:
      - restart_database
      
handlers:
 - name: restart_database
   service:
      name: mariadb
      state: restarted
```

#### 5.5 Bloques.

- Los bloques agrupan tareas de forma lógica y pueden controlar la ejecución de esta agrupación con condicionales.
- La cláusula `rescue` define las tareas que se ejecutarán si falla la cláusula block.
- La cláusula `always` define las tareas que se ejecutarán siempre, independientemente del éxito o fallo del `block` o `rescue`.
- La condición `when` se aplica también a las cláusulas `rescue` y `always` si existen.

```yaml
- name: block example
  hosts: all
  tasks:
   - name: installing and configuring Yum versionlock plugin
     block:
      - name: package needed by yum
        yum:
           name: yum-plugin-versionlock
           state: present
      - name: lock version of tzdata
        lineinfile:
           dest: /etc/yum/pluginconf.d/versionlock.list
           line: tzdata-2016j-1
           state: present
      when: ansible_distribution == "RedHat"
```
```yaml
 tasks:
 - name: Upgrade DB
   block:
      - name: upgrade the database
        shell:
            cmd: /usr/local/lib/upgrade-database
            
   rescue:
      - name: revert the database upgrade
        shell:
            cmd: /usr/local/lib/revert-database
            
   always:
      - name: always restart the database
        service:
           name: mariadb
           state: restarted
```

### 6. Implementación de archivos en hosts administrados.
#### 6.1. Módulos Ansible de archivos.
- `blockinfile` : Inserte, actualice o elimine un bloque de texto multilínea
- `copy` : Copiar archivo de la máquina local o remota a una ubicación en un host administrado. Permitido SELinux.
- `fetch` : Recupera archivos de máquinas remotas al nodo de control.
- `file` : Establecer atributos a un archivo. Propiedad, contextos SELinux, permisos, enlaces, directorios, etc.
- `lineinfile` : Asegura que una línea exista en un archivo o reemplace una existente con una expersión regular.
- `stat` : Recupera información de un archivo.
- `synchronize` : Módulo entorno a rsync.

**Existe un archivo en host administrados**

```yaml
- name: Touch a file and set permissions
  file:
    path: /path/to/file
    owner: user1
    group: group1
    mode: 0640
    state: touch
```

**Modificación de atributos e un archivo**

```yaml
- name: SELinux type is set to samba_share_t
  file:
    path: /path/to/samba_file
    setype: samba_share_t
```

**Cambios en el contexto SELinux persistentes**

```yaml
- name: SELinux type is persistently set to samba_share_t
 sefcontext:
 target: /path/to/samba_file
 setype: samba_share_t
 state: present
```

**Línea en un archivo**

```yaml
- name: Add a line of text to a file
  lineinfile:
    path: /path/to/file
    line: 'Add this line to the file'
    state: present
```

**Bloque en un archivo**

```yaml
- name: Add additional lines to a file
  blockinfile:
    path: /path/to/file
    block: |
       First line in the additional block of text
       Second line in the additional block of text
    state: present
```

**Sincronizar archivos**

```yaml
- name: synchronize local file to remote files
  synchronize:
    src: file
    dest: /path/to/file
```

#### 6.2. Plantillas Jinja2

```yaml
```

```yaml
```

### 7. Administración de proyectos grandes.
- Patrones de hosts.
- Inventarios dinámicos.
- Paralelismos.
- Inclusión e importación de archivos.

### 8. Roles.
- Estructura del rol.
- Roles de sistema.
- Creación de roles.
- Ansible Galaxy.

### 9. Resolución de problemas.
- Solución de problemas en playbooks.
- Solución de problemas en hosts.

### 10. Automatización de tareas RHCSA.
- Software y subscripciones.
- Usuarios y autenticación.
- Arranque y procesos programados.
- Almacenamiento.
- Configuración de red.