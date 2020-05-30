---
title: Openshift
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

OpenShift, formalmente llamado Openshift Container Platform, es un producto de computación en la nube de plataforma como servicio de Red Hat. Los desarrolladores pueden usar Git para desplegar sus aplicaciones Web en los diferentes lenguajes de la plataforma.

#### Ver logs de CRI-O/kubelet de un nodo
```bash
oc adm node-logs -u crio my-node-name
oc adm node-logs -u kubelet my-node-name
```

#### Ver registros journal de un nodo RedHatCoreOS
```bash
oc adm node-logs my-node-name
```

#### Acceder a un nodo (alternativa a SSH)
```bash
[alberto@redhat ~]$ oc debug node/my-node-name
...output omitted...
# chroot /host
# systemctl is-active kubelet
```
#### Comprobar el estado de un deployment
```bash
oc rollout status deployment tiller
```

#### Comandos sobre un pod
```bash
oc get pod
oc status
oc get events
oc describe pod
oc logs my-pod-name -c my-container-name
oc get pod --log-level 10
oc whoami -t ### Obtener token
oc adm top node -l node-role.kubernetes.io/worker
oc get pod -n <project_name>
oc adm node-logs --tail 3 -u kubelet ip-10-0-140-84.us-west-1.compute.internal
```

#### Aplicar plantilla RAW (github) de una instalación
```bash
TILLER_NAMESPACE=tiller-project
oc process -f https://github.com/openshift/origin/raw/master/examples/helm/tiller-template.yaml -p TILLER_NAMESPACE="${TILLER_NAMESPACE}" | oc create -f -
```

#### Comandos machine
```bash
# Obtener los machinsets
oc get machinesets -n openshift-machine-api
NAME                          DESIRED   CURRENT   READY   AVAILABLE   ...
ocp-qz7hf-worker-us-west-1b   1         1         1       1           ...
ocp-qz7hf-worker-us-west-1c   1         1         1       1           ...
```

#### Compilación comandos
```bash
# Ejecutar nginx dentro de un pod
command: ["sh", "-c", "echo VERSION 1.0 desde $HOSTNAME > /usr/share/nginx/html/index.html && nginx -g 'daemon off;'"]

# Crear una app nueva desde un repositorio docker
oc new-app --name mysql --docker-image registry.access.redhat.com/rhscl/mysql-57-rhel7:5.7-47
oc new-app --name netdata --docker-image netdata/netdata

# Crear secreto
oc create secret generic mysql --from-literal user=myuser --from-literal password=redhat123 --from-literal database=test_secrets --from-literal hostname=mysql 

# Crear un proyecto
* La creación de un proyecto también crea un NS con el mismo nombre *
oc new-proyect desa1

# Ver caracteristicas de un proyecto
oc describe project desa1
oc get project desa1 -o yaml
oc get projects -l tipo=desa 

# Aplicar cambios de un yaml
oc apply -f first.yml

# Crear un namespace
* La creación de un namespace también crea un proyecto *
oc create namespace desa4

# Para conceder privilegios de ROOT a los contenedores
oc adm policy add-scc-to-user anyuid -z default

# Para cambiarse de proyecto
oc project desa1

# Para crear un pod (Generator con las nuevas versiones)
oc run --generator=run-pod/v1 nginx --image=nginx

# Para recuperar los pods
oc get pods
oc get pods -o wide
oc describe pod nginx
oc get pod nginx -o yaml

# Para recuperar logs de un pod
oc logs nginx

# Para recuperar todos los objetos de un proyecto
oc get all

# Para recuperar los servicios
oc get svc
oc get describe svc servicio1

# Para recuperar un imagestream
oc get is

# Parar recuperar las rutas
oc get route blog

# Escalar replicas
oc scale --replicas=3 dc blog

# Borrar un pod
oc delete pod blog-1-g89rd

# Borrar objetos en base a un selector
oc delete all -o name -l app=blog
oc get all --selector app=web -o name

# Crear app utilizando dockerfile
oc new-app --name blog3 --strategy=docker https://github.com/apasofttraining/blog

# Editar un DeploymentConfig
oc edit dc ejemplo1

# Recuperar variables de un pod o dc
oc set env dc/ejemplo1 --list

# Agregar variables a un dc
oc set env dc/ejemplo1 RESPONSABLE=pedro

# Sobreescribir variable
oc set env dc/ejemplo1 --overwrite RESPONSABLE=Ramon

# Eliminar variable desde linea de comandos
oc set env dc/ejemplo RESPONSABLE-

# Crear configMap desde linea de comandos
oc create configmap cf1 --from-literal=usuario=usu1 --from-literal=password=secret

# Crear configMap desde archivo de texto
ARCHIVO.env
VAR1=Valor1
VAR2=Valor2
oc create configmap postgres-cm --from-env-file ARCHIVO.env

# Crear recurso desde github en una linea (onliner)
curl -kL https://github.com/sample/sampleRecurse/raw 2>/dev/null | oc apply -n openshift --as system:admin -f -

# Ver imagenes de openshift
oc adm top images

# Entrar dentro del contenedor
oc exec -it c1-w42mj bash

# Importar una imagen a un repositorio interno
oc import-image odoo:13

# Etiquetar una imagen de un repositorio externo
oc tag docker.io/odoo:12 odoo:12
```

#### Términos
```bash
# Proyectos: Un namespace de kubernetes en el que también entran objetos de openshift como rutas, DC, BC, etc.
# Pod: Objeto mínimo para desplegar un contenedor
# Imagestream: Directorio de imagenes apunta a diferentes versiones de las imagenes que queremos desplegar. 
  Ventaja: al cambiar la imagen, se puede actualizar de una forma automática. 
# DeploymentConfig: Objeto que crea un ReplicationControler que se encarga de mantener las replicas indicadas
  de un determinado pod (en base a una imagen de nuestra aplicación).
  La diferencia con un Deployment (kubernetes) es que DC es innovador y tiene ampliada la funcionalidad (desencadenantes)
  pero no ha sido aceptado para sustituir a Deployment por la comunidad Opensource del proyecto, por lo que crear un
  Deployment en vez de un DC nos daría una mayor portabilidad para el futuro.
# ImageBuilder: Constructor de imagen que utiliza un lenguaje de programacion predeterminado para construir nuestra app.
  Existen ImageBuilder por defecto para muchos lenguajes como ruby, php, python, java, etc. También podemos crearlos nosotros.
# BuildConfig: Configuracion de construccion de la imagen basada en el ImageBuilder y el codigo fuente de la app.
# ImageStreamTag: Son diferentes versiones de un ImagenStream.
# ImageStream: Intermediario entre pod e imagen real.
```