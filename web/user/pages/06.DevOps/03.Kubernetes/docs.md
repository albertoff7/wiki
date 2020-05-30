---
title: Kubernetes
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

Kubernetes es un sistema de código libre para la automatización del despliegue, ajuste de escala y manejo de aplicaciones en contenedores​ que fue originalmente diseñado por Google y donado a la Cloud Native Computing Foundation. Soporta diferentes entornos para la ejecución de contenedores, incluido Docker.

## Objetos:
- **Roles**: Un rol es una definición de objetos (Pod, Deployment, etc) y acciones (listar, crear, editar, etc) que se aplican sobre un Namespace.
- **ClusterRole**: Lo mismo que un rol pero se aplica sobre el cluster entero, de forma que los objetos pueden ser de cualquier Namespace.
-  **RoleBinding/ClusterRoleBinding**: Es un objeto que relaciona y asigna el Rol al *subject* (usuario, grupo o ServiceAcount).

## MAIN:
```bash
# Ver configuracion (contexto)
kubectl config view

# Ver nodos
kubectl get nodes

# Ver el estado de un rollout para un deployment
kubectl rollout status deployment deployment-test

# Ver pods filtrados por label
kubectl get pods -l app=front -o wide

# Aplicar una configuracion
kubectl apply -f ejemplo1_nginx.yml 

# Obtener servicios con label front
kubectl get svc -l app=front

# Ver si RBAC esta habilitado
kubectl cluster-info dump |grep authorization-mode
```
### Namespaces
```bash
# Obtener namespaces
kubectl get namespaces

## CONTEXTOS
# Establecer la preferencia de espacio de nombres. 
# Indicar de forma permanente el namespace para llamadas futuras con kubectl.
kubectl config set-context --current --namespace=<insert-namespace-name-here>
kubectl config view | grep namespace:

# También se podría crear un contexto, para lo cual hay que indicar cluster, usuario etc.
# Si creaste un contexto, para cambiar a el ejecuta
kubectl config use-context contexto_xxx

# Obtener pods de un namespace en concreto
kubectl get pods --namespace namespace_xxx
kubectl get pods -n namespace_xxx

# Crear namespaces
kubectl create namespaces test
```

### Certificados (creacion de usuarios para un cluster kubernetes)
```bash
# Generar llaves y firma
openssl genrsa -out alberto.key 2048
openssl req -new -key alberto.key -out alberto.csr -subj "/CN=alberto/O=grupo1"
# Para identificar donde está el CA en el cluster kubernetes
kubectl config view|grep certificate-auth
openssl x509 -req -in alberto.csr -CA /root/.minikube/ca.crt -CAkey /root/.minikube/ca.key -CAcreateserial -out alberto.crt -days 500
openssl x509 -in alberto.crt -noout -text

# Isolated env
kubectl config view|grep server
docker run -rm -ti -v $PWD:/test -w /test -v /root/.minikube/ca.crt:/ca.crt -v /usr/bin/kubectl:/usr/bin/kubectl alpine sh

# Configurar kubectl para el usuario
kubectl config set-cluster minikube --server=https://192.168.1.140:8443 --certificate-authority=/ca.crt
kubectl config set-credentials alberto --client-certificate=alberto.crt --client-key=alberto.key
kubectl config set-context alberto --cluster=minikube --user=alberto
kubectl config use-context alberto
```